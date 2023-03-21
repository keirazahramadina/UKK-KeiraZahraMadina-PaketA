@extends('layouts.main')
@section('content')
<div>
@if(Auth::user()->role == 'admin')
<input type="button" onclick="printDiv('printableArea')" value="Print" class="btn btn-success"/>
@endif
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
</div>
<div class="mt-2">
@if(Auth::user()->role == 'admin' || Auth::user()->role == 'petugas' )
    @if($pengaduan->status == '0')
    <a href="/tanggapan/verif/{{$pengaduan->id_pengaduan}}"><button class="btn btn-success">Verifikasi</button></a>
    @elseif($pengaduan->status == 'proses')
    <a href="/tanggapan/add/{{$pengaduan->id_pengaduan}}"><button class="btn btn-success">Beri Tanggapan</button></a>
    @elseif($pengaduan->status == 'selesai')
    {{-- <a href="/tanggapan" class="text-decoration-none"><h4 class="text-success">pengaduan telah selesai diproses</h4></a> --}}
    @endif
@elseif(Auth::user()->role == 'masyarakat')
    @if($pengaduan->status == '0')
    <h4 class="text-danger">Menunggu Laporan Diverifikasi</h4>
    @elseif($pengaduan->status == 'proses')
    <h4 class="text-success">Pengaduan Telah Diverifikasi</h4>
    @elseif($pengaduan->status == 'selesai')
    <a class="text-decoration-none"><h4 class="text-success">Pengaduan telah selesai diproses</h4></a>
    @endif
@endif
</div>
<div id="printableArea">
<div class="mt-3">
    <h3>Pengaduan dibuat oleh {{$masyarakat->nama}}</h3>
    <p class="text-muted">Diadukan pada tanggal {{$pengaduan->tgl_pengaduan}}</p>
</div>

<div class="row mt-5">
    <div class="col-12">
        <div>{{$pengaduan->isi_laporan}}</div>
    </div>
    <div class="col-12 mt-5">
        @if($pengaduan->foto != null)
            <img class="img-fluid" src="/storage/pengaduan/{{$pengaduan->foto}}" alt="{{$pengaduan->foto}}">
        @else
            <b>tidak ada foto</b>
        @endif    </div>
</div>
{{-- @if($tanggapan != null) --}}
<div class="row mt-5" id="tanggapan">

    @foreach ($tanggapan as $item)

    <div class="col-12">
        <h4>Ditanggapi Oleh {{$item->nama_petugas}}</h4>
    </div>
    <div class="col-12">
        <div>{{$item->tanggapan}}</div>
    </div>
    <div class="col-12">
        <small class="text-muted">Ditanggapi pada : {{$item->created_at}}</small>
    </div>
    @endforeach
</div>
</div>
{{-- @endif --}}

@endsection
