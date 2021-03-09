@extends('layouts.app')
@section('title','Korisnici')

@section('content')

@if(session('korisnik'))
<div class="row justify-content-center">
    <div class='col-lg-6 col-xs-12'>
        <div class="alert alert-{{ session('korisnik')[0] }}" id="korisnik">
            {{ session('korisnik')[1] }}</div>
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

<div class="container">
    <div class="jumbotron jumbotron-fluid py-2 px-2 rounded bg-gradient-light border border-dark rounded-lg shadow-lg">
        <div class="container">
            <h1  style="text-shadow: 2px 2px lightgray"><i class="fas fa-users"></i> Korisnici</h1>

            <p class="lead">U ovoj sekciji se upravlja nalozima korisnika <a
                    class="btn btn-outline-primary float-right font-weight-bold shadow"
                    href={{ route('novi_korisnik') }} role="button">Dodaj Korisnika</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card-header border border-dark">
                <h3 class="text-center text-light font-weight-bold" style="text-shadow: 2px 2px gray">Spisak korisnika
                </h3>
            </div>
            <div class="card-body bg-dark">
                <table class="table table-dark table-hover table-responsive-sm shadow-lg">
                    <thead>
                        <tr>
                            <th scope="col">Ime</th>
                            <th scope="col">Prezime</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Uloga</th>
                            <th scope="col">Akcije</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($korisnici as $korisnik)
                        <tr>
                            <td>{{ $korisnik->ime }}</td>
                            <td>{{ $korisnik->prezime }}</td>
                            <td>{{ $korisnik->email }}</td>
                            <td>
                                @if($korisnik->role == 'user')
                                Student
                                @elseif($korisnik->role=='admin')
                                Profesor
                                @else
                                Administrator
                                @endif

                            </td>
                            <td class="d-inline-flex">
                                <!-- Split dropright button -->
                                <div class="btn-group dropright">
                                    <button type="button" class="btn btn-primary">
                                        Upravljaj
                                    </button>
                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropright</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href={{ route('izmena_korisnika',['id'=>$korisnik->id]) }} role="button">
                                            <i class="fas fa-edit" style="color:orange"></i> Izmeni
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <!-- Button trigger modal -->
                                        <button class="dropdown-item" data-toggle="modal"
                                            data-target="#exampleModal{{ $korisnik->id }}">
                                            <i class="fas fa-trash-alt" style="color:red"></i>
                                            Obriši
                                        </button>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $korisnik->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header text-dark">
                                                <h5 class="modal-title text-center" id="exampleModalLabel">Brisanje
                                                    korisnika
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center text-dark">
                                                <b>Da li stvarno želite da izbrišete korisnika
                                                    "{{ $korisnik->ime }}"?</b>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <form action={{ route('brisanje_korisnika', ['id'=>$korisnik->id]) }}
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger">
                                                        Da</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary"
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

</div>

@endsection
