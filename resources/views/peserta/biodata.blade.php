@extends('layouts.app')

@section('konten')

{{-- <div class="row">
  <div class="col offset-s1 s10">
    tes
  </div>
</div> --}}

<div class="row">
  <div class="col offset-s1 s10 left-align teal-text right-align">
      {{-- <b><i class="material-icons right">check_circle</i>TERVERIVIKSI</b> --}}
      <b><i class="material-icons right">update</i>Menunggu Verifikasi</b>
  </div>
  <div class="col offset-s1 s7 left-align red-text">
      <span>Biodata sudah lengkap! Segera kirim/mnyerahkan berkas untuk diverfikasi!</span>
  </div>
  <div class="col s3 right-align" style="color:#26a69a;">
      <span>Kelengkapan Biodata: 100%</span>
  </div>
  <div class="col offset-s1 s10">
    <div class="progress">
      <div class="determinate" style="width: 100%"></div>
    </div>
  </div>

  <div class="col offset-s1 s10">
    <!-- Modal Upload Foto -->
    <div id="upload" style="border-radius:10px;" class="modal offset-l2 col s9 m9 l3">
      <div class="center-align modal-content">
          {{-- <h4>Modal Header</h4> --}}
          @php $avatar = ($profile->foto!='') ?  asset('storage/foto/'.$profile->foto) : "/img/default_ava.png"; @endphp
          <img id="preview" class="center-align" width="100px" class="circle" src="{{$avatar}}">
          <form class="form-horizontal" role="form" method="post" action="/upload" enctype="multipart/form-data">
              {{ csrf_field() }}
            <input required id="input1" type="file" name="foto_upload" class="input" accept="image/*"  onchange="tampilkanPreview(this,'preview')" />
            <input type="hidden" name="tmp_foto" value="{{$profile->foto}}">
       </div>
       <div class="modal-footer">
            <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="upload"> <i class="material-icons left">file_upload</i>Upload</a> </button>
            <button onclick="batalUpload('{{$avatar}}')" type="reset" class="modal-action modal-close waves-effect waves-green btn-flat" name="reset"><i class="material-icons left">close</i>Cancel</a> </button>
          </form>
       </div>
    </div>
    {{-- end dmodal --}}

    {{-- awal data diri --}}
    <div class="card">
      <div class="card-content">
        <div class="card-title center-align indigo-text"><strong>Biodata Peserta</strong></div>
        @php $notifErr='z-depth-1 #ffebee red lighten-5 red-text'; @endphp
        <div class="card-action ">
          {{-- <a id="edit" class="waves-effect waves-light indigo btn right"><i class="material-icons left">mode_edit</i>Edit</a> --}}
          <a  href="cetakform" class="tooltipped waves-effect waves-light indigo btn right"
            data-tooltip="lengkapi biodata dahulu!" data-position="right">
            <i class="material-icons left">print</i>Cetak Form
            {{-- <i class="material-icons left">print</i><strike>Cetak Form</strike> --}}
          </a>

          <div class="row">
            <div class="col s12">
              <center><a class="tooltipped" data-tooltip="<- klik foto untuk upload foto" data-position="right" href="#upload">
                <img height="90" width="80" class="circle" src="{{$avatar}}">
              </a>
            </center>
            </div>
          </div>

          <b class="indigo-text" style="font-size:110%;">PROFIL DATA ANDA</b>
          <form class="form-horizontal" role="form" method="post" action="/biodata_saya" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{-- <div class="row">
                <div class="input-field col s12">
                  <input required disabled value="{{$profile->id_registrasi}}" id="disabled" type="text" class="validate" name="id_registrasi">
                  <label for="disabled">ID Registrasi</label>
                </div>
              </div> --}}

              <div class="row">
                <div class="input-field col s12">
                  <input required  id="nopeserta" type="text" class="validate" name="nopeserta" value="{{$profile->no_peserta}}">
                  <label for="nopeserta">Nomor Peserta</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s12">
                  <input required  id="nama" type="text" class="validate" name="nama" value="@if($errors->has('nama')) {{old('nama')}} @else {{$profile->nama}} @endif">
                  <label for="nama">Nama Lengkap @if($errors->has('nama')) <li><span class="{{$notifErr}}">{{$errors->first('nama')}}</span></li> @endif</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s6">
                  <input required  id="tempatlahir" type="text" class="validate" name="tempat_lahir" value="@if($errors->has('tempat_lahir')) {{old('tempat_lahir')}} @else {{$profile->tempat_lahir}} @endif">
                  <label for="tempatlahir">Tempat lahir @if($errors->has('tempat_lahir')) <li><span class="{{$notifErr}}">{{$errors->first('tempat_lahir')}}</span></li> @endif</label>
                </div>
                <div class="input-field col s6">
                  <input required id="tanggallahir" type="text" class="datepicker" name="tanggal_lahir" value="@if($errors->has('tanggal_lahir')) {{old('tanggal_lahir')}} @else {{$profile->tanggal_lahir}} @endif">
                  <label for="tanggallahir">Tanggal lahir @if($errors->has('tanggal_lahir')) <li><span class="{{$notifErr}}">{{$errors->first('tanggal_lahir')}}</span></li> @endif</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s12">
                  <p style="color:#787878;">Jenis Kelamin</p>
                  @if($errors->has('jenkel')) <li><span class="{{$notifErr}}">{{$errors->first('jenkel')}}</span></li> @endif
                  <p>
                    <input {{ ($profile->jenis_kelamin=='laki-laki') ? 'checked' : '' }} name="jenkel" value="laki-laki" type="radio" id="lakilaki" />
                    <label for="lakilaki">Laki-laki</label>
                  </p>
                  <p>
                    <input {{ ($profile->jenis_kelamin=='perempuan') ? 'checked' : '' }}  name="jenkel" value="perempuan" type="radio"  id="perempuan" />
                    <label for="perempuan">Perempuan</label>
                  </p>
                  <br>
                </div>
              </div>


              <div class="row">
                <div class="input-field col s4">
                  <input required  id="goldarah" type="text" class="validate" name="gol_darah" value="@if($errors->has('gol_darah')) {{old('gol_darah')}} @else {{$profile->gol_darah}} @endif">
                  <label for="goldarah">Golongan Darah @if($errors->has('gol_darah')) <li><span class="{{$notifErr}}">{{$errors->first('gol_darah')}}</span></li> @endif</label>
                </div>
                <div class="input-field col s4">
                  <input required  id="berat" type="text" class="validate" name="berat" value="@if($errors->has('berat')) {{old('berat')}} @else {{$profile->berat_badan}} @endif">
                  <label for="berat">Berat Badan (Kg) @if($errors->has('berat')) <li><span class="{{$notifErr}}">{{$errors->first('berat')}}</span></li> @endif</label>
                </div>
                <div class="input-field col s4">
                  <input required  id="tinggi" type="text" class="validate" name="tinggi" value="@if($errors->has('tinggi')) {{old('tinggi')}} @else {{$profile->tinggi_badan}} @endif">
                  <label for="tinggi">Tinggi Badan (Cm) @if($errors->has('tinggi')) <li><span class="{{$notifErr}}">{{$errors->first('tinggi')}}</span></li> @endif</label>
                </div>
              </div>

              <div class="row">
                  <div class="input-field col s12">
                      <textarea  id="alamat" class="materialize-textarea" name="alamat">@if($errors->has('tanggal_lahir')) {{old('tanggal_lahir')}} @else {{$profile->alamat}} @endif</textarea>
                      <label for="alamat">Alamat tinggal @if($errors->has('alamat')) <li><span class="{{$notifErr}}">{{$errors->first('alamat')}}</span></li> @endif</label>
                  </div>
              </div>

              <div class="row">
                <div class="input-field col s12">
                  <select required  name="agama">
                    <option value="" disabled selected>Pilih salah satu</option>
                      <option {{ ($profile->agama=='islam') ? 'selected' : '' }} value="islam">Islam</option>
                      <option {{ ($profile->agama=='kristen') ? 'selected' : '' }} value="kristen">Kristen</option>
                      <option {{ ($profile->agama=='buddha') ? 'selected' : '' }} value="buddha">Buddha</option>
                      <option {{ ($profile->agama=='hindu') ? 'selected' : '' }} value="hindu">Hindu</option>
                  </select>
                  <label>Agama @if($errors->has('agama')) <li><span class="{{$notifErr}}">{{$errors->first('agama')}}</span></li> @endif</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s12">
                  <input required  id="asal" type="text" class="validate" name="asal_sekolah" value="@if($errors->has('asal_sekolah')) {{old('asal_sekolah')}} @else {{$profile->asal_sekolah}} @endif">
                  <label for="asal">Asal Sekolah @if($errors->has('agama')) <li><span class="{{$notifErr}}">{{$errors->first('agama')}}</span></li> @endif</label>
                </div>
              </div>

              <div class="row">
                  <div class="input-field col s12">
                      <textarea  id="alamat" class="materialize-textarea" name="alamat_sekolah">@if($errors->has('alamat_sekolah')) {{old('alamat_sekolah')}} @else {{$profile->alamat_sekolah}} @endif</textarea>
                      <label for="alamatSekolah">Alamat Sekolah @if($errors->has('alamat_sekolah')) <li><span class="{{$notifErr}}">{{$errors->first('alamat_sekolah')}}</span></li> @endif</label>
                  </div>
              </div>

              <div class="row">
                <div class="input-field col s12">
                  <select required id="mySelect"  name="tahun">
                    <option value="" disabled selected>Pilih salah satu</option>
                    @foreach ($tahun as $tahuns)
                      <option {{ ($profile->tahun_id==$tahuns->id) ? 'selected' : '_' }} value="{{$tahuns->id}}">{{$tahuns->tahun}}</option>
                    @endforeach
                  </select>
                  <label>Tahun Lulus SMA/SLTA @if($errors->has('tahun')) <li><span class="{{$notifErr}}">{{$errors->first('tahun')}}</span></li> @endif</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s12">
                  <input required  id="noHp" type="text" class="validate" name="no_hp" value="@if($errors->has('no_hp')) {{old('no_hp')}} @else {{$profile->no_hp}} @endif">
                  <label for="noHp">No Telp/Hp @if($errors->has('no_hp')) <li><span class="{{$notifErr}}">{{$errors->first('no_hp')}}</span></li> @endif</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s3">
                  <input required   id="n_ipa" type="text" class="validate" name="n_ipa" value="@if($errors->has('n_ipa')) {{old('n_ipa')}} @else {{$nilai->ipa}} @endif">
                  <label for="n_ipa">UN IPA @if($errors->has('n_ipa')) <li><span class="{{$notifErr}}">{{$errors->first('n_ipa')}}</span></li> @endif</label>
                </div>
                <div class="input-field col s3">
                  <input  required  id="n_ipa" type="text" class="validate" name="n_math" value="@if($errors->has('n_math')) {{old('n_math')}} @else {{$nilai->matematika}} @endif">
                  <label for="n_math">UN MATEMATIKA @if($errors->has('n_math')) <li><span class="{{$notifErr}}">{{$errors->first('n_math')}}</span></li> @endif</label>
                </div>
                <div class="input-field col s3">
                  <input required  id="n_bindo" type="text" class="validate" name="n_bindo" value="@if($errors->has('n_bindo')) {{old('n_bindo')}} @else {{$nilai->bahasa_indonesia}} @endif">
                  <label for="n_bindo">UN BAHASA INDONESIA @if($errors->has('n_bindo')) <li><span class="{{$notifErr}}">{{$errors->first('n_bindo')}}</span></li> @endif</label>
                </div>
                <div class="input-field col s3">
                  <input required  id="n_bing" type="text" class="validate" name="n_bing" value="@if($errors->has('n_bing')) {{old('n_bing')}} @else {{$nilai->bahasa_inggris}} @endif">
                  <label for="n_bing">UN BAHASA INGGRIS @if($errors->has('n_bing')) <li><span class="{{$notifErr}}">{{$errors->first('n_bing')}}</span></li> @endif</label>
                </div>
              </div>

              {{-- <div class="row">
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
                <div class="col s5">
                  @if ($profile->lampiran=='')
                      <span>Anda tidak memiliki Lampiran!</span>
                  @else
                      <span>Lampiran Anda: <a href="{{ asset('storage/lampiran/'. $profile->lampiran) }}"><i class="material-icons">insert_drive_file</i> {{$profile->lampiran}}</a></span>
                  @endif
                </div>
              </div> --}}


              {{-- <div class="row">
                  <div class="input-field offset-s12">
                    <button  type="submit" class="btn btn-primary right indigo">
                      <i class="material-icons">save</i> Simpan
                    </button>
                  </div>
              </div>

          </form> --}}
        </div>
      </div>
    </div>
    {{-- end card data diri --}}

    {{-- awal data ortu --}}
    <div class="card">
      <div class="card-content">

          <b class="indigo-text" style="font-size:110%;">PROFIL DATA ORANG TUA</b>
              {{ csrf_field() }}

              <div class="row">
                <div class="input-field col s12">
                  <input required  id="namaAyah" type="text" class="validate" name="nama_ayah" value="@if($errors->has('nama_ayah')) {{old('nama_ayah')}} @else {{$profile->nama_ayah}} @endif">
                  <label for="namaAyah">Nama Ayah @if($errors->has('nama_ayah')) <li><span class="{{$notifErr}}">{{$errors->first('nama_ayah')}}</span></li> @endif</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input required  id="namaIbu" type="text" class="validate" name="nama_ibu" value="@if($errors->has('nama_ibu')) {{old('nama_ibu')}} @else {{$profile->nama_ibu}} @endif">
                  <label for="namaIbu">Nama Ibu @if($errors->has('nama_ibu')) <li><span class="{{$notifErr}}">{{$errors->first('nama_ibu')}}</span></li> @endif</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input required  id="noOrtu" type="text" class="validate" name="no_ortu" value="@if($errors->has('no_ortu')) {{old('no_ortu')}} @else {{$profile->no_ortu}} @endif">
                  <label for="noOrtu">No Telp/Hp @if($errors->has('no_ortu')) <li><span class="{{$notifErr}}">{{$errors->first('no_ortu')}}</span></li> @endif</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s12">
                  <select required id="jobayah_select">
                    <option value="" disabled selected>Pilih salah satu</option>
                    @foreach ($pekerjaan as $pekerjaans)
                      <option {{ ($profile->pekerjaan_ayah==$pekerjaans->id) ? 'selected' : '_' }}  value="{{$pekerjaans->id}}">{{$pekerjaans->nama_pekerjaan}}</option>
                    @endforeach
                  </select>
                  <label>Pekerjaaan Ayah @if($errors->has('pekerjaan_ayah')) <li><span class="{{$notifErr}}">{{$errors->first('pekerjaan_ayah')}}</span></li> @endif</label>
                </div>
              </div>
              <input type="hidden" name="pekerjaan_ayah" id="jobayah" >

              <div class="row">
                <div class="input-field col s12">
                  <select required  id="jobibu_select">
                    <option value="" disabled selected>Pilih salah satu</option>
                    @foreach ($pekerjaan as $pekerjaans)
                      <option {{ ($profile->pekerjaan_ibu==$pekerjaans->id) ? 'selected' : '_' }}  value="{{$pekerjaans->id}}">{{$pekerjaans->nama_pekerjaan}}</option>
                    @endforeach
                  </select>
                  <label>Pekerjaaan Ibu @if($errors->has('pekerjaan_ibu')) <li><span class="{{$notifErr}}">{{$errors->first('pekerjaan_ibu')}}</span></li> @endif</label>
                </div>
              </div>
              <input type="hidden" name="pekerjaan_ibu" id="jobibu" >

              <div class="row">
                  <div class="input-field col s12">
                      <textarea  id="alamatOrtu" class="materialize-textarea" name="alamat_ortu">@if($errors->has('alamat_ortu')) {{old('alamat_ortu')}} @else {{$profile->alamat_ortu}} @endif</textarea>
                      <label for="alamatOrtu">Alamat @if($errors->has('alamat_ortu')) <li><span class="{{$notifErr}}">{{$errors->first('alamat_ortu')}}</span></li> @endif</label>
                  </div>
              </div>

        </div>
      </div>
      {{-- End Card Data Orang tua --}}

      <div class="card">
        <div class="card-content">
          <div class="row">
              <div class="input-field offset-s12">
                <button  type="submit" class="btn btn-primary right indigo">
                  <i class="material-icons">save</i> Simpan
                </button>
              </div>
          </div>
        </div>
      </div>
    </div>



  </form>

  </div>

</div>

@endsection
