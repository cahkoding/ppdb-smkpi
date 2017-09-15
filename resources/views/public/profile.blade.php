@extends('layouts.app')

@section('konten')

  <ul class="collapsible popout" data-collapsible="expandable">
     <li>
       <div class="collapsible-header"><i class="material-icons">school</i>Tentang Sekolah</div>
       <div class="collapsible-body"><p align="justify">{{$tentang_sekolah->teks}}</p></div>
     </li>
     <li>
       <div class="collapsible-header"><i class="material-icons">whatshot</i>Visi & Misi</div>
       <div class="collapsible-body"><p align="justify">{{$visi_misi->teks}}</p></div>
     </li>
     <li>
       <div class="collapsible-header"><i class="material-icons">place</i>Lokasi</div>
       <div class="collapsible-body"><p align="justify">{{$lokasi->teks}}</p></div>
     </li>
  </ul>
  <br>


@endsection
