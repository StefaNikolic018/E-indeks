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

    <!-- Scripts -->
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

<body style="background-image: linear-gradient(to bottom right, rgb(252,252,252), rgb(90, 90, 90)">
    <div id="app">
        @if(Auth::check())
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
            <a class="navbar-brand " href={{ route('studenti') }}>Evidencija Studenata</a>
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
                    Request::is('pocetna'))
                    <li class="nav-item">
                        <a class="nav-link
                        @if(Request::is('pocetna'))
                        {{'active'}}
                        @endif
                        " href={{route('pocetna')}}><i class="fas fa-user-graduate"></i>
                            Početna</a>
                    </li>
                    @endif
                    @if(Request::is('predmeti') || Request::is('predmeti/*') || Request::is('korisnici') ||
                    Request::is('korisnici/*') || Request::is('studenti') || Request::is('pocetna'))
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
                    Request::is('korisnici/*') || Request::is('predmeti') || Request::is('ocene/*') ||
                    Request::is('pocetna'))
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
                    Request::is('predmeti/*') || Request::is('korisnici') || Request::is('ocene/*') ||
                    Request::is('pocetna'))
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
