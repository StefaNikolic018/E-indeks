@extends('layouts.app')
@section('title', 'Izmena profesora')

@section('content')
<div class="container">

    @if(session('profesor'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-xs-12'>
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

    {{-- FORM TO ADD A STUDENT START --}}
    <div class="card rounded-lg border border-dark bg-gradient-light shadow-lg">
        <div class="card-header text-center">
            <h2 class="font-weight-bold pt-2" style="text-shadow: 2px 2px lightgray">Izmena biografije</h2>
        </div>
        <div class="card-body">
            <form action={{ route('izmena_biografije',['id'=>$profesor->id]) }} method="POST">
                @csrf
                    <div class="form-row">
                            <textarea class="form-control py-2 pb-3" id="bio" name="bio" rows="3" required
                                oninvalid="this.setCustomValidity('Molimo unesite biografiju!')"
                                oninput="setCustomValidity('')">{{ old('bio') ? old('bio') : $profesor->bio }}</textarea>
                            @error('bio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="form-group col-12 text-center">
                            <button type="submit" class="btn btn-outline-primary btn-lg shadow">Sačuvaj</button>
                        </div>
                    </div>
            </form>
        </div>

    </div>
    {{-- FORM TO ADD A STUDENT END --}}


    @endsection
