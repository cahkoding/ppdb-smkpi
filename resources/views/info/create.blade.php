@extends('layouts.dash_admin')

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

      <div class="card">
        <div class="card-content">
          <div class="card-title left-align indigo-text"><strong>Create Info</strong></div>
          <div class="card-action ">
            <form class="form-horizontal" role="form" method="post" action="/info" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row">
                  <div class="input-field col s12">
                    <input required  id="title" type="text" class="validate" name="title" >
                    <label for="title">Title</label>
                  </div>
                </div>


                <div class="row">
                    <div class="input-field col s12">
                        <textarea required  id="isi_info" class="materialize-textarea"  name="isi_info"></textarea>
                        <label for="isi_info">Isi Text</label>
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
                        <i class="material-icons left">save</i> Create
                      </button>
                    </div>
                </div>

            </form>

          </div>
        </div>
      </div>
    </div>


  </div>
</div>
@endsection
