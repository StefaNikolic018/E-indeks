@extends('layouts.app')
@section('title','Obaveštenja')

@section('content')


<div class="container">
    {{-- ALERT MESSAGES START --}}
    @if(session('obavestenje'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-md-6 col-sm-12'>
            <div class="alert alert-{{ session('obavestenje')[0] }}">
                {{ session('obavestenje')[1] }}</div>
        </div>
    </div>
    @endif
    @if(url()->previous()==url('/login'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-md-6  col-sm-12'>
            <div class="alert alert-success shadow">Dobrodošli {{ Auth::user()->ime }}!</div>
        </div>
    </div>
    @endif
    {{-- ALERT MESSAGES END --}}
    {{-- JUMBOTRON START --}}
    <div class="jumbotron jumbotron-fluid py-2 px-2 rounded bg-gradient-light border border-dark shadow-lg">
        <div class="container">
            <h1 class="display-4" style="text-shadow: 2px 2px lightgray"><i class="fas fa-clipboard"></i> Obaveštenja
            </h1>

            <p class="lead">U ovoj sekciji se upravlja obaveštenjima <a
                    class="btn btn-outline-primary float-right font-weight-bold shadow" href={{ route('novo_obavestenje') }}
                    role="button">Dodaj
                    Obaveštenje</a></p>
        </div>
    </div>
    {{-- JUMBOTRON END --}}
    {{-- COLLAPSE FOR SUBJECTS START --}}
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card-header border border-dark py-2">
                <h3 class="text-center font-weight-bold pt-1 text-light" style="text-shadow: 2px 2px gray">Spisak
                    obaveštenja</h3>
            </div>
            <div class="card border-dark shadow-lg">
                <div class="card-header pt-3">
                    <p class="text-center justify-content-around">
                        <a class="btn btn-outline-primary font-weight-bold shadow mt-1" data-toggle="collapse"
                            href="#multiCollapseExample1" role="button" aria-expanded="false"
                            aria-controls="multiCollapseExample1" style="width:138.512px">Profesor
                            <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>PROFESORSKA OBAVEŠTENJA</b>" data-html="true">
                                {{$obavestenja->where('potpis','admin')->count()}}
                            </span>
                            @if($obavestenja->where('odobrenje',0)->where('potpis','admin')->count()>0)
                                <span
                                class="badge badge-danger badge-pill shadow" data-toggle="tooltip"
                                data-placement="top" title="<b>NEODOBRENA OBAVEŠTENJA</b>" data-html="true">
                                {{$obavestenja->where('odobrenje',0)->where('potpis','admin')->count()}}
                                </span>
                            @endif
                        </a>

                        <button class="btn btn-primary font-weight-bold shadow mt-1" type="button"
                            data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false"
                            aria-controls="multiCollapseExample2" style="width:138.512px">Admin
                            <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>ADMINISTRATORSKA OBAVEŠTENJA</b>" data-html="true">
                                {{$obavestenja->where('potpis','superAdmin')->count()}}
                            </span>
                            @if($obavestenja->where('odobrenje',0)->where('potpis','superAdmin')->count()>0)
                                <span
                                class="badge badge-danger badge-pill shadow" data-toggle="tooltip"
                                data-placement="top" title="<b>NEODOBRENA OBAVEŠTENJA</b>" data-html="true">
                                {{$obavestenja->where('odobrenje',0)->where('potpis','superAdmin')->count()}}
                                </span>
                            @endif

                        </button>

                            <button class="btn btn-dark font-weight-bold shadow mt-1" type="button" data-toggle="collapse"
                            data-target="#multiCollapseExample4" aria-expanded="false"
                            aria-controls="multiCollapseExample4" style="width:138.512px">Sva
                            <span class="badge badge-secondary shadow" data-toggle="tooltip"
                                data-placement="top" title="<b>BROJ OBAVEŠTENJA</b>" data-html="true">
                                {{$obavestenja->count()}}
                            </span>
                            @if($obavestenja->where('odobrenje',0)->count()>0)
                                <span
                                class="badge badge-danger badge-pill shadow" data-toggle="tooltip"
                                data-placement="top" title="<b>NEODOBRENA OBAVEŠTENJA</b>" data-html="true">
                                {{$obavestenja->where('odobrenje',0)->count()}}
                                </span>
                            @endif
                        </button>
                    </p>
                </div>
                <div class="row">
                    {{-- PROFESORSKA OBAVESTENJA START --}}
                    <div class="col-lg-12 col-mg-12 col-sm-12">
                        <div class="collapse multi-collapse " id="multiCollapseExample2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-center font-weight-bold pt-2">Administrator
                                        <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ OBAVEŠTENJA</b>" data-html="true">
                                            {{$obavestenja->where('potpis','superAdmin')->count()}}
                                        </span>
                                        @if($obavestenja->where('odobrenje',0)->where('potpis','superAdmin')->count()>0)
                                        <span
                                            class="badge badge-danger badge-pill shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>NEODOBRENA OBAVEŠTENJA</b>" data-html="true">
                                            {{$obavestenja->where('odobrenje',0)->where('potpis','superAdmin')->count()}}
                                        </span>
                                        @endif

                                    </h4>
                                </div>
                                <div class="card-body bg-dark">
                                    {{-- TABLE ADMIN NOTES START --}}
                                                                        {{-- TABLE ALL SUBJECTS START --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Naslov</th>
                                                        <th scope="col">Obaveštenje</th>
                                                        <th scope="col">Datum</th>
                                                        <th scope="col" class="pl-4">Odobrenje</th>
                                                        <th scope="col"> &nbsp;Akcije</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($obavestenja as $obavestenje)
                                                    @if($obavestenje->potpis=='superAdmin')
                                                    <tr class="@if($obavestenje->odobrenje=='0') border border-right-0 border-top-0 border-bottom-0 border-danger @endif">
                                                        <td>{{ $obavestenje->naslov }}</td>
                                                        <td>{{ substr($obavestenje->obavestenje,0,10) }}...</td>
                                                        <td>{{ $obavestenje->datum }}</td>
                                                        <td>
                                                            @if($obavestenje->odobrenje=='0')
                                                            <a class="btn btn-success font-weight-bold shadow" href="{{ route('odobrenje_obavestenja',['id'=>$obavestenje->id,'odobrenje'=>1]) }}" role="button">ODOBRITI</a>

                                                            @elseif($obavestenje->odobrenje=='1')
                                                            <a class="btn btn-danger font-weight-bold shadow" href="{{ route('odobrenje_obavestenja',['id'=>$obavestenje->id,'odobrenje'=>0]) }}" role="button">ZABRANITI</a>
                                                            @endif

                                                        </td>

                                                        <td class="d-inline-flex">

                                                            <!-- Split dropright button -->
                                                            <div class="btn-group dropright">
                                                                <button type="button" class="btn btn-primary">
                                                                    Upravljaj
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-info dropdown-toggle dropdown-toggle-split"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <span class="sr-only">Toggle Dropright</span>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a href="{{ route('obavestenje',['id'=>$obavestenje->id]) }}"
                                                                        class="dropdown-item" role="button">
                                                                        <i class="fas fa-eye"
                                                                            style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href={{ route('izmena_obavestenja', ['id'=>$obavestenje->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{ $obavestenje->id }}">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{ $obavestenje->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header ">
                                                                            <h5 class="modal-title text-center text-dark"
                                                                                id="exampleModalLabel">
                                                                                Brisanje obaveštenja
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-dark">
                                                                            <b>Da li stvarno želite da izbrišete
                                                                                obaveštenje
                                                                                "{{ $obavestenje->naslov }}"?</b>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-center">
                                                                            <form
                                                                                action={{ route('brisanje_obavestenja', ['id'=>$obavestenje->id]) }}
                                                                                method="POST">
                                                                                @csrf
                                                                                <button class="btn btn-danger">
                                                                                    Da</button>
                                                                            </form>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Ne</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    {{-- TABLE ALL SUBJECTS END --}}
                                    {{-- TABLE ADMIN NOTES END --}}
                                    {{-- TABLE ALL NOTES START --}}
                                    {{-- TABLE ALL NOTES END --}}
                                </div>

                            </div>

                        </div>
                    </div>
                    {{-- PROFESORSKA OBAVESTENJA END --}}

                    {{-- ADMINISTRATORSKA OBAVESTENJA START --}}
                    <div class="col-lg-12 col-mg-12 col-sm-12">
                        <div class="collapse multi-collapse" id="multiCollapseExample1">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-center font-weight-bold pt-2">Profesor
                                        <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ OBAVEŠTENJA</b>" data-html="true">
                                            {{$obavestenja->where('potpis','admin')->count()}}
                                        </span>
                                        @if($obavestenja->where('odobrenje',0)->where('potpis','admin')->count()>0)
                                        <span
                                            class="badge badge-danger badge-pill shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>NEODOBRENA OBAVEŠTENJA</b>" data-html="true">
                                            {{$obavestenja->where('odobrenje',0)->where('potpis','admin')->count()}}
                                        </span>
                                        @endif

                                    </h4>
                                </div>
                                <div class="card-body bg-dark">
                                    {{-- TABLE ADMIN NOTES START --}}
                                                                        {{-- TABLE ALL SUBJECTS START --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Naslov</th>
                                                        <th scope="col">Obaveštenje</th>
                                                        <th scope="col">Datum</th>
                                                        <th scope="col" class="pl-4">Odobrenje</th>
                                                        <th scope="col"> &nbsp;Akcije</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($obavestenja as $obavestenje)
                                                    @if($obavestenje->potpis=='admin')
                                                    <tr class="@if($obavestenje->odobrenje=='0') border border-right-0 border-top-0 border-bottom-0 border-danger @endif">
                                                        <td>{{ $obavestenje->naslov }}</td>
                                                        <td>{{ substr($obavestenje->obavestenje,0,10) }}...</td>
                                                        <td>{{ $obavestenje->datum }}</td>
                                                        <td>
                                                            @if($obavestenje->odobrenje=='0')
                                                            <a class="btn btn-success font-weight-bold shadow" href="{{ route('odobrenje_obavestenja',['id'=>$obavestenje->id,'odobrenje'=>1]) }}" role="button">ODOBRITI</a>

                                                            @elseif($obavestenje->odobrenje=='1')
                                                            <a class="btn btn-danger font-weight-bold shadow" href="{{ route('odobrenje_obavestenja',['id'=>$obavestenje->id,'odobrenje'=>0]) }}" role="button">ZABRANITI</a>
                                                            @endif

                                                        </td>

                                                        <td class="d-inline-flex">

                                                            <!-- Split dropright button -->
                                                            <div class="btn-group dropright">
                                                                <button type="button" class="btn btn-primary">
                                                                    Upravljaj
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-info dropdown-toggle dropdown-toggle-split"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <span class="sr-only">Toggle Dropright</span>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a href="{{ route('obavestenje',['id'=>$obavestenje->id]) }}"
                                                                        class="dropdown-item" role="button">
                                                                        <i class="fas fa-eye"
                                                                            style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href={{ route('izmena_obavestenja', ['id'=>$obavestenje->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{ $obavestenje->id }}">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{ $obavestenje->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header ">
                                                                            <h5 class="modal-title text-center text-dark"
                                                                                id="exampleModalLabel">
                                                                                Brisanje obaveštenja
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-dark">
                                                                            <b>Da li stvarno želite da izbrišete
                                                                                obaveštenje
                                                                                "{{ $obavestenje->naslov }}"?</b>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-center">
                                                                            <form
                                                                                action={{ route('brisanje_obavestenja', ['id'=>$obavestenje->id]) }}
                                                                                method="POST">
                                                                                @csrf
                                                                                <button class="btn btn-danger">
                                                                                    Da</button>
                                                                            </form>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Ne</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    {{-- TABLE ALL SUBJECTS END --}}
                                    {{-- TABLE ADMIN NOTES END --}}
                                </div>

                            </div>

                        </div>
                    </div>
                    {{-- ADMINISTRATORSKA OBAVESTENJA END --}}

                    {{-- SVA OBAVESTENJA START --}}
                    <div class="col-lg-12 col-mg-12 col-sm-12">
                        <div class="collapse multi-collapse show" id="multiCollapseExample4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-center font-weight-bold pt-2">Sva obaveštenja
                                        <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>SVA OBAVEŠTENJA</b>" data-html="true">
                                            {{$obavestenja->count()}}
                                        </span>
                                        @if($obavestenja->where('odobrenje',0)->count()>0)
                                        <span
                                            class="badge badge-danger badge-pill shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>NEODOBRENA OBAVEŠTENJA</b>" data-html="true">
                                            {{$obavestenja->where('odobrenje',0)->count()}}
                                        </span>
                                        @endif

                                    </h4>
                                </div>
                                <div class="card-body bg-dark">
                                    {{-- TABLE ADMIN NOTES START --}}
                                                                        {{-- TABLE ALL SUBJECTS START --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Naslov</th>
                                                        <th scope="col">Obaveštenje</th>
                                                        <th scope="col">Potpis</th>
                                                        <th scope="col">Datum</th>
                                                        <th scope="col" class="pl-4">Odobrenje</th>
                                                        <th scope="col"> &nbsp;Akcije</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($obavestenja as $obavestenje)
                                                    <tr class="@if($obavestenje->odobrenje=='0') border border-right-0 border-top-0 border-bottom-0 border-danger @endif">
                                                        <td>{{ $obavestenje->naslov }}</td>
                                                        <td>{{ substr($obavestenje->obavestenje,0,10) }}...</td>
                                                        <td>
                                                            @if($obavestenje->potpis=='admin')
                                                                Profesor
                                                            @elseif($obavestenje->potpis=='superAdmin')
                                                                Administrator
                                                            @endif
                                                        </td>

                                                        <td>{{ $obavestenje->datum }}</td>
                                                        <td>
                                                            @if($obavestenje->odobrenje=='0')
                                                            <a class="btn btn-success font-weight-bold shadow" href="{{ route('odobrenje_obavestenja',['id'=>$obavestenje->id,'odobrenje'=>1]) }}" role="button">ODOBRITI</a>

                                                            @elseif($obavestenje->odobrenje=='1')
                                                            <a class="btn btn-danger font-weight-bold shadow" href="{{ route('odobrenje_obavestenja',['id'=>$obavestenje->id,'odobrenje'=>0]) }}" role="button">ZABRANITI</a>
                                                            @endif

                                                        </td>

                                                        <td class="d-inline-flex">

                                                            <!-- Split dropright button -->
                                                            <div class="btn-group dropright">
                                                                <button type="button" class="btn btn-primary">
                                                                    Upravljaj
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-info dropdown-toggle dropdown-toggle-split"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <span class="sr-only">Toggle Dropright</span>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a href="{{ route('obavestenje',['id'=>$obavestenje->id]) }}"
                                                                        class="dropdown-item" role="button">
                                                                        <i class="fas fa-eye"
                                                                            style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href={{ route('izmena_obavestenja', ['id'=>$obavestenje->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{ $obavestenje->id }}">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{ $obavestenje->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header ">
                                                                            <h5 class="modal-title text-center text-dark"
                                                                                id="exampleModalLabel">
                                                                                Brisanje obaveštenja
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-dark">
                                                                            <b>Da li stvarno želite da izbrišete
                                                                                obaveštenje
                                                                                "{{ $obavestenje->naslov }}"?</b>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-center">
                                                                            <form
                                                                                action={{ route('brisanje_obavestenja', ['id'=>$obavestenje->id]) }}
                                                                                method="POST">
                                                                                @csrf
                                                                                <button class="btn btn-danger">
                                                                                    Da</button>
                                                                            </form>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Ne</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    {{-- TABLE ALL SUBJECTS END --}}
                                    {{-- TABLE ADMIN NOTES END --}}
                                </div>

                            </div>

                        </div>
                    </div>
                    {{-- SVA OBAVESTENJA END --}}
                </div>
            </div>
        </div>
    </div>
    {{-- COLLAPSE FOR STUDENTS END --}}



</div>
@endsection