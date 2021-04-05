@extends('layouts.app')
@section('title','Raspored predavanja')

@section('content')
<div class="container">
        {{-- ALERT MESSAGES START --}}
        @if(session('raspored'))
        <div class="row justify-content-center">
            <div class='col-lg-6 col-md-6 col-sm-12'>
                <div class="alert alert-{{ session('raspored')[0] }}" id="raspored">
                    {{ session('raspored')[1] }}</div>
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
                <h1 style="text-shadow: 2px 2px lightgray" class="font-weight-bold"><i class="fas fa-table"></i> Raspored predavanja
                </h1>

                <p class="lead">U ovoj sekciji se upravlja rasporedom <a
                        class="btn btn-primary border border-secondary rounded float-right font-weight-bold shadow" href={{ route('novi_raspored') }}
                        role="button">Novi</a></p>
            </div>
        </div>
        {{-- JUMBOTRON END --}}
            {{-- SCHEDULE COLLAPSE START  --}}
            <div class="row ">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card-header border border-white bg-dark py-2">
                        <h4 class="text-center font-weight-bold pt-1 text-light" style="text-shadow: 2px 2px black">Spisak
                            rasporeda po godini</h4>
                    </div>
                    <div class="card border-dark shadow-lg">
                        <div class="card-header pt-3">
                            <p class="text-center justify-content-around">
                                <a class="btn btn-outline-primary font-weight-bold shadow mt-1" data-toggle="collapse"
                                    href="#multiCollapseExample1" role="button" aria-expanded="false"
                                    aria-controls="multiCollapseExample1" style="width:138.512px; text-shadow: 1px 1px black">Prva godina <span
                                        class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                        title="<b>BROJ SMEROVA</b>" data-html="true">
                                        {{$rasporedi->where('godina_studija',1)->count()}}
                                    </span></a>
                                <button class="btn btn-primary border border-dark rounded font-weight-bold shadow mt-1" type="button"
                                    data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false"
                                    aria-controls="multiCollapseExample2" style="width:138.512px; text-shadow: 1px 1px black">Druga godina <span
                                        class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                        title="<b>BROJ SMEROVA</b>" data-html="true">
                                        {{$rasporedi->where('godina_studija',2)->count()}}
                                    </span></button>
                                <button class="btn btn-info border border-dark rounded font-weight-bold shadow mt-1" type="button" data-toggle="collapse"
                                    data-target="#multiCollapseExample3" aria-expanded="false"
                                    aria-controls="multiCollapseExample2" style="width:138.512px; text-shadow: 1px 1px gray">Treća godina <span
                                        class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                        title="<b>BROJ SMEROVA</b>" data-html="true">
                                        {{$rasporedi->where('godina_studija',3)->count()}}
                                    </span></button>
                                <button class="btn btn-dark font-weight-bold shadow mt-1" type="button" data-toggle="collapse"
                                    data-target="#multiCollapseExample4" aria-expanded="false"
                                    aria-controls="multiCollapseExample4" style="width:138.512px; text-shadow: 1px 1px black">Svi
                                    rasporedi <span class="badge badge-secondary shadow" data-toggle="tooltip"
                                        data-placement="top" title="<b>BROJ SMEROVA</b>" data-html="true">
                                        {{$rasporedi->count()}}
                                    </span></button>
                            </p>
                        </div>
                        <div class="row">
                            {{-- PRVA GODINA START --}}
                            <div class="col-lg-12 col-mg-12 col-sm-12">
                                <div class="collapse multi-collapse" id="multiCollapseExample1">
                                    <div class="card">
                                        <div class="card-header border border-dark">
                                            <h4 class="text-center font-weight-bold pt-2" style="text-shadow: 1px 1px gray">PRVA GODINA <span
                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                    data-placement="top" title="<b>BROJ RASPOREDA</b>" data-html="true">
                                                    {{$rasporedi->where('godina_studija',1)->count()}}
                                                </span></h4>
                                        </div>
                                        <div class="card-body bg-dark" id="prva">
                                            {{-- TABLE ALL SUBJECTS START --}}
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <table class="table table-dark table-hover table-striped table-striped table-responsive-lg border">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Smer</th>
                                                            <th scope="col">Ponedeljak</th>
                                                            <th scope="col">Utorak</th>
                                                            <th scope="col">Sreda</th>
                                                            <th scope="col">Četvrtak</th>
                                                            <th scope="col">Petak</th>
                                                            <th scope="col">Akcije</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($rasporedi->where('godina_studija',1) as $raspored)
                                                            <tr>
                                                                <td scope="col">{{$raspored->smerovi->naziv}}</td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->ponedeljak[0] != 'Nema predavanja' && !empty($raspored->ponedeljak[0])){
                                                                        if(count($raspored->ponedeljak)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->ponedeljak)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
                                                                </td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->utorak[0] != 'Nema predavanja' && !empty($raspored->utorak[0])){
                                                                        if(count($raspored->utorak)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->utorak)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
                                                                </td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->sreda[0] != 'Nema predavanja' && !empty($raspored->sreda[0])){
                                                                        if(count($raspored->sreda)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->sreda)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
                                                                </td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->cetvrtak[0] != 'Nema predavanja' && !empty($raspored->cetvrtak[0])){
                                                                        if(count($raspored->cetvrtak)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->cetvrtak)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
                                                                </td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->petak[0] != 'Nema predavanja' && !empty($raspored->petak[0])){
                                                                        if(count($raspored->petak)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->petak)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
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
                                                                    <a class="dropdown-item"
                                                                        href={{ route('jedan',['id'=>$raspored->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-eye" style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href={{ route('izmena_rasporeda',['id'=>$raspored->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{ $raspored->id }}1">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{ $raspored->id }}1"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header ">
                                                                            <h5 class="modal-title text-center text-dark"
                                                                                id="exampleModalLabel">Brisanje
                                                                                rasporeda
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-dark">
                                                                            <b>Da li stvarno želite da izbrišete
                                                                                raspored {{$raspored->godina_studija}}. godine
                                                                                "{{ $raspored->smerovi->naziv }}"?</b>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-center">
                                                                            <form
                                                                                action={{ route('brisanje_rasporeda', ['id'=>$raspored->id]) }}
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
                                                            {{-- Modal end --}}
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
                            {{-- PRVA GODINA END --}}
                            {{-- DRUGA GODINA START --}}
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="collapse multi-collapse" id="multiCollapseExample2">
                                    <div class="card">
                                        <div class="card-header border border-dark">
                                            <h4 class="text-center font-weight-bold pt-2" style="text-shadow: 1px 1px gray">DRUGA GODINA <span
                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                    data-placement="top" title="<b>BROJ RASPOREDA</b>" data-html="true">
                                                    {{$rasporedi->where('godina_studija',2)->count()}}
                                                </span></h4>
                                        </div>
                                        {{-- TABLE ALL SUBJECTS START --}}
                                        <div class="card-body bg-dark">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <table class="table table-dark table-hover table-striped table-striped table-responsive-lg border">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Smer</th>
                                                            <th scope="col">Ponedeljak</th>
                                                            <th scope="col">Utorak</th>
                                                            <th scope="col">Sreda</th>
                                                            <th scope="col">Četvrtak</th>
                                                            <th scope="col">Petak</th>
                                                            <th scope="col">Akcije</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($rasporedi->where('godina_studija',2) as $raspored)
                                                            <tr>
                                                                <td scope="col">{{$raspored->smerovi->naziv}}</td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->ponedeljak[0] != 'Nema predavanja' && !empty($raspored->ponedeljak[0])){
                                                                        if(count($raspored->ponedeljak)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->ponedeljak)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
                                                                </td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->utorak[0] != 'Nema predavanja' && !empty($raspored->utorak[0])){
                                                                        if(count($raspored->utorak)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->utorak)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
                                                                </td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->sreda[0] != 'Nema predavanja' && !empty($raspored->sreda[0])){
                                                                        if(count($raspored->sreda)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->sreda)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
                                                                </td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->cetvrtak[0] != 'Nema predavanja' && !empty($raspored->cetvrtak[0])){
                                                                        if(count($raspored->cetvrtak)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->cetvrtak)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
                                                                </td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->petak[0] != 'Nema predavanja' && !empty($raspored->petak[0])){
                                                                        if(count($raspored->petak)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->petak)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
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
                                                                    <a class="dropdown-item"
                                                                        href={{ route('jedan',['id'=>$raspored->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-eye" style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href={{ route('izmena_rasporeda',['id'=>$raspored->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{ $raspored->id }}2">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{ $raspored->id }}2"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header ">
                                                                            <h5 class="modal-title text-center text-dark"
                                                                                id="exampleModalLabel">Brisanje
                                                                                rasporeda
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-dark">
                                                                            <b>Da li stvarno želite da izbrišete
                                                                                raspored {{$raspored->godina_studija}}. godine
                                                                                "{{ $raspored->smerovi->naziv }}"?</b>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-center">
                                                                            <form
                                                                                action={{ route('brisanje_rasporeda', ['id'=>$raspored->id]) }}
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
                                        <div class="card-header border border-dark p-2">
                                            <h4 class="text-center font-weight-bold pt-2" style="text-shadow: 1px 1px gray">TREĆA GODINA <span
                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                    data-placement="top" title="<b>BROJ RASPOREDA</b>" data-html="true">
                                                    {{$rasporedi->where('godina_studija',3)->count()}}
                                                </span></h4>
                                        </div>
                                        <div class="card-body bg-dark">
                                            {{-- TABLE ALL SUBJECTS START --}}
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <table class="table table-dark table-hover table-striped table-striped table-responsive-lg border">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Smer</th>
                                                            <th scope="col">Ponedeljak</th>
                                                            <th scope="col">Utorak</th>
                                                            <th scope="col">Sreda</th>
                                                            <th scope="col">ČETVRTAK</th>
                                                            <th scope="col">Petak</th>
                                                            <th scope="col">Akcije</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($rasporedi->where('godina_studija',3) as $raspored)
                                                            <tr>
                                                                <td scope="col">{{$raspored->smerovi->naziv}}</td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->ponedeljak[0] != 'Nema predavanja' && !empty($raspored->ponedeljak[0])){
                                                                        if(count($raspored->ponedeljak)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->ponedeljak)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
                                                                </td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->utorak[0] != 'Nema predavanja' && !empty($raspored->utorak[0])){
                                                                        if(count($raspored->utorak)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->utorak)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
                                                                </td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->sreda[0] != 'Nema predavanja' && !empty($raspored->sreda[0])){
                                                                        if(count($raspored->sreda)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->sreda)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
                                                                </td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->cetvrtak[0] != 'Nema predavanja' && !empty($raspored->cetvrtak[0])){
                                                                        if(count($raspored->cetvrtak)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->cetvrtak)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
                                                                </td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->petak[0] != 'Nema predavanja' && !empty($raspored->petak[0])){
                                                                        if(count($raspored->petak)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->petak)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
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
                                                                    <a class="dropdown-item"
                                                                        href={{ route('jedan',['id'=>$raspored->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-eye" style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href={{ route('izmena_rasporeda',['id'=>$raspored->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{ $raspored->id }}3">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{ $raspored->id }}3"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header ">
                                                                            <h5 class="modal-title text-center text-dark"
                                                                                id="exampleModalLabel">Brisanje
                                                                                rasporeda
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-dark">
                                                                            <b>Da li stvarno želite da izbrišete
                                                                                raspored {{$raspored->godina_studija}}. godine
                                                                                "{{ $raspored->smerovi->naziv }}"?</b>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-center">
                                                                            <form
                                                                                action={{ route('brisanje_rasporeda', ['id'=>$raspored->id]) }}
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
                            {{-- TRECA GODINA END --}}
                            {{-- SVI PREDMETI START --}}
                            <div class="col-lg-12 col-mg-12 col-sm-12">
                                <div class="collapse multi-collapse show" id="multiCollapseExample4">
                                    <div class="card">
                                        <div class="card-header border border-dark p-2">

                                            <h4 class="text-center font-weight-bold" style="text-shadow: 1px 1px gray" focus>Svi rasporedi <span
                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                    data-placement="top" title="<b>BROJ PREDMETA</b>" data-html="true">
                                                    {{$rasporedi->count()}}
                                                </span></h4>
                                        </div>
                                        <div class="card-body bg-dark">
                                            {{-- TABLE ALL SUBJECTS START --}}
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <table class="table table-dark table-hover table-striped table-striped table-responsive-lg border">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Smer</th>
                                                            <th scope="col">Godina</th>
                                                            <th scope="col">Ponedeljak</th>
                                                            <th scope="col">Utorak</th>
                                                            <th scope="col">Sreda</th>
                                                            <th scope="col">Četvrtak</th>
                                                            <th scope="col">Petak</th>
                                                            <th scope="col">Akcije</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($rasporedi as $raspored)
                                                            <tr>
                                                                <td scope="col">{{$raspored->smerovi->naziv}}</td>
                                                                <td scope="col">{{$raspored->godina_studija}}</td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->ponedeljak[0] != 'Nema predavanja' && !empty($raspored->ponedeljak[0])){
                                                                        if(count($raspored->ponedeljak)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->ponedeljak)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
                                                                </td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->utorak[0] != 'Nema predavanja' && !empty($raspored->utorak[0])){
                                                                        if(count($raspored->utorak)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->utorak)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
                                                                </td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->sreda[0] != 'Nema predavanja' && !empty($raspored->sreda[0])){
                                                                        if(count($raspored->sreda)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->sreda)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
                                                                </td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->cetvrtak[0] != 'Nema predavanja' && !empty($raspored->cetvrtak[0])){
                                                                        if(count($raspored->cetvrtak)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->cetvrtak)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
                                                                </td>
                                                                <td scope="col">
                                                                    <span
                                                                    class="badge badge-secondary shadow" data-toggle="tooltip"
                                                                    data-placement="top" title="<b>BROJ PREDAVANJA</b>" data-html="true">
                                                                    @php
                                                                    if($raspored->petak[0] != 'Nema predavanja' && !empty($raspored->petak[0])){
                                                                        if(count($raspored->petak)==1){
                                                                            $i=1;
                                                                            echo $i;
                                                                        } else {
                                                                            $i=count($raspored->petak)/4;
                                                                            echo $i;
                                                                        }
                                                                    } else {
                                                                        $i='Nema predavanja';
                                                                        echo $i;
                                                                    }
                                                                    @endphp
                                                                    </span>
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
                                                                    <a class="dropdown-item"
                                                                        href={{ route('jedan',['id'=>$raspored->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-eye" style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href={{ route('izmena_rasporeda',['id'=>$raspored->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{ $raspored->id }}4">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{ $raspored->id }}4"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header ">
                                                                            <h5 class="modal-title text-center text-dark"
                                                                                id="exampleModalLabel">Brisanje
                                                                                rasporeda
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-dark">
                                                                            <b>Da li stvarno želite da izbrišete
                                                                                raspored {{$raspored->godina_studija}}. godine
                                                                                "{{ $raspored->smerovi->naziv }}"?</b>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-center">
                                                                            <form
                                                                                action={{ route('brisanje_rasporeda', ['id'=>$raspored->id]) }}
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

            {{-- SCHEDULE COLLAPSE END --}}
</div>

@endsection
