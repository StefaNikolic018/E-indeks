@extends('layouts.app')
@section('title', 'Novi smer')

@section('content')
<div class="container">

    @if(session('smer'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-xs-12'>
            <div class="alert alert-{{ session('smer')[0] }}">
                {{ session('smer')[1] }}</div>
        </div>
    </div>
    @endif

    {{-- FORM TO ADD A STUDENT START --}}
    <div class="card rounded-lg border border-dark bg-gradient-light shadow-lg">
        <div class="card-header text-center">
            <h2 class="font-weight-bold pt-2" style="text-shadow: 2px 2px lightgray">Novi smer</h2>
        </div>
        <div class="card-body text-center font-weight-bold">
            <form action={{ route('novi_smer') }} method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label for="naziv">Naziv</label>
                            <input value="{{ old('naziv') }}" required
                                oninvalid="this.setCustomValidity('Molimo unesite naziv!')"
                                oninput="setCustomValidity('')" type="text"
                                class="form-control @error('naziv') is-invalid @enderror" id="naziv"
                                name="naziv" placeholder="Unesite naziv">
                            @error('naziv')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label class="font-weight-bold" for="akreditovan">Akreditovan</label>
                        <select class="form-control custom-select mr-sm-2 @error('akreditovan') is-invalid @enderror" id="akreditovan"
                            name="akreditovan" oninvalid="this.setCustomValidity('Molimo izaberite godinu akreditacije!')"
                            oninput="setCustomValidity('')">
                        @for($i=2000;$i<=date("Y");$i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                        </select>
                        @error('akreditovan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                        <label for="naziv">ESPB</label>
                            <input value="{{ old('espb') }}" required
                                oninvalid="this.setCustomValidity('Molimo unesite ESPB!')"
                                oninput="setCustomValidity('')" type="text"
                                class="form-control @error('espb') is-invalid @enderror" id="espb"
                                name="espb" value="180" readonly style="color:black" placeholder="180">
                            @error('espb')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>

                </div>
                <div class="form-row">
                    {{-- <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label class="font-weight-bold" for="predmeti">Predmeti </label>
                        <select class="custom-select mr-sm-2 @error('predmeti') is-invalid @enderror"
                            id="predmeti" name="predmeti[]" required
                            oninvalid="this.setCustomValidity('Molimo izaberite predmete!')"
                            oninput="setCustomValidity('')" multiple>
                            @foreach($predmeti as $predmet)
                            <option value="{{ $predmet->naziv }}">{{ $predmet->naziv }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Više izbora (CTRL + CLICK)</small>
                        @error('predmeti')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                    <div class="form-group col-12">
                        <label class="font-weight-bold" for="opis" class="text-center">Opis</label>
                        <textarea class="form-control py-2 pb-3" id="bio" name="opis" rows="3" value="{{ old('opis') }}" required
                            oninvalid="this.setCustomValidity('Molimo unesite opis!')"
                            oninput="setCustomValidity('')"></textarea>
                        @error('opis')
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
</div>

    @endsection
