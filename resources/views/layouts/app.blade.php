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
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css?v=echo time();') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
</head>

<body style="background-image: linear-gradient(to bottom right, rgb(252,252,252), rgb(90, 90, 90)" onload="createFormFields()">
    <div id="app">
        @if(Auth::check())
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
            <a class="navbar-brand " href={{ route('/') }}>Evidencija Studenata</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @can('isAdmin')
                <ul class="navbar-nav mr-auto">
                    {{-- @if(Request::is('predmeti') || Request::is('predmeti/*') || Request::is('korisnici') ||
                    Request::is('korisnici/*') || Request::is('studenti'))
                    <li class="nav-item
                    @if(Request::is('studenti'))
                    {{'active'}}
                    @endif
                    ">
                    <a class="nav-link" href={{ route('studenti') }}><i class="fas fa-user-graduate"></i>
                        Studenti</a>
                    </li>
                    @endif
                    @if(Request::is('studenti/novi_student'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('studenti')}}>Studenti</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Novi student</li>
                        </ol>
                    </li>
                    @elseif(Request::is('studenti/izmena_studenta/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('studenti')}}>Studenti</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href={{route('student',['id'=>$student->id])}}>Student "{{$student->ime}}"</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Izmena studenta "{{$student->ime}}"
                            </li>
                        </ol>
                    </li>
                    @elseif(Request::is('studenti/student/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('studenti')}}>Studenti</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Student "{{$student->ime}}"</li>
                        </ol>
                    </li>
                    @elseif(Request::is('ocene/ocena_izmena/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('studenti')}}>Studenti</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href={{route('student',['id'=>$id['st_id']])}}>Student "{{$ime}}"</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Izmena ocene</li>
                        </ol>
                    </li>
                    @endif
                    @if(Request::is('studenti') || Request::is('studenti/*') || Request::is('korisnici') ||
                    Request::is('korisnici/*') || Request::is('predmeti') || Request::is('ocene/*'))
                    <li class="nav-item
                    @if(Request::is('predmeti'))
                    {{'active'}}
                    @endif
                    ">
                        <a class="nav-link" href={{ route('predmeti') }}><i class="fas fa-book"></i> Predmeti</a>
                    </li>
                    @endif
                    @if(Request::is('predmeti/novi_predmet'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('predmeti')}}>Predmeti</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Novi predmet</li>
                        </ol>
                    </li>
                    @elseif(Request::is('predmeti/izmena_predmeta/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('predmeti')}}>Predmeti</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Izmena predmeta "{{$predmet->naziv}}"
                            </li>
                        </ol>
                    </li>
                    @endif
                    @if(Request::is('studenti') || Request::is('studenti/*') || Request::is('predmeti') ||
                    Request::is('predmeti/*') || Request::is('korisnici') || Request::is('ocene/*'))
                    <li class="nav-item
                    @if(Request::is('korisnici'))
                        {{'active'}}
                    @endif
                    ">
                        <a class="nav-link" href={{ route('korisnici') }}><i class="fas fa-users"></i> Korisnici</a>
                    </li>
                    @endif
                    @if(Request::is('korisnici/novi_korisnik'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('korisnici')}}>Korisnici</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Novi korisnik</li>
                        </ol>
                    </li>
                    @elseif(Request::is('korisnici/izmena_korisnika/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('korisnici')}}>Korisnici</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Izmena korisnika "{{$korisnik->ime}}"
                            </li>
                        </ol>
                    </li>
                    @endif --}}

                </ul>
                @elsecan('isUser')
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href={{route('profil',['ime'=>Auth::user()->ime])}}><i
                                class="fas fa-user-graduate"></i>
                            Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href=""><i class="fas fa-user-graduate"></i>
                            Zahtev</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href=""><i class="fas fa-user-graduate"></i>
                            Profil</a>
                    </li>
                </ul>
                @elsecan('isSuperAdmin')
                <ul class="navbar-nav mr-auto">
                    @if(Request::is('predmeti') || Request::is('predmeti/*') || Request::is('korisnici') ||
                    Request::is('korisnici/*') || Request::is('studenti') || Request::is('studenti/*') ||
                    Request::is('pocetna') || Request::is('profesori') || Request::is('profesori/*') || Request::is('obavestenja') || Request::is('obavestenja/*') || Request::is('smerovi') || Request::is('smerovi/*') || Request::is('raspored') || Request::is('raspored/*') || Request::is('raspored_ispita') || Request::is('raspored_ispita/*'))
                    <li class="nav-item">
                        <a class="nav-link
                        @if(Request::is('pocetna'))
                        {{'active'}}
                        @endif
                        " href={{route('pocetna')}}><i class="fas fa-home"></i>
                            Početna</a>
                    </li>
                    @endif
                    @if(Request::is('predmeti') || Request::is('predmeti/*') || Request::is('korisnici') ||
                    Request::is('korisnici/*') || Request::is('studenti') || Request::is('pocetna') || Request::is('profesori') || Request::is('profesori/*') || Request::is('obavestenja') || Request::is('obavestenja/*') || Request::is('smerovi') || Request::is('smerovi/*') || Request::is('raspored') || Request::is('raspored/*') || Request::is('raspored_ispita') || Request::is('raspored_ispita/*'))
                    <li class="nav-item
                    @if(Request::is('studenti'))
                    {{'active'}}
                    @endif
                    ">
                        <a class="nav-link" href={{ route('studenti') }}><i class="fas fa-user-graduate"></i>
                            Studenti</a>
                    </li>
                    @endif
                    @if(Request::is('studenti/novi_student'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('studenti')}}>Studenti</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Novi student</li>
                        </ol>
                    </li>
                    @elseif(Request::is('studenti/izmena_studenta/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('studenti')}}>Studenti</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href={{route('student',['id'=>$student->id])}}>Student "{{$student->ime}}"</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Izmena studenta "{{$student->ime}}"
                            </li>
                        </ol>
                    </li>
                    @elseif(Request::is('studenti/student/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('studenti')}}>Studenti</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Student "{{$student->ime}}"</li>
                        </ol>
                    </li>
                    @elseif(Request::is('ocene/ocena_izmena/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('studenti')}}>Studenti</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href={{route('student',['id'=>$id['st_id']])}}>Student "{{$ime}}"</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Izmena ocene</li>
                        </ol>
                    </li>
                    @endif
                    @if(Request::is('predmeti') || Request::is('predmeti/*') || Request::is('korisnici') ||
                    Request::is('korisnici/*') || Request::is('studenti') || Request::is('pocetna') || Request::is('profesori') || Request::is('studenti/*')|| Request::is('obavestenja')|| Request::is('obavestenja/*') || Request::is('smerovi') || Request::is('smerovi/*') || Request::is('raspored') || Request::is('raspored/*') || Request::is('raspored_ispita') || Request::is('raspored_ispita/*'))
                    <li class="nav-item
                    @if(Request::is('profesori'))
                    {{'active'}}
                    @endif
                    ">
                        <a class="nav-link" href={{ route('profesori') }}><i class="fas fa-user-tie"></i>
                            Profesori</a>
                    </li>
                    @endif
                    @if(Request::is('profesori/novi_profesor'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('profesori')}}>Profesori</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Novi profesor</li>
                        </ol>
                    </li>
                    @elseif(Request::is('profesori/izmena_profesora/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('profesori')}}>Profesori</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href={{route('profesor',['id'=>$profesor->id])}}>Profesor "{{$profesor->ime}}"</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Izmena profesora "{{$profesor->ime}}"
                            </li>
                        </ol>
                    </li>
                    @elseif(Request::is('profesori/profesor/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('profesori')}}>Profesori</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profesor "{{$profesor->ime}}"</li>
                        </ol>
                    </li>
                    @endif
                    @if(Request::is('studenti') || Request::is('studenti/*') || Request::is('korisnici') ||
                    Request::is('korisnici/*') || Request::is('predmeti') || Request::is('ocene/*') ||
                    Request::is('pocetna') || Request::is('profesori') || Request::is('profesori/*') || Request::is('obavestenja') || Request::is('obavestenja/*')
                    || Request::is('smerovi') || Request::is('smerovi/*') || Request::is('raspored') || Request::is('raspored/*') || Request::is('raspored_ispita') || Request::is('raspored_ispita/*'))
                    <li class="nav-item
                    @if(Request::is('predmeti'))
                    {{'active'}}
                    @endif
                    ">
                        <a class="nav-link" href={{ route('predmeti') }}><i class="fas fa-book"></i> Predmeti</a>
                    </li>
                    @endif
                    @if(Request::is('predmeti/novi_predmet'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('predmeti')}}>Predmeti</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Novi predmet</li>
                        </ol>
                    </li>
                    @elseif(Request::is('predmeti/izmena_predmeta/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('predmeti')}}>Predmeti</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Izmena predmeta "{{$predmet->naziv}}"
                            </li>
                        </ol>
                    </li>
                    @elseif(Request::is('predmeti/kopiranje_predmeta/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('predmeti')}}>Predmeti</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kopiranje predmeta "{{$predmet->naziv}}"
                            </li>
                        </ol>
                    </li>
                    @endif
                    @if(Request::is('studenti') || Request::is('studenti/*') || Request::is('predmeti') ||
                    Request::is('predmeti/*') || Request::is('korisnici') || Request::is('ocene/*') ||
                    Request::is('pocetna') || Request::is('profesori') || Request::is('profesori/*') || Request::is('obavestenja') || Request::is('obavestenja/*') || Request::is('smerovi') || Request::is('smerovi/*') || Request::is('raspored') || Request::is('raspored/*') || Request::is('raspored_ispita') || Request::is('raspored_ispita/*'))
                    <li class="nav-item
                    @if(Request::is('korisnici'))
                        {{'active'}}
                    @endif
                    ">
                        <a class="nav-link" href={{ route('korisnici') }}><i class="fas fa-users"></i> Korisnici</a>
                    </li>
                    @endif
                    @if(Request::is('korisnici/novi_korisnik'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('korisnici')}}>Korisnici</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Novi korisnik</li>
                        </ol>
                    </li>
                    @elseif(Request::is('korisnici/izmena_korisnika/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('korisnici')}}>Korisnici</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Izmena korisnika "{{$korisnik->ime}}"
                            </li>
                        </ol>
                    </li>
                    @endif
                    @if(Request::is('studenti') || Request::is('studenti/*') || Request::is('predmeti') ||
                    Request::is('predmeti/*') || Request::is('korisnici') || Request::is('ocene/*') ||
                    Request::is('pocetna') || Request::is('profesori') || Request::is('profesori/*') || Request::is('obavestenja') || Request::is('korisnici/*') || Request::is('smerovi') || Request::is('smerovi/*') || Request::is('raspored') || Request::is('raspored/*') || Request::is('raspored_ispita') || Request::is('raspored_ispita/*'))
                    <li class="nav-item
                    @if(Request::is('obavestenja'))
                        {{'active'}}
                    @endif
                    ">
                    <a class="nav-link" href={{ route('obavestenja') }}><i class="fas fa-clipboard"></i> Obaveštenja
                        @if(App\Http\Controllers\ObavestenjeController::brojObavestenja()>0)
                        <span
                        class="badge badge-danger badge-pill shadow" data-toggle="tooltip"
                        data-placement="top" title="<b>NEODOBRENA OBAVEŠTENJA</b>" data-html="true">
                            {{App\Http\Controllers\ObavestenjeController::brojObavestenja()}}
                        </span>
                        @endif
                    </a>
                    </li>
                    @endif
                    @if(Request::is('obavestenja/novo_obavestenje'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('obavestenja')}}>Obaveštenja</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Novo obaveštenje</li>
                        </ol>
                    </li>
                    @elseif(Request::is('obavestenja/izmena_obavestenja/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('obavestenja')}}>Obaveštenja</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href={{route('obavestenje',['id'=>$obavestenje->id])}}>Obaveštenje "{{ substr($obavestenje->naslov,0,10)}}..."</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Izmena obaveštenja "{{substr($obavestenje->naslov,0,10)}}..."</li>
                        </ol>
                    </li>
                    @elseif(Request::is('obavestenja/obavestenje/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('obavestenja')}}>Obaveštenja</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Obaveštenje "{{substr($obavestenje->naslov,0,10)}}..."</li>
                        </ol>
                    </li>
                    @endif

                    @if(Request::is('studenti') || Request::is('studenti/*') || Request::is('predmeti') ||
                    Request::is('predmeti/*') || Request::is('korisnici') || Request::is('ocene/*') ||
                    Request::is('pocetna') || Request::is('profesori') || Request::is('profesori/*') || Request::is('obavestenja') || Request::is('obavestenja/*') || Request::is('korisnici/*') || Request::is('smerovi') || Request::is('raspored') || Request::is('raspored/*') || Request::is('raspored_ispita') || Request::is('raspored_ispita/*'))
                    <li class="nav-item
                    @if(Request::is('smerovi'))
                        {{'active'}}
                    @endif
                    ">
                    <a class="nav-link" href={{ route('smerovi') }}><i class="fas fa-swatchbook"></i> Smerovi
                    </a>
                    </li>
                    @endif
                    @if(Request::is('smerovi/novi_smer'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('smerovi')}}>Smerovi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Novi smer</li>
                        </ol>
                    </li>
                    @elseif(Request::is('smerovi/izmena_smera/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('smerovi')}}>Smerovi</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href={{route('smerovi',['id'=>$smer->id])}}>Smer "{{ substr($smer->naziv,0,10)}}..."</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Izmena smera "{{substr($smer->naziv,0,10)}}..."</li>
                        </ol>
                    </li>
                    @elseif(Request::is('smerovi/smer/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('smerovi')}}>Smerovi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Smer "{{substr($smer->naziv,0,10)}}..."</li>
                        </ol>
                    </li>
                    @endif

                    @if(Request::is('studenti') || Request::is('studenti/*') || Request::is('predmeti') ||
                    Request::is('predmeti/*') || Request::is('korisnici') || Request::is('ocene/*') ||
                    Request::is('pocetna') || Request::is('profesori') || Request::is('profesori/*') || Request::is('obavestenja') || Request::is('obavestenja/*') || Request::is('korisnici/*') || Request::is('smerovi') || Request::is('smerovi/*') || Request::is('raspored') || Request::is('raspored/*') || Request::is('raspored_ispita'))
                    <li class="nav-item
                    @if(Request::is('raspored_ispita'))
                        {{'active'}}
                    @endif
                    ">
                    <a class="nav-link" href={{ route('raspored_ispita') }}><i class="far fa-calendar-alt"></i> Ispiti/Kolokvijumi
                    </a>
                    </li>
                    @endif
                    @if(Request::is('raspored_ispita/novi_raspored'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('raspored_ispita')}}>Ispiti/Kolokvijumi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Novi raspored</li>
                        </ol>
                    </li>
                    @elseif(Request::is('raspored_ispita/izmena_rasporeda/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('raspored_ispita')}}>Ispiti/Kolokvijumi</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href={{route('raspored_ispita',['id'=>$raspored->id])}}>Raspored {{$raspored->godina_studija}}. godina"{{ substr($raspored->smerovi->naziv,0,10)}}..."</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Izmena rasporeda..."</li>
                        </ol>
                    </li>
                    @elseif(Request::is('raspored_ispita/jedan/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('raspored_ispita')}}>Ispiti/Kolokvijumi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Raspored {{$raspored->godina_studija}}. godina "{{substr($raspored->smerovi->naziv,0,10)}}..."</li>
                        </ol>
                    </li>
                    @endif

                    @if(Request::is('studenti') || Request::is('studenti/*') || Request::is('predmeti') ||
                    Request::is('predmeti/*') || Request::is('korisnici') || Request::is('ocene/*') ||
                    Request::is('pocetna') || Request::is('profesori') || Request::is('profesori/*') || Request::is('obavestenja') || Request::is('obavestenja/*') || Request::is('korisnici/*') || Request::is('smerovi') || Request::is('smerovi/*') || Request::is('raspored_ispita') || Request::is('raspored_ispita/*') || Request::is('raspored'))
                    <li class="nav-item
                    @if(Request::is('raspored'))
                        {{'active'}}
                    @endif
                    ">
                    <a class="nav-link" href={{ route('raspored') }}><i class="fas fa-table"></i> Raspored
                    </a>
                    </li>
                    @endif
                    @if(Request::is('raspored/novi_raspored'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('raspored')}}>Raspored</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Novi raspored</li>
                        </ol>
                    </li>
                    @elseif(Request::is('raspored/izmena_rasporeda/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('raspored')}}>Raspored</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href={{route('raspored',['id'=>$raspored->id])}}>Raspored {{$raspored->godina_studija}}. godina"{{ substr($raspored->smerovi->naziv,0,10)}}..."</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Izmena rasporeda..."</li>
                        </ol>
                    </li>
                    @elseif(Request::is('raspored/jedan/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('raspored')}}>Raspored</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Raspored {{$raspored->godina_studija}}. godina "{{substr($raspored->smerovi->naziv,0,10)}}..."</li>
                        </ol>
                    </li>
                    @endif


                </ul>
                @endcan
                <!-- Default dropleft button -->
                <div class="btn-group dropleft float-right">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->ime}}
                    </button>
                    <div class="dropdown-menu py-0">
                        <!-- Dropdown menu links -->
                        <form action={{route('logout')}} method="GET">
                            <button class="btn dropdown-item shadow" type="submit">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>

                        </form>
                    </div>
                </div>


            </div>
        </nav>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>

</html>
