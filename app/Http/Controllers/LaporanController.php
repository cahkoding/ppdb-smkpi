<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use Http\Requests;
use Charts;
use App\Models\Profile;
use Auth;

class LaporanController extends Controller
{


    //
    public function index()
    {
      $id=Auth::user()->id;
      $profile = Profile::Where('user_id',$id)->get()->first();
      $chart = Charts::create('pie', 'highcharts')
        ->title('Diagram')
        ->labels(['laki-laki', 'Perempuan'])
        ->values([55,64])
        ->dimensions(500,500)
        ->responsive(false);

      return view('laporan.home', compact('chart', 'profile'));
    }
}
