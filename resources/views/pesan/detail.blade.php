@extends('layouts.dash')

@section('konten')

<div class="col s12 m12 l9">

  <div class="row">
    <div class="col s11">
      <!-- Modal Upload Foto -->

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
            {{-- <input type="submit" value="Upload" /><br/> --}}
            <!--untuk menampilkan file gambar yang telah di upload-->
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
      {{-- end modal --}}

      <div class="card">
        <div class="card-content">
          <div class="card-title left-align indigo-text"><strong>Detail Pesan</strong></div>
          <div class="card-action ">

            <form class="form-horizontal" role="form">
                <div class="row">
                  <div class="input-field col s12">
                    <input required readonly id="id_pesan" type="text" class="validate"  value="{{$pesan->id_pesan}}">
                    <label for="id_pesan">ID_Pesan</label>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s12">
                    <input readonly  id="subject" type="text" class="validate"  value="{{$pesan->subjek}}">
                    <label for="subject">Subject</label>
                  </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea readonly id="pesan" class="materialize-textarea" >{{$pesan->pesan_teks}}</textarea>
                        <label for="pesan">pesan teks</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <span>Lampiran:
                          @if ($pesan->lampiran=='')
                              Tidak ada lampiran
                          @else
                          <a href="{{ asset('storage/lampiran/'. $pesan->lampiran) }}">
                          <i class="material-icons">insert_drive_file</i> {{$pesan->lampiran}}</a>
                          @endif
                        </span>
                    </div>
                </div>

            </form>

            <div class="row">
                <div class="input-field offset-s12">
                  <button id="reply" type="submit" class="btn btn-primary right indigo">
                    <i class="material-icons right">reply</i> Reply
                  </button>
                </div>
            </div>

          </div>
        </div>
      </div>


      {{-- REPLY FORM --}}
      <div id="reply_div" style = "display: none;">
      <div class="card">
        <div class="card-content">
          <div class="card-title left-align indigo-text"><strong><i class="material-icons">reply</i>Reply</strong></div>
          <div class="card-action ">
            <form class="form-horizontal" role="form" method="post" action="/pesan/{{$pesan->id_pesan}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id_peserta" value="{{$pesan->id_peserta}}">
                <div class="row">
                  <div class="input-field col s12">
                    <input readonly required  id="subject" type="text" class="validate" name="subject" value="REPLY[#{{$pesan->id_pesan}}]">
                    <label for="subject">Subject</label>
                  </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea  id="pesan" class="materialize-textarea" name="pesan"></textarea>
                        <label for="pesan">pesan teks</label>
                    </div>
                </div>

                <div class="row">
                  <div class="file-field input-field col s7">
                    <div class="btn">
                      <span>Upload</span>
                      <input  type="file" name="lampiran">
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate"  type="text" placeholder="lampiran pdf/rar jika lebih dari satu">
                    </div>
                  </div>
                </div>

                <div class="row">
                    <div class="input-field offset-s12">
                      <button  type="submit" class="btn btn-primary right indigo">
                        <i class="material-icons right">send</i>send
                      </button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
      </div>


    {{-- end --}}

    </div>


  </div>
</div>
@endsection
