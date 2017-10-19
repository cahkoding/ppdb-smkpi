<?php

namespace App\Helpers;
use Auth;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class MyLib
{
    public static function getUser() {return Auth::user()->id;}
    public static function getProfile() {return $profile=Profile::Where('user_id', Auth::user()->id)->get()->first();}


    public static function UploadLampiran($request)
    {
        $filename=null;
        if ($request->file('lampiran')!=null) {
            $filename = time().'_'.$request->file('lampiran')->getClientOriginalName();
            $request->file('lampiran')->storeAs('public/lampiran', $filename);
        }
        return $filename;
    }

    public static function UploadGambar($request)
    {
        $gambar=null;
        if ($request->file('gambar')!=null) {
            $gambar = time().'_'.$request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/foto', $gambar);
        }
        return $gambar;
    }

    public static function UpdateLampiran($request)
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
        return $filename;
    }

    public static function UpdateGambar($request)
    {
        if ($request->file('gambar')!=null) {
            if($request->tmp_gambar!=null){
                Storage::delete('public/foto/'.$request->tmp_gambar);
            }
            $gambar = time().'_'.$request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/foto', $gambar);
        }else{
            $gambar   = ($request->tmp_gambar!=null) ? $request->tmp_gambar : null;
        }
        return $gambar;
    }

}
