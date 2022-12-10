@extends('layouts.app')

@section('content')
    <div id="app" class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <follow-component :order="{{ $order }}"></follow-component>
            </div>
        </div>
    </div>
@endsection
