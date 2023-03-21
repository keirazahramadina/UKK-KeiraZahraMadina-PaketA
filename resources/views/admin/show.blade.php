@extends('layouts.main')

@section('content')
<div class="py-">
    <h3>Daftar Pengaduan Masyarakat Desa Cipayung</h3>
</div>
<div class="row">
    <div class="col-sm">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Semua Pengaduan</h5>
              <h6 class="card-text">{{ count($semuaPengaduan) }} Pengaduan</h6>
              <a href="{{ url('/admin/semua') }}" class="card-link">Lihat Data</a>
            </div>
          </div>
      </div>
      <div class="col-sm">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Belum di Proses</h5>
              <h6 class="card-text">{{ count($notProcess) }} Pengaduan</h6>
              <a href="{{ url('/admin/belum-proses') }}" class="card-link">Lihat Data</a>
            </div>
          </div>
      </div>
      <div class="col-sm">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Sedang di Proses</h5>
              <h6 class="card-text">{{ count($process) }} Pengaduan</h6>
              <a href="{{ url('/admin/proses') }}" class="card-link">Lihat Data</a>
            </div>
          </div>
      </div>
      <div class="col-sm">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Selesai</h5>
              <h6 class="card-text">{{ count($done) }} Pengaduan</h6>
              <a href="{{ url('/admin/selesai') }}" class="card-link">Lihat Data</a>
            </div>
          </div>
      </div>
</div>
@endsection
