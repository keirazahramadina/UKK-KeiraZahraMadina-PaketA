@extends('layouts.main')

@section('content')
@php
    $status = request()->segment(count(request()->segments()));
@endphp
<div class="py-2">
    <h5>{{ ucwords($status) }} Daftar Pengaduan Masyarakat Desa Cipayung</h5>
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
    @foreach($data as $mas)
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
       <td>
        @if($mas->status == '0')
        <h9>belum diverifikasi</h9> 
        @elseif ($mas->status == 'proses')
        <h9>proses</h9> 
        @else 
        <h9>selesai</h9> 
        @endif

    </td>
       @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
       <td><a href="{{url('tanggapan/add', ['id' => $mas->id_pengaduan])}}">Beri Tanggapan</a></td>
       @endif
       <td><a href="{{url('pengaduan/detail', ['id' => $mas->id_pengaduan])}}">Lihat Tanggapan</a></td>
    </tr>
    @endforeach
  </table>
@endsection
