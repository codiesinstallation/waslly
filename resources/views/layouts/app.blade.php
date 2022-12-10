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



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css"
/>

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

</head>

<body>
    <div id="app">


        @yield('nav')

        <main class="py-4">

            @yield('content')
        </main>
    </div>

    <script src="{{ asset('assets/js/bootstrap.min.js') }}">
        < script src = "{{ asset('assets/js/bootstrap.esm.min.js') }}" >
    </script>


</body>

</html>
