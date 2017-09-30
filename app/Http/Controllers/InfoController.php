<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;

use Auth;
use App\Models\Info;
use App\Models\Profile;

class InfoController extends Controller
{
    //
    public function index()
    {
        $profile = Profile::Where('user_id',Auth::user()->id)->get()->first();
        $info = Info::paginate(8);
        return view('info.info', compact('info', 'profile'));
    }

    public function create()
    {
        $profile = Profile::Where('user_id',Auth::user()->id)->get()->first();
        return view('info.create', compact('profile'));
    }

    public function store(Request $request)
    {
        $filename=null;
        if ($request->file('lampiran')!=null) {
            $filename = time().'_'.$request->file('lampiran')->getClientOriginalName();
            $request->file('lampiran')->storeAs('public/lampiran', $filename);
        }
        $gambar=null;
        if ($request->file('gambar')!=null) {
            $gambar = time().'_'.$request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/foto', $gambar);
        }

        Info::create([
            'author' => Auth::user()->id,
            'title' => $request->title,
            'text' => $request->isi_info,
            'lampiran' => $filename,
            'gambar' => $gambar,
        ]);

        return redirect('/info')->with('message', 'Berhasil menambahkan info!');
    }

    public function destroy($id)
    {
        $info = Info::find($id);
        Info::destroy($id);
        return redirect('/info')->with('message', 'Info "'.$info->title.'" telah dihapus!');
    }

    public function show($id)
    {
        $profile = Profile::Where('user_id',Auth::user()->id)->get()->first();
        $info = Info::find($id);
        return view('info.show', compact('info', 'profile'));
    }

    public function update(Request $request, $id)
    {
        //validasi lampiran
        if ($request->file('lampiran')!=null) {
            if($request->tmp_lampiran!=null){
                Storage::delete('public/lampiran/'.$request->tmp_lampiran);
            }
            $filename = time().'_'.$request->file('lampiran')->getClientOriginalName();
            $request->file('lampiran')->storeAs('public/lampiran', $filename);
        }else{
            $filename = ($request->tmp_lampiran!=null) ? $request->tmp_lampiran : null;
        }
        //validasi gambar
        if ($request->file('gambar')!=null) {
            if($request->tmp_gambar!=null){
                Storage::delete('public/foto/'.$request->tmp_gambar);
            }
            $gambar = time().'_'.$request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/foto', $gambar);
        }else{
            $gambar   = ($request->tmp_gambar!=null) ? $request->tmp_gambar : null;
        }

        Info::find($id)->update([
            'title'=> $request->title,
            'text' => $request->isi_info,
            'lampiran' => $filename,
            'gambar' => $gambar,
        ]);

        return redirect('info/'.$id)->with('message', 'Info berhasil disimpan!');
    }

}
