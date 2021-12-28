@extends('partials.app')
@section('content')
    <div class="layout-px-spacing">

        <div class="page-header">
            <div class="page-title">
                <h3>Daftar Artikel</h3>
            </div>
        </div>

        <div class="row mx-auto" id="cancel-row">
            <div class="col-12">
                <a href="{{url('admin/artikel/tambah')}}" class="btn btn-primary">Tambah</a>
            </div>
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <table id="zero-config" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Foto</th>
                                <th>Kategori</th>
                                <th>Dibuat</th>
                                <th class="no-content">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($artikel as $a)
                            <tr>
                                <td>{{$a->judul}}</td>
                                <td><img src="{{asset('artikels/'.$a->foto)}}" alt="Foto" width="120"></td>
                                <td>{{$a->kategori}}</td>
                                <td>{{date("d M Y",$a->created_at)}}</td>
                                <td><a href="{{ route('artikel.edit',$a->id) }}" class="btn btn-primary" rel="noopener noreferrer">Edit</a>|<a href="{{ route('artikel.hapus',$a->id) }}" class="btn btn-danger" rel="noopener noreferrer">Hapus</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
@endsection