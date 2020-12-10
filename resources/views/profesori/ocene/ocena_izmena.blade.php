@extends('layouts.app')
@section('title','Izmena ocene')

@section('content')
<div class="row justify-content-center mb-5">
    <div class="card rounded-lg  bg-gradient-light border border-dark shadow-lg">
        <div class="card-header text-center bg-gradient-white">
            <h2 class="font-weight-bold">Izmena ocene</h2>
        </div>
        <div class="card-body ">
            <form action={{route('ocena_izmena', ['id'=>$id['oc_id'], 'id1'=>$id['st_id']])}} method="POST">
                @csrf
                <div class="form-group">
                    <label for="izaberi">Predmet</label>
                    <select class="custom-select mr-sm-2 @error('izbor') is-invalid @enderror" id="izaberi" name="izbor"
                        required oninvalid="this.setCustomValidity('Molimo izaberite predmet!')"
                        oninput="setCustomValidity('')">
                        <option value={{$predmeti->id}}>{{$predmeti->naziv}}</option>
                    </select>
                    @error('izbor')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ocena">Ocena</label>
                    <div class="input-group">

                        <input type="number" min="5" max="10" class="form-control @error('ocena') is-invalid @enderror"
                            id="ocena" name="ocena" value={{$ocena->ocena}} required
                            oninvalid="this.setCustomValidity('Molimo unesite ocenu!')" oninput="setCustomValidity('')">
                        @error('ocena')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">.00</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="datum">Datum</label>
                    <input type="date" class="form-control @error('datum') is-invalid @enderror" id="datum" name="datum"
                        value={{$ocena->datum}} required oninvalid="this.setCustomValidity('Molimo izaberite datum!')"
                        oninput="setCustomValidity('')">
                    @error('datum')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-outline-primary mb-3 ml-3 shadow font-weight-bold" role="button"
                        value="Sačuvaj" />
                </div>
            </form>

        </div>
    </div>
</div>
</div>
@endsection