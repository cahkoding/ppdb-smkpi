<?php

namespace App\Http\Controllers;
use PDF;
use Auth;
use MyLib;
use App\User;
use App\Models\Pesan;
use App\Models\Nilai;
use App\Models\Tahun;
use App\Models\Profile;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;
use App\Http\Requests\SimpanRequest;
use Illuminate\Support\Facades\Storage;

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
        $users = Profile::paginate(7);
        return view('admin.peserta', compact('users', 'profile'));
    }

    public function admin_user()
    {
        $profile = Profile::Where('user_id',Auth::user()->id)->get()->first();
        $users = User::whereIn('role',[2,3])->paginate(7);
        return view('admin.user_admin', compact('profile', 'users'));
    }

    public function tambah_admin_user()
    {
        $profile = Profile::Where('user_id',Auth::user()->id)->get()->first();
        return view('admin.tambah_user_admin', compact('profile'));
    }

    public function store_admin_user(UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
        return redirect('/admin/user')->with('message', $request->email.' Berhasil ditambahkan!');
    }

    public function apply(Request $request)
    {
        // by KhihadySucahyo, Kalo Objek manggil onbjek gaperlu diekstrak objeknya wkwk
        $arr = array_merge(array_map('intval', array_slice($request->id, 0)));
        $users = Profile::whereIn('user_id', [$arr])->update(['status_diterima'=>'Lulus']);
        return redirect()->back()->with('message','Berhasil apply!');
    }

    public function cari_peserta(Request $request)
    {
        $par=$request->search;
        $profile = Profile::Where('user_id',Auth::user()->id)->get()->first();
        $users = Profile::Where('no_peserta','like',"%{$par}%")
                        ->orWhere('nama','like',"%{$par}%")
                        ->orWhere('asal_sekolah','like',"%{$par}%")
                        ->paginate(7);
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
        $profile = User::Where('id',$id)->get()->first();
        User::destroy($id);
        return redirect()->back()->with('destroy_message', 'Peserta '.$profile->email.' telah dihapus!');
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
