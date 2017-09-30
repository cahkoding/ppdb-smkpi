
<table border="">
  <tr>
    <td style="text-align:left;" width="10">
      <img src="img/logo.png" width="70" alt="">
    </td>
    <td style="text-align:center; " width="100" >
      <strong>Calon Siswa PPDB Terdaftar</strong>
    </td>
    <td style="text-align:right;">
      <strong>SMK PI AMBARRUKMO 1 SLEMAN <br></strong>
      <span style="font-size:12px;"><i>Jl. Cendrawasih 125 Mancasan lor, Condong Catur, Depok, Sleman Telp. (0274)4477515 <br>
      Website: http://localhost/psbonline | E-Mail: smkpiambarrukmo@yahoo.co.id
      </i></span>
    </td>
  </tr>
</table>

<hr style="border-width: 1px;">

<br>
<div class="" style="margin-left:25px;">

<table border="1" align="center" style="text-align: left;">
  <thead>
    <tr>
      <td colspan="6"><h4>Daftar Peserta</h4></td>
    </tr>
    <tr>
      <td width="20">No</td>
      <td>Nama</td>
      <td>Asal Sekolah</td>
      <td>Email</td>
      <td>Hp</td>
      <td>Orang tua</td>
    </tr>
  </thead>
  <tbody>
    @php
      $i=1;
    @endphp
    @foreach ($users as $user)
      <tr>
        <td>{{$i}}.</td>
        <td>{{$user->profile->nama}}</td>
        <td>{{$user->profile->asal_sekolah}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->profile->no_hp}}</td>
        <td>{{$user->profile->ortu_wali}}</td>
      </tr>
      @php $i++; @endphp
    @endforeach
  </tbody>
</table>

@php
  $BulanIndo = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
  $tanggal = date('j').' '.$BulanIndo[date('n')-1].' '.date('Y');
@endphp

<br><br><br>
<table align="center" style="text-align:center;" border="">
  <tr>
    <td width="20" rowspan="3"> </td>
    <td width="100">Yogyakarta, {{$tanggal}}</td>
  </tr>
  <tr>
    <td height="50"></td>
  </tr>
  <tr>
    <td>PANITIA PPDB</td>
  </tr>
</table>
