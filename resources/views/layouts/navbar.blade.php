@if(Auth::check())
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #80D0C7; background-image: linear-gradient(160deg, #80D0C7 5%, #0093E9 60%);">
        <a class="navbar-brand mr-0 mr-sm-2" href={{ route('/') }}><img class="img-fluid" style="max-height: 30px;" src="{{asset('images/logo1.png')}}" alt="Logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse text-center " id="navbarSupportedContent">
            @can('isAdmin')
            <ul class="navbar-nav mr-auto">
                @if(Request::is('profesor/*') || Request::is('student/*') || Request::is('obavestavanje') || Request::is('obavestavanje/*') || Request::is('ocene/ocena_izmena/*/*') || Request::is('smer/*'))
                    <li class="nav-item ml-sm-3 mr-sm-3 ml-0 mr-0">
                        <a class="nav-link @if(Request::is('profesor/*')) active @endif" href={{route('profile',['ime'=>Auth::user()->ime])}}>
                            <i class="fas fa-user-tie"></i>
                            Profil
                        </a>
                    </li>
                    @if(Request::is('profesor/*') || Request::is('student/svi') || Request::is('obavestavanje') || Request::is('obavestavanje/*') && !Request::is('student/*'))
                    <li class="nav-item mr-sm-3 mr-0">
                        <a class="nav-link @if(Request::is('student/svi'))
                        active
                        @endif" href={{ route('svi') }}><i class="fas fa-user-graduate"></i>
                            Studenti</a>
                    </li>
                    @endif
                    @if(Request::is('student/*') && !Request::is('student/svi'))
                    <li class="nav-item mr-sm-3 mr-0">
                        <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('svi')}}>Studenti</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Student "{{$student->ime}}"</li>
                        </ol>
                    </li>
                    @elseif(Request::is('ocene/ocena_izmena/*/*'))
                    <li class="nav-item mr-sm-3 mr-0">
                        <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('svi')}}>Studenti</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href={{route('jedan_student',['id'=>$id['st_id']])}}>Student "{{$ime}}"</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Izmena ocene</li>
                        </ol>
                    </li>
                    @elseif(Request::is('smer/*'))
                    <li class="nav-item mr-sm-3 mr-0">
                        <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('svi')}}>Studenti</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Smer</li>
                        </ol>
                    </li>
                    @endif
                    @if(Request::is('obavestavanje/sva') || Request::is('profesor/*') || Request::is('student/*') || Request::is('ocene/ocena_izmena/*/*') || Request::is('smer/*'))
                    <li class="nav-item">
                    <a class="nav-link
                    @if(Request::is('obavestavanje/sva'))
                    active
                    @endif
                " href={{ route('sva') }}><i class="fas fa-clipboard"></i> Obaveštenja
                    </a>
                    </li>
                    @endif
                    @if(Request::is('obavestavanje/novo'))
                    <li class="nav-item">
                        <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('sva')}}>Obaveštenja</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Novo obaveštenje</li>
                        </ol>
                    </li>
                    @elseif(Request::is('obavestavanje/izmena/*'))
                    <li class="nav-item">
                        <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('sva')}}>Obaveštenja</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href={{route('profesorsko_obavestenje',['id'=>$obavestenje->id])}}>"{{ substr($obavestenje->naslov,0,10)}}..."</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Izmena "{{substr($obavestenje->naslov,0,10)}}..."</li>
                        </ol>
                    </li>
                    @elseif(Request::is('obavestavanje/*') && !Request::is('obavestavanje/sva') && !Request::is('obavestavanje/novo'))
                    <li class="nav-item">
                        <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                            <li class="breadcrumb-item"><a href={{ route('sva')}}>Obaveštenja</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> "{{substr($obavestenje->naslov,0,10)}}..."</li>
                        </ol>
                    </li>
                    @endif
                @endif
            </ul>
            @elsecan('isUser')
            <ul class="navbar-nav mr-auto">
                @if(Request::is('profil/*') || Request::is('kalendar') || Request::is('raspored_predavanja'))
                    <li class="nav-item">
                        <a class="nav-link @if(Request::is('profil/*')) active @endif ml-sm-3 mr-sm-3 ml-0 mr-0" href={{route('profil',['ime'=>Auth::user()->ime])}}><i
                                class="fas fa-user-graduate"></i>
                            Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Request::is('raspored_predavanja')) active @endif mr-sm-3 mr-0" href={{ route('raspored_predavanja') }}><i class="fas fa-table"></i> Raspored
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Request::is('kalendar')) active @endif" href={{ route('kalendar') }}><i class="far fa-calendar-alt"></i> Ispiti/Kolokvijumi
                        </a>
                    </li>
                @endif
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
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('studenti')}}>Studenti</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Novi </li>
                    </ol>
                </li>
                @elseif(Request::is('studenti/izmena_studenta/*'))
                <li class="nav-item">
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('studenti')}}>Studenti</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a
                                href={{route('student',['id'=>$student->id])}}>"{{$student->ime}}"</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Izmena
                        </li>
                    </ol>
                </li>
                @elseif(Request::is('studenti/student/*'))
                <li class="nav-item">
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('studenti')}}>Studenti</a></li>
                        <li class="breadcrumb-item active" aria-current="page">"{{$student->ime}}"</li>
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
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('profesori')}}>Profesori</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Novi </li>
                    </ol>
                </li>
                @elseif(Request::is('profesori/izmena_profesora/*'))
                <li class="nav-item">
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('profesori')}}>Profesori</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a
                                href={{route('profesor',['id'=>$profesor->id])}}>"{{$profesor->ime}}"</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Izmena
                        </li>
                    </ol>
                </li>
                @elseif(Request::is('profesori/profesor/*'))
                <li class="nav-item">
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('profesori')}}>Profesori</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> "{{$profesor->ime}}"</li>
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
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('predmeti')}}>Predmeti</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Novi</li>
                    </ol>
                </li>
                @elseif(Request::is('predmeti/izmena_predmeta/*'))
                <li class="nav-item">
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('predmeti')}}>Predmeti</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Izmena "{{$predmet->naziv}}"
                        </li>
                    </ol>
                </li>
                @elseif(Request::is('predmeti/kopiranje_predmeta/*'))
                <li class="nav-item">
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('predmeti')}}>Predmeti</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kopiranje "{{$predmet->naziv}}"
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
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('korisnici')}}>Korisnici</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Novi </li>
                    </ol>
                </li>
                @elseif(Request::is('korisnici/izmena_korisnika/*'))
                <li class="nav-item">
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('korisnici')}}>Korisnici</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Izmena "{{$korisnik->ime}}"
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
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('obavestenja')}}>Obaveštenja</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Novo </li>
                    </ol>
                </li>
                @elseif(Request::is('obavestenja/izmena_obavestenja/*'))
                <li class="nav-item">
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('obavestenja')}}>Obaveštenja</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href={{route('obavestenje',['id'=>$obavestenje->id])}}> "{{ substr($obavestenje->naslov,0,10)}}..."</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Izmena </li>
                    </ol>
                </li>
                @elseif(Request::is('obavestenja/obavestenje/*'))
                <li class="nav-item">
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('obavestenja')}}>Obaveštenja</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> "{{substr($obavestenje->naslov,0,10)}}..."</li>
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
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('smerovi')}}>Smerovi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Novi</li>
                    </ol>
                </li>
                @elseif(Request::is('smerovi/izmena_smera/*'))
                <li class="nav-item">
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('smerovi')}}>Smerovi</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href={{route('smerovi',['id'=>$smer->id])}}>"{{ substr($smer->naziv,0,10)}}..."</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Izmena </li>
                    </ol>
                </li>
                @elseif(Request::is('smerovi/smer/*'))
                <li class="nav-item">
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('smerovi')}}>Smerovi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">"{{substr($smer->naziv,0,10)}}..."</li>
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
                <a class="nav-link" href={{ route('raspored_ispita') }}><i class="far fa-calendar-alt"></i> Kalendar
                </a>
                </li>
                @endif
                @if(Request::is('raspored_ispita/novi_raspored'))
                <li class="nav-item">
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('raspored_ispita')}}>Kalendar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Novi </li>
                    </ol>
                </li>
                @elseif(Request::is('raspored_ispita/izmena_rasporeda/*'))
                <li class="nav-item">
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('raspored_ispita')}}>Kalendar</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href={{route('raspored_ispita',['id'=>$raspored->id])}}>{{$raspored->godina_studija}}. godina"{{ substr($raspored->smerovi->naziv,0,10)}}..."</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Izmena </li>
                    </ol>
                </li>
                @elseif(Request::is('raspored_ispita/jedan/*'))
                <li class="nav-item">
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('raspored_ispita')}}>Kalendar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$raspored->godina_studija}}. godina "{{substr($raspored->smerovi->naziv,0,10)}}..."</li>
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
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('raspored')}}>Raspored</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Novi </li>
                    </ol>
                </li>
                @elseif(Request::is('raspored/izmena_rasporeda/*'))
                <li class="nav-item">
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('raspored')}}>Raspored</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href={{route('raspored',['id'=>$raspored->id])}}>{{$raspored->godina_studija}}. godina"{{ substr($raspored->smerovi->naziv,0,10)}}..."</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Izmena</li>
                    </ol>
                </li>
                @elseif(Request::is('raspored/jedan/*'))
                <li class="nav-item">
                    <ol class="breadcrumb border border-secondary mt-1 mb-0 py-1">
                        <li class="breadcrumb-item"><a href={{ route('raspored')}}>Raspored</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$raspored->godina_studija}}. godina "{{substr($raspored->smerovi->naziv,0,10)}}..."</li>
                    </ol>
                </li>
                @endif


            </ul>
            @endcan
            <!-- Default dropleft button -->
            <div class="btn-group dropleft float-right">
                <button type="button" class="btn btn-primary border border-dark rounded dropdown-toggle" data-toggle="dropdown"
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
