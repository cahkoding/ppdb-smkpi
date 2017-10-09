@extends('layouts.dash_admin')

@section('konten')
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
