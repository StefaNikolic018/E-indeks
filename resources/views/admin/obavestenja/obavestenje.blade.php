@section('title','Obaveštenje')
@extends('layouts.app')

@section('content')


<div class="container">
    {{-- ALERT MESSAGES START --}}
    @if(session('student'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-xs-12'>
            <div class="alert alert-{{session('obavestenje')[0]}} shadow" id="obavestenje">{{ session('obavestenje')[1] }}</div>
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

        <div class='col-lg-12 col-md-12 col-sm-12 my-2'>
            <div class="card border border-dark shadow-lg">
                <div class="card-header">
                    <h2>

                            @if($obavestenje->odobrenje=='0')
                                <span
                                class="badge badge-danger badge-pill shadow" data-toggle="tooltip"
                                data-placement="top" title="<b>STANJE OBAVEŠTENJA</b>" data-html="true">
                                    NEODOBRENO
                                </span>
                            @else
                                <span
                                class="badge badge-success badge-pill shadow" data-toggle="tooltip"
                                data-placement="top" title="<b>STANJE OBAVEŠTENJA</b>" data-html="true">
                                    ODOBRENO
                                </span>
                            @endif

                        <span data-toggle="tooltip" data-placement="top" title="<b>AUTOR</b>" data-html="true"
                            class="badge badge-pill badge-secondary shadow">
                            @if($obavestenje->potpis=='admin')
                                Profesor
                            @else
                                Administrator
                            @endif
                        </span>

                        <span class="float-right btn-group shadow "><a class="btn btn-outline-dark font-weight-bold"
                                href={{ route('izmena_obavestenja', ['id'=>$obavestenje->id]) }} role="button">
                                <i class="fas fa-edit" style="color:orange"></i> Izmeni
                            </a>
                            <button class="btn btn-outline-dark font-weight-bold" data-toggle="modal"
                                data-target="#exampleModal{{$obavestenje->id}}">
                                <i class="fas fa-trash-alt" style="color:red"></i>
                                Obriši
                            </button>
                        </span>
                    </h2>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{$obavestenje->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h5 class="modal-title text-center text-dark" id="exampleModalLabel">Brisanje
                                        obaveštenja
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center text-dark">
                                    <b>Da li stvarno želite da izbrišete obaveštenje "{{ $obavestenje->naslov }}"?</b>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <form action={{ route('brisanje_obavestenja', ['id'=>$obavestenje->id]) }} method="POST">
                                        @csrf
                                        <button class="btn btn-danger">
                                            Da</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ne</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="font-weight-bold text-center"><span class="float-left">"{{$obavestenje->naslov}}"</span><span class="float-right">{{$obavestenje->datum}}</span></h3>
                    </div>
                    <div class="card-body px-5">
                        <h5>{{$obavestenje->obavestenje}}</h5>
                    </div>
                </div>
            </div>
        </div>

</div>
@endsection
