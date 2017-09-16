@extends('layouts.dash_admin')

@section('konten')

<div class="col s12 m12 l9">

  <div class="row">
    <div class="col s11">
      <!-- Modal Upload Foto -->

      @extends('layouts.uploadModal')

        <div class="card">
          <div class="card-content">
            <div class="card-title left-align indigo-text"><strong>{{$visi_misi->title}}</strong></div>
            <div class="card-action ">

              <form class="form-horizontal" role="form" method="post" action="/visi_misi" enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <div class="row">
                      <div class="input-field col s12">
                          <textarea  id="teks" name="teks" class="materialize-textarea" >{{$visi_misi->teks}}</textarea>
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
