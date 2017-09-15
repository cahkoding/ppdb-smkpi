@extends('layouts.app')

@section('konten')

  <table class="striped responsive-table">
     <thead>
       <tr>
           <th>ID Registrasi</th>
           <th>Nama</th>
           <th>Asal Sekolah</th>
           <th>Status Verifikasi</th>
           <th style="text-align:center;">Status Kelulusan</th>
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
         </tr>
       @endforeach
     </tbody>
   </table>
   {{$users->links('vendor.pagination.default')}}

@endsection
