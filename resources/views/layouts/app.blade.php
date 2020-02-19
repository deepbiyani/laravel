<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    {{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>--}}
    {{--<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>--}}

    {{--<script href="{{ asset('js/jquery.min.js') }}" rel="stylesheet"></script>--}}
{{--    <script href="{{ asset('js/jquery.DataTable.min.js') }}" rel="stylesheet"></script>--}}
    {{--<script src="https://code.jquery.com/jquery-3.4.1.min.js"--}}
            {{--integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="--}}
            {{--crossorigin="anonymous"></script>--}}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @guest

                        @else
                            <li>
                                <a href="{{url('/')}}/category/manage">
                                    Manage Categories
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/products/manage">
                                    Manage Products
                                </a>
                            </li>
                        @endguest

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}


    <script>
        var base_url = '{{url('/')}}'
        window.translations = {!! Cache::get('translations') !!};

        //fetch translations in the js
        function trans(key, replace = {})
        {
            let translation = key.split('.').reduce((t, i) => t[i] || null, window.translations);

            for (var placeholder in replace) {
                translation = translation.replace(`:${placeholder}`, replace[placeholder]);
            }

            return translation;
        }

        console.log(trans('passwords.password'));
    </script>
</body>
</html>