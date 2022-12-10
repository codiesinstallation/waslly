@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <country-component :data="{{ $countries }}"></country-component>

            </div>
        </div>
    </div>
@endsection
