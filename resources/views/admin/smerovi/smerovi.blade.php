@extends('layouts.app')
@section('title','Smerovi')

@section('content')


<div class="container">
    {{-- ALERT MESSAGES START --}}
    @if(session('smer'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-md-6 col-sm-12'>
            <div class="alert alert-{{ session('smer')[0] }}" id="smer">
                {{ session('smer')[1] }}</div>
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
            <h1 style="text-shadow: 2px 2px lightgray" class="font-weight-bold"><i class="fas fa-swatchbook"></i> Smerovi
            </h1>

            <p class="lead">U ovoj sekciji se upravlja smerovima <a
                    class="btn btn-primary border border-secondary rounded float-right font-weight-bold shadow" href={{ route('novi_smer') }}
                    role="button">Novi</a></p>
        </div>
    </div>
    {{-- JUMBOTRON END --}}
    {{-- COLLAPSE FOR SUBJECTS START --}}
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card-header border border-white bg-dark py-2">
                <h4 class="text-center font-weight-bold pt-1 text-light" style="text-shadow: 2px 2px black">Spisak
                    smerova</h4>
            </div>
            <div class="card border-dark shadow-lg">
                {{-- <div class="card-header pt-3">
                    <p class="text-center justify-content-around">
                            <button class="btn btn-dark font-weight-bold shadow mt-1" type="button" data-toggle="collapse"
                            data-target="#multiCollapseExample4" aria-expanded="false"
                            aria-controls="multiCollapseExample4" style="width:138.512px">Svi
                            <span class="badge badge-secondary shadow" data-toggle="tooltip"
                                data-placement="top" title="<b>BROJ SMEROVA</b>" data-html="true">
                                {{$smerovi->count()}}
                            </span>
                        </button>
                    </p>
                </div> --}}
                <div class="row">
                    {{-- SVI SMEROVI START --}}
                    <div class="col-lg-12 col-mg-12 col-sm-12">
                        <div class="collapse multi-collapse show" id="multiCollapseExample4">
                            <div class="card">
                                <div class="card-header border border-dark p-2">
                                    <h4 class="text-center font-weight-bold" style="text-shadow: 1px 1px gray">Svi smerovi
                                        <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ SMEROVA</b>" data-html="true">
                                            {{$smerovi->count()}}
                                        </span>
                                    </h4>
                                </div>
                                <div class="card-body bg-dark">
                                    {{-- TABLE ALL STUDY PROGRAM START --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-lg table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Naziv</th>
                                                        <th scope="col">Opis</th>
                                                        <th scope="col">Akreditovan</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Predmeti</th>
                                                        <th scope="col"> &nbsp;Akcije</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($smerovi as $smer)
                                                    <tr>
                                                        <td>{{ $smer->naziv }}</td>
                                                        <td>{{ substr($smer->opis,0,10) }}...</td>
                                                        <td>{{$smer->akreditovan}}.</td>
                                                        <td>{{ $smer->espb }}</td>
                                                        <td class="pl-5">
                                                            <span
                                                            class="badge badge-info shadow" data-toggle="tooltip"
                                                            data-placement="top" title="<b>BROJ PREDMETA</b>" data-html="true">
                                                            {{$smer->predmeti->count()}}
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
                                                                    <a href="{{ route('smer',['id'=>$smer->id]) }}"
                                                                        class="dropdown-item" role="button">
                                                                        <i class="fas fa-eye"
                                                                            style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href={{ route('izmena_smera', ['id'=>$smer->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{ $smer->id }}">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>
                                                                </div>
                                                            </div>
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
