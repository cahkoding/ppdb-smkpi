@extends('layouts.dash_admin')

@section('konten')

<div class="col s12 m12 l9">

  <div class="row">
    <div class="col s11">
      <!-- Modal Upload Foto -->

      @extends('layouts.uploadModal')
      <h4>Chat</h4>
      <ul id="tabs-swipe-demo" class="tabs tabs-fixed-width">
        <li class="tab col s3"><a href="#test-swipe-1"><i class="material-icons "active"">inbox</i>Kotak Masuk</a></li>
        <li class="tab col s3"><a href="#test-swipe-2"><i class="material-icons">call_made</i>Pesan Terkirim</a></li>
        <li class="tab col s3"><a href="#test-swipe-3"><i class="material-icons">create</i>Tulis Pesan</a></li>
      </ul>

      {{-- KOTAK MASUK --}}
      <div id="test-swipe-1" class="col s12" style="height:100%;">
        <table class="striped responsive-table">
           <thead>
             <tr>
                 <th>ID Pesan</th>
                 <th>Subject</th>
                 <th>Tanggal Terkirim</th>
                 <th>Tools</th>
             </tr>
           </thead>

           <tbody>
           @foreach ($pesan as $pesans)
             <tr>
               <td>#ID{{$pesans->id_pesan}}</td>
               <td>{{$pesans->subjek}}</td>
               <td>{{$pesans->pesan_teks}}</td>
               <td><a href="/pesan_admin/{{$pesans->id_pesan}}"><i class="material-icons">remove_red_eye</i></a></td>
             </tr>
           @endforeach
           </tbody>
         </table>
      </div>
      {{-- END --}}

      {{-- Sent --}}
      <div id="test-swipe-2" class="col s12">
        <table class="striped responsive-table">
           <thead>
             <tr>
                 <th>ID Pesan</th>
                 <th>Subject</th>
                 <th>Tanggal Terkirim</th>
                 <th>Tools</th>
             </tr>
           </thead>

           <tbody>
             @foreach ($terkirim as $terkirims)
               <tr>
                 <td>#ID{{$terkirims->id_pesan}}</td>
                 <td>{{$terkirims->subjek}}</td>
                 <td>{{$terkirims->pesan_teks}}</td>
                 <td><a href="/pesan_admin/{{$terkirims->id_pesan}}"><i class="material-icons">remove_red_eye</i></a></td>
               </tr>
             @endforeach
           </tbody>
         </table>
      </div>
      {{-- end --}}

      {{-- Bikin Pesan --}}
      <div id="test-swipe-3" class="col s12" style="height:100%">
        <div class="card">
          <div class="card-content">
            <div class="card-title left-align indigo-text"><strong>Tulis pesan</strong></div>
            <div class="card-action ">

              <form class="form-horizontal" role="form" method="post" action="/biodata_saya" enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <div class="row">
                    <div class="input-field col s12">
                      <input required  id="subject" type="text" class="validate" name="subject">
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
                        <input type="hidden" name="tmp_lampiran" value="{{$profile->lampiran}}">
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate"  type="text" placeholder="lampiran pdf/rar jika lebih dari satu">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                      <div class="input-field offset-s12">
                        <button  type="submit" class="btn btn-primary right indigo">
                          <i class="material-icons">save</i> Simpan
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
