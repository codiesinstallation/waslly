<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
        <title> {{ app()->getLocale() == 'ar' ? $branch->name_ar : $branch->name_en }}
        </title>
    @else
        <title> Codies
        </title>
    @endauth
    <title>{{ __('lang.Reports') }}</title>

    @include('layouts.datatable')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('css/print.css') }}" rel="stylesheet">
    <!-- Styles -->
    @if (app()->getLocale() == 'ar')
        <link href="{{ asset('assets/css/bootstrap.rtl.min.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    @endif
    <style lang="scss">
        table {
            border-collapse: collapse;
            margin: 0 auto;
            width: 100%;
            margin-top: 40px;

            tr {
                background: #f2f2f2;
            }

            th {
                font-size: 15px;
                background-color: #03d361;
                color: #1a181f;
                text-transform: uppercase;
            }
        }

        table th,
        table td {
            padding: 15px;
            text-align: center;
        }

        @media screen and (max-width: 600px) {
            table {
                border: 0;

                thead {
                    display: none;
                }

                tr {
                    display: block;
                    margin-bottom: 10px;
                }

                td {
                    border-bottom: 1px solid #ddd;
                    display: block;
                    font-size: 14px;
                    text-align: right;

                    &::before {
                        content: attr(data-label);
                        float: left;
                        font-weight: 900;
                        text-transform: uppercase;
                    }

                    &::last-child {
                        border-bottom: 0;
                    }
                }
            }
        }
    </style>
</head>

<body>
    @include('layouts.navb4')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @if (Auth::user()->status === 0 || Auth::user()->status === 1)

                    <div class="card mb-5">
                        <div class="alert alert-danger " style="display: none">يجب تحديد فتره (من-الى) </div>
                        <form name="form" class="needs-validation mt-2 hideMeInPrint" method="GET"
                            action="reports">
                            <div class="form-row justify-content-center">
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label"
                                            for="from">{{ __('lang.From') }}</label>
                                        <div class="col-sm-8">
                                            <input class="form-control " type="date" name="from" id="from"
                                                placeholder="{{ __('lang.From') }}" value="{{ request('from') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label"
                                            for="to">{{ __('lang.To') }}</label>
                                        <div class="col-sm-8">
                                            <input class="form-control " type="date" name="to" id="to"
                                                placeholder="{{ __('lang.To') }}" value="{{ request('to') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-none">
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <input placeholder="{{ __('lang.Sender Name') }}"
                                                class="form-control value="{{ request('sender') }}" name="sender" />
                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="input-group">
                                        <select class="form-control " name="period">
                                            <option
                                                value="daily"@if (request('period') == 'daily') selected="selected" @endif>
                                                {{ __('lang.Daily') }} </option>
                                            <option value="monthly"
                                                @if (request('period') == 'monthly') selected="selected" @endif>
                                                {{ __('lang.Monthly') }}</option>
                                            <option value="period"
                                                @if (request('period') == 'period') selected="selected" @endif>
                                                {{ __('lang.Period') }}</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-2 d-none">
                                    <div class="input-group">
                                        <select class="form-control-sm " name="user_id">
                                            <option value="">{{ __('lang.All Users') }}</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    @if (request('user_id') == $user->id) selected="selected" @endif>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="input-group">
                                        <select class="form-control-sm " name="pay">
                                            <option value="">{{ __('lang.All Orders') }}</option>
                                            <option value="Cash"
                                                @if (request('pay') === 'Cash') selected="selected" @endif>
                                                {{ __('lang.Cash') }}</option>
                                            <option value="Card"
                                                @if (request('pay') === 'Card') selected="selected" @endif>
                                                {{ __('lang.Card') }}</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <button class="btn btn-success" type="submit">
                                        {{ __('lang.View') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="card-header">

                            <h5>{{ __('lang.Reports') }}</h5>
                        </div>
                        <div class="card-body">

                            {!! $dataTable->table() !!}


                        </div>

                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ __('lang.Expenses') }}</h5>

                        </div>
                        <div class="card-body">
                            <table id="expenses" class="text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            {{ __('lang.Code') }}
                                        </th>

                                        <th>
                                            {{ __('lang.Cost') }}
                                        </th>
                                        <th>
                                            {{ __('lang.Vat') }}
                                        </th>
                                        <th>
                                            {{ __('lang.Pay Method') }}
                                        </th>

                                        <th>
                                            {{ __('lang.BILL ICON') }}
                                        </th>
                                        <th>
                                            {{ __('lang.Date') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expenses as $expense)
                                        <tr>
                                            <td style="width: 100px;max-width: 500px;">{{ $expense->expense_title }}
                                            </td>
                                            <td>{{ $expense->expense_cost }}</td>
                                            <td>{{ $expense->expense_vat }}</td>
                                            <td>{{ $expense->pay }}</td>

                                            <td>
                                                <a href="{{ asset($expense->expense_icon) }}" target="_blank">
                                                <img src="{{ asset($expense->expense_icon) }}"
                                                    class="card-img-top w-25 h-25" />
                                                    </a>
                                            </td>
                                            <td>{{ $expense->expense_date }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                     <tr>
                                        <th> {{ __('lang.Vat') }}</th>
                                        <td> {{ $expense_vat }}</td>
                                    </tr>
                                    <tr>
                                        <th> {{ __('lang.Total') }}</th>
                                        <td> {{ $expense_cost }}</td>
                                    </tr>

                                    <tr>
                                        <th> {{ __('lang.Diff Between Orders And Expenses') }}</th>
                                        <td> {{ $total - $expense_cost }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
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
    </div>

</body>

{!! $dataTable->scripts() !!}
<script>
    $(function() {

        function getUrlParameter(name) {
            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(location.search);
            return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
        }
        if (getUrlParameter('period') == 'period' && getUrlParameter('to') === '' &&
            getUrlParameter(
                'from') === '') {
            $('.alert-danger').css('display', 'block');

        }
        $('select').on('change', function(e) {
            $('.alert-danger').fadeOut();
            document.forms['form'].submit();

        });
        $('.reload').click(function() {
            location.reload(true)
        })
    })
</script>
@isset($sum)
    <script>
        $(function() {
            $('table').addClass('text-center table-bordered');
            var table = document.getElementById("orders-table");

            var footer = table.createTFoot();
            footer.classList.add('text-center');
            var row = footer.insertRow(0);
            footer.innerHTML =
                `<tr> <th <th colspan='8'> {{ __('lang.Total Of Orders Without Vat') }}</th> <th colspan='8'> ` +
                {!! json_encode(round($sum ?? '', 2)) !!} +
                ` </th> </tr><tr> <th <th colspan='8'> {{ __('lang.Total Of Vat') }}</th> <th <th colspan='8'>` +
                {!! json_encode(round($vat ?? '', 2)) !!} +
                ` </tr><tr></th> <th <th colspan='8'> {{ __('lang.Total Of Orders With Vat') }}</th> <th <th colspan='8'>` +
                {!! json_encode(round($total ?? '', 2)) !!} +
                ` </th> </tr>`;

        })
    </script>
@endisset

</html>
