<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="min-height: 100%">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>

        @sectionMissing('title')
        @yield(config('app.name'))
        @else
        @yield('title')
        @endif

    </title>
    {{-- fullcalendar start --}}
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.min.js" integrity="sha256-rPPF6R+AH/Gilj2aC00ZAuB2EKmnEjXlEWx5MkAp7bw=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/locales-all.min.js" integrity="sha256-/ZgxvDj3QtyBZNLbfJaHdwbHF8R6OW82+5MT5yBsH9g=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.min.css" integrity="sha256-uq9PNlMzB+1h01Ij9cx7zeE2OR2pLAfRw3uUUOOPKdA=" crossorigin="anonymous">
    {{-- fullcalendar end --}}
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- TOOLTIP SCRIPT START --}}
    <script type="text/javascript">
        $(function () {
            $("[data-toggle='tooltip']").tooltip();
        });
    </script>
    {{-- TOOLTIP SCRIPT END --}}
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&family=Roboto:wght@300&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css?v=echo time();') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
</head>

    <body style="background-color: #8EC5FC;
    background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);
    " onload="createFormFields()">

    <div id="app" style="min-height:calc(100vh - 37px)">
        @include('layouts.navbar')
        <main class="py-4" >
            @yield('content')
        </main>

    </div>
    @include('layouts.footer')

    {{-- script alert messages fade out start --}}
    <script>
        @if(session('korisnik'))
        $("#korisnik").fadeTo(2000, 500).slideUp(500, function(){
            $("#korisnik").slideUp(500);
        });
        @elseif(session('obavestenje'))
        $("#obavestenje").fadeTo(2000, 500).slideUp(500, function(){
            $("#obavestenje").slideUp(500);
        });
        @elseif(session('profesor'))
        $("#profesor").fadeTo(2000, 500).slideUp(500, function(){
            $("#profesor").slideUp(500);
        });
        @elseif(session('predmet'))
        $("#predmet").fadeTo(2000, 500).slideUp(500, function(){
            $("#predmet").slideUp(500);
        });
        @elseif(session('raspored_ispita'))
        $("#raspored_ispita").fadeTo(2000, 500).slideUp(500, function(){
            $("#raspored_ispita").slideUp(500);
        });
        @elseif(session('raspored'))
        $("#raspored").fadeTo(2000, 500).slideUp(500, function(){
            $("#raspored").slideUp(500);
        });
        @elseif(session('smer'))
        $("#smer").fadeTo(2000, 500).slideUp(500, function(){
            $("#smer").slideUp(500);
        });
        @elseif(session('student'))
        $("#student").fadeTo(2000, 500).slideUp(500, function(){
            $("#student").slideUp(500);
        });
        @elseif(session('login'))
        $("#login").fadeTo(2000,500).slideUp(500,function(){
            $("#login").slideUp(500);
        });
        @elseif(!empty('poruka'))
        $("#poruka").fadeTo(2000,500).slideUp(500,function(){
            $("#poruka").slideUp(500);
        })
        @endif
        @if(url()->previous()==url('/login'))
        $('#welcome').fadeTo(2000,500).slideUp(500, function(){
            $("#welcome").slideUp(500);
        })
        @endif

    </script>
    <style>
        th{text-shadow: 2px 2px 5px black;}
        table.fc-col-header th.fc-col-header-cell { text-shadow: 1px 1px 3px white;}
        h2.fc-toolbar-title { text-shadow: 1px 1px 3px white;}
        table#studenti th{ text-shadow: 1px 1px 3px lightgray;}
        /* FOR FOOTER START */

        /* FOR FOOTER END */

    </style>

    {{-- script alert messages fade out end --}}
</body>

</html>
