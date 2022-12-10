<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid">

        @auth
            <a class="navbar-brand" href="{{ route('settings') }}">
                <img src="{{ $branch->logo }}" width="100" height="30" class="d-inline-block align-top" alt="">
                {{ app()->getLocale() == 'ar' ? $branch->name_ar : $branch->name_en }} </a>
        @endauth
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{ __('lang.Home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders') }}">{{ __('lang.Shipments') }}</a>
                    </li>
                    <li class="nav-item d-none">
                        <a class="nav-link" href="{{ route('country') }}">{{ __('lang.Country') }}</a>
                    </li>
                    <li class="nav-item d-none">
                        <a class="nav-link" href="{{ route('governorate') }}">{{ __('lang.Governorate') }}</a>
                    </li>
                     <li class="nav-item">
                            <a class="nav-link" href="{{ route('expenses') }}">{{ __('lang.Expenses') }}</a>
                        </li>
                    @if (Auth::user()->status === 0)

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users') }}">{{ __('lang.Users') }}</a>
                        </li>
                    @endif
                    @if (Auth::user()->status === 0 || Auth::user()->status === 1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reports') }}">{{ __('lang.Reports') }}</a>
                        </li>
                    @endif

                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('lang.Login') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                            <span
                                class="fi fi-{{ LaravelLocalization::getCurrentLocale() === 'ar' ? 'eg' : 'us' }}"></span>

                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    @if ($properties['native'] == 'EN')
                                        <span class="fi fi-us"></span>
                                    @elseif($properties['native'] == 'ع')
                                        <span class="fi fi-eg"></span>
                                    @endif
                                    {{ $properties['native'] }}
                                </a>
                            @endforeach
                        </div>

                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('lang.Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                @endguest

            </ul>
        </div>
    </div>
</nav>
