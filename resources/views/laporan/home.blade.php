@extends('layouts.dash_admin')

@section('konten')

<div class="col s12 m12 l9">

  <div class="row">
    <div class="col s11">
      <!-- Modal Upload Foto -->

      @extends('layouts.uploadModal')

      <h4>Control Panel Informasi</h4>
      <center>
          {!! $chart->render() !!}
      </center>
    </div>


  </div>
</div>
@endsection
