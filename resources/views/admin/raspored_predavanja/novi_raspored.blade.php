@extends('layouts.app')
@section('title','Novi raspored')


@section('content')

<div class="container" onload="createFormFields()">

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
            <h1 class="font-weight-bold pt-2" style="text-shadow: 2px 2px lightgray">Novi raspored</h1>
        </div>
        <div class="card-body text-center font-weight-bold">
            <form action={{ route('novi_raspored') }} method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-lg-6 col-md-6 col-sm-12 ">
                        <label class="font-weight-bold" for="smer">Smer</label>
                        <select class="form-control custom-select mr-sm-2 @error('smer') is-invalid @enderror" id="smer"
                            name="smer" oninvalid="this.setCustomValidity('Molimo izaberite smer!')"
                            oninput="setCustomValidity('')">
                        <option value="">Izaberite smer</option>
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


                    <div class="form-group col-lg-6 col-md-6 col-sm-12 ">
                        <label class="font-weight-bold" for="godina_studija">Godina</label>
                        <select class="form-control custom-select mr-sm-2 @error('godina_studija') is-invalid @enderror" id="godina_studija"
                            name="godina_studija" oninvalid="this.setCustomValidity('Molimo izaberite godinu studija!')"
                            oninput="setCustomValidity('')">
                        <option value="">Izaberite godinu studija</option>
                        @for($i=1;$i<=3;$i++)
                        <option value="{{$i}}">{{$i}}.</option>
                        @endfor
                        </select>
                        @error('godina_studija')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="border border-secondary mb-3 bg-info shadow rounded p-3">

                    <div class="col-12 col-sm-8 offset-sm-2">
                        <div class="form-row">
                            <h2 class="m-auto font-weight-bold">Ponedeljak</h2>
                            <div class="input-group mb-3 text-center">
                                <div class="input-group-prepend">
                                <label class="input-group-text" for="Ponedeljak">Izaberite</label>
                                </div>
                                <select name="ponedeljak" class="custom-select shadow" id="Ponedeljak">
                                <option value="0">Broj predavanja</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="Ponedeljak"></div>
                </div>
                <div class="border border-secondary mb-3 bg-info shadow rounded p-3">
                    <div class="col-12 col-sm-8 offset-sm-2">
                        <div class="form-row">
                            <h2 class="m-auto font-weight-bold">Utorak</h2>
                            <div class="input-group mb-3 text-center">
                                <div class="input-group-prepend">
                                <label class="input-group-text" for="Utorak">Izaberite</label>
                                </div>
                                <select name="utorak" class="custom-select shadow" id="Utorak">
                                <option value="0" selected>Broj predavanja</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="Utorak"></div>
                </div>
                <div class="border border-secondary mb-3 bg-info shadow rounded p-3">
                    <div class="col-12 col-sm-8 offset-sm-2">
                        <div class="form-row">
                            <h2 class="m-auto font-weight-bold">Sreda</h2>
                            <div class="input-group mb-3 text-center">
                                <div class="input-group-prepend">
                                <label class="input-group-text" for="Sreda">Izaberite</label>
                                </div>
                                <select name="sreda" class="custom-select shadow" id="Sreda">
                                <option value="0" selected>Broj predavanja</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="Sreda"></div>
                </div>
                <div class="border border-secondary mb-3 bg-info shadow rounded p-3">
                    <div class="col-12 col-sm-8 offset-sm-2">
                        <div class="form-row">
                            <h2 class="m-auto font-weight-bold">Četvrtak</h2>
                            <div class="input-group mb-3 text-center">
                                <div class="input-group-prepend">
                                <label class="input-group-text" for="Četvrtak">Izaberite</label>
                                </div>
                                <select name="cetvrtak" class="custom-select shadow" id="Četvrtak">
                                <option value="0" selected>Broj predavanja</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="Četvrtak"></div>
                </div>
                <div class="border border-secondary mb-3 bg-info shadow rounded p-3">
                    <div class="col-12 col-sm-8 offset-sm-2">
                        <div class="form-row">
                            <h2 class="m-auto font-weight-bold">Petak</h2>
                            <div class="input-group mb-3 text-center">
                                <div class="input-group-prepend">
                                <label class="input-group-text" for="Petak">Izaberite</label>
                                </div>
                                <select name="petak" class="custom-select shadow" id="Petak">
                                <option value="0" selected>Broj predavanja</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="Petak"></div>
                </div>


                <div class="form-row">
                        <div class="form-group mt-3 col-12 text-center">
                            <button type="submit" class="btn btn-outline-primary btn-lg shadow">Sačuvaj</button>
                        </div>
                </div>
            </form>
        </div>

    </div>
