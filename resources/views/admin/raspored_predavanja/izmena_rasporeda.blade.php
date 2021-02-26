@extends('layouts.app')
@section('title','Izmena rasporeda '.$raspored->godina_studija.'. godine "'.$raspored->smerovi->naziv.'"')


@section('content')

<div class="container" >

    @if(session('raspored'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-xs-12'>
            <div class="alert alert-{{ session('raspored')[0] }}">
                {{ session('raspored')[1] }}</div>
        </div>
    </div>
    @endif

    {{-- FORM TO ADD A STUDENT START --}}
    <div class="card rounded-lg border border-dark bg-gradient-light shadow-lg">
        <div class="card-header text-center">
            <h1 class="font-weight-bold pt-2" style="text-shadow: 2px 2px lightgray">Izmena rasporeda</h1>
        </div>
        <div class="card-body text-center font-weight-bold">
            <form action={{ route('izmena_rasporeda',['id'=>$raspored->id]) }} method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-lg-6 col-md-6 col-sm-12 ">
                        <label class="font-weight-bold" for="smer">Smer</label>
                        <select class="form-control custom-select mr-sm-2 @error('smer') is-invalid @enderror" id="smer"
                            name="smer" oninvalid="this.setCustomValidity('Molimo izaberite smer!')"
                            oninput="setCustomValidity('')">
                        <option value="{{$raspored->smer}}">{{$raspored->smerovi->naziv}}</option>
                        </select>
                        @error('smer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="form-group col-lg-6 col-md-6 col-sm-12 ">
                        <label class="font-weight-bold" for="godina_studija">Godina</label>
                        <select class="form-control custom-select mr-sm-2 @error('godina_studija') is-invalid @enderror" id="godina_studija"
                            name="godina_studija" oninvalid="this.setCustomValidity('Molimo izaberite godinu studija!')"
                            oninput="setCustomValidity('')">
                        <option value="{{$raspored->godina_studija}}">{{$raspored->godina_studija}}.</option>
                        </select>
                        @error('godina_studija')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="border border-secondary mb-3 bg-info shadow rounded p-3">

                    <div class="col-12 col-sm-8 offset-sm-2 d-none">
                        <div class="form-row">
                            <div class="input-group mb-3 text-center">
                                <div class="input-group-prepend">
                                <label class="input-group-text" for="Ponedeljak">Izaberite</label>
                                </div>
                                <select name="ponedeljak" class="custom-select shadow" id="Ponedeljak">
                                <option value="{{$pon}}" selected>Broj predavanja</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <h2 class="m-auto font-weight-bold pb-2">Ponedeljak</h2>
                    {{-- TREBA DA ISPISEM CASOVE KOJI VEC POSTOJE --}}
                    @if($raspored->ponedeljak!='Nema predavanja')
                    @php $j=0; @endphp
                    @for($i=0;$i<count($raspored->ponedeljak);$i=$i+4)
                        @php $j=$j+1; @endphp
                        <div class="form-row p-1 border rounded border-dark shadow bg-light" id="Ponedeljak{{$j}}">
                            <h2 class="col-12 text-center p-2" id="Ponedeljak{{$j}}[]">Ponedeljak: {{$j}}. čas @if($j==(count($raspored->ponedeljak)/4))<span class="float-right btn btn-outline-danger" onclick="obrisiCas('Ponedeljak{{$j}}',{{$j}})"><i class="fas fa-times-circle"></i></span>@endif</h2><hr>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label for="predmet">Predmet</label>
                            <select value="{{ old("predmet") }}" required oninvalid="this.setCustomValidity("Molimo unesite ime predmeta!")" oninput="setCustomValidity("")" class="form-control custom-select @error("predmet") is-invalid @enderror" id="predmet" name="Ponedeljak{{$j}}[]" placeholder="Unesite predmet">
                            <option value="">Izaberite predmet</option>
                            @foreach($predmeti as $predmet)
                            <option value="{{$predmet->id}}" @if($predmet->id==$raspored->ponedeljak[$i]) selected @endif>{{$predmet->naziv}}</option>
                            @endforeach
                            </select>
                            @error("predmet")
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label for="vreme">Vreme</label>
                            <input value="{{ old("vreme") ? old("vreme") : $raspored->ponedeljak[$i+1] }}" required oninvalid="this.setCustomValidity("Molimo unesite vreme!(od-do)")" oninput="setCustomValidity("")" type="text" class="form-control @error("vreme") is-invalid @enderror" id="vreme" name="Ponedeljak{{$j}}[]" placeholder="Unesite vreme">
                            @error("vreme")<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label class="font-weight-bold" for="vrsta">Predavanja/vežbe</label>
                            <select class="form-control custom-select mr-sm-2 @error("vrsta") is-invalid @enderror" id="vrsta" name="Ponedeljak{{$j}}[]" oninvalid="this.setCustomValidity("Molimo izaberite vrstu predavanja!")" oninput="setCustomValidity("")">
                            <option value="">Izaberite vrstu predavanja</option>
                            <option value="Predavanja" @if($raspored->ponedeljak[$i+2]=='Predavanja') selected @endif>Predavanja</option>
                            <option value="Vežbe" @if($raspored->ponedeljak[$i+2]=='Vežbe') selected @endif>Vežbe</option>'
                            </select>
                            @error("vrsta")
                            <span class="invalid-feedback" role="alert">'
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label class="font-weight-bold" for="prostorija">Prostorija</label>
                            <select class="form-control custom-select mr-sm-2 @error("prostorija") is-invalid @enderror" id="prostorija" name="Ponedeljak{{$j}}[]" oninvalid="this.setCustomValidity("Molimo izaberite prostoriju predavanja!")" oninput="setCustomValidity("")">
                            <option value="">Izaberite prostoriju predavanja</option>
                            <option value="A1" @if($raspored->ponedeljak[$i+3]=='A1') selected @endif>A1</option>
                            <option value="A2" @if($raspored->ponedeljak[$i+3]=='A2') selected @endif>A2</option>
                            <option value="A3" @if($raspored->ponedeljak[$i+3]=='A3') selected @endif>A3</option>
                            </select>
                            @error("prostorija")
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                            </div><br>

                    @endfor
                    @else
                                <h2 class="text-center border p-2 rounded bg-light" id="PonedeljakNP">Nema predavanja</h2>

                    @endif

                    <div class="Ponedeljak">

                    </div>
                    <div class="form-row">
                        <div class="form-group mt-3 col-12 text-center">
                            <a id="dodajPon" class="btn btn-primary btn-lg shadow">Dodaj čas</a>
                        </div>
                    </div>
                </div>
                <div class="border border-secondary mb-3 bg-info shadow rounded p-3">
                    <div class="col-12 col-sm-8 offset-sm-2 d-none">
                        <div class="form-row">
                            <div class="input-group mb-3 text-center">
                                <div class="input-group-prepend">
                                <label class="input-group-text" for="Utorak">Izaberite</label>
                                </div>
                                <select name="utorak" class="custom-select shadow" id="Utorak">
                                    <option value="{{$uto}}" selected>Broj predavanja</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <h2 class="m-auto font-weight-bold pb-2">Utorak</h2>

                    @if($raspored->utorak!='Nema predavanja')
                    @php $j=0; @endphp
                    @for($i=0;$i<count($raspored->utorak);$i=$i+4)
                        @php $j=$j+1; @endphp
                        <div class="form-row p-1 border rounded border-dark shadow bg-light" id="Utorak{{$j}}">
                            <h2 class="col-12 text-center p-2" id="Utorak{{$j}}[]">Utorak: {{$j}}. čas @if($j==(count($raspored->utorak)/4))<span class="float-right btn btn-outline-danger" onclick="obrisiCas('Utorak{{$j}}',{{$j}})"><i class="fas fa-times-circle"></i></span>@endif</h2><hr>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label for="predmet">Predmet</label>
                            <select value="{{ old("predmet") }}" required oninvalid="this.setCustomValidity("Molimo unesite ime predmeta!")" oninput="setCustomValidity("")" class="form-control custom-select @error("predmet") is-invalid @enderror" id="predmet" name="Utorak{{$j}}[]" placeholder="Unesite predmet">
                            <option value="">Izaberite predmet</option>
                            @foreach($predmeti as $predmet)
                            <option value="{{$predmet->id}}" @if($predmet->id==$raspored->utorak[$i]) selected @endif>{{$predmet->naziv}}</option>
                            @endforeach
                            </select>
                            @error("predmet")
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label for="vreme">Vreme</label>
                            <input value="{{ old("vreme") ? old("vreme") : $raspored->utorak[$i+1] }}" required oninvalid="this.setCustomValidity("Molimo unesite vreme!(od-do)")" oninput="setCustomValidity("")" type="text" class="form-control @error("vreme") is-invalid @enderror" id="vreme" name="Utorak{{$j}}[]" placeholder="Unesite vreme">
                            @error("vreme")<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label class="font-weight-bold" for="vrsta">Predavanja/vežbe</label>
                            <select class="form-control custom-select mr-sm-2 @error("vrsta") is-invalid @enderror" id="vrsta" name="Utorak{{$j}}[]" oninvalid="this.setCustomValidity("Molimo izaberite vrstu predavanja!")" oninput="setCustomValidity("")">
                            <option value="">Izaberite vrstu predavanja</option>
                            <option value="Predavanja" @if($raspored->utorak[$i+2]=='Predavanja') selected @endif>Predavanja</option>
                            <option value="Vežbe" @if($raspored->utorak[$i+2]=='Vežbe') selected @endif>Vežbe</option>'
                            </select>
                            @error("vrsta")
                            <span class="invalid-feedback" role="alert">'
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label class="font-weight-bold" for="prostorija">Prostorija</label>
                            <select class="form-control custom-select mr-sm-2 @error("prostorija") is-invalid @enderror" id="prostorija" name="Utorak{{$j}}[]" oninvalid="this.setCustomValidity("Molimo izaberite prostoriju predavanja!")" oninput="setCustomValidity("")">
                            <option value="">Izaberite prostoriju predavanja</option>
                            <option value="A1" @if($raspored->utorak[$i+3]=='A1') selected @endif>A1</option>
                            <option value="A2" @if($raspored->utorak[$i+3]=='A2') selected @endif>A2</option>
                            <option value="A3" @if($raspored->utorak[$i+3]=='A3') selected @endif>A3</option>
                            </select>
                            @error("prostorija")
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                            </div><br>

                    @endfor
                    @else
                    <h2 class="text-center border p-2 rounded bg-light" id="UtorakNP">Nema predavanja</h2>


                    @endif

                    <div class="Utorak">

                    </div>
                    <div class="form-row">
                        <div class="form-group mt-3 col-12 text-center">
                            <a id="dodajUto" class="btn btn-primary btn-lg shadow">Dodaj čas</a>
                        </div>
                    </div>

                </div>
                <div class="border border-secondary mb-3 bg-info shadow rounded p-3">
                    <div class="col-12 col-sm-8 offset-sm-2 d-none">
                        <div class="form-row">
                            <h2 class="m-auto font-weight-bold">Sreda</h2>
                            <div class="input-group mb-3 text-center">
                                <div class="input-group-prepend">
                                <label class="input-group-text" for="Sreda">Izaberite</label>
                                </div>
                                <select name="sreda" class="custom-select shadow" id="Sreda">
                                    <option value="{{$sre}}">Broj predavanja</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <h2 class="m-auto font-weight-bold pb-2">Sreda</h2>
                    @if($raspored->sreda!='Nema predavanja')
                    @php $j=0; @endphp
                    @for($i=0;$i<count($raspored->sreda);$i=$i+4)
                        @php $j=$j+1; @endphp
                        <div class="form-row p-1 border rounded border-dark shadow bg-light" id="Sreda{{$j}}">
                            <h2 class="col-12 text-center p-2" id="Sreda{{$j}}[]">Sreda: {{$j}}. čas @if($j==(count($raspored->sreda)/4))<span class="float-right btn btn-outline-danger" onclick="obrisiCas('Sreda{{$j}}',{{$j}})"><i class="fas fa-times-circle"></i></span>@endif</h2><hr>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label for="predmet">Predmet</label>
                            <select value="{{ old("predmet") }}" required oninvalid="this.setCustomValidity("Molimo unesite ime predmeta!")" oninput="setCustomValidity("")" class="form-control custom-select @error("predmet") is-invalid @enderror" id="predmet" name="Sreda{{$j}}[]" placeholder="Unesite predmet">
                            <option value="">Izaberite predmet</option>
                            @foreach($predmeti as $predmet)
                            <option value="{{$predmet->id}}" @if($predmet->id==$raspored->sreda[$i]) selected @endif>{{$predmet->naziv}}</option>
                            @endforeach
                            </select>
                            @error("predmet")
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label for="vreme">Vreme</label>
                            <input value="{{ old("vreme") ? old("vreme") : $raspored->sreda[$i+1] }}" required oninvalid="this.setCustomValidity("Molimo unesite vreme!(od-do)")" oninput="setCustomValidity("")" type="text" class="form-control @error("vreme") is-invalid @enderror" id="vreme" name="Sreda{{$j}}[]" placeholder="Unesite vreme">
                            @error("vreme")<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label class="font-weight-bold" for="vrsta">Predavanja/vežbe</label>
                            <select class="form-control custom-select mr-sm-2 @error("vrsta") is-invalid @enderror" id="vrsta" name="Sreda{{$j}}[]" oninvalid="this.setCustomValidity("Molimo izaberite vrstu predavanja!")" oninput="setCustomValidity("")">
                            <option value="">Izaberite vrstu predavanja</option>
                            <option value="Predavanja" @if($raspored->sreda[$i+2]=='Predavanja') selected @endif>Predavanja</option>
                            <option value="Vežbe" @if($raspored->sreda[$i+2]=='Vežbe') selected @endif>Vežbe</option>'
                            </select>
                            @error("vrsta")
                            <span class="invalid-feedback" role="alert">'
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label class="font-weight-bold" for="prostorija">Prostorija</label>
                            <select class="form-control custom-select mr-sm-2 @error("prostorija") is-invalid @enderror" id="prostorija" name="Sreda{{$j}}[]" oninvalid="this.setCustomValidity("Molimo izaberite prostoriju predavanja!")" oninput="setCustomValidity("")">
                            <option value="">Izaberite prostoriju predavanja</option>
                            <option value="A1" @if($raspored->sreda[$i+3]=='A1') selected @endif>A1</option>
                            <option value="A2" @if($raspored->sreda[$i+3]=='A2') selected @endif>A2</option>
                            <option value="A3" @if($raspored->sreda[$i+3]=='A3') selected @endif>A3</option>
                            </select>
                            @error("prostorija")
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                            </div><br>

                    @endfor
                    @else
                        <h2 class="text-center border p-2 rounded bg-light" id="SredaNP">Nema predavanja</h2>


                    @endif

                    <div class="Sreda"></div>
                    <div class="form-row">
                        <div class="form-group mt-3 col-12 text-center">
                            <a id="dodajSre" class="btn btn-primary btn-lg shadow">Dodaj čas</a>
                        </div>
                    </div>
                </div>
                <div class="border border-secondary mb-3 bg-info shadow rounded p-3">
                    <div class="col-12 col-sm-8 offset-sm-2 d-none">
                        <div class="form-row">
                            <h2 class="m-auto font-weight-bold">Četvrtak</h2>
                            <div class="input-group mb-3 text-center">
                                <div class="input-group-prepend">
                                <label class="input-group-text" for="Četvrtak">Izaberite</label>
                                </div>
                                <select name="cetvrtak" class="custom-select shadow" id="Četvrtak">
                                    <option value="{{$cet}}">Broj predavanja</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <h2 class="m-auto font-weight-bold pb-2">Četvrtak</h2>
                    @if($raspored->cetvrtak!='Nema predavanja')
                    @php $j=0; @endphp
                    @for($i=0;$i<count($raspored->cetvrtak);$i=$i+4)
                        @php $j=$j+1; @endphp
                        <div class="form-row p-1 border rounded border-dark shadow bg-light" id="Četvrtak{{$j}}">
                            <h2 class="col-12 text-center p-2" id="Četvrtak{{$j}}[]">Četvrtak: {{$j}}. čas @if($j==(count($raspored->cetvrtak)/4))<span class="float-right btn btn-outline-danger" onclick="obrisiCas('Četvrtak{{$j}}',{{$j}})"><i class="fas fa-times-circle"></i></span>@endif</h2><hr>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label for="predmet">Predmet</label>
                            <select value="{{ old("predmet") }}" required oninvalid="this.setCustomValidity("Molimo unesite ime predmeta!")" oninput="setCustomValidity("")" class="form-control custom-select @error("predmet") is-invalid @enderror" id="predmet" name="Četvrtak{{$j}}[]" placeholder="Unesite predmet">
                            <option value="">Izaberite predmet</option>
                            @foreach($predmeti as $predmet)
                            <option value="{{$predmet->id}}" @if($predmet->id==$raspored->cetvrtak[$i]) selected @endif>{{$predmet->naziv}}</option>
                            @endforeach
                            </select>
                            @error("predmet")
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label for="vreme">Vreme</label>
                            <input value="{{ old("vreme") ? old("vreme") : $raspored->cetvrtak[$i+1] }}" required oninvalid="this.setCustomValidity("Molimo unesite vreme!(od-do)")" oninput="setCustomValidity("")" type="text" class="form-control @error("vreme") is-invalid @enderror" id="vreme" name="Četvrtak{{$j}}[]" placeholder="Unesite vreme">
                            @error("vreme")<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label class="font-weight-bold" for="vrsta">Predavanja/vežbe</label>
                            <select class="form-control custom-select mr-sm-2 @error("vrsta") is-invalid @enderror" id="vrsta" name="Četvrtak{{$j}}[]" oninvalid="this.setCustomValidity("Molimo izaberite vrstu predavanja!")" oninput="setCustomValidity("")">
                            <option value="">Izaberite vrstu predavanja</option>
                            <option value="Predavanja" @if($raspored->cetvrtak[$i+2]=='Predavanja') selected @endif>Predavanja</option>
                            <option value="Vežbe" @if($raspored->cetvrtak[$i+2]=='Vežbe') selected @endif>Vežbe</option>'
                            </select>
                            @error("vrsta")
                            <span class="invalid-feedback" role="alert">'
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label class="font-weight-bold" for="prostorija">Prostorija</label>
                            <select class="form-control custom-select mr-sm-2 @error("prostorija") is-invalid @enderror" id="prostorija" name="Četvrtak{{$j}}[]" oninvalid="this.setCustomValidity("Molimo izaberite prostoriju predavanja!")" oninput="setCustomValidity("")">
                            <option value="">Izaberite prostoriju predavanja</option>
                            <option value="A1" @if($raspored->cetvrtak[$i+3]=='A1') selected @endif>A1</option>
                            <option value="A2" @if($raspored->cetvrtak[$i+3]=='A2') selected @endif>A2</option>
                            <option value="A3" @if($raspored->cetvrtak[$i+3]=='A3') selected @endif>A3</option>
                            </select>
                            @error("prostorija")
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                            </div><br>

                    @endfor
                    @else
                        <h2 class="text-center border p-2 rounded bg-light" id="ČetvrtakNP">Nema predavanja</h2>


                    @endif

                    <div class="Četvrtak"></div>

                    <div class="form-row">
                        <div class="form-group mt-3 col-12 text-center">
                            <a id="dodajČet" class="btn btn-primary btn-lg shadow">Dodaj čas</a>
                        </div>
                    </div>
                </div>
                <div class="border border-secondary mb-3 bg-info shadow rounded p-3">
                    <div class="col-12 col-sm-8 offset-sm-2 d-none">
                        <div class="form-row">
                            <h2 class="m-auto font-weight-bold">Petak</h2>
                            <div class="input-group mb-3 text-center">
                                <div class="input-group-prepend">
                                <label class="input-group-text" for="Petak">Izaberite</label>
                                </div>
                                <select name="petak" class="custom-select shadow" id="Petak">
                                    <option value="{{$pet}}">Broj predavanja</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <h2 class="m-auto font-weight-bold pb-2">Petak</h2>
                    @if($raspored->petak!='Nema predavanja')
                    @php $j=0; @endphp
                    @for($i=0;$i<count($raspored->petak);$i=$i+4)
                        @php $j=$j+1; @endphp
                        <div class="form-row p-1 border rounded border-dark shadow bg-light" id="Petak{{$j}}">
                            <h2 class="col-12 text-center p-2" id="Petak{{$j}}[]">Petak: {{$j}}. čas @if($j==(count($raspored->petak)/4))<span class="float-right btn btn-outline-danger" onclick="obrisiCas('Petak{{$j}}',{{$j}})"><i class="fas fa-times-circle"></i></span>@endif</h2><hr>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label for="predmet">Predmet</label>
                            <select value="{{ old("predmet") }}" required oninvalid="this.setCustomValidity("Molimo unesite ime predmeta!")" oninput="setCustomValidity("")" class="form-control custom-select @error("predmet") is-invalid @enderror" id="predmet" name="Petakk{{$j}}[]" placeholder="Unesite predmet">
                            <option value="">Izaberite predmet</option>
                            @foreach($predmeti as $predmet)
                            <option value="{{$predmet->id}}" @if($predmet->id==$raspored->petak[$i]) selected @endif>{{$predmet->naziv}}</option>
                            @endforeach
                            </select>
                            @error("predmet")
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label for="vreme">Vreme</label>
                            <input value="{{ old("vreme") ? old("vreme") : $raspored->petak[$i+1] }}" required oninvalid="this.setCustomValidity("Molimo unesite vreme!(od-do)")" oninput="setCustomValidity("")" type="text" class="form-control @error("vreme") is-invalid @enderror" id="vreme" name="Petakk{{$j}}[]" placeholder="Unesite vreme">
                            @error("vreme")<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label class="font-weight-bold" for="vrsta">Predavanja/vežbe</label>
                            <select class="form-control custom-select mr-sm-2 @error("vrsta") is-invalid @enderror" id="vrsta" name="Petakk{{$j}}[]" oninvalid="this.setCustomValidity("Molimo izaberite vrstu predavanja!")" oninput="setCustomValidity("")">
                            <option value="">Izaberite vrstu predavanja</option>
                            <option value="Predavanja" @if($raspored->petak[$i+2]=='Predavanja') selected @endif>Predavanja</option>
                            <option value="Vežbe" @if($raspored->petak[$i+2]=='Vežbe') selected @endif>Vežbe</option>'
                            </select>
                            @error("vrsta")
                            <span class="invalid-feedback" role="alert">'
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12 ">
                            <label class="font-weight-bold" for="prostorija">Prostorija</label>
                            <select class="form-control custom-select mr-sm-2 @error("prostorija") is-invalid @enderror" id="prostorija" name="Petakk{{$j}}[]" oninvalid="this.setCustomValidity("Molimo izaberite prostoriju predavanja!")" oninput="setCustomValidity("")">
                            <option value="">Izaberite prostoriju predavanja</option>
                            <option value="A1" @if($raspored->petak[$i+3]=='A1') selected @endif>A1</option>
                            <option value="A2" @if($raspored->petak[$i+3]=='A2') selected @endif>A2</option>
                            <option value="A3" @if($raspored->petak[$i+3]=='A3') selected @endif>A3</option>
                            </select>
                            @error("prostorija")
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                            </div><br>

                    @endfor
                    @else
                        <h2 class="text-center border p-2 rounded bg-light" id="PetakNP">Nema predavanja</h2>


                    @endif

                    <div class="Petak"></div>
                    <div class="form-row">
                        <div class="form-group mt-3 col-12 text-center">
                            <a id="dodajPet" class="btn btn-primary btn-lg shadow">Dodaj čas</a>
                        </div>
                    </div>
                </div>


                <div class="form-row">
                        <div class="form-group mt-3 col-12 text-center">
                            <button type="submit" class="btn btn-outline-primary btn-lg shadow">Sačuvaj</button>
                        </div>
                </div>
                <input class="d-none" id="nevidljiviPon" value="{{$pon}}" name="ponedeljak">
                <input class="d-none" id="nevidljiviUto" value="{{$uto}}" name="utorak">
                <input class="d-none" id="nevidljiviSre" value="{{$sre}}" name="sreda">
                <input class="d-none" id="nevidljiviČet" value="{{$cet}}" name="cetvrtak">
                <input class="d-none" id="nevidljiviPet" value="{{$pet}}" name="petak">
            </form>
        </div>

    </div>
</div>
{{-- <input class="d-none" id="nevidljivSmer">
<input class="d-none" id="nevidljivaGodina"> --}}






<script>

    // function createFormFields(){
    //     let week=['Ponedeljak','Utorak','Sreda','Četvrtak','Petak'];
    //     // SMISLITI KAKO DA SE DODAJU VREDNOSTI U POLJA
    //     for(i=0;i<week.length;i++){

    //             let html = '';
    //             let br = document.getElementById(week[i]).value;
    //             for(j=0;j<br;j++){
    //                 let cas=j+1;
    //                 html+='<div class="form-row p-1 border rounded border-dark shadow bg-light">';
    //                 html+='<h2 class="col-12 text-center p-2">'+week[i]+': '+cas+'. čas</h2><hr>';
    //                 html+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
    //                 html+='<label for="predmet">Predmet</label>';
    //                 html+='<select value="{{ old("predmet") }}" required oninvalid="this.setCustomValidity("Molimo unesite ime predmeta!")" oninput="setCustomValidity("")" class="form-control custom-select @error("predmet") is-invalid @enderror" id="predmet" name="'+week[i]+cas+'[]" placeholder="Unesite predmet">';
    //                 html+='<option value="">Izaberite predmet</option>';
    //                 html+='@foreach($predmeti as $predmet) ';
    //                 html+='<option value="{{$predmet->id}}">{{$predmet->naziv}}</option>';
    //                 html+='@endforeach';
    //                 html+='</select>';
    //                 html+='@error("predmet")';
    //                 html+='<span class="invalid-feedback" role="alert">';
    //                 html+='<strong>{{ $message }}</strong>';
    //                 html+='</span>';
    //                 html+='@enderror';
    //                 html+='</div>';
    //                 html+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
    //                 html+='<label for="vreme">Vreme</label>';
    //                 html+='<input value="{{ old("vreme") }}" required oninvalid="this.setCustomValidity("Molimo unesite vreme!(od-do)")" oninput="setCustomValidity("")" type="text" class="form-control @error("vreme") is-invalid @enderror" id="vreme" name="'+week[i]+cas+'[]" placeholder="Unesite vreme">';
    //                 html+='@error("vreme")<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror';
    //                 html+='</div>';
    //                 html+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
    //                 html+='<label class="font-weight-bold" for="vrsta">Predavanja/vežbe</label>';
    //                 html+='<select class="form-control custom-select mr-sm-2 @error("vrsta") is-invalid @enderror" id="vrsta" name="'+week[i]+cas+'[]" oninvalid="this.setCustomValidity("Molimo izaberite vrstu predavanja!")" oninput="setCustomValidity("")">';
    //                 html+='<option value="">Izaberite vrstu predavanja</option>';
    //                 html+='<option value="Predavanja">Predavanja</option>';
    //                 html+='<option value="Vežbe">Vežbe</option>'
    //                 html+='</select>';
    //                 html+='@error("vrsta")';
    //                 html+='<span class="invalid-feedback" role="alert">'
    //                 html+='<strong>{{ $message }}</strong>';
    //                 html+='</span>';
    //                 html+='@enderror';
    //                 html+='</div>';
    //                 html+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
    //                 html+='<label class="font-weight-bold" for="prostorija">Prostorija</label>';
    //                 html+='<select class="form-control custom-select mr-sm-2 @error("prostorija") is-invalid @enderror" id="prostorija" name="'+week[i]+cas+'[]" oninvalid="this.setCustomValidity("Molimo izaberite prostoriju predavanja!")" oninput="setCustomValidity("")">';
    //                 html+='<option value="">Izaberite prostoriju predavanja</option>';
    //                 html+='<option value="A1">A1</option>';
    //                 html+='<option value="A2">A2</option>';
    //                 html+='<option value="A3">A3</option>';
    //                 html+='</select>';
    //                 html+='@error("prostorija")';
    //                 html+='<span class="invalid-feedback" role="alert">'
    //                 html+='<strong>{{ $message }}</strong>'
    //                 html+='</span>';
    //                 html+='@enderror';
    //                 html+='</div>';
    //                 html+='</div><br>';
    //             }
    //             document.querySelector("."+week[i]).innerHTML=html;

    //         }
    // }

    document.addEventListener('click',event=>{
        switch(event.target.id){
            case 'dodajPon':
                event.preventDefault();
                let cas1=document.getElementById('nevidljiviPon').value;
                cas1=parseInt(cas1)+1;
                let html1='';
                html1+='<div class="form-row p-1 border rounded border-dark shadow bg-light" id="Ponedeljak'+cas1+'">';
                html1+='<h2 class="col-12 text-center p-2" id="Ponedeljak'+cas1+'[]">Ponedeljak: '+cas1+'. čas</h2><hr>';
                html1+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html1+='<label for="predmet">Predmet</label>';
                html1+='<select value="{{ old("predmet") }}" required oninvalid="this.setCustomValidity("Molimo unesite ime predmeta!")" oninput="setCustomValidity("")" class="form-control custom-select @error("predmet") is-invalid @enderror" id="predmet" name="Ponedeljak'+cas1+'[]" placeholder="Unesite predmet">';
                html1+='<option value="">Izaberite predmet</option>';
                html1+='@foreach($predmeti as $predmet) ';
                html1+='<option value="{{$predmet->id}}">{{$predmet->naziv}}</option>';
                html1+='@endforeach';
                html1+='</select>';
                html1+='@error("predmet")';
                html1+='<span class="invalid-feedback" role="alert">';
                html1+='<strong>{{ $message }}</strong>';
                html1+='</span>';
                html1+='@enderror';
                html1+='</div>';
                html1+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html1+='<label for="vreme">Vreme</label>';
                html1+='<input value="{{ old("vreme") }}" required oninvalid="this.setCustomValidity("Molimo unesite vreme!(od-do)")" oninput="setCustomValidity("")" type="text" class="form-control @error("vreme") is-invalid @enderror" id="vreme" name="Ponedeljak'+cas1+'[]" placeholder="Unesite vreme">';
                html1+='@error("vreme")<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror';
                html1+='</div>';
                html1+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html1+='<label class="font-weight-bold" for="vrsta">Predavanja/vežbe</label>';
                html1+='<select class="form-control custom-select mr-sm-2 @error("vrsta") is-invalid @enderror" id="vrsta" name="Ponedeljak'+cas1+'[]" oninvalid="this.setCustomValidity("Molimo izaberite vrstu predavanja!")" oninput="setCustomValidity("")">';
                html1+='<option value="">Izaberite vrstu predavanja</option>';
                html1+='<option value="Predavanja">Predavanja</option>';
                html1+='<option value="Vežbe">Vežbe</option>'
                html1+='</select>';
                html1+='@error("vrsta")';
                html1+='<span class="invalid-feedback" role="alert">'
                html1+='<strong>{{ $message }}</strong>';
                html1+='</span>';
                html1+='@enderror';
                html1+='</div>';
                html1+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html1+='<label class="font-weight-bold" for="prostorija">Prostorija</label>';
                html1+='<select class="form-control custom-select mr-sm-2 @error("prostorija") is-invalid @enderror" id="prostorija" name="Ponedeljak'+cas1+'[]" oninvalid="this.setCustomValidity("Molimo izaberite prostoriju predavanja!")" oninput="setCustomValidity("")">';
                html1+='<option value="">Izaberite prostoriju predavanja</option>';
                html1+='<option value="A1">A1</option>';
                html1+='<option value="A2">A2</option>';
                html1+='<option value="A3">A3</option>';
                html1+='</select>';
                html1+='@error("prostorija")';
                html1+='<span class="invalid-feedback" role="alert">'
                html1+='<strong>{{ $message }}</strong>'
                html1+='</span>';
                html1+='@enderror';
                html1+='</div>';
                html1+='</div><br>';
                if((cas1-1)==0){
                    if(document.getElementById('PonedeljakNP') != null){
                        document.getElementById('PonedeljakNP').remove();
                    }
                    document.querySelector('.Ponedeljak').innerHTML= html1;
                } else {
                    document.querySelector('.Ponedeljak').insertAdjacentHTML('beforeend', html1);

                }
                document.getElementById('nevidljiviPon').setAttribute('value',cas1);
                if((cas1-1)>0){
                    document.getElementById('Ponedeljak'+(cas1-1)+'[]').innerHTML='Ponedeljak: '+(cas1-1)+'. čas';
                }
                let brisanje = '<span class="float-right btn btn-outline-danger" onclick="obrisiCas(\'Ponedeljak'+cas1+'\','+cas1+')"><i class="fas fa-times-circle"></i></span>'
                document.getElementById('Ponedeljak'+cas1+'[]').insertAdjacentHTML('beforeend',brisanje);
                break;
            case 'dodajUto':
                event.preventDefault();
                let cas2=document.getElementById('nevidljiviUto').value;
                cas2=parseInt(cas2)+1;
                let html2='';
                html2+='<div class="form-row p-1 border rounded border-dark shadow bg-light" id="Utorak'+cas2+'">';
                html2+='<h2 class="col-12 text-center p-2" id="Utorak'+cas2+'[]">Utorak: '+cas2+'. čas</h2><hr>';
                html2+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html2+='<label for="predmet">Predmet</label>';
                html2+='<select value="{{ old("predmet") }}" required oninvalid="this.setCustomValidity("Molimo unesite ime predmeta!")" oninput="setCustomValidity("")" class="form-control custom-select @error("predmet") is-invalid @enderror" id="predmet" name="Utorak'+cas2+'[]" placeholder="Unesite predmet">';
                html2+='<option value="">Izaberite predmet</option>';
                html2+='@foreach($predmeti as $predmet) ';
                html2+='<option value="{{$predmet->id}}">{{$predmet->naziv}}</option>';
                html2+='@endforeach';
                html2+='</select>';
                html2+='@error("predmet")';
                html2+='<span class="invalid-feedback" role="alert">';
                html2+='<strong>{{ $message }}</strong>';
                html2+='</span>';
                html2+='@enderror';
                html2+='</div>';
                html2+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html2+='<label for="vreme">Vreme</label>';
                html2+='<input value="{{ old("vreme") }}" required oninvalid="this.setCustomValidity("Molimo unesite vreme!(od-do)")" oninput="setCustomValidity("")" type="text" class="form-control @error("vreme") is-invalid @enderror" id="vreme" name="Utorak'+cas2+'[]" placeholder="Unesite vreme">';
                html2+='@error("vreme")<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror';
                html2+='</div>';
                html2+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html2+='<label class="font-weight-bold" for="vrsta">Predavanja/vežbe</label>';
                html2+='<select class="form-control custom-select mr-sm-2 @error("vrsta") is-invalid @enderror" id="vrsta" name="Utorak'+cas2+'[]" oninvalid="this.setCustomValidity("Molimo izaberite vrstu predavanja!")" oninput="setCustomValidity("")">';
                html2+='<option value="">Izaberite vrstu predavanja</option>';
                html2+='<option value="Predavanja">Predavanja</option>';
                html2+='<option value="Vežbe">Vežbe</option>'
                html2+='</select>';
                html2+='@error("vrsta")';
                html2+='<span class="invalid-feedback" role="alert">'
                html2+='<strong>{{ $message }}</strong>';
                html2+='</span>';
                html2+='@enderror';
                html2+='</div>';
                html2+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html2+='<label class="font-weight-bold" for="prostorija">Prostorija</label>';
                html2+='<select class="form-control custom-select mr-sm-2 @error("prostorija") is-invalid @enderror" id="prostorija" name="Utorak'+cas2+'[]" oninvalid="this.setCustomValidity("Molimo izaberite prostoriju predavanja!")" oninput="setCustomValidity("")">';
                html2+='<option value="">Izaberite prostoriju predavanja</option>';
                html2+='<option value="A1">A1</option>';
                html2+='<option value="A2">A2</option>';
                html2+='<option value="A3">A3</option>';
                html2+='</select>';
                html2+='@error("prostorija")';
                html2+='<span class="invalid-feedback" role="alert">'
                html2+='<strong>{{ $message }}</strong>'
                html2+='</span>';
                html2+='@enderror';
                html2+='</div>';
                html2+='</div><br>';
                if((cas2-1)==0){
                    if(document.getElementById('UtorakNP') != null){
                        document.getElementById('UtorakNP').remove();
                    }
                    document.querySelector('.Utorak').innerHTML= html2;
                } else {
                    document.querySelector('.Utorak').insertAdjacentHTML('beforeend', html2);

                }
                document.getElementById('nevidljiviUto').setAttribute('value',cas2);
                if((cas2-1)>0){
                    document.getElementById('Utorak'+(cas2-1)+'[]').innerHTML='Utorak: '+(cas2-1)+'. čas';
                }
                let brisanje2 = '<span class="float-right btn btn-outline-danger" onclick="obrisiCas(\'Utorak'+cas2+'\','+cas2+')"><i class="fas fa-times-circle"></i></span>'
                document.getElementById('Utorak'+cas2+'[]').insertAdjacentHTML('beforeend',brisanje2);
                break;
            case 'dodajSre':
                event.preventDefault();
                let cas3=document.getElementById('nevidljiviSre').value;
                cas3=parseInt(cas3)+1;
                let html3='';
                html3+='<div class="form-row p-1 border rounded border-dark shadow bg-light" id="Sreda'+cas3+'">';
                html3+='<h2 class="col-12 text-center p-2" id="Sreda'+cas3+'[]">Sreda: '+cas3+'. čas</h2><hr>';
                html3+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html3+='<label for="predmet">Predmet</label>';
                html3+='<select value="{{ old("predmet") }}" required oninvalid="this.setCustomValidity("Molimo unesite ime predmeta!")" oninput="setCustomValidity("")" class="form-control custom-select @error("predmet") is-invalid @enderror" id="predmet" name="Sreda'+cas3+'[]" placeholder="Unesite predmet">';
                html3+='<option value="">Izaberite predmet</option>';
                html3+='@foreach($predmeti as $predmet) ';
                html3+='<option value="{{$predmet->id}}">{{$predmet->naziv}}</option>';
                html3+='@endforeach';
                html3+='</select>';
                html3+='@error("predmet")';
                html3+='<span class="invalid-feedback" role="alert">';
                html3+='<strong>{{ $message }}</strong>';
                html3+='</span>';
                html3+='@enderror';
                html3+='</div>';
                html3+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html3+='<label for="vreme">Vreme</label>';
                html3+='<input value="{{ old("vreme") }}" required oninvalid="this.setCustomValidity("Molimo unesite vreme!(od-do)")" oninput="setCustomValidity("")" type="text" class="form-control @error("vreme") is-invalid @enderror" id="vreme" name="Sreda'+cas3+'[]" placeholder="Unesite vreme">';
                html3+='@error("vreme")<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror';
                html3+='</div>';
                html3+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html3+='<label class="font-weight-bold" for="vrsta">Predavanja/vežbe</label>';
                html3+='<select class="form-control custom-select mr-sm-2 @error("vrsta") is-invalid @enderror" id="vrsta" name="Sreda'+cas3+'[]" oninvalid="this.setCustomValidity("Molimo izaberite vrstu predavanja!")" oninput="setCustomValidity("")">';
                html3+='<option value="">Izaberite vrstu predavanja</option>';
                html3+='<option value="Predavanja">Predavanja</option>';
                html3+='<option value="Vežbe">Vežbe</option>'
                html3+='</select>';
                html3+='@error("vrsta")';
                html3+='<span class="invalid-feedback" role="alert">'
                html3+='<strong>{{ $message }}</strong>';
                html3+='</span>';
                html3+='@enderror';
                html3+='</div>';
                html3+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html3+='<label class="font-weight-bold" for="prostorija">Prostorija</label>';
                html3+='<select class="form-control custom-select mr-sm-2 @error("prostorija") is-invalid @enderror" id="prostorija" name="Sreda'+cas3+'[]" oninvalid="this.setCustomValidity("Molimo izaberite prostoriju predavanja!")" oninput="setCustomValidity("")">';
                html3+='<option value="">Izaberite prostoriju predavanja</option>';
                html3+='<option value="A1">A1</option>';
                html3+='<option value="A2">A2</option>';
                html3+='<option value="A3">A3</option>';
                html3+='</select>';
                html3+='@error("prostorija")';
                html3+='<span class="invalid-feedback" role="alert">'
                html3+='<strong>{{ $message }}</strong>'
                html3+='</span>';
                html3+='@enderror';
                html3+='</div>';
                html3+='</div><br>';
                if((cas3-1)==0){
                    if(document.getElementById('SredaNP') != null){
                        document.getElementById('SredaNP').remove();
                    }
                    document.querySelector('.Sreda').innerHTML= html3;
                } else {
                    document.querySelector('.Sreda').insertAdjacentHTML('beforeend', html3);

                }
                document.getElementById('nevidljiviSre').setAttribute('value',cas3);
                if((cas3-1)>0){
                    document.getElementById('Sreda'+(cas3-1)+'[]').innerHTML='Sreda: '+(cas3-1)+'. čas';
                }
                let brisanje3 = '<span class="float-right btn btn-outline-danger" onclick="obrisiCas(\'Sreda'+cas3+'\','+cas3+')"><i class="fas fa-times-circle"></i></span>'
                document.getElementById('Sreda'+cas3+'[]').insertAdjacentHTML('beforeend',brisanje3);
                break;
            case 'dodajČet':
                event.preventDefault();
                let cas6=document.getElementById('nevidljiviČet').value;
                cas6=parseInt(cas6)+1;
                let html6='';
                html6+='<div class="form-row p-1 border rounded border-dark shadow bg-light" id="Četvrtak'+cas6+'">';
                html6+='<h2 class="col-12 text-center p-2" id="Četvrtak'+cas6+'[]">Četvrtak: '+cas6+'. čas</h2><hr>';
                html6+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html6+='<label for="predmet">Predmet</label>';
                html6+='<select value="{{ old("predmet") }}" required oninvalid="this.setCustomValidity("Molimo unesite ime predmeta!")" oninput="setCustomValidity("")" class="form-control custom-select @error("predmet") is-invalid @enderror" id="predmet" name="Cetvrtak'+cas6+'[]" placeholder="Unesite predmet">';
                html6+='<option value="">Izaberite predmet</option>';
                html6+='@foreach($predmeti as $predmet) ';
                html6+='<option value="{{$predmet->id}}">{{$predmet->naziv}}</option>';
                html6+='@endforeach';
                html6+='</select>';
                html6+='@error("predmet")';
                html6+='<span class="invalid-feedback" role="alert">';
                html6+='<strong>{{ $message }}</strong>';
                html6+='</span>';
                html6+='@enderror';
                html6+='</div>';
                html6+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html6+='<label for="vreme">Vreme</label>';
                html6+='<input value="{{ old("vreme") }}" required oninvalid="this.setCustomValidity("Molimo unesite vreme!(od-do)")" oninput="setCustomValidity("")" type="text" class="form-control @error("vreme") is-invalid @enderror" id="vreme" name="Cetvrtak'+cas6+'[]" placeholder="Unesite vreme">';
                html6+='@error("vreme")<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror';
                html6+='</div>';
                html6+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html6+='<label class="font-weight-bold" for="vrsta">Predavanja/vežbe</label>';
                html6+='<select class="form-control custom-select mr-sm-2 @error("vrsta") is-invalid @enderror" id="vrsta" name="Cetvrtak'+cas6+'[]" oninvalid="this.setCustomValidity("Molimo izaberite vrstu predavanja!")" oninput="setCustomValidity("")">';
                html6+='<option value="">Izaberite vrstu predavanja</option>';
                html6+='<option value="Predavanja">Predavanja</option>';
                html6+='<option value="Vežbe">Vežbe</option>'
                html6+='</select>';
                html6+='@error("vrsta")';
                html6+='<span class="invalid-feedback" role="alert">'
                html6+='<strong>{{ $message }}</strong>';
                html6+='</span>';
                html6+='@enderror';
                html6+='</div>';
                html6+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html6+='<label class="font-weight-bold" for="prostorija">Prostorija</label>';
                html6+='<select class="form-control custom-select mr-sm-2 @error("prostorija") is-invalid @enderror" id="prostorija" name="Cetvrtak'+cas6+'[]" oninvalid="this.setCustomValidity("Molimo izaberite prostoriju predavanja!")" oninput="setCustomValidity("")">';
                html6+='<option value="">Izaberite prostoriju predavanja</option>';
                html6+='<option value="A1">A1</option>';
                html6+='<option value="A2">A2</option>';
                html6+='<option value="A3">A3</option>';
                html6+='</select>';
                html6+='@error("prostorija")';
                html6+='<span class="invalid-feedback" role="alert">'
                html6+='<strong>{{ $message }}</strong>'
                html6+='</span>';
                html6+='@enderror';
                html6+='</div>';
                html6+='</div><br>';
                if((cas6-1)==0){
                    if(document.getElementById('ČetvrtakNP') != null){
                        document.getElementById('ČetvrtakNP').remove();
                    }
                    document.querySelector('.Četvrtak').innerHTML= html6;
                } else {
                    document.querySelector('.Četvrtak').insertAdjacentHTML('beforeend', html6);

                }
                document.getElementById('nevidljiviČet').setAttribute('value',cas6);
                if((cas6-1)>0){
                    document.getElementById('Četvrtak'+(cas6-1)+'[]').innerHTML='Četvrtak: '+(cas6-1)+'. čas';
                }
                let brisanje4 = '<span class="float-right btn btn-outline-danger" onclick="obrisiCas(\'Četvrtak'+cas6+'\','+cas6+')"><i class="fas fa-times-circle"></i></span>'
                document.getElementById('Četvrtak'+cas6+'[]').insertAdjacentHTML('beforeend',brisanje4);
                break;
            case 'dodajPet':
                event.preventDefault();
                let cas7=document.getElementById('nevidljiviPet').value;
                cas7=parseInt(cas7)+1;
                let html7='';
                html7+='<div class="form-row p-1 border rounded border-dark shadow bg-light" id="Petak'+cas7+'">';
                html7+='<h2 class="col-12 text-center p-2" id="Petak'+cas7+'[]">Petak: '+cas7+'. čas</h2><hr>';
                html7+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html7+='<label for="predmet">Predmet</label>';
                html7+='<select value="{{ old("predmet") }}" required oninvalid="this.setCustomValidity("Molimo unesite ime predmeta!")" oninput="setCustomValidity("")" class="form-control custom-select @error("predmet") is-invalid @enderror" id="predmet" name="Petak'+cas7+'[]" placeholder="Unesite predmet">';
                html7+='<option value="">Izaberite predmet</option>';
                html7+='@foreach($predmeti as $predmet) ';
                html7+='<option value="{{$predmet->id}}">{{$predmet->naziv}}</option>';
                html7+='@endforeach';
                html7+='</select>';
                html7+='@error("predmet")';
                html7+='<span class="invalid-feedback" role="alert">';
                html7+='<strong>{{ $message }}</strong>';
                html7+='</span>';
                html7+='@enderror';
                html7+='</div>';
                html7+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html7+='<label for="vreme">Vreme</label>';
                html7+='<input value="{{ old("vreme") }}" required oninvalid="this.setCustomValidity("Molimo unesite vreme!(od-do)")" oninput="setCustomValidity("")" type="text" class="form-control @error("vreme") is-invalid @enderror" id="vreme" name="Petak'+cas7+'[]" placeholder="Unesite vreme">';
                html7+='@error("vreme")<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror';
                html7+='</div>';
                html7+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html7+='<label class="font-weight-bold" for="vrsta">Predavanja/vežbe</label>';
                html7+='<select class="form-control custom-select mr-sm-2 @error("vrsta") is-invalid @enderror" id="vrsta" name="Petak'+cas7+'[]" oninvalid="this.setCustomValidity("Molimo izaberite vrstu predavanja!")" oninput="setCustomValidity("")">';
                html7+='<option value="">Izaberite vrstu predavanja</option>';
                html7+='<option value="Predavanja">Predavanja</option>';
                html7+='<option value="Vežbe">Vežbe</option>'
                html7+='</select>';
                html7+='@error("vrsta")';
                html7+='<span class="invalid-feedback" role="alert">'
                html7+='<strong>{{ $message }}</strong>';
                html7+='</span>';
                html7+='@enderror';
                html7+='</div>';
                html7+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                html7+='<label class="font-weight-bold" for="prostorija">Prostorija</label>';
                html7+='<select class="form-control custom-select mr-sm-2 @error("prostorija") is-invalid @enderror" id="prostorija" name="Petak'+cas7+'[]" oninvalid="this.setCustomValidity("Molimo izaberite prostoriju predavanja!")" oninput="setCustomValidity("")">';
                html7+='<option value="">Izaberite prostoriju predavanja</option>';
                html7+='<option value="A1">A1</option>';
                html7+='<option value="A2">A2</option>';
                html7+='<option value="A3">A3</option>';
                html7+='</select>';
                html7+='@error("prostorija")';
                html7+='<span class="invalid-feedback" role="alert">'
                html7+='<strong>{{ $message }}</strong>'
                html7+='</span>';
                html7+='@enderror';
                html7+='</div>';
                html7+='</div><br>';
                if((cas7-1)==0){
                    if(document.getElementById('PetakNP') != null){
                        document.getElementById('PetakNP').remove();
                    }
                    document.querySelector('.Petak').innerHTML= html7;
                } else {
                    document.querySelector('.Petak').insertAdjacentHTML('beforeend', html7);

                }
                document.getElementById('nevidljiviPet').setAttribute('value',cas7);
                if((cas7-1)>0){
                    document.getElementById('Petak'+(cas7-1)+'[]').innerHTML='Petak: '+(cas7-1)+'. čas';
                }
                let brisanje5 = '<span class="float-right btn btn-outline-danger" onclick="obrisiCas(\'Petak'+cas7+'\','+cas7+')"><i class="fas fa-times-circle"></i></span>'
                document.getElementById('Petak'+cas7+'[]').insertAdjacentHTML('beforeend',brisanje5);
                break;
            default:
                break;
        }
    });

    function obrisiCas(id,br){
        let week = ['Ponedeljak','Utorak','Sreda','Četvrtak','Petak'];
        week.forEach(element => {
            if(id.includes(element)){
                let br1=br-1;
                if(br!=1){
                    document.getElementById('nevidljivi'+element.substr(0,3)).setAttribute('value',br1);
                    let brisanje = '<span class="float-right btn btn-outline-danger" onclick="obrisiCas(\''+element+br1+'\','+br1+')"><i class="fas fa-times-circle"></i></span>'
                    document.getElementById(element+br1+'[]').insertAdjacentHTML('beforeend',brisanje);
                    document.getElementById(id).remove();
                } else {
                    document.getElementById(id).remove();
                    document.getElementById('nevidljivi'+element.substr(0,3)).setAttribute('value','0');
                    document.querySelector('.'+element).insertAdjacentHTML('afterbegin','<h2 class="text-center border p-2 rounded bg-light">Nema predavanja</h2>');

                }

            }
        });


    }

//
</script>

@endsection
