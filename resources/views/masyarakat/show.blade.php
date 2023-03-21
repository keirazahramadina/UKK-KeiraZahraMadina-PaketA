@extends('layouts.main')
@section('content')
<div class="mb-3">
    {{-- <a href="masyarakat/add">
        <button class="btn btn-info text-light">Tambah</button>
    </a> --}}
</div>
<table class="table table-striped">
    <thead class="bg-dark text-light">
        <tr>
            @php
                $no = 1;
            @endphp
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Username</th>
            <th>No.Telphone</th>
            {{-- <th colspan="2">Action</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach($masyarakat as $mas)
        <tr>

            <td>{{$no++}}</td>
            <td>{{$mas->nik}}</td>
            <td>{{$mas->nama}}</td>
            <td>{{$mas->username}}</td>
            <td>{{$mas->telp}}</td>
            {{-- <td><a href="masyarakat/edit/{{$mas->id}}">Edit</a></td>
            <td><a href="masyarakat/delete/{{$mas->id}}">Hapus</a></td> --}}

        </tr>
        @endforeach
    </tbody>
</table>
@endsection