@extends('layouts.app')
@section('title', 'Izmena profesora')

@section('content')
<div class="container">

    @if(session('profesor'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-xs-12'>
            <div class="alert alert-{{ session('profesor')[0] }}">
                {{ session('profesor')[1] }}</div>
        </div>
    </div>
    @endif

    {{-- FORM TO ADD A STUDENT START --}}
    <div class="card rounded-lg border border-dark bg-gradient-light shadow-lg">
        <div class="card-header text-center">
            <h2 class="font-weight-bold pt-2" style="text-shadow: 2px 2px lightgray">Izmena profesora</h2>
        </div>
        <div class="card-body">
            <form action={{ route('izmena_profesora',['id'=>$profesor->id]) }} method="POST">
                @csrf
                <div class="form-row">

                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label class="font-weight-bold" for="ime">Ime</label>
                            <input value="{{ old('ime') ? old('ime') : $profesor->ime }}" required
                                oninvalid="this.setCustomValidity('Molimo unesite ime!')"
                                oninput="setCustomValidity('')" type="text"
                                class="form-control @error('ime') is-invalid @enderror" id="ime"
                    name="ime" placeholder="">

                            @error('ime')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label class="font-weight-bold" for="prezime">Prezime</label>
                        <input value="{{ old('prezime') ? old('prezime') : $profesor->prezime }}" required
                            oninvalid="this.setCustomValidity('Molimo unesite prezime!')"
                            oninput="setCustomValidity('')" type="text"
                            class="form-control @error('prezime') is-invalid @enderror" id="prezime" name="prezime" >
                        @error('prezime')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label class="font-weight-bold" for="zvanje">Zvanje</label>
                        <input value="{{ old('zvanje') ? old('zvanje') : $profesor->zvanje }}" required
                            oninvalid="this.setCustomValidity('Molimo unesite zvanje!')"
                            oninput="setCustomValidity('')" type="text"
                            class="form-control @error('zvanje') is-invalid @enderror" id="zvanje" name="zvanje" >
                        @error('zvanje')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">



                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label class="font-weight-bold" for="email_korisnika">Email</label>
                        <div class="input-group">
                            <select class="custom-select mr-sm-2 @error('email_korisnika') is-invalid @enderror" id="email_korisnika"
                                name="email_korisnika" required oninvalid="this.setCustomValidity('Molimo izaberite email!')"
                                oninput="setCustomValidity('')"">
                            <option value="{{$profesor->email_korisnika}}" selected>{{$profesor->email_korisnika}}</option>
                            </select>
                        </div>
                        @error('email_korisnika')
                        <span class=" invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                            <label class="font-weight-bold" for="datum_rodjenja">Datum rodjenja</label>
                            <input value="{{ old('datum_rodjenja') ? old('datum_rodjenja') :  $profesor->datum_rodjenja }}" required
                                oninvalid="this.setCustomValidity('Molimo unesite datum rodjenja!')"
                                oninput="setCustomValidity('')" type="date"
                                class="form-control @error('datum_rodjenja') is-invalid @enderror" id="datum_rodjenja"
                                name="datum_rodjenja">
                            @error('datum_rodjenja')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                            <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                            <label class="font-weight-bold" for="datum_zaposljenja">Godina zaposlenja</label>
                            <select class="form-control custom-select mr-sm-2 @error('datum_zaposljenja') is-invalid @enderror" id="datum_zaposljenja"
                                name="datum_zaposljenja" oninvalid="this.setCustomValidity('Molimo izaberite godinu zaposlenja!')"
                                oninput="setCustomValidity('')">
                            @for($i=1990;$i<=date("Y");$i++)
                            <option value="{{$i}}" 
                            @if($profesor->datum_zaposljenja == $i) 
                                selected
                            @elseif(old('datum_zaposljenja')==$i)
                                selected
                            @endif
                            >{{$i}}</option>
                            @endfor
                            </select>
                            @error('datum_zaposljenja')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        {{-- FALE MI PREDMETI NA KOJIMA PREDAJE PROFESOR --}}



                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label class="font-weight-bold" for="predmeti">Predmeti </label>
                            <select class="custom-select mr-sm-2 @error('predmeti') is-invalid @enderror"
                                id="predmeti" name="predmeti[]" required
                                oninvalid="this.setCustomValidity('Molimo izaberite predmete!')"
                                oninput="setCustomValidity('')" multiple>
                                @foreach($predmeti as $predmet)
                                <option value="{{ $predmet->naziv }}" 
                                    @foreach($pred as $p) 
                                        @if($predmet->naziv==$p) 
                                            selected 
                                        @endif 
                                    @endforeach>{{ $predmet->naziv }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Više izbora (CTRL + CLICK)</small>
                            @error('predmeti')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label class="font-weight-bold" for="bio" class="text-center">Biografija/Dostignuća</label>
                            <textarea class="form-control py-2 pb-3" id="bio" name="bio" rows="3" required
                                oninvalid="this.setCustomValidity('Molimo unesite biografiju!')"
                                oninput="setCustomValidity('')">{{ old('bio') ? old('bio') : $profesor->bio }}</textarea>
                            @error('bio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
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
