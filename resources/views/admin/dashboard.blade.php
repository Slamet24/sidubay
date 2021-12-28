@extends('partials.app')
@section('content')
<div class="layout-px-spacing">
    <div class="row p-4">
        @for($i=0;$i<=4;$i++)
        <div class="col-4 p-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>
@endsection