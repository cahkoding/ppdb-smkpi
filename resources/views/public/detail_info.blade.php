@extends('layouts.app')

@section('konten')

  <div class="card">
    <div class="card-content">
      <div class="card-title left-align indigo-text"><strong>{{$info->title}}</strong></div>
      <div class="card-action ">
        {{-- <textarea required  id="isi_info" class="materialize-textarea"  name="isi_info">{{$info->text}}</textarea> --}}
        <span>{{$info->text}}</span>
        <span>{{$info->lampiran}}</span>
      </div>
    </div>
  </div>

@endsection