</div>
<input class="d-none nevidljivSmer">
<input class="d-none" id="nevidljivaGodina" value="1">



<script>

    function createFormFields(){
        let week=['Ponedeljak','Utorak','Sreda','Četvrtak','Petak'];

        for(i=0;i<week.length;i++){

                let html = '';
                let br = document.getElementById(week[i]).value;
                for(j=0;j<br;j++){
                    let cas=j+1;
                    html+='<div class="form-row p-1 border rounded border-dark shadow bg-light">';
                    html+='<h2 class="col-12 text-center p-2">'+week[i]+': '+cas+'. čas</h2><hr>';
                    html+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                    html+='<label for="predmet">Predmet</label>';
                    html+='<select value="{{ old("predmet") }}" required oninvalid="this.setCustomValidity("Molimo unesite ime predmeta!")" oninput="setCustomValidity("")" class="form-control custom-select @error("predmet") is-invalid @enderror" id="predmet" name="'+week[i]+cas+'[]" placeholder="Unesite predmet">';
                    html+='<option value="">Izaberite predmet</option>';
                    html+='@foreach($predmeti as $predmet) ';
                    html+='<option value="{{$predmet->id}}">{{$predmet->naziv}}</option>';
                    html+='@endforeach';
                    html+='</select>';
                    html+='@error("predmet")';
                    html+='<span class="invalid-feedback" role="alert">';
                    html+='<strong>{{ $message }}</strong>';
                    html+='</span>';
                    html+='@enderror';
                    html+='</div>';
                    html+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                    html+='<label for="vreme">Vreme</label>';
                    html+='<input value="{{ old("vreme") }}" required oninvalid="this.setCustomValidity("Molimo unesite vreme!(od-do)")" oninput="setCustomValidity("")" type="text" class="form-control @error("vreme") is-invalid @enderror" id="vreme" name="'+week[i]+cas+'[]" placeholder="Unesite vreme">';
                    html+='@error("vreme")<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror';
                    html+='</div>';
                    html+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                    html+='<label class="font-weight-bold" for="vrsta">Predavanja/vežbe</label>';
                    html+='<select class="form-control custom-select mr-sm-2 @error("vrsta") is-invalid @enderror" id="vrsta" name="'+week[i]+cas+'[]" oninvalid="this.setCustomValidity("Molimo izaberite vrstu predavanja!")" oninput="setCustomValidity("")">';
                    html+='<option value="">Izaberite vrstu predavanja</option>';
                    html+='<option value="Predavanja">Predavanja</option>';
                    html+='<option value="Vežbe">Vežbe</option>'
                    html+='</select>';
                    html+='@error("vrsta")';
                    html+='<span class="invalid-feedback" role="alert">'
                    html+='<strong>{{ $message }}</strong>';
                    html+='</span>';
                    html+='@enderror';
                    html+='</div>';
                    html+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                    html+='<label class="font-weight-bold" for="prostorija">Prostorija</label>';
                    html+='<select class="form-control custom-select mr-sm-2 @error("prostorija") is-invalid @enderror" id="prostorija" name="'+week[i]+cas+'[]" oninvalid="this.setCustomValidity("Molimo izaberite prostoriju predavanja!")" oninput="setCustomValidity("")">';
                    html+='<option value="">Izaberite prostoriju predavanja</option>';
                    html+='<option value="A1">A1</option>';
                    html+='<option value="A2">A2</option>';
                    html+='<option value="A3">A3</option>';
                    html+='</select>';
                    html+='@error("prostorija")';
                    html+='<span class="invalid-feedback" role="alert">'
                    html+='<strong>{{ $message }}</strong>'
                    html+='</span>';
                    html+='@enderror';
                    html+='</div>';
                    html+='</div><br>';
                }
                document.querySelector("."+week[i]).innerHTML=html;

            }
    }


    document.addEventListener('input', function (event) {

        let week=['Ponedeljak','Utorak','Sreda','Četvrtak','Petak'];

        for(i=0;i<week.length;i++){
            if(event.target.id==week[i]){
                // let smer1=document.getElementById('smer').value;
                // console.log(smer1);
                // let godina1=document.getElementById('godina_studija').value;
                // console.log(godina1);

                let html = '';
                let br = event.target.value;
                for(j=0;j<br;j++){
                    let cas=j+1;
                    html+='<div class="form-row p-1 border rounded border-dark shadow bg-light">';
                    html+='<h2 class="col-12 text-center p-2">'+week[i]+': '+cas+'. čas</h2><hr>';
                    html+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                    html+='<label for="predmet">Predmet</label>';
                    html+='<select value="{{ old("predmet") }}" required oninvalid="this.setCustomValidity("Molimo unesite ime predmeta!")" oninput="setCustomValidity("")" class="form-control custom-select @error("predmet") is-invalid @enderror" id="predmet" name="'+week[i]+cas+'[]" placeholder="Unesite predmet">';
                    html+='<option value="">Izaberite predmet</option>';
                    html+='@foreach($predmeti as $predmet) ';
                    html+='<option value="{{$predmet->id}}">{{$predmet->naziv}}</option>';
                    html+='@endforeach';
                    html+='</select>';
                    html+='@error("predmet")';
                    html+='<span class="invalid-feedback" role="alert">';
                    html+='<strong>{{ $message }}</strong>';
                    html+='</span>';
                    html+='@enderror';
                    html+='</div>';
                    html+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                    html+='<label for="vreme">Vreme</label>';
                    html+='<input value="{{ old("vreme") }}" required oninvalid="this.setCustomValidity("Molimo unesite vreme!(od-do)")" oninput="setCustomValidity("")" type="text" class="form-control @error("vreme") is-invalid @enderror" id="vreme" name="'+week[i]+cas+'[]" placeholder="Unesite vreme">';
                    html+='@error("vreme")<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror';
                    html+='</div>';
                    html+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                    html+='<label class="font-weight-bold" for="vrsta">Predavanja/vežbe</label>';
                    html+='<select class="form-control custom-select mr-sm-2 @error("vrsta") is-invalid @enderror" id="vrsta" name="'+week[i]+cas+'[]" oninvalid="this.setCustomValidity("Molimo izaberite vrstu predavanja!")" oninput="setCustomValidity("")">';
                    html+='<option value="">Izaberite vrstu predavanja</option>';
                    html+='<option value="Predavanja">Predavanja</option>';
                    html+='<option value="Vežbe">Vežbe</option>'
                    html+='</select>';
                    html+='@error("vrsta")';
                    html+='<span class="invalid-feedback" role="alert">'
                    html+='<strong>{{ $message }}</strong>';
                    html+='</span>';
                    html+='@enderror';
                    html+='</div>';
                    html+='<div class="form-group col-lg-3 col-md-3 col-sm-12 ">';
                    html+='<label class="font-weight-bold" for="prostorija">Prostorija</label>';
                    html+='<select class="form-control custom-select mr-sm-2 @error("prostorija") is-invalid @enderror" id="prostorija" name="'+week[i]+cas+'[]" oninvalid="this.setCustomValidity("Molimo izaberite prostoriju predavanja!")" oninput="setCustomValidity("")">';
                    html+='<option value="">Izaberite prostoriju predavanja</option>';
                    html+='<option value="A1">A1</option>';
                    html+='<option value="A2">A2</option>';
                    html+='<option value="A3">A3</option>';
                    html+='</select>';
                    html+='@error("prostorija")';
                    html+='<span class="invalid-feedback" role="alert">'
                    html+='<strong>{{ $message }}</strong>'
                    html+='</span>';
                    html+='@enderror';
                    html+='</div>';
                    html+='</div><br>';
                }
                document.querySelector("."+week[i]).innerHTML=html;

            }
        }
});
</script>

@endsection
