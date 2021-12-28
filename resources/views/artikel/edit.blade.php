@extends('partials.app')
@section('content')
<div class="layout-px-spacing">
    @if(session('status'))
    <div class="alert alert-primary my-4" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div class="card mt-4">
        <div class="card-body">
            <form method="post" action="{{ route('artikel.edit',$artikel->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Judul Artikel</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="judul" aria-describedby="emailHelp" value="{{ $artikel->judul }}">
                    @if($errors->artikel->first('judul'))
                    <div id="emailHelp" class="form-text text-danger">{{ $errors->artikel->first('judul') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="exampleInputEmail1" name="deskripsi" aria-describedby="emailHelp">{{ $artikel->deskripsi }}</textarea>
                    @if($errors->artikel->first('deskripsi'))
                    <div id="emailHelp" class="form-text text-danger">{{ $errors->artikel->first('deskripsi') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Foto</label>
                        <input class="form-control" type="file" name="foto" id="formFile">
                        @if($errors->artikel->first('foto'))
                        <div id="emailHelp" class="form-text text-danger">{{ $errors->artikel->first('foto') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label">Kategori</label>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kategori" id="kategori1" {{ $artikel->kategori == 'umum' ? 'checked':'' }} value="umum">
                            <label class="form-check-label" for="kategori1">
                                Umum
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kategori" id="kategori1" {{ $artikel->kategori == 'info' ? 'checked':'' }} value="info">
                            <label class="form-check-label" for="kategori1">
                                Info
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        @if($errors->artikel->first('kategori'))
                        <div id="emailHelp" class="form-text text-danger">{{ $errors->artikel->first('kategori') }}</div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection