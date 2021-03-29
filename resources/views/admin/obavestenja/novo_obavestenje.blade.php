@extends('layouts.app')
@section('title', 'Novo obaveštenje')

@section('content')
<div class="container">

    @if(session('obavestenje'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-xs-12'>
            <div class="alert alert-{{ session('obavestenje')[0] }}" id="obavestenje">
                {{ session('obavestenje')[1] }}</div>
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
            <h2 class="font-weight-bold pt-2" style="text-shadow: 2px 2px lightgray">Novo obaveštenje</h2>
        </div>
        <div class="card-body text-center font-weight-bold">
            <form action={{ route('novo_obavestenje') }} method="POST">
                @csrf
                <div class="form-row">

                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label for="naslov">Naslov</label>
                            <input value="{{ old('naslov') }}" required
                                oninvalid="this.setCustomValidity('Molimo unesite naslov!')"
                                oninput="setCustomValidity('')" type="text"
                                class="form-control @error('naslov') is-invalid @enderror" id="naslov"
                                name="naslov" placeholder="Unesite naslov">
                            @error('naslov')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                            <label for="datum">Datum</label>
                            <input value="{{ old('datum') }}" required
                                oninvalid="this.setCustomValidity('Molimo unesite datum!')"
                                oninput="setCustomValidity('')" type="date"
                                class="form-control @error('datum') is-invalid @enderror" id="datum"
                                name="datum">
                            @error('datum')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label for="naslov">Smer</label>
                            <select class="custom-select mr-sm-2 @error('smer') is-invalid @enderror" id="smer"
                                name="smer" required oninvalid="this.setCustomValidity('Molimo izaberite smer!')"
                                oninput="setCustomValidity('')"">
                                <option value="">Izaberite smer</option>
                                <option value="svi">Svi smerovi</option>
                                @foreach($smerovi as $smer)
                                <option value="{{$smer->id}}" @if(old('smer'))@if(old('smer')==$smer->id) selected @endif @endif>{{$smer->naziv}}</option>
                                @endforeach
                            </select>
                            @error('smer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-lg-12 col-md-12 col-sm-12 ">
                        <label for="obavestenje">Obavestenje</label>
                        <textarea rows="4" required
                            oninvalid="this.setCustomValidity('Molimo unesite sadržaj obaveštenja!')"
                            oninput="setCustomValidity('')" type="text"
                            class="form-control @error('obavestenje') is-invalid @enderror" id="obavestenje" name="obavestenje">{{ old('obavestenje') }}</textarea>
                        @error('obavestenje')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>

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
