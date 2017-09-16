@extends('layouts.dash_admin')

@section('konten')

<div class="col s12 m12 l9">

  <div class="row">
    <div class="col s11">
      <!-- Modal Upload Foto -->

      @extends('layouts.uploadModal')

        <div class="card">
          <div class="card-content">
            <div class="card-title left-align indigo-text"><strong>{{$tentang_sekolah->title}}</strong></div>
            <div class="card-action ">
              <form class="form-horizontal" role="form" method="post" action="/tentang_sekolah" enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <div class="row">
                      <div class="input-field col s12">
                          <textarea  id="teks" name="teks" class="materialize-textarea" >{{$tentang_sekolah->teks}}</textarea>
                      </div>
                  </div>

                  <div class="row">
                      <div class="input-field col s12">
                          <span>Gambar:
                            @if ($tentang_sekolah->gambar=='')
                                Tidak ada gambar
                            @else
                            <a href="{{ asset('storage/lampiran/'. $pesan->lampiran) }}">
                            <i class="material-icons">insert_drive_file</i> {{$pesan->lampiran}}</a>
                            @endif
                          </span>
                      </div>
                  </div>

                  <div class="row">
                      <div class="input-field col s12">
                          <span>Lampiran:
                            @if ($tentang_sekolah->lampiran=='')
                                Tidak ada lampiran
                            @else
                            <a href="{{ asset('storage/lampiran/'. $tentang_sekolah->lampiran) }}">
                            <i class="material-icons">insert_drive_file</i> {{$tentang_sekolah->lampiran}}</a>
                            @endif
                          </span>
                      </div>
                  </div>

                  <div class="row">
                      <div class="input-field offset-s12">
                        <button  type="submit" class="btn btn-primary right indigo">
                          <i class="material-icons right">save</i>Simpan
                        </button>
                      </div>
                  </div>

              </form>

            </div>
          </div>
        </div>


      {{-- end --}}

    </div>


  </div>
</div>
@endsection
