<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Simple Forum') }}</title>

    <!-- Styles -->
    <link href="{{ asset('vendor/simpleforum/plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/simpleforum/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/simpleforum/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <script src="{{ asset('vendor/simpleforum/plugins/JQuery/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('vendor/simpleforum/plugins/AngularJS/angular.min.js') }}"></script>
    <script src="{{ asset('vendor/simpleforum/js/app-operations.js') }}"></script>
    <script src="{{ asset('vendor/simpleforum/plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>

<!--    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
-->
</head>
<body>
    <div id="app" ng-app="simpleforum">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="/ozgurince/simpleforum">
                        {{-- config('app.name', 'Simple Forum') --}}
                        Simple Forum
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Giriş Yap</a></li>
                            <li><a href="{{ route('register') }}">Kaydol</a></li>
                        @else
                            @if(Auth::user()->isAdmin())
                            <li><a href="{{ route('users.index') }}">Kullanıcı Yönetimi</a></li>
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('profile_with_id', ['id' => Auth::user()->id]) }}">
                                            Profil
                                        </a>
                                        <a href="{{ route('settings') }}">
                                            Ayarlar
                                        </a>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Çıkış
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

    </div>

    

    <footer class="footer">
      <div class="container">
        <p class="text-muted">© Copyright 2017 by <b><a href="http://ozgurhalilince.com/" target="_blank">Özgür Halil İNCE</a></b></p>
      </div>
    </footer>

    @yield('page_scripts')    
    
</body>
</html>
