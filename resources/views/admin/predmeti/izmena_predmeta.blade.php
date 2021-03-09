@extends('layouts.app')
@section('title','Izmena predmeta')

@section('content')
<div class="container">
    @if(url()->previous()==url('/login'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-md-6  col-sm-12'>
            <div class="alert alert-success shadow" id="welcome">Dobrodošli {{ Auth::user()->ime }}!</div>
        </div>
    </div>
    @endif
    <div class="row justify-content-center text-center">
        <div class="card rounded-lg bg-gradient-light border border-dark shadow-lg">
            <div class="card-header text-center">

                <h3 class="font-weight-bold pt-2" style="text-shadow: 2px 2px lightgray">Izmena predmeta</h3>
            </div>
            <div class="card-body">

                <form action={{route('izmena_predmeta', ['id'=>$predmet->id])}} method="POST">
                    @csrf
                    <div class="form-row text-center">
                        <div class="form-group col-12">
                            <label for="smer">Smer</label><br>
                            <select class="custom-select mr-sm-2 @error('smer') is-invalid @enderror" id="inlineFormCustomSelect" name="smer" required oninvalid="this.setCustomValidity('Molimo izaberite smer!')"
                            oninput="setCustomValidity('')">
                                <option value="">Izaberi smer</option>
                                @foreach($smerovi as $smer)
                                    <option value="{{$smer->id}}" <?php if($predmet->smerovi==$smer->id){
                                        echo 'selected';
                                    } ?>>{{$smer->naziv}}</option>
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
                        <div class="form-group col-6 ">
                            <label for="sifra">Šifra</label>
                            <input required oninvalid="this.setCustomValidity('Molimo unesite šifru predmeta!')"
                                oninput="setCustomValidity('')" type="text"
                                class="form-control @error('sifra') is-invalid @enderror" name="sifra"
                                value="{{ old('sifra') ? old('sifra') :  $predmet->sifra}}">
                            @error('sifra')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group col-6 ">
                            <label for="naziv">Naziv</label>
                            <input required oninvalid="this.setCustomValidity('Molimo unesite naziv predmeta!')"
                                oninput="setCustomValidity('')" type="text"
                                class="form-control @error('naziv') is-invalid @enderror" name="naziv"
                                value="{{ old('naziv') ? old('naziv') :  $predmet->naziv}}">
                            @error('naziv')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-6 ">
                            <label for="god_stud">Godina Studija</label>
                            <input required oninvalid="this.setCustomValidity('Molimo unesite godinu studija!')"
                                oninput="setCustomValidity('')" type="number" max="5" min="1" placeholder="1"
                                class="form-control @error('godina_studija') is-invalid @enderror" name="godina_studija"
                                value={{ old('godina_studija') ? old('godina_studija') :  $predmet->godina_studija}}>
                            @error('godina_studija')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group col-6 ">
                            <label for="espb">ESPB</label>
                            <input required oninvalid="this.setCustomValidity('Molimo unesite broj ESPB!')"
                                oninput="setCustomValidity('')" type="number" min="3" max="7" placeholder="3"
                                class="form-control @error('epsb') is-invalid @enderror" name="espb"
                                value={{ old('espb') ? old('espb') :  $predmet->espb}}>
                            @error('espb')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-row text-center">
                        <div class="form-group col-12">
                            <label for="obavezni_izborni">Obavezni/Izborni</label><br>
                            <select required oninvalid="this.setCustomValidity('Molimo izaberite status predmeta!')"
                                oninput="setCustomValidity('')" class="custom-select mr-sm-2 " id="inlineFormCustomSelect"
                                name="obavezni_izborni" required>
                                <option>Status Predmeta</option>
                                <option value="Obavezni" <?php if($predmet->obavezni_izborni=='Obavezni' || old('obavezni_izborni')=='Obavezni'){
                            echo 'selected';
                        } ?>>Obavezni</option>
                                <option value="Izborni" <?php if($predmet->obavezni_izborni=='Izborni' || old('obavezni_izborni')=='Izborni'){
                            echo 'selected';
                        } ?>>Izborni</option>
                            </select>
                            @error('obavezni_izborni')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <br>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-outline-primary mb-3 ml-3 btn-lg shadow">Sačuvaj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {{-- STARO --}}
    {{-- <div class="row justify-content-left">
    <div class='col-lg-6 col-xs-12'>
      <div class="lead my-3 col-6">Izmena Predmeta</div><br>
      <form action={{route('izmena_predmeta', ['id'=>$predmet->id])}} method="POST">
    @csrf

    <div class="form-group col-6 ">
        <label for="sifra">Sifra</label>
        <input required oninvalid="this.setCustomValidity('Molimo unesite šifru predmeta!')"
            oninput="setCustomValidity('')" type="text" class="form-control @error('sifra') is-invalid @enderror"
            name="sifra" value={{ old('sifra') ? old('sifra') :  $predmet->sifra}}>
        @error('sifra')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>


    <div class="form-group col-6 ">
        <label for="naziv">Naziv</label>
        <input required oninvalid="this.setCustomValidity('Molimo unesite naziv predmeta!')"
            oninput="setCustomValidity('')" type="text" class="form-control @error('naziv') is-invalid @enderror"
            name="naziv" value={{ old('naziv') ? old('naziv') :  $predmet->naziv}}>
        @error('naziv')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>


    <div class="form-group col-6 ">
        <label for="god_stud">Godina Studija</label>
        <input required oninvalid="this.setCustomValidity('Molimo unesite godinu studija!')"
            oninput="setCustomValidity('')" type="number" max="5" min="1" placeholder="1"
            class="form-control @error('godina_studija') is-invalid @enderror" name="godina_studija"
            value={{ old('godina_studija') ? old('godina_studija') :  $predmet->godina_studija}}>
        @error('godina_studija')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>


    <div class="form-group col-6 ">
        <label for="espb">ESPB</label>
        <input required oninvalid="this.setCustomValidity('Molimo unesite broj ESPB!')" oninput="setCustomValidity('')"
            type="number" min="3" max="7" placeholder="3" class="form-control @error('epsb') is-invalid @enderror"
            name="espb" value={{ old('espb') ? old('espb') :  $predmet->espb}}>
        @error('espb')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-6 my-1">
        <label class="mr-sm-2 " for="inlineFormCustomSelect">Obavezni/Izborni</label><br>
        <select required oninvalid="this.setCustomValidity('Molimo izaberite status predmeta!')"
            oninput="setCustomValidity('')" class="custom-select mr-sm-2 " id="inlineFormCustomSelect"
            name="obavezni_izborni" required>
            <option>Status Predmeta</option>
            <option value="Obavezni" <?php if($predmet->obavezni_izborni=='Obavezni' || old('obavezni_izborni')=='Obavezni'){
                echo 'selected';
            } ?>>Obavezni</option>
            <option value="Izborni" <?php if($predmet->obavezni_izborni=='Izborni' || old('obavezni_izborni')=='Izborni'){
                echo 'selected';
            } ?>>Izborni</option>
        </select>
        @error('obavezni_izborni')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <br>
    <input type="submit" class="btn btn-outline-primary mb-3 ml-3" role="button" value="Sačuvaj" />
    </form> --}}
</div>
</div>

</div>

@endsection
