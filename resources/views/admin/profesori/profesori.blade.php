@extends('layouts.app')
@section('title','Profesori')

@section('content')


<div class="container">
    {{-- ALERT MESSAGES START --}}
    @if(session('profesor'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-md-6 col-sm-12'>
            <div class="alert alert-{{ session('profesor')[0] }}" id="profesor">
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
    {{-- JUMBOTRON START --}}
    <div class="jumbotron jumbotron-fluid py-2 px-2 rounded bg-gradient-white border border-dark shadow-lg mb-2">
        <div class="container border border-secondary rounded shadow bg-gradient-light py-2">
            <h1 class="font-weight-bold" style="text-shadow: 2px 2px lightgray"><i class="fas fa-user-tie"></i> Profesori
            </h1>

            <p class="lead">U ovoj sekciji se upravlja profesorima <a
                    class="btn btn-primary border border-secondary rounded float-right font-weight-bold shadow" href={{ route('novi_profesor') }}
                    role="button">Novi</a></p>
        </div>
    </div>
    {{-- JUMBOTRON END --}}
    {{-- COLLAPSE FOR SUBJECTS START --}}
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card-header border border-white bg-dark py-2">
                <h4 class="text-center font-weight-bold pt-1 text-light" style="text-shadow: 2px 2px black">Spisak
                    profesora</h4>
            </div>
            <div class="card border-dark shadow-lg">
                <div class="row">
                    {{-- SVI STUDENTI START --}}
                    <div class="col-lg-12 col-mg-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-center font-weight-bold pt-2" style="text-shadow: 1px 1px gray">Svi profesori <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ PROFESORA</b>" data-html="true">
                                            {{$profesori->count()}}
                                        </span></h4>
                                </div>
                                <div class="card-body bg-dark">
                                    {{-- TABLE ALL SUBJECTS START --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-sm table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Ime</th>
                                                        <th scope="col">Prezime</th>
                                                        <th scope="col">Datum rođenja</th>
                                                        <th scope="col">Zvanje</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Godina zaposlenja</th>
                                                        <th scope="col"> &nbsp;Akcije</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($profesori as $profesor)
                                                    <tr>
                                                        <td>{{ $profesor->ime }}</td>
                                                        <td>{{ $profesor->prezime }}</td>
                                                        <td>{{ $profesor->datum_rodjenja }}</td>
                                                        <td>{{ $profesor->zvanje }}</td>
                                                        <td>{{ $profesor->email_korisnika }}</td>
                                                        <td>{{ $profesor->datum_zaposljenja }}</td>
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
                                                                    <a href="{{ route('profesor',['id'=>$profesor->id]) }}"
                                                                        class="dropdown-item" role="button">
                                                                        <i class="fas fa-eye"
                                                                            style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href={{ route('izmena_profesora', ['id'=>$profesor->id]) }}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{ $profesor->id }}">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{ $profesor->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header ">
                                                                            <h5 class="modal-title text-center text-dark"
                                                                                id="exampleModalLabel">
                                                                                Brisanje profesora
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-dark">
                                                                            <b>Da li stvarno želite da izbrišete
                                                                                profesora
                                                                                "{{ $profesor->ime }}"?</b>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-center">
                                                                            <form
                                                                                action={{ route('brisanje_profesora', ['id'=>$profesor->id]) }}
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
                    {{-- SVI STUDENTI END --}}
                </div>
            </div>
        </div>
    </div>
    {{-- COLLAPSE FOR STUDENTS END --}}



</div>
@endsection
