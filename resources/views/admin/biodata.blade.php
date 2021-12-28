@extends('partials.app')
@section('content')
    <div class="layout-px-spacing">

        <div class="page-header">
            <div class="page-title">
                <h3>Daftar Biodata Peserta</h3>
            </div>
        </div>

        <div class="row mx-auto" id="cancel-row">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <table id="zero-config" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Instansi</th>
                                <th>Alamat</th>
                                <th>Nomor Telp</th>
                                <th>Foto</th>
                                <th>CV</th>
                                <th>Karya Tulis</th>
                                <th class="no-content">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($biodata as $a)
                            <tr>
                                <td>{{$a->tempat_lahir}}</td>
                                <td>{{$a->tanggal_lahir}}</td>
                                <td>{{$a->instansi}}</td>
                                <td>{{$a->alamat}}</td>
                                <td>{{$a->no_telp}}</td>
                                <td><div class="row">
                                        <div class="col">
                                            <img src="{{asset('bio/'.$a->foto_closeup)}}" alt="">
                                        </div>
                                        <div class="col">
                                            <img src="{{asset('bio/'.$a->foto_body)}}" alt="">
                                        </div>
                                    </div>
                                </td>
                                <td><a href="{{asset('bio/'.$a->cv)}}" target="_blank" class="btn btn-primary" rel="noopener noreferrer">Download</a></td>
                                <td><a href="{{asset('bio/'.$a->karya_tulis)}}" target="_blank" class="btn btn-primary" rel="noopener noreferrer">Download</a></td>
                                <td><a href="{{ route('adminbio.hapus',$a->id) }}" class="btn btn-danger" rel="noopener noreferrer">Hapus</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
@endsection