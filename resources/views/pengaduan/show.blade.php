@extends('layouts.main')

@section('content')
<div class="mb-3">
  @if (Auth::user()->role == 'masyarakat')
  <a href="pengaduan/add">
    <button class="btn btn-info text-light">Buat Pengaduan</button>
</a>
  @endif
  
</div>
<table class="table table-bordered table-hover">
  <tr>
    <th>ID Pengaduan</th>
    <th>Tanggal Pengaduan</th>
    <th>Nama</th>
    <th>NIK</th>
    <th>Isi Laporan</th>
    <th>Foto</th>
    <th>Status</th>
    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
    <th>Action</th>
    @endif

    <th>Tanggapan</th>
  </tr>
  @foreach($pengaduan as $mas)
  <tr>
    <td>{{$mas->id_pengaduan}}</td>
    <td>{{$mas->tgl_pengaduan}}</td>
    <td>{{$mas->nama}}</td>
    <td>{{$mas->nik}}</td>
    <td>{{$mas->isi_laporan}}</td>
    <td>
        @if($mas->foto != null)
        <img class="img-fluid" src="/storage/pengaduan/{{$mas->foto}}" alt="{{$mas->foto}}">
    @else
        <b>tidak ada foto</b>
    @endif
    </td>
     <td>{{$mas->status}}</td>
     @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
     <td><a href="tanggapan/add/{{$mas->id_pengaduan}}">Beri Tanggapan</a></td>
     @endif
     <td><a href="pengaduan/detail/{{$mas->id_pengaduan}}">Lihat Tanggapan</a></td>
  </tr>
  @endforeach
</table>
@endsection
