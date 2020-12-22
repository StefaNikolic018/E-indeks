@section('title','Početna')
@extends('layouts.app')

@section('content')


<div class="container">
    {{-- ALERT MESSAGES START --}}
    @if(session('student'))
        <div class="row justify-content-center">
            <div class='col-lg-6 col-xs-12'>
                <div class="alert alert-{{ session('student')[0] }} shadow">{!!
                    session('student')[1]
                    !!}</div>
            </div>
        </div>
    @endif
    @error('student_predmet')
        <div class="row justify-content-center">
            <div class='col-lg-6 col-xs-12'>
                <div class="alert alert-danger shadow">
                    {{ $message }}
                </div>
            </div>
        </div>
    @enderror
    {{-- ALERT MESSAGES END --}}

    {{-- POBROJAVANJE START --}}
    <div class="row">

        {{-- PREDMETI START --}}
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card bg-gradient-primary text-center p-3 shadow-lg">
                <a style="text-decoration: none; color:inherit;" href="{{route('predmeti')}}">
                <h2 class="font-weight-bold" style="text-shadow: 1px 1px lightgray"><i class="fas fa-book"></i> PREDMETI
                </h2>
                </a>
                <h2 class="font-weight-bold" style="text-shadow: 1px 1px gray">
                    <span class="badge badge-pill badge-secondary shadow">
                        + {{ $predmeti }}
                    </span>
                </h2>
                <h3>
                    <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                        aria-controls="collapseExample">
                        <i class="far fa-arrow-alt-circle-down" style="color:white"></i>
                    </a>
                </h3>
                <div class="collapse" id="collapseExample">
                    <div class="row py-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <h6 class="font-weight-bold" style="text-shadow: 1px 1px lightgray">I<br> GODINA </h6>
                            <h6 class="font-weight-bold" style="text-shadow: 1px 1px gray">
                                <span class="badge badge-pill badge-secondary shadow">
                                    + {{ $prva }}
                                </span>
                            </h6>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <h6 class="font-weight-bold" style="text-shadow: 1px 1px lightgray">II<br> GODINA </h6>
                            <h6 class="font-weight-bold" style="text-shadow: 1px 1px gray">
                                <span class="badge badge-pill badge-secondary shadow">
                                    + {{ $druga }}
                                </span>
                            </h6>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <h6 class="font-weight-bold" style="text-shadow: 1px 1px lightgray">III<br> GODINA</h6>
                            <h6 class="font-weight-bold" style="text-shadow: 1px 1px gray">
                                <span class="badge badge-pill badge-secondary shadow">
                                    + {{ $treca }}
                                </span>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- PREDMETI END --}}
        {{-- OBAVESTENJA START --}}
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card bg-gradient-secondary text-center p-3 shadow-lg">
                <h2 class="font-weight-bold" style="text-shadow: 1px 1px lightgray"><i class="fas fa-book"></i>
                    OBAVEŠTENJA</h2>
                <h2 class="font-weight-bold" style="text-shadow: 1px 1px lightgray">
                    <span class="badge badge-pill badge-light shadow">
                        + {{ $obavestenja }}
                    </span>
                    @if($neodobrena>0)
                    <a href="{{route('obavestenja')}}">
                    <span class="badge badge-pill badge-danger shadow" data-toggle="tooltip"
                    data-placement="top" title="<b>NEODOBRENA OBAVEŠTENJA</b>" data-html="true">
                        {{ $neodobrena }}
                    </span>
                    </a>
                    @endif
                </h2>
                <h3>
                    <a data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false"
                        aria-controls="collapseExample">
                        <i class="far fa-arrow-alt-circle-down" style="color:black"></i>
                    </a>
                </h3>
                <div class="collapse" id="collapseExample2">
                    <div class="row py-2">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h6 class="font-weight-bold" style="text-shadow: 1px 1px lightgray">
                                <i class="fas fa-user-tie"></i>
                                <br> PROFESOR </h6>
                            <h6 class="font-weight-bold" style="text-shadow: 1px 1px lightgray">
                                <span class="badge badge-pill badge-light shadow">
                                    + {{ $prof }}
                                </span>
                            </h6>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h6 class="font-weight-bold" style="text-shadow: 1px 1px lightgray">
                                <i class="fas fa-user"></i>
                                <br> ADMIN </h6>
                            <h6 class="font-weight-bold" style="text-shadow: 1px 1px lightgray">
                                <span class="badge badge-pill badge-light shadow">
                                    + {{ $admin }}
                                </span>
                            </h6>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        {{-- OBAVESTENJA END --}}

        {{-- KORISNICI START --}}
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card text-center bg-gradient-light p-3 shadow-lg">
                <a style="text-decoration: none; color:inherit;" href="{{route('korisnici')}}">
                <h2 class="font-weight-bold" style="text-shadow: 1px 1px gray"><i class="fas fa-users"></i>
                    KORISNICI
                </h2>
                </a>
                <h2 class="font-weight-bold" style="text-shadow: 1px 1px gray">
                    <span class="badge badge-pill badge-primary shadow">
                        + {{ $korisnici }}
                    </span>
                </h2>
                <h3>
                    <a data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false"
                        aria-controls="collapseExample">
                        <i class="far fa-arrow-alt-circle-down"></i>
                    </a>
                </h3>
                <div class="collapse" id="collapseExample1">
                    <div class="row py-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <h6 class="font-weight-bold" style="text-shadow: 1px 1px lightgray"><i
                                    class="fas fa-user-tie"></i><br> PROFESORI </h6>
                            <h6 class="font-weight-bold" style="text-shadow: 1px 1px gray">
                                <span class="badge badge-pill badge-primary shadow">
                                    + {{ $profesori }}
                                </span>
                            </h6>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <h6 class="font-weight-bold" style="text-shadow: 1px 1px lightgray"><i
                                    class="fas fa-user-graduate"></i><br> STUDENTI </h6>
                            <h6 class="font-weight-bold" style="text-shadow: 1px 1px gray">
                                <span class="badge badge-pill badge-primary shadow">
                                    + {{ $studenti }}
                                </span>
                            </h6>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <h6 class="font-weight-bold" style="text-shadow: 1px 1px lightgray"><i
                                    class="fas fa-user"></i><br> ADMIN</h6>
                            <h6 class="font-weight-bold" style="text-shadow: 1px 1px gray">
                                <span class="badge badge-pill badge-primary shadow">
                                    + {{ $administratori }}
                                </span>
                            </h6>
                        </div>
                    </div>
                </div>



            </div>

        </div>
        {{-- KORISNICI END --}}



    </div>
    {{-- POBROJAVANJE END --}}

</div>
@endsection
