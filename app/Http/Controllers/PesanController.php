<?php

namespace App\Http\Controllers;

use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Pesan;
use Http\Requests;
use App\User;
use Auth;


class PesanController extends Controller
{
    public function index()
    {
        $id=Auth::user()->id;
        $users     = User::Where('role',2)->get();
        $pesan     = Pesan::Where([['pengirim', 'admin'],['id_peserta',$id]])->orderBy('created_at', 'desc')->paginate(8);
        $terkirim  = Pesan::Where([['pengirim', 'peserta'],['id_peserta',$id]])->orderBy('created_at', 'desc')->paginate(8);
        return view('pesan.pesan', compact('users', 'pesan', 'terkirim'));
    }

    public function detail($id)
    {
      $pesan  = Pesan::Where('id_pesan', $id)->get()->first();
      return view('pesan.detail', compact('pesan'));
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

      Telegram::sendMessage([
          'chat_id' => '410626437',
          'text' => 'Anda memiliki pesan dari user yang harus segera dijawab!'
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
