@section('title',$profesor->ime)
@extends('layouts.app')

@section('content')


<div class="container">
    {{-- ALERT MESSAGES START --}}
    @if(session('profesor'))
        <div class="row justify-content-center">
            <div class='col-lg-6 col-xs-12'>
                <div class="alert alert-{{ session('profesor')[0] }} shadow" id="profesor">
                    {{ session('profesor')[1] }}</div>
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

    {{-- profesor INFO START --}}
    <div class="row justify-content-center">
        <div class='col-xs-12 col-sm-6 my-2'>
            <div class="card border border-dark shadow-lg">
                <div class="card-header">
                    <h4>
                        <span class="badge badge-pill badge-primary shadow" data-toggle="tooltip" data-placement="top"
                            title="<b>RADNI STAŽ (GODINA)</b>" data-html="true">
                            {{-- OVDE TREBA DA BUDE RACUNICA OD DATUMA ZAPOSLJENJA --}}
                            @php
                             $d=date("Y");
                             echo ($d-$profesor->datum_zaposljenja);
                            @endphp
                        </span>
                        <span class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                            title="<b>BROJ PREDMETA</b>" data-html="true">
                            {{-- OVDE TREBA IZRACUNATI BROJ PREDMETA KOJE PREDAJE --}}
                            {{ count($predmeti) }}
                        </span>
                        @can('isSuperAdmin')
                        <span class="float-right btn-group shadow ">
                            <a class="btn btn-outline-dark font-weight-bold"
                                href={{ route('izmena_profesora', ['id'=>$profesor->id]) }}
                                role="button">
                                <i class="fas fa-edit" style="color:orange"></i> Izmeni
                            </a>
                            <button class="btn btn-outline-dark font-weight-bold" data-toggle="modal"
                                data-target="#exampleModal{{ $profesor->id }}">
                                <i class="fas fa-trash-alt" style="color:red"></i>
                                Obriši
                            </button>
                        </span>

                    </h4>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $profesor->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h5 class="modal-title text-center text-dark" id="exampleModalLabel">Brisanje
                                        profesora
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center text-dark">
                                    <b>Da li stvarno želite da izbrišete profesora "{{ $profesor->ime }}"?</b>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <form
                                        action={{ route('brisanje_profesora', ['id'=>$profesor->id]) }}
                                        method="POST">
                                        @csrf
                                        <button class="btn btn-danger">
                                            Da</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ne</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endcan
                </div>
                <div class="card-body">
                <table class="table table-hover table-striped table-bordered table-responsive-sm" id="studenti">
                    <tbody>
                        <tr>
                            <th class="ml-3">Ime</th>
                            <td>{{ $profesor->ime }}</td>



                        </tr>
                        <tr>
                            <th>Prezime</th>
                            <td>{{ $profesor->prezime }}</td>

                        </tr>
                        <tr>
                            <th>Zvanje</th>
                            <td>{{ $profesor->zvanje }}</td>

                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $profesor->email_korisnika }}</td>


                        </tr>
                        <tr>
                            <th>Datum Rodjenja</th>
                            <td>{{ $profesor->datum_rodjenja }}</td>
                        </tr>
                    </tbody>

                </table>
                                                {{-- <div class="list-group text-center border border-secondary">
                                                    <button type="button"
                                                        class="list-group-item list-group-item-action active font-weight-bold" style="text-shadow: 1px 1px black"
                                                        disabled>Predmeti</button>
                                                    @foreach($pred as $p)
                                                        <button type="button"
                                                            class="list-group-item list-group-item-action">
                                                            {{ $p }}
                                                        </button>
                                                    @endforeach

                                                </div> --}}
                </div>
            </div>
        </div>

        {{-- BIOGRAFIJA START --}}
        <div class='col-xs-12 col-sm-6 my-2 '>
            <div class="card rounded-lg bg-gradient-light border border-dark shadow-lg">
                <div class="card-header text-center py-3">
                    <h4 class="font-weight-bold " style="text-shadow: 2px 2px lightgray">Biografija</h4>
                </div>
                <div class="card-body bg-white">
                    {{-- OVDE TREBA BIOGRAFIJA --}}
                    <div class="container border border-secondary rounded shadow bg-gradient-light py-4">
                        @if($profesor->bio)
                        {{$profesor->bio}}
                        @else
                        Biografija je prazna, molimo <a href="{{ route('izmena_profesora', ['id'=>$profesor->id]) }}" style="text-decoration: underline red solid">unesite</a> biografiju!
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- BIOGRAFIJA END --}}
    </div>
    {{-- profesor INFO END --}}
    <br>


    {{-- COLLAPSE FOR SUBJECTS START --}}
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card-header border border-white bg-dark py-2">
                <h3 class="text-center font-weight-bold pt-1 text-light" style="text-shadow: 2px 2px black">Spisak predmeta
                </h3>
            </div>
            <div class="card border-dark shadow-lg">
                <div class="card-header pt-3">
                    <p class="text-center justify-content-around">
                        <a class="btn btn-outline-primary font-weight-bold shadow mt-1" data-toggle="collapse"
                            href="#multiCollapseExample1" role="button" aria-expanded="false"
                            aria-controls="multiCollapseExample1" style="width:138.512px; text-shadow: 1px 1px black">Prva godina <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>BROJ PREDMETA</b>" data-html="true">
                                @php
                                    $i=0;
                                    foreach ($predmeti as $predmet){
                                    if($predmet[0]['godina_studija']==1){
                                    $i++;

                                    }
                                    }
                                    echo $i;
                                @endphp
                            </span></a>
                        <button class="btn btn-primary font-weight-bold shadow mt-1 border border-dark rounded" type="button"
                            data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false"
                            aria-controls="multiCollapseExample2" style="width:138.512px; text-shadow: 1px 1px black">Druga godina <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>BROJ PREDMETA</b>" data-html="true">
                                @php
                                    $i=0;
                                    foreach ($predmeti as $predmet){
                                    if($predmet[0]['godina_studija']==2){
                                    $i++;

                                    }
                                    }
                                    echo $i;
                                @endphp
                            </span></button>
                        <button class="btn btn-info font-weight-bold shadow mt-1 border border-dark rounded" type="button" data-toggle="collapse"
                            data-target="#multiCollapseExample3" aria-expanded="false"
                            aria-controls="multiCollapseExample2" style="width:138.512px; text-shadow: 1px 1px gray">Treća godina <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>BROJ PREDMETA</b>" data-html="true">
                                @php
                                    $i=0;
                                    foreach ($predmeti as $predmet){
                                    if($predmet[0]['godina_studija']==3){
                                    $i++;

                                    }
                                    }
                                    echo $i;
                                @endphp
                            </span></button>
                        <button class="btn btn-dark font-weight-bold shadow mt-1" type="button" data-toggle="collapse"
                            data-target="#multiCollapseExample4" aria-expanded="false"
                            aria-controls="multiCollapseExample4" style="width:138.512px; text-shadow: 1px 1px black">Svi predmeti <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>BROJ PREDMETA</b>" data-html="true">
                                {{count($pred)}}
                            </span></button>
                    </p>
                </div>
                <div class="row">
                    {{-- PRVA GODINA START --}}
                    <div class="col-lg-12 col-mg-12 col-sm-12">
                        <div class="collapse multi-collapse" id="multiCollapseExample1">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-center font-weight-bold pt-2" style="text-shadow: 1px 1px gray">PRVA GODINA <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ PREDMETA</b>" data-html="true">
                                            @php
                                                $i=0;
                                                foreach ($predmeti as $predmet){
                                                if($predmet[0]['godina_studija']==1){
                                                $i++;

                                                }
                                                }
                                                echo $i;
                                            @endphp
                                        </span></h4>
                                </div>
                                <div class="card-body bg-dark">
                                    {{-- TABLE SUBJECTS FIRST YEAR START --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-sm table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Šifra</th>
                                                        <th scope="col">Naziv</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">ESPB</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($predmeti as $predmet)
                                                    @if($predmet[0]['godina_studija']==1)
                                                    <tr>
                                                        <td>{{ $predmet[0]['sifra']}}</td>
                                                        <td>{{ $predmet[0]['naziv'] }}</td>
                                                        <td>{{ $predmet[0]['obavezni_izborni'] }}</td>
                                                        <td>{{ $predmet[0]['espb']}}</td>
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
                                    <h4 class="text-center font-weight-bold pt-2" style="text-shadow: 1px 1px gray">DRUGA GODINA <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ PREDMETA</b>" data-html="true">
                                            @php
                                                $i=0;

                                                foreach ($predmeti as $predmet){
                                                if($predmet[0]['godina_studija']==2){
                                                $i++;

                                                }
                                                }
                                                echo $i;
                                            @endphp
                                        </span></h4>
                                </div>
                                {{-- TABLE SUBJECTS SECOND YEAR START --}}
                                <div class="card-body bg-dark">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-sm table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Šifra</th>
                                                        <th scope="col">Naziv</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">ESPB</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($predmeti as $predmet)
                                                        @if($predmet[0]['godina_studija']==2)
                                                    <tr>
                                                        <td>{{ $predmet[0]['sifra']}}</td>
                                                        <td>{{ $predmet[0]['naziv'] }}</td>

                                                        <td>{{ $predmet[0]['obavezni_izborni'] }}</td>
                                                        <td>{{ $predmet[0]['espb']}}</td>
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
                                    <h4 class="text-center font-weight-bold pt-2" style="text-shadow: 1px 1px gray">TREĆA GODINA <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ PREDMETA</b>" data-html="true">
                                            @php
                                                $i=0;

                                                foreach ($predmeti as $predmet){
                                                if($predmet[0]['godina_studija']==3){
                                                $i++;

                                                }
                                                }
                                                echo $i;
                                            @endphp
                                        </span></h4>
                                </div>
                                <div class="card-body bg-dark">
                                    {{-- TABLE SUBJECTS THIRD YEAR START --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-sm table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Šifra</th>
                                                        <th scope="col">Naziv</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">ESPB</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($predmeti as $predmet)
                                                        @if($predmet[0]['godina_studija']==3)
                                                    <tr>
                                                        <td>{{ $predmet[0]['sifra']}}</td>
                                                        <td>{{ $predmet[0]['naziv'] }}</td>

                                                        <td>{{ $predmet[0]['obavezni_izborni'] }}</td>
                                                        <td>{{ $predmet[0]['espb']}}</td>
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
                                <div class="card-header border border-dark p-2">
                                    <h4 class="text-center font-weight-bold" style="text-shadow: 1px 1px gray">Svi predmeti <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ PREDMETA</b>" data-html="true">
                                            {{count($pred)}}
                                        </span></h4>
                                </div>
                                <div class="card-body bg-dark">
                                    {{-- TABLE ALL SUBJECTS START --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-sm table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Šifra</th>
                                                        <th scope="col">Naziv</th>
                                                        <th scope="col">Godina</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">ESPB</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($predmeti as $predmet)
                                                    <tr>
                                                                    <td>{{ $predmet[0]['sifra'] }}</td>
                                                                    <td>{{ $predmet[0]['naziv'] }}</td>
                                                                    <td>{{$predmet[0]['godina_studija']}}.</td>
                                                                    <td>{{ $predmet[0]['obavezni_izborni'] }}</td>
                                                                    <td>{{ $predmet[0]['espb']
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
