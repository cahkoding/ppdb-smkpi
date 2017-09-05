<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;

use Auth;
use Http\Requests;
use App\Models\Nilai;
use App\Models\Profile;
use App\Models\Tahun;
use App\Models\Pekerjaan;
use PDF;


class UserController extends Controller
{

    public function biodata()
    {
        $id=Auth::user()->id;
        $profile = Profile::Where('user_id',$id)->get()->first();
        $nilai   = Nilai::Where('user_id',$id)->get()->first();
        $tahun   = Tahun::all();
        $pekerjaan = Pekerjaan::all();
        return view('peserta.biodata', compact('profile','tahun','pekerjaan','nilai'));
    }

    public function simpan(Request $request)
    {

        if ($request->file('lampiran')!=null) {
            if($request->tmp_lampiran!=null){
                Storage::delete('public/lampiran/'.$request->tmp_lampiran);
            }
            $filename = time().'_'.$request->file('lampiran')->getClientOriginalName();
            $request->file('lampiran')->storeAs('public/lampiran', $filename);
        }else{
            $filename = ($request->tmp_lampiran!=null) ? $request->tmp_lampiran : '';
        }


        Profile::Where('user_id',Auth::user()->id)->update([
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'asal_sekolah' => $request->asal,
            'no_peserta_un'=> $request->no_un,
            'tahun_id'=> $request->tahun,
            'berat_badan' => $request->berat,
            'tinggi_badan'=> $request->tinggi,
            'jenis_kelamin' => $request->jenkel,
            'agama' => $request->agama,
            'alamat'=> $request->alamat,
            'ortu_wali'=> $request->ortu_wali,
            'pekerjaan_id'=> $request->pekerjaan,
            'lampiran'=> $filename,
        ]);

        Nilai::Where('user_id',Auth::user()->id)->update([
            'ipa' => $request->n_ipa,
            'matematika' => $request->n_math,
            'bahasa_indonesia' => $request->n_bindo,
            'bahasa_inggris'=> $request->n_bing,
        ]);
        return redirect('/biodata_saya')->with('message','Data Berhasil disimpan!');
    }

    public function upload(Request $request)
    {
        $this->validate($request, ['foto_upload' => 'mimes:jpeg,jpg,png|max:150|required']);
        if($request->tmp_foto!=null){
            Storage::delete('public/foto/'.$request->tmp_foto);
        }

        $filename_ = time().'_'.$request->file('foto_upload')->getClientOriginalName();
        $filename  = str_replace(' ', '_', $filename_);
        $request->file('foto_upload')->storeAs('public/foto', $filename);

        Profile::Where('user_id',Auth::user()->id)->update(['foto'=>$filename]);
        return redirect('/biodata_saya')->with('message','Berhasil Upload Foto!');
    }

    public function cetakForm()
    {
        $id=Auth::user()->id;
        $profile = Profile::Where('user_id',$id)->get()->first();
        $nilai   = Nilai::Where('user_id',$id)->get()->first();
        $pdf=PDF::loadView('pdf.formulir', compact('profile', 'nilai'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('formulir.pdf');
    }
}
