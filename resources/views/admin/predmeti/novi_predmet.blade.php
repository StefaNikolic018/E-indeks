@extends('layouts.app')
@section('title','Novi predmet')

@section('content')
<div class="container">
@if(session('predmet'))
  <div class="row justify-content-center">
    <div class='col-lg-6 col-xs-12'>
      <div class="alert alert-{{session('predmet')[0]}}">{{ session('predmet')[1] }}</div>
    </div>
  </div>
@endif
<div class="card rounded-lg bg-gradient-light border border-dark">
    <div class="card-header text-center"><h1>Novi Predmet</h1></div>
    <div class="card-body">
 <form action={{route('novi_predmet')}} method="POST">
        @csrf
<div class="form-row">
    <div class="form-group col-6 ">
      <label for="sifra">Šifra</label>
      <input value="{{old('sifra')}}" required oninvalid="this.setCustomValidity('Molimo unesite šifru predmeta!')"
oninput="setCustomValidity('')" type="text" class="form-control @error('sifra') is-invalid @enderror" id="sifra" name="sifra">
  @error('sifra')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
  @enderror
    </div>


    <div class="form-group col-6 ">
      <label for="naziv">Naziv</label>
      <input value="{{old('naziv')}}" required oninvalid="this.setCustomValidity('Molimo unesite naziv predmeta!')"
oninput="setCustomValidity('')" type="text" class="form-control @error('naziv') is-invalid @enderror" id="naziv" name="naziv">
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
      <input value="{{old('godina_studija')}}" required oninvalid="this.setCustomValidity('Molimo godinu studija!')"
oninput="setCustomValidity('')" type="number" max="5" min="1" placeholder="1" class="form-control @error('godina_studija') is-invalid @enderror" id="god_stud" name="godina_studija">
@error('godina_studija')
  <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
  </span>
@enderror
    </div>


  <div class="form-group col-6 ">
    <label for="espb">ESPB</label>
    <input value="{{old('espb')}}" required oninvalid="this.setCustomValidity('Molimo unesite broj ESPB!')"
oninput="setCustomValidity('')" type="number" max="7" min="3" placeholder="3" class="form-control @error('espb') is-invalid @enderror" id="espb" name="espb">
@error('espb')
  <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
  </span>
@enderror
  </div>

</div>
<div class="form-row">

        <div class="col-lg-6 col-md-6 col-sm-12 my-1 text-center">
          <label for="obavezni_izborni">Obavezni/Izborni</label><br>
          <select class="custom-select mr-sm-2 @error('obavezni_izborni') is-invalid @enderror" id="inlineFormCustomSelect" name="obavezni_izborni" required oninvalid="this.setCustomValidity('Molimo izaberite status predmeta!')"
 oninput="setCustomValidity('')">
            <option selected value="Nije izabrano">Status Predmeta</option>
            <option value="Obavezni">Obavezni</option>
            <option value="Izborni">Izborni</option>
          </select>
      @error('obavezni_izborni')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12  my-1 text-center">
            <label for="smer">Smer</label><br>
            <select class="custom-select mr-sm-2 @error('smer') is-invalid @enderror" id="inlineFormCustomSelect" name="smer" required oninvalid="this.setCustomValidity('Molimo izaberite smer!')"
   oninput="setCustomValidity('')">
              <option value="">Izaberi smer</option>
              @foreach($smerovi as $smer)
              <option value="{{$smer->id}}">{{$smer->naziv}}</option>
              @endforeach
            </select>
        @error('smer')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
          </div>
</div>
          <br>

        <div class="col-12 text-center">
            <button type="submit" class="btn btn-outline-primary mb-3 ml-3 btn-lg">Sačuvaj</button>
        </div>
          </form>
    </div>
</div>
      </div>


@endsection
