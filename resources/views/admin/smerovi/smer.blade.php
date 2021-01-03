@section('title','Smer "'.$smer->naziv.'"')
@extends('layouts.app')

@section('content')


<div class="container">
    {{-- ALERT MESSAGES START --}}
    @if(session('smer'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-md-6 col-sm-12'>
            <div class="alert alert-{{ session('smer')[0] }}">
                {{ session('smer')[1] }}</div>
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
            <h1 class="text-center" style="text-shadow: 1px 1px lightgray"> <span class="float-left">
                <a class="btn btn-dark font-weight-bold" style="text-shadow: 0px 0px"
                href={{ route('izmena_smera', ['id'=>$smer->id]) }}
                role="button">
                <i class="fas fa-edit" style="color:orange"></i>
                Izmeni
            </a></span>
            {{$smer->naziv}}
            <span class="float-right">
                <button class="btn btn-dark font-weight-bold" data-toggle="modal"
                data-target="#exampleModal{{ $smer->id }}">
                <i class="fas fa-trash-alt"
                    style="color:red"></i>
                Obriši
            </button>

            </span>
            </h1>
             <!-- Modal -->
             <div class="modal fade" id="exampleModal{{ $smer->id }}"
                tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title text-center text-dark"
                                id="exampleModalLabel">
                                Brisanje smera
                            </h5>
                            <button type="button" class="close"
                                data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center text-dark">
                            <b>Da li stvarno želite da izbrišete
                                smer
                                "{{ $smer->naziv }}"?</b>
                        </div>
                        <div
                            class="modal-footer justify-content-center">
                            <form
                                action={{ route('brisanje_smera', ['id'=>$smer->id]) }}
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

            <h4 class=" text-center">{{$smer->opis}}</h4>
            <hr>
            <h6 class="font-weight-bold">ESPB: {{$smer->espb}} <span class="float-right"> Akreditovan: {{$smer->akreditovan}}. godine</span></h6>
        </div>
    </div>
    {{-- JUMBOTRON END --}}
        {{-- COLLAPSE FOR SUBJECTS START --}}
        <div class="row ">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card-header border border-dark py-2">
                    <h3 class="text-center font-weight-bold pt-1" style="text-shadow: 2px 2px rgb(180,180,180)">Spisak predmeta
                    </h3>
                </div>
                <div class="card border-dark shadow-lg">
                    <div class="card-header pt-3">
                        <p class="text-center justify-content-around">
                            <a class="btn btn-outline-primary font-weight-bold shadow mt-1" data-toggle="collapse"
                                href="#multiCollapseExample1" role="button" aria-expanded="false"
                                aria-controls="multiCollapseExample1" style="width:138.512px">Prva godina <span
                                    class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                    title="<b>BROJ PREDMETA</b>" data-html="true">
                                    @php
                                        $i=0;
                                        foreach ($smer->predmeti as $predmet){
                                        if($predmet->godina_studija==1){
                                        $i++;

                                        }
                                        }
                                        echo $i;
                                    @endphp
                                </span></a>

                            <button class="btn btn-primary font-weight-bold shadow mt-1" type="button"
                                data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false"
                                aria-controls="multiCollapseExample2" style="width:138.512px">Druga godina <span
                                    class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                    title="<b>BROJ PREDMETA</b>" data-html="true">
                                    @php
                                        $i=0;
                                        foreach ($smer->predmeti as $predmet){
                                        if($predmet->godina_studija==2){
                                        $i++;

                                        }
                                        }
                                        echo $i;
                                    @endphp
                                </span></button>
                            <button class="btn btn-info font-weight-bold shadow mt-1" type="button" data-toggle="collapse"
                                data-target="#multiCollapseExample3" aria-expanded="false"
                                aria-controls="multiCollapseExample2" style="width:138.512px">Treća godina <span
                                    class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                    title="<b>BROJ PREDMETA</b>" data-html="true">
                                    @php
                                        $i=0;
                                        foreach ($smer->predmeti as $predmet){
                                        if($predmet->godina_studija==3){
                                        $i++;

                                        }
                                        }
                                        echo $i;
                                    @endphp
                                </span></button>
                            <button class="btn btn-dark font-weight-bold shadow mt-1" type="button" data-toggle="collapse"
                                data-target="#multiCollapseExample4" aria-expanded="false"
                                aria-controls="multiCollapseExample4" style="width:138.512px">Svi predmeti <span
                                    class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                    title="<b>BROJ PREDMETA</b>" data-html="true">
                                    {{count($smer->predmeti)}}
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
                                                @php
                                                    $i=0;
                                                    foreach ($smer->predmeti as $predmet){
                                                    if($predmet->godina_studija==1){
                                                    $i++;

                                                    }
                                                    }
                                                    echo $i;
                                                @endphp
                                            </span>
                                            <span
                                                class="badge badge-warning shadow" data-toggle="tooltip" data-placement="top"
                                                title="<b>ESPB 1. GODINA</b>" data-html="true">
                                                @php
                                                    $espb=0;
                                                    foreach ($smer->predmeti as $predmet){
                                                    if($predmet->godina_studija==1){
                                                    $espb+=$predmet->espb;

                                                    }
                                                    }
                                                    echo $espb;
                                                @endphp
                                            </span>
                                        </h4>
                                    </div>
                                    <div class="card-body bg-dark">
                                        {{-- TABLE SUBJECTS FIRST YEAR START --}}
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table table-dark table-hover table-responsive-sm">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Sifra</th>
                                                            <th scope="col">Naziv</th>
                                                            <th scope="col">Obavezni/Izborni</th>
                                                            <th scope="col">ESPB</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($smer->predmeti as $predmet)
                                                        @if($predmet->godina_studija==1)
                                                        <tr>
                                                            <td>{{ $predmet->sifra}}</td>
                                                            <td>{{ $predmet->naziv }}</td>
                                                            <td>{{ $predmet->obavezni_izborni }}</td>
                                                            <td>{{ $predmet->espb}}</td>
                                                        </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        {{-- TABLE SUBJECTS FIRST YEAR END --}}
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
                                                @php
                                                    $i=0;

                                                    foreach ($smer->predmeti as $predmet){
                                                    if($predmet->godina_studija==2){
                                                    $i++;

                                                    }
                                                    }
                                                    echo $i;
                                                @endphp
                                            </span>
                                            <span
                                                class="badge badge-warning shadow" data-toggle="tooltip" data-placement="top"
                                                title="<b>ESPB 2. GODINA</b>" data-html="true">
                                                @php
                                                    $espb=0;
                                                    foreach ($smer->predmeti as $predmet){
                                                    if($predmet->godina_studija==2){
                                                    $espb+=$predmet->espb;

                                                    }
                                                    }
                                                    echo $espb;
                                                @endphp
                                            </span>
                                        </h4>
                                    </div>
                                    {{-- TABLE SUBJECTS SECOND YEAR START --}}
                                    <div class="card-body bg-dark">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table table-dark table-hover table-responsive-sm">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Sifra</th>
                                                            <th scope="col">Naziv</th>
                                                            <th scope="col">Obavezni/Izborni</th>
                                                            <th scope="col">ESPB</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($smer->predmeti as $predmet)
                                                            @if($predmet->godina_studija==2)
                                                        <tr>
                                                            <td>{{ $predmet->sifra}}</td>
                                                            <td>{{ $predmet->naziv }}</td>

                                                            <td>{{ $predmet->obavezni_izborni }}</td>
                                                            <td>{{ $predmet->espb}}</td>
                                                        </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                    {{-- TABLE SUBJECTS SECOND YEAR END --}}
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
                                                @php
                                                    $i=0;

                                                    foreach ($smer->predmeti as $predmet){
                                                    if($predmet->godina_studija==3){
                                                    $i++;

                                                    }
                                                    }
                                                    echo $i;
                                                @endphp
                                            </span>
                                            <span
                                                class="badge badge-warning shadow" data-toggle="tooltip" data-placement="top"
                                                title="<b>ESPB 3. GODINA</b>" data-html="true">
                                                @php
                                                    $espb=0;
                                                    foreach ($smer->predmeti as $predmet){
                                                    if($predmet->godina_studija==1){
                                                    $espb+=$predmet->espb;

                                                    }
                                                    }
                                                    echo $espb;
                                                @endphp
                                            </span>

                                        </h4>
                                    </div>
                                    <div class="card-body bg-dark">
                                        {{-- TABLE SUBJECTS THIRD YEAR START --}}
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table table-dark table-hover table-responsive-sm">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Sifra</th>
                                                            <th scope="col">Naziv</th>
                                                            <th scope="col">Obavezni/Izborni</th>
                                                            <th scope="col">ESPB</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($smer->predmeti as $predmet)
                                                            @if($predmet->godina_studija==3)
                                                        <tr>
                                                            <td>{{ $predmet->sifra}}</td>
                                                            <td>{{ $predmet->naziv }}</td>

                                                            <td>{{ $predmet->obavezni_izborni }}</td>
                                                            <td>{{ $predmet->espb}}</td>
                                                        </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        {{-- TABLE SUBJECTS THIRD YEAR END --}}
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
                                        <h4 class="text-center font-weight-bold pt-2">SVI PREDMETI <span
                                                class="badge badge-secondary shadow" data-toggle="tooltip"
                                                data-placement="top" title="<b>BROJ PREDMETA</b>" data-html="true">
                                                {{count($smer->predmeti)}}
                                            </span>
                                            <span
                                                class="badge badge-warning shadow" data-toggle="tooltip" data-placement="top"
                                                title="<b>UKUPNO ESPB</b>" data-html="true">
                                                @php
                                                    $espb=0;
                                                    foreach ($smer->predmeti as $predmet){
                                                    $espb+=$predmet->espb;
                                                    }
                                                    echo $espb;
                                                @endphp
                                            </span>
                                        </h4>
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
                                                            <th scope="col">Godina Studija</th>
                                                            <th scope="col">Obavezni/Izborni</th>
                                                            <th scope="col">ESPB</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($smer->predmeti as $predmet)
                                                        <tr>
                                                                        <td>{{ $predmet->sifra }}</td>
                                                                        <td>{{ $predmet->naziv }}</td>
                                                                        <td>{{$predmet->godina_studija}}</td>
                                                                        <td>{{ $predmet->obavezni_izborni }}</td>
                                                                        <td>{{ $predmet->espb
                                                                        }}</td>
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
                        {{-- SVE OCENE END --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- COLLAPSE FOR SUBJECTS END --}}

</div>
@endsection
