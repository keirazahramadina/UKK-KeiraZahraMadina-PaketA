@extends('layouts.main')
@section('content')
<div>
    <h3>Berikan Tanggapan Anda</h3>

</div>
<div class="d-flex justify-content-center p-3">
    <form action="/tanggapan/store/{{$idPengaduan}}" method="post" enctype="multipart/form-data" class="d-flex justify-content-center">
        @csrf
        <div class="row">
            <div class="col-12 mb-2">
                <label for="tanggapan">Tanggapan</label><br>
                <textarea name="tanggapan" class="form-control"></textarea>
            </div>
            @if ($errors->has('tanggapan'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('tanggapan') }}</strong>
                    </span>
                @endif
            <div class="col-12 mb-2">
                <input type="submit" value="Berikan Tanggapan Anda" class="form-control">
            </div>
        </div>

    </form>
</div>
@endsection