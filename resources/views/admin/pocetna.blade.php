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
                <h2 class="font-weight-bold" style="text-shadow: 1px 1px lightgray"><i class="fas fa-book"></i> PREDMETI
                </h2>
                <h2 class="font-weight-bold" style="text-shadow: 1px 1px gray">
                    <span class="badge badge-pill badge-secondary shadow">
                        + {{ $predmeti }}
                    </span>
                </h2>
            </div>

        </div>
        {{-- PREDMETI END --}}
        {{-- KORISNICI START --}}
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card text-center bg-gradient-light p-3 shadow-lg">
                <h2 class="font-weight-bold" style="text-shadow: 1px 1px gray"><i class="fas fa-users"></i>
                    KORISNICI
                </h2>
                <h2 class="font-weight-bold" style="text-shadow: 1px 1px gray">
                    <span class="badge badge-pill badge-primary shadow">
                        + {{ $korisnici }}
                    </span></h2>
            </div>

        </div>
        {{-- KORISNICI END --}}

        {{-- OBAVESTENJA START --}}
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card bg-gradient-secondary text-center p-3 shadow-lg">
                <h2 class="font-weight-bold" style="text-shadow: 1px 1px lightgray"><i class="fas fa-book"></i>
                    OBAVEŠTENJA</h2>
                <h2 class="font-weight-bold" style="text-shadow: 1px 1px lightgray">
                    <span class="badge badge-pill badge-light shadow">
                        + {{ $obavestenja }}
                    </span></h2>
            </div>

        </div>
        {{-- OBAVESTENJA END --}}

    </div>
    {{-- POBROJAVANJE END --}}

</div>
@endsection
