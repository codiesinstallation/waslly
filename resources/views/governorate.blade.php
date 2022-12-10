@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <governorate-component :countries="{{ $countries }}" :data="{{ $governorates }}"></governorate-component>

            </div>
        </div>
    </div>
@endsection
