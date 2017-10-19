<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SimpanRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Pekerjaan;
use App\Models\Profile;
use App\Models\Pesan;
use App\Models\Nilai;
use App\Models\Tahun;
use App\User;
use PDF;
use Auth;
use MyLib;

class AdminController extends Controller
{
    public function index()
    {
        $profile = Profile::Where('user_id',Auth::user()->id)->get()->first();
        return view('admin.home', compact('profile'));
    }

    public function peserta()
    {
        $profile = Profile::Where('user_id',Auth::user()->id)->get()->first();
        $users = User::Where('role','<>',2)->paginate(7);
        return view('admin.peserta', compact('users', 'profile'));
    }

    public function cetakForm($id)
    {
        $tahun   = Tahun::all();
        $pekerjaan = Pekerjaan::all();
        $nilai   = Nilai::Where('user_id',$id)->get()->first();
        $profile = Profile::Where('user_id',$id)->get()->first();
        $pdf=PDF::loadView('pdf.formulir', compact('profile', 'nilai', 'pekerjaan', 'tahun'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('formulir.pdf');
    }

    public function hapus($id)
    {
        $profile = Profile::Where('user_id',$id)->get()->first();
        User::destroy($id);
        return redirect('/peserta')->with('destroy_message', 'Peserta '.$profile->nama.' telah dihapus!');
    }

    public function edit($id)
    {
        $profile = Profile::Where('user_id',$id)->get()->first();
        $nilai   = Nilai::Where('user_id',$id)->get()->first();
        $tahun   = Tahun::all();
        $pekerjaan = Pekerjaan::all();
        return view('admin.edit', compact('profile','tahun','pekerjaan','nilai'));
    }

    public function update(SimpanRequest $request, $id)
    {
        Profile::Where('user_id',$id)->update([
          'nama' => $request->nama,
          'tempat_lahir' => $request->tempat_lahir,
          'tanggal_lahir'=> $request->tanggal_lahir,
          'jenis_kelamin' => $request->jenkel,
          'gol_darah' => $request->gol_darah,
          'berat_badan' => $request->berat,
          'tinggi_badan'=> $request->tinggi,
          'alamat'=> $request->alamat,
          'agama' => $request->agama,
          'asal_sekolah' => $request->asal_sekolah,
          'alamat_sekolah' => $request->alamat_sekolah,
          'tahun_id'=> $request->tahun,
          'no_hp'=>$request->no_hp,
          // Data ortu
          'nama_ayah' => $request->nama_ayah,
          'nama_ibu' => $request->nama_ibu,
          'no_ortu'=>$request->no_ortu,
          'pekerjaan_ayah' => $request->pekerjaan_ayah,
          'pekerjaan_ibu' => $request->pekerjaan_ibu,
          'alamat_ortu'=> $request->alamat_ortu,
          // 'lampiran'=> MyLib::UpdateLampiran($request),
        ]);

        Nilai::Where('user_id',$id)->update([
          'ipa' => $request->n_ipa,
          'matematika' => $request->n_math,
          'bahasa_indonesia' => $request->n_bindo,
          'bahasa_inggris'=> $request->n_bing,
        ]);
        return redirect('edit/'.$id)->with('message','Data Berhasil disimpan!');
    }


    public function pesan()
    {
      $users     = User::Where('role','<>',2)->get();
      $profile = Profile::Where('user_id',Auth::user()->id)->get()->first();
      $pesan     = Pesan::Where('pengirim', 'peserta')->orderBy('created_at', 'desc')->paginate(8);
      $terkirim  = Pesan::Where('pengirim', 'admin')->orderBy('created_at', 'desc')->paginate(8);
      return view('admin.pesan', compact('users', 'profile', 'pesan', 'terkirim'));
    }

    public function pesan_detail($id)
    {
      $profile = Profile::Where('user_id',Auth::user()->id)->get()->first();
      $pesan  = Pesan::Where('id_pesan', $id)->get()->first();
      return view('admin.pesan_detail', compact('profile', 'pesan'));
    }

    public function send(Request $request)
    {
      Pesan::create([
          'id_peserta' => $request->userid,
          'id_admin' => Auth::User()->id,
          'subjek' => $request->subject,
          'pesan_teks' => $request->pesan,
          'lampiran' => MyLib::UploadLampiran($request),
          'pengirim' => 'admin',
      ]);
      return redirect('/pesan_admin')->with('message', 'Pesan berhasil dikirim!');
    }

    public function reply(Request $request, $id)
    {
      Pesan::create([
          'id_admin' => Auth::user()->id,
          'id_peserta' => $request->id_peserta,
          'subjek' => $request->subject,
          'pesan_teks' => $request->pesan,
          'lampiran' => MyLib::UploadLampiran($request),
          'pengirim' => 'admin',
          'jenis_pesan' => 'reply',
      ]);
      return redirect('/pesan_admin')->with('message', 'berhasil membalas pesan!');
    }

    public function hasil_seleksi()
    {
        $profile = Profile::Where('user_id',Auth::user()->id)->get()->first();
        return view('admin.hasil_seleksi', compact('profile'));
    }

    public function cetakLap()
    {
        $users = User::Where('role','<>',2)->get();
        $pdf=PDF::loadView('pdf.calonsiswa_terdaftar', compact('users'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('calonsiswa_terdaftar.pdf');
    }
}
