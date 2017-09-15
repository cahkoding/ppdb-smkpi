@extends('layouts.dash_admin')

@section('konten')
  <div id="upload" class="modal offset-l1 col s9 m9 l3">
    <div class="center-align modal-content">
      {{-- <h4>Modal Header</h4> --}}
      @php
        $avatar = ($profile->foto!='') ?  asset('storage/foto/'.$profile->foto) : "/img/default_ava.png";
      @endphp
      <img id="preview" class="center-align" width="200px" class="circle" src="{{$avatar}}">
      <form class="form-horizontal" role="form" method="post" action="/upload" enctype="multipart/form-data">
          {{ csrf_field() }}
        <input required id="input1" type="file" name="foto_upload" class="input" accept="image/*"  onchange="tampilkanPreview(this,'preview')" />
        <input type="hidden" name="tmp_foto" value="{{$profile->foto}}">
    </div>
    <div class="modal-footer">
      <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="upload">
        <i class="material-icons left">file_upload</i>Upload</a>
      </button>
      <button onclick="batalUpload('{{$avatar}}')" type="reset" class="modal-action modal-close waves-effect waves-green btn-flat" name="reset">
        <i class="material-icons left">close</i>Cancel</a>
      </button>
    </form>
    </div>
  </div>



  <!-- konten -->
  <div class="col s12 m12 l9"> <!-- Note that "m8 l9" was added -->
    <h4>DASHBOARD ADMIN</h4>
    <hr>
      <div class="col s5">
          <a href="/sekolah">
          <div class="card">
            <div class="card-content black white-text">
                <strong><i class="material-icons left">school</i>SEKOLAH</strong>
            </div>
          </div>
          </a>
      </div>

      <div class="col s5">
        <a href="/peserta">
          <div class="card">
            <div class="card-content black white-text">
                <strong><i class="material-icons left">perm_identity</i>PESERTA</strong>
            </div>
          </div>
        </a>
      </div>

      <div class="col s5">
        <a href="/info">
          <div class="card">
            <div class="card-content black white-text">
                <strong><i class="material-icons left">info</i>INFORMASI</strong>
            </div>
          </div>
        </a>
      </div>

      <div class="col s5">
        <a href="/laporan">
          <div class="card">
            <div class="card-content black white-text">
                <strong><i class="material-icons left">book</i>LAPORAN</strong>
            </div>
          </div>
        </a>
      </div>
  </div>

@endsection
