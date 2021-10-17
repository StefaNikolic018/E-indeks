@section('title','Evidencija Studenata | Početna')
@extends('layouts.app')

@section('content')


<div class="container">
    {{-- ALERT MESSAGES START --}}
    @if(session('student'))
        <div class="row justify-content-center">
            <div class='col-lg-6 col-xs-12'>
                <div class="alert alert-{{ session('student')[0] }} shadow" id="student">{!!
                    session('student')[1]
                    !!}</div>
            </div>
        </div>
    @endif
    @error('student_predmet')
        <div class="row justify-content-center">
            <div class='col-lg-6 col-xs-12'>
                <div class="alert alert-danger shadow" id="student_predmet">
                    {{ $message }}
                </div>
            </div>
        </div>
    @enderror
    @if(url()->previous()==url('/login'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-md-6  col-sm-12'>
            <div class="alert alert-success shadow" id="welcome">Dobrodošli {{ Auth::user()->ime }}!</div>
        </div>
    </div>
    @endif
    {{-- ALERT MESSAGES END --}}

    {{-- POBROJAVANJE START --}}
    <div class="row">

        {{-- PREDMETI START --}}
        <div class="col-lg-4 col-md-4 col-sm-12 mb-sm-0 mb-2 ">
            <div class="card bg-gradient-primary text-center p-3 shadow-lg border border-dark rounded">
                <a style="text-decoration: none; color:inherit;" href="{{route('predmeti','svi')}}">
                <h2 class="font-weight-bold" style="text-shadow: 1px 1px lightgray"><i class="fas fa-book"></i> PREDMETI
                </h2>
                </a>
                <h2 class="font-weight-bold" style="text-shadow: 1px 1px gray">
                    <span class="badge badge-pill badge-secondary shadow">
                        + {{ $predmeti }}
                    </span>
                </h2>
                <h3>
                    <a data-toggle="collapse" id="predmeti1" href="#collapseExample" role="button" aria-expanded="false"
                        aria-controls="collapseExample">
                        <i class="far fa-arrow-alt-circle-down" id="ikonica1" style="color:white"></i>
                    </a>
                </h3>
                <div class="collapse border shadow-lg border-light rounded" id="collapseExample">
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
        <div class="col-lg-4 col-md-4 col-sm-12 mb-sm-0 mb-2">
            <div class="card bg-gradient-secondary text-center p-3 shadow-lg border border-dark rounded">
                @if($neodobrena<1)
                <a href="{{route('obavestenja')}}" style="text-decoration: none; color:inherit;">
                <h2 class="font-weight-bold" style="text-shadow: 1px 1px lightgray; "><i class="fas fa-clipboard"></i>
                    OBAVEŠTENJA</h2>
                </a>
                @else
                <h2 class="font-weight-bold" style="text-shadow: 1px 1px lightgray"><i class="fas fa-clipboard"></i>
                    OBAVEŠTENJA
                </h2>
                @endif
                <h2 class="font-weight-bold" style="text-shadow: 1px 1px lightgray">
                    <span class="badge badge-pill badge-light shadow">
                        + {{ $obavestenja }}
                    </span>
                    @if($neodobrena>0)
                    <a href="{{route('obavestenja')}}">
                    <span class="badge badge-pill badge-danger shadow" data-toggle="tooltip"
                    data-placement="top" title="<b>NEODOBRENA OBAVEŠTENJA</b>" data-html="true" style="animation: pulse 5s infinite;">
                        {{ $neodobrena }}
                    </span>
                    </a>
                    @endif
                </h2>
                <h3>
                    <a data-toggle="collapse" href="#collapseExample2" id="obavestenja1" role="button" aria-expanded="false"
                        aria-controls="collapseExample">
                        <i class="far fa-arrow-alt-circle-down" id="ikonica2" style="color:black"></i>
                    </a>
                </h3>
                <div class="collapse border shadow-lg border-dark rounded" id="collapseExample2">
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
            <div class="card text-center bg-gradient-light p-3 shadow-lg border border-dark rounded">
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
                    <a data-toggle="collapse" href="#collapseExample1" id="korisnici1" role="button" aria-expanded="false"
                        aria-controls="collapseExample">
                        <i class="far fa-arrow-alt-circle-down" id="ikonica3"></i>
                    </a>
                </h3>
                <div class="collapse border shadow-lg border-info rounded" id="collapseExample1">
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
<script>
    document.getElementById('predmeti1').addEventListener('click',function(event){
        if(document.getElementById('collapseExample').classList.contains('show')){
            document.getElementById('ikonica1').classList.remove('fa-arrow-alt-circle-up');
            document.getElementById('ikonica1').classList.add('fa-arrow-alt-circle-down');
        } else {
            document.getElementById('ikonica1').classList.add('fa-arrow-alt-circle-up');
            document.getElementById('ikonica1').classList.remove('fa-arrow-alt-circle-down');
        }
    });
    document.getElementById('obavestenja1').addEventListener('click',function(event){
        if(document.getElementById('collapseExample2').classList.contains('show')){
            document.getElementById('ikonica2').classList.remove('fa-arrow-alt-circle-up');
            document.getElementById('ikonica2').classList.add('fa-arrow-alt-circle-down');
        } else {
            document.getElementById('ikonica2').classList.add('fa-arrow-alt-circle-up');
            document.getElementById('ikonica2').classList.remove('fa-arrow-alt-circle-down');
        }
    });
    document.getElementById('korisnici1').addEventListener('click',function(event){
        if(document.getElementById('collapseExample1').classList.contains('show')){
            document.getElementById('ikonica3').classList.remove('fa-arrow-alt-circle-up');
            document.getElementById('ikonica3').classList.add('fa-arrow-alt-circle-down');
        } else {
            document.getElementById('ikonica3').classList.add('fa-arrow-alt-circle-up');
            document.getElementById('ikonica3').classList.remove('fa-arrow-alt-circle-down');
        }
    });
</script>
@endsection
