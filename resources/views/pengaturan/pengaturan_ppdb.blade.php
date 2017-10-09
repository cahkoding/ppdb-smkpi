@extends('layouts.dash_admin')

@section('konten')

<div class="col s12 m12 l9">

  <div class="row">
    <div class="col s11">

        <div class="card">
          <div class="card-content">
            <div class="card-title left-align indigo-text"><i class="material-icons right">settings</i>Pengaturan PPDB</div>
            <div class="card-action ">

              <form class="form-horizontal" role="form" method="post" action="/lokasi" enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <div class="row">
                      <div class="input-field col s12">
                          <textarea  id="teks" name="teks" class="materialize-textarea" ></textarea>
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
