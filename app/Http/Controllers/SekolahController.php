<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah;
use App\Models\Profile;
use Auth;

class SekolahController extends Controller
{
  public function tentang_sekolah()
  {
      $profile = Profile::Where('user_id',Auth::user()->id)->get()->first();
      $tentang_sekolah = Sekolah::Where('title', 'Tentang Sekolah')->get()->first();
      return view('sekolah.tentang_sekolah', compact('tentang_sekolah', 'profile'));
  }

  public function tentang_sekolah_store(Request $request)
  {
      Sekolah::Where('id', 1)->update(['teks'=>$request->teks]);
      return redirect('/tentang_sekolah')->with('message','Data Berhasil disimpan!');
  }

  public function visi_misi()
  {
      $profile = Profile::Where('user_id',Auth::user()->id)->get()->first();
      $visi_misi = Sekolah::Where('title', 'Visi & Misi')->get()->first();
      return view('sekolah.visi_misi', compact('visi_misi', 'profile'));
  }

  public function visi_misi_store(Request $request)
  {
      Sekolah::Where('id', 2)->update(['teks'=>$request->teks]);
      return redirect('/visi_misi')->with('message','Data Berhasil disimpan!');
  }

  public function lokasi()
  {
      $profile = Profile::Where('user_id',Auth::user()->id)->get()->first();
      $lokasi = Sekolah::Where('title', 'Lokasi')->get()->first();
      return view('sekolah.lokasi', compact('lokasi', 'profile'));
  }

  public function lokasi_store(Request $request)
  {
      Sekolah::Where('id', 3)->update(['teks'=>$request->teks]);
      return redirect('/lokasi')->with('message','Data Berhasil disimpan!');
  }


  public function pengaturan_ppdb()
  {
    $profile = Profile::Where('user_id',Auth::user()->id)->get()->first();
    return view('pengaturan.pengaturan_ppdb', compact('profile'));
  }

  public function pengaturan_telegramBot()
  {
    $profile = Profile::Where('user_id',Auth::user()->id)->get()->first();
    return view('pengaturan.pengaturan_telegrambot', compact('profile'));
  }


}
