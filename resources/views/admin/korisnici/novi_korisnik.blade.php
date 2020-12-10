@extends('layouts.app')
@section('title','Novi korisnik')

@section('content')
<div class="container">
    <div class="card bg-gradient-light rounded-lg border-dark text-center shadow-lg">
        <div class="card-header bg-gradient-white ">
            <h3 class="font-weight-bold pt-2" style="text-shadow: 2px 2px lightgray">Novi korisnik </h3>
        </div>
        <form action={{ route('novi_korisnik') }} method="POST">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label for="ime">Ime</label>
                        <input required oninvalid="this.setCustomValidity('Molimo unesite ime!')"
                            oninput="setCustomValidity('')" type="text"
                            class="form-control @error('ime') is-invalid @enderror" id="ime" name="ime"
                            value="{{ old('ime') }}">
                        @error('ime')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label for="prezime">Prezime</label>
                        <input required oninvalid="this.setCustomValidity('Molimo unesite prezime!')"
                            oninput="setCustomValidity('')" type="text"
                            class="form-control @error('prezime') is-invalid @enderror" id="prezime" name="prezime"
                            value="{{ old('prezime') }}">
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
                            <input required oninvalid="this.setCustomValidity('Molimo unesite email!')"
                                oninput="setCustomValidity('')" type="email"
                                class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                value="{{ old('email') }}">
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
                        <input required oninvalid="this.setCustomValidity('Molimo unesite lozinku!')"
                            oninput="setCustomValidity('')" type="password"
                            class="form-control @error('lozinka') is-invalid @enderror" id="lozinka" name="password"
                            value="{{ old('password') }}">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        </>
                    </div>
                </div>

                <div class="col-12 mt-3 text-center">
                    <button type="submit" class="btn btn-outline-primary btn-lg mb-3 ml-3 shadow">Sačuvaj</button>
                </div>
            </div>
    </div>
    </form>
</div>



@endsection
