<?php

namespace App\Http\Controllers;

use Auth;
use MyLib;
use App\User;
use Http\Requests;
use App\Models\Pesan;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Events\UserMengirimPesan;

class PesanController extends Controller
{

    public function index()
    {
        $users     = User::Where('role',2)->get();
        $pesan     = Pesan::Where([['pengirim', 'admin'],  ['id_peserta',Auth::user()->id]])->orderBy('created_at', 'desc')->paginate(8);
        $terkirim  = Pesan::Where([['pengirim', 'peserta'],['id_peserta',Auth::user()->id]])->orderBy('created_at', 'desc')->paginate(8);
        return view('pesan.pesan', compact('users', 'pesan', 'terkirim'));
    }


    public function detail($id)
    {
        $pesan  = Pesan::Where('id_pesan', $id)->get()->first();
        return view('pesan.detail', compact('pesan'));
    }


    public function send(Request $request)
    {
        Pesan::create([
            'id_peserta' => Auth::user()->id,
            'subjek' => $request->subject,
            'pesan_teks' => $request->pesan,
            'lampiran' => MyLib::LampiranPesan($request),
            'pengirim' => 'peserta',
        ]);  event(new UserMengirimPesan());
        return redirect('/pesan')->with('message', 'Pesan berhasil dikirim!');
    }


    public function reply(Request $request, $id)
    {
        Pesan::create([
            'id_peserta' => Auth::user()->id,
            'subjek' => $request->subject,
            'pesan_teks' => $request->pesan,
            'lampiran' => MyLib::LampiranPesan($request),
            'pengirim' => 'peserta',
            'jenis_pesan' => 'reply',
        ]);  event(new UserMengirimPesan());
        return redirect('/pesan')->with('message', 'berhasil membalas pesan!');
    }

}
