<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Pesan;
use Http\Requests;
use Auth;


class PesanController extends Controller
{
    public function index()
    {
        $id=Auth::user()->id;
        $profile = Profile::Where('user_id',$id)->get()->first();
        $pesan     = Pesan::Where([['pengirim', 'admin'],['id_peserta',$id]])->orderBy('created_at', 'desc')->paginate(8);
        $terkirim  = Pesan::Where([['pengirim', 'peserta'],['id_peserta',$id]])->orderBy('created_at', 'desc')->paginate(8);
        return view('pesan.pesan', compact('profile', 'pesan', 'terkirim'));
    }

    public function detail($id)
    {
      $profile = Profile::Where('user_id',Auth::user()->id)->get()->first();
      $pesan  = Pesan::Where('id_pesan', $id)->get()->first();
      return view('pesan.detail', compact('profile', 'pesan'));
    }

    public function send(Request $request)
    {
      $filename=null;
      if ($request->file('lampiran')!=null) {
          $filename = time().'_'.$request->file('lampiran')->getClientOriginalName();
          $request->file('lampiran')->storeAs('public/lampiran', $filename);
      }

      Pesan::create([
          'id_peserta' => Auth::user()->id,
          'subjek' => $request->subject,
          'pesan_teks' => $request->pesan,
          'lampiran' => $filename,
          'pengirim' => 'peserta',
      ]);

      return redirect('/pesan')->with('message', 'Pesan berhasil dikirim!');
    }

    public function reply(Request $request, $id)
    {
      $filename=null;
      if ($request->file('lampiran')!=null) {
          $filename = time().'_'.$request->file('lampiran')->getClientOriginalName();
          $request->file('lampiran')->storeAs('public/lampiran', $filename);
      }

      Pesan::create([
          'id_peserta' => Auth::user()->id,
          'subjek' => $request->subject,
          'pesan_teks' => $request->pesan,
          'lampiran' => $filename,
          'pengirim' => 'peserta',
          'jenis_pesan' => 'reply',
      ]);

      return redirect('/pesan')->with('message', 'berhasil membalas pesan!');
    }

}
