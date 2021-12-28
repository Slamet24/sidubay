<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>SIDUBAY</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/authentication/form-2.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/switches.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/flatpickr/flatpickr.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/flatpickr/custom-flatpickr.css')}}">
</head>
<body class="form">
    

    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                    @if(session('status'))
                    <div class="alert alert-primary my-4" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                        <h1 class="">Daftar</h1>
                        <p class="signup-link register">Sudah daftar? <a href="{{url('login')}}">Masuk</a></p>
                        <form class="text-left" method="post" action="{{ url('daftar_proses') }}">
                            <div class="form">
                                @csrf
                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">NAMA LENGKAP</label>
                                    <input id="username" name="nama" type="text" class="form-control" placeholder="Masukkan Nama Lengkap">
                                    @if($errors->daftar->first('nama'))
                    <div id="emailHelp" class="form-text text-danger">{{ $errors->daftar->first('nama') }}</div>
                    @endif
                                </div>

                                <div id="email-field" class="field-wrapper input">
                                    <label for="email">EMAIL</label>
                                    <input id="email" name="email" type="email" value="" class="form-control" placeholder="Masukkan Email">
                                    @if($errors->daftar->first('email'))
                    <div id="emailHelp" class="form-text text-danger">{{ $errors->daftar->first('email') }}</div>
                    @endif
                                </div>

                                <div id="email-field" class="field-wrapper input">
                                    <label for="email">TANGGAL LAHIR</label>
                                    <input id="basicFlatpickr" name="tanggal_lahir" type="text" value="" class="form-control" placeholder="Pilih Tanggal">
                                    @if($errors->daftar->first('tanggal_lahir'))
                    <div id="emailHelp" class="form-text text-danger">{{ $errors->daftar->first('tanggal_lahir') }}</div>
                    @endif
                                </div>

                                <div id="email-field" class="field-wrapper input">
                                    <label for="email">INSTANSI</label>
                                    <input id="email" name="instansi" type="text" value="" class="form-control" placeholder="Masukkan Instansi">
                                    @if($errors->daftar->first('instansi'))
                    <div id="emailHelp" class="form-text text-danger">{{ $errors->daftar->first('instansi') }}</div>
                    @endif
                                </div>

                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">DAFTAR</button>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>                    
                </div>
            </div>
        </div>
    </div>

    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('assets/js/authentication/form-2.js')}}"></script>
    <script src="{{asset('plugins/flatpickr/flatpickr.js')}}"></script>
    <script src="{{asset('plugins/flatpickr/custom-flatpickr.js')}}"></script>

</body>
</html>