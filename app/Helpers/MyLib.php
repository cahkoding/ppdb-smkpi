<?php

namespace App\Helpers;
use Auth;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class MyLib
{
    public static function getUser() {return Auth::user()->id;}
    public static function getProfile() {return $profile=Profile::Where('user_id', Auth::user()->id)->get()->first();}


    public static function LampiranPesan($request)
    {
        $filename=null;
        if ($request->file('lampiran')!=null) {
            $filename = time().'_'.$request->file('lampiran')->getClientOriginalName();
            $request->file('lampiran')->storeAs('public/lampiran', $filename);
        }
        return $filename;
    }


    public static function LampiranBiodata($request)
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


}
