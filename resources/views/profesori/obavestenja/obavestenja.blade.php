@extends('layouts.app')
@section('title','Evidencija Studenata | Obaveštenja')

@section('content')


<div class="container" id="kontejner">

    @if(session('obavestenje'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-md-6 col-sm-12'>
            <div class="alert alert-{{ session('obavestenje')[0] }}" id="obavestenje">
                {{ session('obavestenje')[1] }}</div>
        </div>
    </div>
    @endif
    @if(url()->previous()==url('/login'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-md-6  col-sm-12'>
            <div class="alert alert-success shadow" id="welcome">Dobrodošli {{ Auth::user()->ime }}!</div>
        </div>
    </div>
    @endif
    {{-- ALERT MESSAGES END --}}
    {{-- JUMBOTRON START --}}
    <div class="jumbotron jumbotron-fluid py-2 px-2 rounded bg-gradient-white border border-dark shadow-lg mb-2">
        <div class="container border border-secondary rounded shadow bg-gradient-light py-2">
            <h1 style="text-shadow: 2px 2px lightgray" class="font-weight-bold"><i class="fas fa-clipboard"></i> Obaveštenja
            </h1>

            <p class="lead">U ovoj sekciji se upravlja obaveštenjima <a
                    class="btn btn-primary border border-secondary rounded float-right font-weight-bold shadow" href={{ route('novo') }}
                    role="button">Novo</a></p>
        </div>
    </div>
    {{-- JUMBOTRON END --}}
    {{-- COLLAPSE FOR SUBJECTS START --}}
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card-header border border-white bg-dark py-2">
                <h4 class="text-center font-weight-bold pt-1 text-light" style="text-shadow: 2px 2px black">Spisak
                    obaveštenja</h4>
            </div>
            <div class="card border-dark shadow-lg">
                <div class="card-header pt-3">
                    <p class="text-center justify-content-around">
                        <a class="btn btn-outline-primary font-weight-bold shadow mt-1" data-toggle="collapse"
                            href="#multiCollapseExample1" role="button" aria-expanded="false"
                            aria-controls="multiCollapseExample1" style="width:138.512px; text-shadow: 1px 1px black">Prof
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

                        <button class="btn btn-primary font-weight-bold shadow mt-1 border border-dark rounded" type="button"
                            data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false"
                            aria-controls="multiCollapseExample2" style="width:138.512px; text-shadow: 1px 1px black">Admin
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
                            aria-controls="multiCollapseExample4" style="width:138.512px; text-shadow: 1px 1px black">Sva
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
                                            <table class="table table-dark table-hover table-responsive-lg table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Naslov</th>
                                                        <th scope="col">Obaveštenje</th>
                                                        <th scope="col">Smer</th>
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
                                                        <td>{{ ucfirst($obavestenje->smer) }}</td>
                                                        <td>{{ $obavestenje->datum }}</td>
                                                        <td>
                                                            @if($obavestenje->odobrenje=='0')
                                                            {{-- <a class="btn btn-success font-weight-bold shadow" href="{{ route('odobrenje_obavestenja',['id'=>$obavestenje->id,'odobrenje'=>1]) }}" role="button">ODOBRITI</a> --}}
                                                            <div class="alert alert-danger p-1 text-center">NEODOBRENO</div>

                                                            @elseif($obavestenje->odobrenje=='1')
                                                            {{-- <a class="btn btn-danger font-weight-bold shadow" href="{{ route('odobrenje_obavestenja',['id'=>$obavestenje->id,'odobrenje'=>0]) }}" role="button">ZABRANITI</a> --}}
                                                            <div class="alert alert-success p-1 text-center">ODOBRENO</div>
                                                            @endif
                                                        </td>

                                                        <td class="d-inline-flex">
                                                            @if($obavestenje->user->id==Auth::user()->id)
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
                                                                    <a href="{{ route('profesorsko_obavestenje',['id'=>$obavestenje->id]) }}"
                                                                        class="dropdown-item" role="button">
                                                                        <i class="fas fa-eye"
                                                                            style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href={{ route('izmena', ['id'=>$obavestenje->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{ $obavestenje->id }}1">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{ $obavestenje->id }}1"
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
                                                                                action={{ route('brisanje', ['id'=>$obavestenje->id]) }}
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
                                                            @else
                                                            <a href="{{ route('profesorsko_obavestenje',['id'=>$obavestenje->id]) }}"
                                                                        class="btn btn-info" role="button">
                                                                        <i class="fas fa-eye"
                                                                            style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>
                                                            @endif
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
                                            <table class="table table-dark table-hover table-responsive-lg table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Naslov</th>
                                                        <th scope="col">Obaveštenje</th>
                                                        <th scope="col">Smer</th>
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
                                                        <td>{{ ucfirst($obavestenje->smer) }}</td>
                                                        <td>{{ $obavestenje->datum }}</td>
                                                        <td>
                                                            @if($obavestenje->odobrenje=='0')
                                                            {{-- <a class="btn btn-success font-weight-bold shadow" href="{{ route('odobrenje_obavestenja',['id'=>$obavestenje->id,'odobrenje'=>1]) }}" role="button">ODOBRITI</a> --}}
                                                            <div class="alert alert-danger p-1 text-center">NEODOBRENO</div>

                                                            @elseif($obavestenje->odobrenje=='1')
                                                            {{-- <a class="btn btn-danger font-weight-bold shadow" href="{{ route('odobrenje_obavestenja',['id'=>$obavestenje->id,'odobrenje'=>0]) }}" role="button">ZABRANITI</a> --}}
                                                            <div class="alert alert-success p-1 text-center">ODOBRENO</div>
                                                            @endif

                                                        </td>

                                                        <td class="d-inline-flex">
                                                            @if($obavestenje->user->id==Auth::user()->id)
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
                                                                    <a href="{{ route('profesorsko_obavestenje',['id'=>$obavestenje->id]) }}"
                                                                        class="dropdown-item" role="button">
                                                                        <i class="fas fa-eye"
                                                                            style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href={{ route('izmena', ['id'=>$obavestenje->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{ $obavestenje->id }}2">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{ $obavestenje->id }}2"
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
                                                                                action={{ route('brisanje', ['id'=>$obavestenje->id]) }}
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
                                                            @else
                                                            <a href="{{ route('profesorsko_obavestenje',['id'=>$obavestenje->id]) }}"
                                                                        class="btn btn-info" role="button">
                                                                        <i class="fas fa-eye"
                                                                            style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>
                                                            @endif
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
                                <div class="card-header border border-dark p-2">
                                    <h4 class="text-center font-weight-bold" style="text-shadow: 1px 1px gray">Sva obaveštenja
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
                                            <table class="table table-dark table-hover table-responsive-lg table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Naslov</th>
                                                        <th scope="col">Obaveštenje</th>
                                                        <th scope="col">Smer</th>
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
                                                        <td>{{ ucfirst($obavestenje->smer) }}</td>
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
                                                            {{-- <button class="btn btn-success font-weight-bold shadow" onclick="odobrenje('1',{{$obavestenje->id}})">ODOBRITI</button> --}}
                                                            {{-- <a class="btn btn-success font-weight-bold shadow" href="{{ route('odobrenje_obavestenja',['id'=>$obavestenje->id,'odobrenje'=>1]) }}" role="button">ODOBRITI</a> --}}
                                                            <div class="alert alert-danger p-1 text-center">NEODOBRENO</div>


                                                            @elseif($obavestenje->odobrenje=='1')
                                                            {{-- <button class="btn btn-danger font-weight-bold shadow" onclick="odobrenje('0',{{$obavestenje->id}})">ZABRANITI</button> --}}
                                                            {{-- <a class="btn btn-danger font-weight-bold shadow" href="{{ route('odobrenje_obavestenja',['id'=>$obavestenje->id,'odobrenje'=>0]) }}" role="button">ZABRANITI</a> --}}
                                                            <div class="alert alert-success p-1 text-center">ODOBRENO</div>

                                                            @endif

                                                        </td>

                                                        <td class="d-inline-flex">
                                                            @if($obavestenje->user->id==Auth::user()->id)
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
                                                                    <a href="{{ route('profesorsko_obavestenje',['id'=>$obavestenje->id]) }}"
                                                                        class="dropdown-item" role="button">
                                                                        <i class="fas fa-eye"
                                                                            style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href={{ route('izmena', ['id'=>$obavestenje->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{ $obavestenje->id }}3">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{ $obavestenje->id }}3"
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
                                                                                action={{ route('brisanje', ['id'=>$obavestenje->id]) }}
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
                                                            @else
                                                            <a href="{{ route('profesorsko_obavestenje',['id'=>$obavestenje->id]) }}"
                                                                        class="btn btn-info" role="button">
                                                                        <i class="fas fa-eye"
                                                                            style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>
                                                            @endif
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
{{-- <script>
    function odobrenje(odobrenje,id){
        console.log(odobrenje);
        let izmenaUrl = "{{ route('odobrenje_obavestenja',[':id',':odobrenje']) }}";
        izmenaUrl = izmenaUrl.replace(':id',id);
        izmenaUrl= izmenaUrl.replace(':odobrenje',odobrenje);
        $.ajax({
            type: "POST",
            url: izmenaUrl,
            data: {
                id: id,
                odobrenje: odobrenje,
            },
            headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
            success:function(){
                    document.getElementById('obavestenjeUspeh').classList.remove('d-none');
                    $("#obavestenjeUspeh").fadeTo(2000, 500).slideUp(500, function(){
                        $("#obavestenjeUspeh").slideUp(500);
                    });
                    let html='<div class="row justify-content-center d-none" id="obavestenjeUspeh">';
                    html+='<div class="col-lg-6 col-md-6 col-sm-12">';
                    html+='<div class="alert alert-success">';
                    html+='Uspešno izmenjen status obaveštenja!';
                    html+='</div>';
                    html+='</div>';
                    html+='</div>';
                    document.getElementById('kontejner').insertAdjacentHTML('beforeBegin',html);
            },error:function(){
                    document.getElementById('obavestenjeGreska').classList.remove('d-none');
                    $("#obavestenjeGreska").fadeTo(2000, 500).slideUp(500, function(){
                        $("#obavestenjeGreska").slideUp(500);
                    });
                    let html='<div class="row justify-content-center d-none" id="obavestenjeGreska">';
                    html+='<div class="col-lg-6 col-md-6 col-sm-12">';
                    html+='<div class="alert alert-danger">';
                    html+='Došlo je do greške, pokušajte ponovo!';
                    html+='</div>';
                    html+='</div>';
                    html+='</div>';
                    document.getElementById('kontejner').insertAdjacentHTML('beforeBegin',html);
            }
        });
    }
</script> --}}
@endsection
