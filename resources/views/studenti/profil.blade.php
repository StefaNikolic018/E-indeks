{{-- @foreach($studenti as $student)
@if($student->email == Auth::user()->email) --}}
@section('title',$student->ime)
@extends('layouts.app')

@section('content')


<div class="container">
    {{-- ALERT MESSAGES START --}}
    @if(session('student'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-xs-12'>
            <div class="alert alert-{{session('student')[0]}} shadow">{!! session('student')[1] !!}</div>
        </div>
    </div>
    @endif
    @error('student_predmet')
    <div class="row justify-content-center">
        <div class='col-lg-6 col-xs-12'>
            <div class="alert alert-danger shadow">
                {{ $message}}
            </div>
        </div>
    </div>
    @enderror
    @if(url()->previous()==url('/login'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-md-6  col-sm-12'>
            <div class="alert alert-success shadow" id="welcome">Dobrodošli {{ Auth::user()->ime }}!</div>
        </div>
    </div>
    @endif
    {{-- ALERT MESSAGES END --}}

    {{-- STUDENT INFO START --}}
    <div class="row justify-content-center">
        <div class='col-xs-12 col-sm-6 my-2'>
            <div class="card border border-dark shadow-lg">
                <div class="card-header">
                    <h5>
                        <span class="badge badge-pill badge-primary shadow" data-toggle="tooltip" data-placement="top"
                            title="<b>GODINA STUDIJA</b>" data-html="true">
                            {{$student->godina_studija}}.
                        </span>

                        <span data-toggle="tooltip" data-placement="top" title="<b>PROSEK OCENA</b>" data-html="true"
                            class="badge badge-pill shadow
                            @if($student->prosek_ocena < 7.00)
                                {{' badge-danger'}}
                            @elseif($student->prosek_ocena >=7.00 && $student->prosek_ocena<=8.50)
                                {{' badge-warning'}}
                            @elseif($student->prosek_ocena > 8.50)
                                {{' badge-success'}}
                            @endif
                            ">{{$student->prosek_ocena}}
                        </span>
                        <span class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                            title="<b>UKUPNO ESPB</b>" data-html="true">
                            {{$student->espb}}
                        </span>

                        <span class="float-right badge badge-pill badge-info shadow mt-1 text-wrap" data-toggle="tooltip"
                            data-placement="top" title="<b>Smer studija</b>" data-html="true">
                            {{$student->smers->naziv}}
                        </span>


                    </h2>


                </div>
                <table class="table table-hover table-responsive-lg table-striped table-bordered" id="studenti">
                    <tbody>
                        <tr>
                            <th class="ml-3">Ime</th>
                            <td>{{$student->ime}}</td>



                        </tr>
                        <tr>
                            <th>Ime roditelja</th>
                            <td>{{$student->ime_roditelja}}</td>
                        </tr>
                        <tr>
                            <th>Prezime</th>
                            <td>{{$student->prezime}}</td>

                        </tr>

                        <tr>
                            <th>Broj Indeksa</th>
                            <td>{{$student->broj_indeksa}}</td>


                        </tr>
                        <tr>
                            <th>Broj telefona</th>
                            <td>0{{$student->broj_telefona}}</td>

                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{$student->email}}</td>


                        </tr>
                        <tr>
                            <th>Datum Rodjenja</th>
                            <td>{{$student->datum_rodjenja}}</td>
                        </tr>
                        <tr>
                            <th>JMBG</th>
                            <td>{{$student->jmbg}}</td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- OBAVESTENJA START --}}
        <div class='col-xs-12 col-sm-6 my-2 '>
            <div class="card rounded-lg bg-gradient-light border border-dark shadow-lg" style="max-height:453.050px;">
                <div class="card-header text-center">
                    <h3 class="font-weight-bold pt-2" style="text-shadow: 2px 2px 4px lightgray">Obaveštenja</h3>
                </div>
                <div class="card-body pb-5" style="overflow-y:scroll;">
                    @if(!empty($obavestenja))
                        @foreach($obavestenja as $obavestenje)
                        <div class="card rounded-lg bg-gradient-light border @if($obavestenje->datum==date("Y-m-d")) border-primary @else border-dark @endif shadow-lg">
                            <div class="card-header text-center p-0 pt-1">
                                <h5 class="font-weight-bold">{{$obavestenje->naslov}}</h5>
                            </div>
                            <div class="card-body border @if($obavestenje->datum==date("Y-m-d")) border-info @else border-dark @endif" style="overflow-y:scroll;">
                                {{$obavestenje->obavestenje}}
                            </div>
                            <div class="card-footer p-2">
                                <h6>
                                <span class="float-left">{{$obavestenje->datum}}</span>
                                <span class="float-right">
                                    @switch($obavestenje->potpis)
                                        @case('admin')
                                            Profesor
                                            @break
                                        @default
                                            Administrator
                                    @endswitch
                                </span>
                                </h6>
                            </div>
                        </div>
                        <br>
                        @endforeach
                    @else
                        <h3 class="text-center m-auto p-3 border border-dark rounded">Nema obaveštenja</h3>
                    @endif
                </div>
                <div class="card-footer p-2">
                    {{-- TREBA IZBROJATI OBAVESTENJA --}}
                    <h3>
                    <span class="badge badge-secondary shadow-lg float-left" data-toggle="tooltip" data-placement="top"
                            title="<b>UKUPNO OBAVEŠTENJA</b>" data-html="true">
                            {{count($obavestenja)}}
                    </span>
                    <span class="badge badge-primary shadow-lg float-right" data-toggle="tooltip" data-placement="top"
                            title="<b>NOVA OBAVEŠTENJA</b>" data-html="true">
                            {{count($obavestenja->where('datum',date('Y-m-d')))}}
                    </span>
                    </h3>

                </div>
            </div>
        </div>
        {{-- OBAVESTENJA END --}}
    </div>
    {{-- STUDENT INFO END --}}
    <br>


    {{-- COLLAPSE FOR SUBJECTS START --}}
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card-header border border-white bg-dark py-2">
                <h4 class="text-center font-weight-bold pt-1 text-light" style="text-shadow: 2px 2px 4px black">Spisak ocena
                    po godini
                </h4>
            </div>
            <div class="card border-dark shadow-lg">
                <div class="card-header pt-3">
                    <p class="text-center justify-content-around">
                        <a class="btn btn-outline-primary font-weight-bold shadow mt-1" data-toggle="collapse"
                            href="#multiCollapseExample1" role="button" aria-expanded="false"
                            aria-controls="multiCollapseExample1" style="width:138.512px; text-shadow: 1px 1px black">I godina <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>BROJ OCENA</b>" data-html="true">
                                @php
                                $i=0;

                                foreach ($predmeti as $predmet){
                                foreach ($ocene as $ocena){
                                if ($predmet->id==$ocena->predmet_id && $student->id==$ocena->student_id){
                                if($predmet->godina_studija == 1){
                                $i++;

                                }
                                }
                                }
                                }
                                echo $i;
                                @endphp
                            </span></a>
                        <button class="btn btn-primary border border-dark rounded font-weight-bold shadow mt-1" type="button"
                            data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false"
                            aria-controls="multiCollapseExample2" style="width:138.512px; text-shadow: 1px 1px 4px black">II godina <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>BROJ OCENA</b>" data-html="true">
                                @php
                                $i=0;

                                foreach ($predmeti as $predmet){
                                foreach ($ocene as $ocena){
                                if ($predmet->id==$ocena->predmet_id && $student->id==$ocena->student_id){
                                if($predmet->godina_studija == 2){
                                $i++;

                                }
                                }
                                }
                                }
                                echo $i;
                                @endphp
                            </span></button>
                        <button class="btn btn-info border border-dark rounded font-weight-bold shadow mt-1" type="button" data-toggle="collapse"
                            data-target="#multiCollapseExample3" aria-expanded="false"
                            aria-controls="multiCollapseExample2" style="width:138.512px; text-shadow: 1px 1px 4px gray">III godina <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>BROJ OCENA</b>" data-html="true">
                                @php
                                $i=0;

                                foreach ($predmeti as $predmet){
                                foreach ($ocene as $ocena){
                                if ($predmet->id==$ocena->predmet_id && $student->id==$ocena->student_id){
                                if($predmet->godina_studija == 3){
                                $i++;

                                }
                                }
                                }
                                }
                                echo $i;
                                @endphp
                            </span></button>
                        <button class="btn btn-dark font-weight-bold shadow mt-1" type="button" data-toggle="collapse"
                            data-target="#multiCollapseExample4" aria-expanded="false"
                            aria-controls="multiCollapseExample4" style="width:138.512px; text-shadow: 1px 1px 4px black">Sve ocene <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>BROJ PREDMETA</b>" data-html="true">
                                @php
                                $i=0;

                                foreach ($predmeti as $predmet){
                                foreach ($ocene as $ocena){
                                if ($predmet->id==$ocena->predmet_id && $student->id==$ocena->student_id){

                                $i++;


                                }
                                }
                                }
                                echo $i;
                                @endphp
                            </span></button>
                    </p>
                </div>
                <div class="row">
                    {{-- PRVA GODINA START --}}
                    <div class="col-lg-12 col-mg-12 col-sm-12">
                        <div class="collapse multi-collapse" id="multiCollapseExample1">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-center font-weight-bold pt-2">PRVA GODINA <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ PREDMETA</b>" data-html="true">
                                            {{$predmeti->where('godina_studija',1)->count()}}
                                        </span></h4>
                                </div>
                                <div class="card-body bg-dark">
                                    {{-- TABLE ALL GRADES FIRST YEAR START --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-lg table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Šifra</th>
                                                        <th scope="col">Naziv</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Ocena</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($predmeti as $predmet)
                                                    @foreach ($ocene as $ocena)
                                                    @if ($predmet->id==$ocena->predmet_id &&
                                                    $student->id==$ocena->student_id)
                                                    @if($predmet->godina_studija == 1)
                                                    <tr>
                                                        <td>{{$predmet->sifra}}</td>
                                                        <td>{{$predmet->naziv}}</td>
                                                        <td>{{$predmet->obavezni_izborni}}</td>
                                                        <td>{{$predmet->espb}}</td>
                                                        <td>{{$ocena->ocena}}</td>
                                                    </tr>
                                                    @endif
                                                    @endif
                                                    @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    {{-- TABLE ALL GRADES FIRST YEAR END --}}
                                </div>

                            </div>

                        </div>
                    </div>
                    {{-- PRVA GODINA END --}}
                    {{-- DRUGA GODINA START --}}
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="collapse multi-collapse" id="multiCollapseExample2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-center font-weight-bold pt-2">DRUGA GODINA <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ PREDMETA</b>" data-html="true">
                                            {{$predmeti->where('godina_studija',2)->count()}}
                                        </span></h4>
                                </div>
                                {{-- TABLE ALL GRADES SECOND YEAR START --}}
                                <div class="card-body bg-dark">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-lg table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Šifra</th>
                                                        <th scope="col">Naziv</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Ocena</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($predmeti as $predmet)
                                                    @foreach ($ocene as $ocena)
                                                    @if ($predmet->id==$ocena->predmet_id &&
                                                    $student->id==$ocena->student_id)
                                                    @if($predmet->godina_studija == 2)
                                                    <tr>
                                                        <td>{{$predmet->sifra}}</td>
                                                        <td>{{$predmet->naziv}}</td>
                                                        <td>{{$predmet->obavezni_izborni}}</td>
                                                        <td>{{$predmet->espb}}</td>
                                                        <td>{{$ocena->ocena}}</td>
                                                    </tr>
                                                    @endif
                                                    @endif
                                                    @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                {{-- TABLE ALL GRADES SECOND YEAR END --}}
                            </div>
                        </div>
                    </div>
                    {{-- DRUGA GODINA END --}}
                    {{-- TRECA GODINA START --}}
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="collapse multi-collapse" id="multiCollapseExample3">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-center font-weight-bold pt-2">TREĆA GODINA <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ PREDMETA</b>" data-html="true">
                                            {{$predmeti->where('godina_studija',3)->count()}}
                                        </span></h4>
                                </div>
                                <div class="card-body bg-dark">
                                    {{-- TABLE ALL GRADES THIRD YEAR START --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-lg table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Šifra</th>
                                                        <th scope="col">Naziv</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Ocena</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($predmeti as $predmet)
                                                    @foreach ($ocene as $ocena)
                                                    @if ($predmet->id==$ocena->predmet_id &&
                                                    $student->id==$ocena->student_id)
                                                    @if($predmet->godina_studija == 3)
                                                    <tr>
                                                        <td>{{$predmet->sifra}}</td>
                                                        <td>{{$predmet->naziv}}</td>
                                                        <td>{{$predmet->obavezni_izborni}}</td>
                                                        <td>{{$predmet->espb}}</td>
                                                        <td>{{$ocena->ocena}}</td>
                                                    </tr>
                                                    @endif
                                                    @endif
                                                    @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    {{-- TABLE ALL GRADES THIRD YEAR END --}}
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- TRECA GODINA END --}}
                    {{-- SVE OCENE START --}}
                    <div class="col-lg-12 col-mg-12 col-sm-12">
                        <div class="collapse multi-collapse show" id="multiCollapseExample4">
                            <div class="card">
                                <div class="card-header border border-dark rounded p-2">
                                    <h4 class="text-center font-weight-bold" style="text-shadow:1px 1px 3px gray">Sve ocene <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ PREDMETA</b>" data-html="true">
                                            {{$predmeti->count()}}
                                        </span></h4>
                                </div>
                                <div class="card-body bg-dark">
                                    {{-- TABLE ALL GRADES START --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-lg table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Šifra</th>
                                                        <th scope="col">Naziv</th>
                                                        <th scope="col">Godina</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Ocena</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($predmeti as $predmet)
                                                    @foreach ($ocene as $ocena)
                                                    @if ($predmet->id==$ocena->predmet_id &&
                                                    $student->id==$ocena->student_id)

                                                    <tr>
                                                        <td>{{$predmet->sifra}}</td>
                                                        <td>{{$predmet->naziv}}</td>
                                                        <td>{{$predmet->godina_studija}}.</td>
                                                        <td>{{$predmet->obavezni_izborni}}</td>
                                                        <td>{{$predmet->espb}}</td>
                                                        <td>{{$ocena->ocena}}</td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    {{-- TABLE ALL GRADES END --}}
                                </div>

                            </div>

                        </div>
                    </div>
                    {{-- SVE OCENE END --}}
                </div>
            </div>
        </div>
    </div>
    {{-- COLLAPSE FOR GRADES END --}}

</div>
@endsection
{{-- @endif
@endforeach --}}
