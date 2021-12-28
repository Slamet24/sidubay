@extends('partials.app')
@section('content')
<div class="layout-px-spacing">

    <div class="row layout-spacing">

        <!-- Content -->
        <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

            <div class="user-profile layout-spacing">
                <div class="widget-content widget-content-area">
                    <div class="d-flex justify-content-center">
                        <h3 class="">Profile</h3>
                        <a href="user_account_setting.html" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg></a>
                    </div>
                    <div class="text-center user-info">
                        @if($peserta->foto_closeup)
                        <img src="{{ asset('bio/'.$peserta->foto_closeup) }}" width="90px" height="90px" alt="Foto">
                        @else
                        <img src="assets/img/90x90.jpg" alt="avatar">
                        @endif
                        <p class="">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="user-info-list">

                        <div class="">
                            <ul class="contacts-block list-unstyled">
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee">
                                        <path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
                                        <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
                                        <line x1="6" y1="1" x2="6" y2="4"></line>
                                        <line x1="10" y1="1" x2="10" y2="4"></line>
                                        <line x1="14" y1="1" x2="14" y2="4"></line>
                                    </svg> {{ $peserta->instansi }}
                                </li>
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg> {{ date('d M Y',strtotime($peserta->tanggal_lahir)) }}
                                </li>
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg> {{ $peserta->alamat }}
                                </li>
                                <li class="contacts-block__item">
                                    <a href="mailto:example@mail.com"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg> {{ Auth::user()->email }}</a>
                                </li>
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg> {{ $peserta->no_telp }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">
            @if(session('status'))
            <div class="alert alert-primary my-4" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <form method="post" action="{{ url('peserta/biodata/simpan',Auth::user()->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="nama" aria-describedby="emailHelp" value="{{ old('nama') ? old('nama'):Auth::user()->name }}">
                    @if($errors->peserta->first('nama'))
                    <div id="emailHelp" class="form-text text-danger">{{ $errors->peserta->first('nama') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="tempat_lahir" aria-describedby="emailHelp" value="{{ old('tempat_lahir') ? old('tempat_lahir'):$peserta->tempat_lahir }}">
                    @if($errors->peserta->first('tempat_lahir'))
                    <div id="emailHelp" class="form-text text-danger">{{ $errors->peserta->first('tempat_lahir') }}</div>
                    @endif
                </div>
                <div id="email-field" class="field-wrapper input">
                    <label for="email">Tanggal Lahir</label>
                    <input id="basicFlatpickr" name="tanggal_lahir" type="text" value="{{ old('tanggal_lahir')?old('tanggal_lahir'):$peserta->tanggal_lahir }}" class="form-control" placeholder="Pilih Tanggal">
                    @if($errors->daftar->first('tanggal_lahir'))
                    <div id="emailHelp" class="form-text text-danger">{{ $errors->daftar->first('tanggal_lahir') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Instansi</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="instansi" aria-describedby="emailHelp" value="{{ old('instansi') ? old('instansi'):$peserta->instansi }}">
                    @if($errors->peserta->first('instansi'))
                    <div id="emailHelp" class="form-text text-danger">{{ $errors->peserta->first('instansi') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" value="{{ old('email') ? old('email'):Auth::user()->email }}">
                    @if($errors->peserta->first('email'))
                    <div id="emailHelp" class="form-text text-danger">{{ $errors->peserta->first('email') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="no_telp" aria-describedby="emailHelp" value="{{ old('no_telp') ? old('no_telp'):$peserta->no_telp }}">
                    @if($errors->peserta->first('no_telp'))
                    <div id="emailHelp" class="form-text text-danger">{{ $errors->peserta->first('no_telp') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Alamat</label>
                    <textarea class="form-control" id="exampleInputEmail1" name="alamat" aria-describedby="emailHelp">{{ old('alamat')?old('alamat'):$peserta->alamat }}</textarea>
                    @if($errors->peserta->first('alamat'))
                    <div id="emailHelp" class="form-text text-danger">{{ $errors->peserta->first('alamat') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Foto Close Up</label>
                        <input class="form-control" type="file" name="foto_closeup" id="formFile">
                        @if($errors->peserta->first('foto_closeup'))
                        <div id="emailHelp" class="form-text text-danger">{{ $errors->peserta->first('foto_closeup') }}</div>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Foto Full Body</label>
                        <input class="form-control" type="file" name="foto_full" id="formFile">
                        @if($errors->peserta->first('foto_full'))
                        <div id="emailHelp" class="form-text text-danger">{{ $errors->peserta->first('foto_full') }}</div>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">CV</label>
                        <input class="form-control" type="file" name="cv" id="formFile">
                        @if($errors->peserta->first('cv'))
                        <div id="emailHelp" class="form-text text-danger">{{ $errors->peserta->first('cv') }}</div>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Karya Tulis</label>
                        <input class="form-control" type="file" name="karya_tulis" id="formFile">
                        @if($errors->peserta->first('karya_tulis'))
                        <div id="emailHelp" class="form-text text-danger">{{ $errors->peserta->first('karya_tulis') }}</div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </div>
</div>
@endsection