<?php

namespace App\Http\Controllers;

use Auth;
use MyLib;
use App\Models\Profile;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
  public function tentang_sekolah()
  {
      $tentang_sekolah = Sekolah::Where('title', 'Tentang Sekolah')->get()->first();
      return view('sekolah.tentang_sekolah', compact('tentang_sekolah'), ['profile'=>MyLib::getProfile()]);
  }


  public function tentang_sekolah_store(Request $request)
  {
      Sekolah::Where('id', 1)->update(['teks'=>$request->teks]);
      return redirect('/tentang_sekolah')->with('message','Data Berhasil disimpan!');
  }


  public function visi_misi()
  {
      $visi_misi = Sekolah::Where('title', 'Visi & Misi')->get()->first();
      return view('sekolah.visi_misi', compact('visi_misi'), ['profile'=>MyLib::getProfile()]);
  }


  public function visi_misi_store(Request $request)
  {
      Sekolah::Where('id', 2)->update(['teks'=>$request->teks]);
      return redirect('/visi_misi')->with('message','Data Berhasil disimpan!');
  }


  public function lokasi()
  {
      $lokasi = Sekolah::Where('title', 'Lokasi')->get()->first();
      return view('sekolah.lokasi', compact('lokasi'), ['profile'=>MyLib::getProfile()]);
  }


  public function lokasi_store(Request $request)
  {
      Sekolah::Where('id', 3)->update(['teks'=>$request->teks]);
      return redirect('/lokasi')->with('message','Data Berhasil disimpan!');
  }


  public function pengaturan_ppdb()
  {
      return view('pengaturan.pengaturan_ppdb', ['profile'=>MyLib::getProfile()]);
  }


  public function pengaturan_telegramBot()
  {
      return view('pengaturan.pengaturan_telegrambot', ['profile'=>MyLib::getProfile()]);
  }


}
