@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (Auth::user()->status === 0 )
                    <users-component ></users-component>
                @else
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">{{ __('Don\'t have Persmession  ') }}</h4>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
