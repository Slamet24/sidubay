@extends('partials.app')
@section('content')
    <div class="layout-px-spacing">

        <div class="page-header">
            <div class="page-title">
                <h3>Daftar Peserta</h3>
            </div>
        </div>

        <div class="row mx-auto" id="cancel-row">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <table id="zero-config" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Status</th>
                                <th class="no-content">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peserta as $a)
                            <tr>
                                <td>{{$a->name}}</td>
                                <td>{{$a->email}}</td>
                                <td>{{$a->plain}}</td>
                                <td>{{$a->active ? 'Aktif':'Tidak Aktif'}}</td>
                                <td><a href="{{ route('adminpeserta.edit',$a->id) }}" class="btn btn-success" rel="noopener noreferrer">Aktifkan</a>|<a href="{{ route('adminpeserta.hapus',$a->id) }}" class="btn btn-danger" rel="noopener noreferrer">Hapus</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
@endsection