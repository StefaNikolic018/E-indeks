@extends('layouts.app')
@section('title', 'Novi student')

@section('content')
<div class="container">

    @if(session('student'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-xs-12'>
            <div class="alert alert-{{ session('student')[0] }}" id="student">
                {{ session('student')[1] }}</div>
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
            <h2 class="font-weight-bold pt-2" style="text-shadow: 2px 2px lightgray">Novi student</h2>
        </div>
        <div class="card-body">
            <form action={{ route('novi_student') }} method="POST">
                @csrf
                <div class="form-row">

                    <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                        <label for="broj_indeksa">Broj indeksa</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2">REr/SEr...</span>
                            </div>
                            <input value="{{ old('broj_indeksa') }}" required
                                oninvalid="this.setCustomValidity('Molimo unesite broj indeksa!')"
                                oninput="setCustomValidity('')" type="text"
                                class="form-control @error('broj_indeksa') is-invalid @enderror" id="br_indeksa"
                                name="broj_indeksa" placeholder="">

                            @error('broj_indeksa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                        <label for="ime">Ime</label>
                        <input value="{{ old('ime') }}" required
                            oninvalid="this.setCustomValidity('Molimo unesite ime!')" oninput="setCustomValidity('')"
                            type="text" class="form-control @error('ime') is-invalid @enderror" id="ime" name="ime">
                        @error('ime')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                        <label for="ime_roditelja">Ime roditelja</label>
                        <input value="{{ old('ime_roditelja') }}" required
                            oninvalid="this.setCustomValidity('Molimo unesite ime roditelja!')"
                            oninput="setCustomValidity('')" type="text"
                            class="form-control @error('ime_roditelja') is-invalid @enderror" id="ime_rod"
                            name="ime_roditelja">
                        @error('ime_roditelja')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                        <label for="prezime">Prezime</label>
                        <input value="{{ old('prezime') }}" required
                            oninvalid="this.setCustomValidity('Molimo unesite prezime!')"
                            oninput="setCustomValidity('')" type="text"
                            class="form-control @error('prezime') is-invalid @enderror" id="prezime" name="prezime">
                        @error('prezime')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label for="email">Smer</label>
                        <div class="input-group">
                            <select class="custom-select mr-sm-2 @error('smer') is-invalid @enderror" id="smer"
                                name="smer" required oninvalid="this.setCustomValidity('Molimo izaberite smer!')"
                                oninput="setCustomValidity('')"">
                                <option value="">Izaberite smer</option>
                                @foreach($smerovi as $smer)
                                <option value="{{$smer->id}}">{{$smer->naziv}}</option>
                                @endforeach
                        </select>
                        </div>
                        @error('smer')
                        <span class=" invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>



                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <select class="custom-select mr-sm-2 @error('email') is-invalid @enderror" id="email"
                                name="email" required oninvalid="this.setCustomValidity('Molimo izaberite email!')"
                                oninput="setCustomValidity('')"">
                                <option value="">Izaberite email</option>
                                @foreach($emails as $email)
                                <option value={{$email->email}}>{{$email->email}}</option>
                                @endforeach
                        </select>
                        </div>
                        @error('email')
                        <span class=" invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                            <label for="broj_telefona">Broj Telefona</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2">+381... ILI 06...</span>
                                </div>
                                <input value="{{ old('broj_telefona') }}" required
                                    oninvalid="this.setCustomValidity('Molimo unesite broj telefona!')"
                                    oninput="setCustomValidity('')" type="tel"
                                    class="form-control @error('broj_telefona') is-invalid @enderror" id="broj_telefona"
                                    name="broj_telefona">
                                @error('broj_telefona')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                            <label for="godina_studija">Godina studija</label>
                            <input value="{{ old('godina_studija') }}" required
                                oninvalid="this.setCustomValidity('Molimo unesite godinu studija!')"
                                oninput="setCustomValidity('')" type="number" min="1" max="5" placeholder="1"
                                class="form-control @error('godina_studija') is-invalid @enderror" id="godina_studija"
                                name="godina_studija">
                            @error('godina_studija')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                            <label for="datum_rodjenja">Datum rodjenja</label>
                            <input value="{{ old('datum_rodjenja') }}" required
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
                            <label for="jmbg">JMBG</label>
                            <input value="{{ old('jmbg') }}" required
                                oninvalid="this.setCustomValidity('Molimo unesite JMBG!')"
                                oninput="setCustomValidity('')" type="text"
                                class="form-control @error('jmbg') is-invalid @enderror" id="jmbg" name="jmbg">
                            @error('jmbg')
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
