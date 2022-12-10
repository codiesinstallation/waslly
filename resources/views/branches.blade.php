@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8">

                        <settings-component :form="{{ $branch }}"></settings-component>

            </div>
            <div class="col-6">
                <div class="card mb-3">
                    <div class="card-header"></div>
                    <div class="card-body"></div>
                </div>
            </div>
            <div class="col-6">
                <div class="card mb-3">
                    <div class="card-header"></div>
                    <div class="card-body"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
