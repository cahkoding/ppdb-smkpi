@extends('layouts.dash_admin')

@section('konten')

<div class="col s12 m12 l9">

  <div class="row">
    <div class="col s11">
      <!-- Modal Upload Foto -->

      @extends('layouts.uploadModal')

      <h4>daftar peserta</h4>

      <table class="striped responsive-table">
         <thead>
           <tr>
               <th>ID Registrasi</th>
               <th>Nama</th>
               <th>Asal Sekolah</th>
               <th>Status Verifikasi</th>
               <th style="text-align:center;">Status Kelulusan</th>
               <th style="text-align:center;">Tools</th>
           </tr>
         </thead>

         <tbody>
           @foreach ($users as $user)
             <tr>
               <td>{{$user->profile->id_registrasi}}</td>
               <td>{{$user->profile->nama}}</td>
               <td>{{$user->profile->asal_sekolah}}</td>
               <td>{{$user->profile->status_verifikasi}}</td>
               <td style="text-align:center;">{{$user->profile->status_kelulusan}}</td>
               <td>
                 <a href="edit/{{$user->profile->user_id}}"><i class="material-icons black-text">mode_edit</i></a>
                 <a href="hapus/{{$user->profile->user_id}}" onclick="return confirm('hapus peserta {{$user->profile->nama}}?')">
                   <i class="material-icons black-text">delete_forever</i>
                 </a>
                 <a href="cetakform/{{$user->profile->user_id}}"><i class="material-icons black-text">print</i></a>
               </td>
             </tr>
           @endforeach
         </tbody>
       </table>
       {{$users->links('vendor.pagination.default')}}
    </div>


  </div>
</div>
@endsection
