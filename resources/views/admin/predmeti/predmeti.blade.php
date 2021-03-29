@extends('layouts.app')
@section('title','Predmeti')

@section('content')

@if(session('predmet'))
<div class="row justify-content-center">
    <div class='col-lg-6 col-xs-12'>
        <div class="alert alert-{{ session('predmet')[0] }}" id="predmet">
            {{ session('predmet')[1] }}</div>
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

{{-- CONTAINER START --}}
<div class="container">
    {{-- JUMBOTRON START --}}
    <div class="jumbotron jumbotron-fluid py-2 px-2 bg-gradient-light border border-dark rounded-lg shadow-lg">
        <div class="container">
            <h1  style="text-shadow: 2px 2px lightgray"><i class="fas fa-book"></i> Predmeti</h1>

            <p class="lead">U ovoj sekciji se upravlja predmetima<a
                    class="btn btn-outline-primary float-right font-weight-bold shadow" href={{ route('novi_predmet') }}
                    role="button">Dodaj Predmet</a></p>
        </div>
    </div>
    {{-- JUMBOTRON END --}}
    {{-- COLLAPSE FOR SUBJECTS START --}}
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card-header border border-dark py-2">
                <h3 class="text-center font-weight-bold pt-1 text-light" style="text-shadow: 2px 2px gray">Spisak
                    predmeta po
                    godini</h3>
            </div>
            <div class="card border-dark shadow-lg">
                <div class="card-header pt-3">
                    <p class="text-center justify-content-around">
                        <a class="btn btn-outline-primary font-weight-bold shadow mt-1" data-toggle="collapse"
                            href="#multiCollapseExample1" role="button" aria-expanded="false"
                            aria-controls="multiCollapseExample1" style="width:138.512px">Prva godina <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>BROJ PREDMETA</b>" data-html="true">
                                {{$predmeti->where('godina_studija',1)->count()}}
                            </span></a>
                        <button class="btn btn-primary font-weight-bold shadow mt-1" type="button"
                            data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false"
                            aria-controls="multiCollapseExample2" style="width:138.512px">Druga godina <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>BROJ PREDMETA</b>" data-html="true">
                                {{$predmeti->where('godina_studija',2)->count()}}
                            </span></button>
                        <button class="btn btn-info font-weight-bold shadow mt-1" type="button" data-toggle="collapse"
                            data-target="#multiCollapseExample3" aria-expanded="false"
                            aria-controls="multiCollapseExample2" style="width:138.512px">Treća godina <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>BROJ PREDMETA</b>" data-html="true">
                                {{$predmeti->where('godina_studija',3)->count()}}
                            </span></button>
                        <button class="btn btn-dark font-weight-bold shadow mt-1" type="button" data-toggle="collapse"
                            data-target="#multiCollapseExample4" aria-expanded="false"
                            aria-controls="multiCollapseExample4" style="width:138.512px">Svi
                            predmeti <span class="badge badge-secondary shadow" data-toggle="tooltip"
                                data-placement="top" title="<b>BROJ PREDMETA</b>" data-html="true">
                                {{$predmeti->count()}}
                            </span></button>
                    </p>
                </div>
                <div class="row">
                    {{-- PRVA GODINA START --}}
                    <div class="col-lg-12 col-mg-12 col-sm-12">
                        <div class="collapse multi-collapse" id="multiCollapseExample1">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-center font-weight-bold pt-2">PRVA GODINA <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ PREDMETA</b>" data-html="true">
                                            {{$predmeti->where('godina_studija',1)->count()}}
                                        </span></h4>
                                </div>
                                <div class="card-body bg-dark" id="prva">
                                    {{-- TABLE ALL SUBJECTS START --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Sifra</th>
                                                        <th scope="col">Naziv</th>
                                                        <th scope="col">Smer</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Obavezni/Izborni</th>
                                                        <th scope="col">Akcije</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($predmeti as $predmet)
                                                    @if($predmet->godina_studija == 1)
                                                    <tr>

                                                        <td>{{ $predmet->sifra }}</td>
                                                        <td>{{ $predmet->naziv }}</td>
                                                        <td>{{ $predmet->smer->naziv }}</td>
                                                        <td>{{ $predmet->espb }}</td>
                                                        <td>{{ $predmet->obavezni_izborni }}</td>
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
                                                                    <a class="dropdown-item"
                                                                        href={{ route('izmena_predmeta',['id'=>$predmet->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href={{ route('kopiranje_predmeta',['id'=>$predmet->id]) }}
                                                                        role="button">
                                                                        <i class="far fa-copy" style="color:gray"></i>
                                                                        Kopiraj
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{ $predmet->id }}1">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{ $predmet->id }}1"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header ">
                                                                            <h5 class="modal-title text-center text-dark"
                                                                                id="exampleModalLabel">Brisanje
                                                                                studenta
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-dark">
                                                                            <b>Da li stvarno želite da izbrišete
                                                                                predmet
                                                                                "{{ $predmet->naziv }}"?</b>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-center">
                                                                            <form
                                                                                action={{ route('brisanje_predmeta', ['id'=>$predmet->id]) }}
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
                                </div>

                            </div>

                        </div>
                    </div>
                    {{-- PRVA GODINA END --}}
                    {{-- DRUGA GODINA START --}}
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="collapse multi-collapse" id="multiCollapseExample2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-center font-weight-bold pt-2">DRUGA GODINA <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ PREDMETA</b>" data-html="true">
                                            {{$predmeti->where('godina_studija',2)->count()}}
                                        </span></h4>
                                </div>
                                {{-- TABLE ALL SUBJECTS START --}}
                                <div class="card-body bg-dark">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Sifra</th>
                                                        <th scope="col">Naziv</th>
                                                        <th scope="col">Smer</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Obavezni/Izborni</th>
                                                        <th scope="col">Akcije</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($predmeti as $predmet)
                                                    @if($predmet->godina_studija==2)
                                                    <tr>

                                                        <td>{{ $predmet->sifra }}</td>
                                                        <td>{{ $predmet->naziv }}</td>
                                                        <td>{{ $predmet->smer->naziv }}</td>
                                                        <td>{{ $predmet->espb }}</td>
                                                        <td>{{ $predmet->obavezni_izborni }}</td>
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
                                                                    <a class="dropdown-item"
                                                                        href={{ route('izmena_predmeta',['id'=>$predmet->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href={{ route('kopiranje_predmeta',['id'=>$predmet->id]) }}
                                                                        role="button">
                                                                        <i class="far fa-copy" style="color:gray"></i>
                                                                        Kopiraj
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{ $predmet->id }}2">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{ $predmet->id }}2"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header ">
                                                                            <h5 class="modal-title text-center text-dark"
                                                                                id="exampleModalLabel">Brisanje
                                                                                studenta
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-dark">
                                                                            <b>Da li stvarno želite da izbrišete
                                                                                predmet
                                                                                "{{ $predmet->naziv }}"?</b>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-center">
                                                                            <form
                                                                                action={{ route('brisanje_predmeta', ['id'=>$predmet->id]) }}
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
                                </div>
                                {{-- TABLE ALL SUBJECTS END --}}
                            </div>
                        </div>
                    </div>
                    {{-- DRUGA GODINA END --}}
                    {{-- TRECA GODINA START --}}
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="collapse multi-collapse" id="multiCollapseExample3">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-center font-weight-bold pt-2">TREĆA GODINA <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ PREDMETA</b>" data-html="true">
                                            {{$predmeti->where('godina_studija',3)->count()}}
                                        </span></h4>
                                </div>
                                <div class="card-body bg-dark">
                                    {{-- TABLE ALL SUBJECTS START --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Sifra</th>
                                                        <th scope="col">Naziv</th>
                                                        <th scope="col">Smer</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Obavezni/Izborni</th>
                                                        <th scope="col">Akcije</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($predmeti as $predmet)
                                                    @if($predmet->godina_studija == 3)
                                                    <tr>

                                                        <td>{{ $predmet->sifra }}</td>
                                                        <td>{{ $predmet->naziv }}</td>
                                                        <td>{{ $predmet->smer->naziv }}</td>
                                                        <td>{{ $predmet->espb }}</td>
                                                        <td>{{ $predmet->obavezni_izborni }}</td>
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
                                                                    <a class="dropdown-item"
                                                                        href={{ route('izmena_predmeta',['id'=>$predmet->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href={{ route('kopiranje_predmeta',['id'=>$predmet->id]) }}
                                                                        role="button">
                                                                        <i class="far fa-copy" style="color:gray"></i>
                                                                        Kopiraj
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{ $predmet->id }}3">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{ $predmet->id }}3"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header ">
                                                                            <h5 class="modal-title text-center text-dark"
                                                                                id="exampleModalLabel">Brisanje
                                                                                studenta
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-dark">
                                                                            <b>Da li stvarno želite da izbrišete
                                                                                predmet
                                                                                "{{ $predmet->naziv }}"?</b>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-center">
                                                                            <form
                                                                                action={{ route('brisanje_predmeta', ['id'=>$predmet->id]) }}
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
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- TRECA GODINA END --}}
                    {{-- SVI PREDMETI START --}}
                    <div class="col-lg-12 col-mg-12 col-sm-12">
                        <div class="collapse multi-collapse show" id="multiCollapseExample4">
                            <div class="card">
                                <div class="card-header">

                                    <h4 class="text-center font-weight-bold pt-2" focus>SVI PREDMETI <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ PREDMETA</b>" data-html="true">
                                            {{$predmeti->count()}}
                                        </span></h4>
                                </div>
                                <div class="card-body bg-dark">
                                    {{-- TABLE ALL SUBJECTS START --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Sifra</th>
                                                        <th scope="col">Naziv</th>
                                                        <th scope="col">Smer</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Godina studija</th>
                                                        <th scope="col">Obavezni/Izborni</th>
                                                        <th scope="col">Akcije</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($predmeti as $predmet)
                                                    <tr>

                                                        <td>{{ $predmet->sifra }}</td>
                                                        <td>{{ $predmet->naziv }}</td>
                                                        <td>{{ $predmet->smer->naziv }}</td>
                                                        <td>{{ $predmet->espb }}</td>
                                                        <td>{{$predmet->godina_studija}}</td>
                                                        <td>{{ $predmet->obavezni_izborni }}</td>
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
                                                                    <a class="dropdown-item"
                                                                        href={{ route('izmena_predmeta',['id'=>$predmet->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href={{ route('kopiranje_predmeta',['id'=>$predmet->id]) }}
                                                                        role="button">
                                                                        <i class="far fa-copy" style="color:gray"></i>
                                                                        Kopiraj
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{ $predmet->id }}4">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{ $predmet->id }}4"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header ">
                                                                            <h5 class="modal-title text-center text-dark"
                                                                                id="exampleModalLabel">
                                                                                Brisanje
                                                                                studenta
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-dark">
                                                                            <b>Da li stvarno želite da izbrišete
                                                                                predmet
                                                                                "{{ $predmet->naziv }}"?</b>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-center">
                                                                            <form
                                                                                action={{ route('brisanje_predmeta', ['id'=>$predmet->id]) }}
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
                                </div>

                            </div>

                        </div>
                    </div>
                    {{-- SVI PREDMETI END --}}
                </div>
            </div>
        </div>
    </div>
    {{-- COLLAPSE FOR SUBJECT END --}}


</div>
{{-- CONTAINER END --}}
@endsection
