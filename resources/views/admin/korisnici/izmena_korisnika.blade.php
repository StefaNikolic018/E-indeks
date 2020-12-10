@extends('layouts.app')
@section('title','Izmena korisnika '.$korisnik->ime)

@section('content')
<div class="container">
    <div class="card bg-gradient-light rounded-lg border border-dark shadow-lg">
        <div class="card-header text-center bg-gradient-white rounded-sm">
            <h3 class="font-weight-bold pt-2" style="text-shadow: 2px 2px lightgray">Izmena korisnika </h3>
        </div>
        <form
            action={{ route('izmena_korisnika',[ 'id'=>$korisnik->id]) }}
            method="POST">
            @csrf
            <div class="card-body">

                <div class="form-row">
                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label for="ime">Ime</label>
                        <input type="text" class="form-control @error('ime')
        is-invalid @enderror" name="ime"
                            value={{ old('ime') ? old('ime') : $korisnik->ime }}>
                        @error('ime')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label for="prezime">Prezime</label>
                        <input type="text" class="form-control @error('prezime')
        is-invalid @enderror" name="prezime"
                            value={{ old('prezime') ? old('prezime') : $korisnik->prezime }}>
                        @error('prezime')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label for="uloga">Uloga</label>
                        <select class="custom-select mr-sm-2 @error('uloga') is-invalid @enderror" id="uloga"
                            name="uloga" required oninvalid="this.setCustomValidity('Molimo izaberite ulogu!')"
                            oninput="setCustomValidity('')"">
                            <option value=" admin">Profesor</option>
                            <option value="user">Student</option>
                            <option value="superAdmin">Administrator</option>
                        </select>
                        @error('uloga')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-lg-6 col-md-6 col-sm-12 ">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control @error('email')
          is-invalid @enderror" name="email"
                                value={{ old('email') ? old('email') : $korisnik->email }}>
                            <div class="input-group-append">
                                <div class="input-group-text">@example.com</div>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>


                    <div class="form-group col-lg-6 col-md-6 col-sm-12 ">
                        <label for="lozinka">Lozinka</label>
                        <input type="password" class="form-control @error('password')
        is-invalid @enderror" name="password" value={{ old('password') }}>
                        <small style="color: red">*</small><small> Unesite staru lozinku ako ne želite da je
                            menjate!</small>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        </>
                    </div>

                    <div class="col-12 mt-3 text-center">
                        <button type="submit" class="btn btn-outline-primary btn-lg mb-3 ml-3 shadow">Sačuvaj</button>
                    </div>
        </form>
    </div>
</div>
</div>



{{-- STARO --}}
{{-- <div class="row justify-content-left">
    <div class='col-lg-6 col-xs-12'>

      <div class="lead my-3 col-6">Izmena Korisnika</div><br>
      <form action={{ route('izmena_korisnika',[ 'id'=>$korisnik->id]) }}
method="POST">
@csrf

<div class="form-group col-6 ">
    <label for="ime">Ime</label>
    <input type="text" class="form-control @error('ime')
    is-invalid @enderror" name="ime"
        value={{ old('ime') ? old('ime') : $korisnik->ime }}>
    @error('ime')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>


<div class="form-group col-6 ">
    <label for="prezime">Prezime</label>
    <input type="text" class="form-control @error('prezime')
    is-invalid @enderror" name="prezime"
        value={{ old('prezime') ? old('prezime') : $korisnik->prezime }}>
    @error('prezime')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>


<div class="form-group col-6 ">
    <label for="email">Email</label>
    <input type="email" class="form-control @error('email')
      is-invalid @enderror" name="email"
        value={{ old('email') ? old('email') : $korisnik->email }}>
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>


<div class="form-group col-6 ">
    <label for="lozinka">Lozinka</label>
    <input type="password" class="form-control @error('password')
    is-invalid @enderror" name="password" value={{ old('password') }}>
    <small>Unesite staru lozinku ako ne želite da je menjate!</small>
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<input type="submit" class="btn btn-outline-primary mb-3 ml-3" role="button" value="Sačuvaj" />
</form>
</div>
</div> --}}
</div>
</div>

@endsection
