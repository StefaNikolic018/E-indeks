@extends('layouts.app')
@section('title','Izmena studenta ')

@section('content')
<div class="container">

    <div class="card rounded border border-dark bg-gradient-light shadow-lg">
        <div class="card-header text-center">
            <h2 class="font-weight-bold">Izmena studenta</h2>
        </div>
        <div class="card-body">
            <form action={{route('izmena_studenta', ['id'=>$student->id])}} method="POST">
                @csrf
                <div class="form-row">

                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label for="broj_indeksa">Broj indeksa</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2">REr/SEr...</span>
                            </div>
                            <input required oninvalid="this.setCustomValidity('Molimo unesite broj indeksa!')"
                                oninput="setCustomValidity('')" type="text"
                                class="form-control @error('broj_indeksa') is-invalid @enderror" id="br_indeksa"
                                name="broj_indeksa"
                                value="{{old('broj_indeksa') ? old('broj_indeksa') : $student->broj_indeksa}}">

                            @error('broj_indeksa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label for="ime">Ime</label>
                        <input required oninvalid="this.setCustomValidity('Molimo unesite ime!')"
                            oninput="setCustomValidity('')" type="text"
                            class="form-control @error('ime') is-invalid @enderror" id="ime" name="ime"
                            value={{old('ime') ? old('ime') : $student->ime}}>
                        @error('ime')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label for="ime_roditelja">Ime roditelja</label>
                        <input required oninvalid="this.setCustomValidity('Molimo unesite ime roditelja!')"
                            oninput="setCustomValidity('')" type="text"
                            class="form-control @error('ime_roditelja') is-invalid @enderror" id="ime_rod"
                            name="ime_roditelja"
                            value={{old('ime_roditelja') ? old('ime_roditelja') : $student->ime_roditelja}}>
                        @error('ime_roditelja')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">

                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label for="prezime">Prezime</label>
                        <input required oninvalid="this.setCustomValidity('Molimo unesite prezime!')"
                            oninput="setCustomValidity('')" type="text"
                            class="form-control @error('prezime') is-invalid @enderror" id="prezime" name="prezime"
                            value={{old('prezime') ? old('prezime') : $student->prezime}}>
                        @error('prezime')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <input required oninvalid="this.setCustomValidity('Molimo unesite validan email!')"
                                oninput="setCustomValidity('')" type="email"
                                class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                value={{old('email') ? old('email') : $student->email}}>
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">@example.com</span>
                            </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
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
                            <input required oninvalid="this.setCustomValidity('Molimo unesite broj telefona!')"
                                oninput="setCustomValidity('')" type="text"
                                class="form-control @error('broj_telefona') is-invalid @enderror" id="broj_telefona"
                                name="broj_telefona"
                                value="{{old('broj_telefona') ? old('broj_telefona') : $student->broj_telefona}}">
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
                        <input required oninvalid="this.setCustomValidity('Molimo unesite validnu godinu studija!!')"
                            oninput="setCustomValidity('')" type="number" min="1" max="5" placeholder="1"
                            class="form-control @error('godina_studija') is-invalid @enderror" id="godina_studija"
                            name="godina_studija"
                            value={{old('godina_studija') ? old('godina_studija') : $student->godina_studija}}>
                        @error('godina_studija')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label for="datum_rodjenja">Datum rodjenja</label>
                        <input required oninvalid="this.setCustomValidity('Molimo unesite datum rodjenja!')"
                            oninput="setCustomValidity('')" type="date"
                            class="form-control @error('datum_rodjenja') is-invalid @enderror" id="datum_rodjenja"
                            name="datum_rodjenja"
                            value={{old('datum_rodjenja') ? old('datum_rodjenja') : $student->datum_rodjenja}}>
                        @error('datum_rodjenja')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label for="jmbg">JMBG</label>
                        <input required oninvalid="this.setCustomValidity('Molimo unesite JMBG!')"
                            oninput="setCustomValidity('')" type="text"
                            class="form-control @error('jmbg') is-invalid @enderror" id="jmbg" name="jmbg"
                            value={{old('jmbg') ? old('jmbg') : $student->jmbg}}>
                        @error('jmbg')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg shadow font-weight-bold">Sačuvaj</button>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>
</div>
@endsection
