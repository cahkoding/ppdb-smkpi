<?php

namespace App\Helpers;
use App\Models\Profile;
use Auth;

class MyLib
{
    public static function getUser()
    {
        return Auth::user()->id;
    }

    public static function getProfile()
    {
        return $profile=Profile::Where('user_id', Auth::user()->id)->get()->first();
    }


}
