@section('title',$student->ime)
@extends('layouts.app')

@section('content')


<div class="container">
    {{-- ALERT MESSAGES START --}}
    @if(session('student'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-xs-12'>
            <div class="alert alert-{{session('student')[0]}} shadow" id="student">{{ session('student')[1] }}</div>
        </div>
    </div>
    @endif
    @error('student_predmet')
    <div class="row justify-content-center">
        <div class='col-lg-6 col-xs-12'>
            <div class="alert alert-danger shadow">
                {{$message}}
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
                    <h3>
                        <span class="d-flex justify-content-center">
                        <span class="badge badge-info shadow" data-toggle="tooltip" data-placement="top"
                        title="<b>BROJ INDEKSA</b>" data-html="true">
                        {{$student->broj_indeksa}}
                        </span>&nbsp;
                        <span data-toggle="tooltip" data-placement="top" title="<b>PROSEK OCENA</b>" data-html="true"
                            class="badge badge-pill shadow
                            @if($student->prosek_ocena < 7.00)
                                {{' badge-danger'}}
                            @elseif($student->prosek_ocena >=7.00 && $student->prosek_ocena<=8.50)
                                {{' badge-warning'}}
                            @elseif($student->prosek_ocena > 8.50)
                                {{' badge-success'}}
                            @endif
                            ">
                            @if($student->prosek_ocena != NULL)
                            {{$student->prosek_ocena}}
                            @else
                                0.00
                            @endif
                        </span>&nbsp;
                        <span class="badge badge-pill badge-primary shadow" data-toggle="tooltip" data-placement="top"
                            title="<b>GODINA STUDIJA</b>" data-html="true">
                            {{$student->godina_studija}}.
                        </span>&nbsp;

                        <span class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                            title="<b>UKUPNO ESPB</b>" data-html="true">
                            {{$student->espb}}
                        </span>
                        </span>

                    </h3>

                </div>
                <table class="table table-hover table-striped table-bordered table-responsive-lg" id="studenti">
                    <tbody>
                        <tr>
                            <th>Smer</th>
                            <td><a class="font-weight-bold" href="{{route('program',['id'=>$student->smers->id])}}" style="color:inherit;">{{$student->smers->naziv}}</a></td>


                        </tr>

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
                            <th>Telefon</th>
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

        {{-- DODAJ OCENU START --}}
        <div class='col-xs-12 col-sm-6 my-2 '>
            <div class="card rounded-lg bg-gradient-light border border-dark shadow-lg">
                <div class="card-header text-center">
                    <h3 class="font-weight-bold pt-2" style="text-shadow: 2px 2px lightgray">Dodaj ocenu</h3>
                </div>
                <div class="card-body pb-4">
                    <div class="container border border-secondary rounded shadow bg-gradient-light py-2">
                    <form action={{route('dodaj_ocenu', ['id'=>$student->id])}} method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="izaberi">Predmet</label>
                            <select class="custom-select mr-sm-2 @error('predmet_id') is-invalid @enderror" id="izaberi"
                                name="izbor" required oninvalid="this.setCustomValidity('Molimo izaberite predmet!')"
                                oninput="setCustomValidity('')">
                                <option>Odaberi Predmet</option>
                                {{-- OVDE TREBA DA LISTA SAMO PREDMETE SMERA KOJI STUDENT POHADJA --}}

                                @foreach ($predmeti as $predmet)
                                @foreach($pred as $p)
                                @if($predmet->naziv==$p)
                                <option value={{$predmet->id}}>{{$predmet->naziv}}</option>
                                @endif
                                @endforeach
                                @endforeach
                            </select>
                            @error('predmet_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="ocena">Ocena</label>
                            <div class="input-group">

                                <input type="number" min="6" max="10" placeholder="6"
                                    class="form-control @error('ocena') is-invalid @enderror" id="ocena" name="ocena"
                                    required oninvalid="this.setCustomValidity('Molimo unesite ocenu!')"
                                    oninput="setCustomValidity('')">
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
                            <input type="date" class="form-control @error('datum') is-invalid @enderror" id="datum"
                                name="datum" required oninvalid="this.setCustomValidity('Molimo unesite datum!')"
                                oninput="setCustomValidity('')">
                            @error('datum')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center">
                            <input type="submit" class="btn btn-primary mb-3 ml-3 shadow font-weight-bold mt-3 p-2 border border-dark rounded"
                                role="button" value="Sačuvaj" />
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- DODAJ OCENU END --}}
    </div>
    {{-- STUDENT INFO END --}}
    <br>


    {{-- COLLAPSE FOR SUBJECTS START --}}
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card-header border border-white bg-dark py-2">
                <h4 class="text-center font-weight-bold pt-1 text-light" style="text-shadow: 2px 2px black">Spisak ocena
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
                                foreach($student->ocene as $ocena){
                                    if($ocena->predmet->godina_studija==1){
                                        $i++;
                                    }
                                }
                                echo $i;
                            @endphp
                            </span></a>
                        <button class="btn btn-primary font-weight-bold shadow mt-1 border border-dark rounded" type="button"
                            data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false"
                            aria-controls="multiCollapseExample2" style="width:138.512px">II godina <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>BROJ OCENA</b>" data-html="true">
                                @php
                                $i=0;
                                foreach($student->ocene as $ocena){
                                    if($ocena->predmet->godina_studija==2){
                                        $i++;
                                    }
                                }
                                echo $i;
                                @endphp
                            </span></button>
                        <button class="btn btn-info font-weight-bold shadow mt-1 border border-dark rounded" type="button" data-toggle="collapse"
                            data-target="#multiCollapseExample3" aria-expanded="false"
                            aria-controls="multiCollapseExample2" style="width:138.512px; text-shadow: 1px 1px gray">III godina <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>BROJ OCENA</b>" data-html="true">
                                @php
                                $i=0;
                                foreach($student->ocene as $ocena){
                                    if($ocena->predmet->godina_studija==3){
                                        $i++;
                                    }
                                }
                                echo $i;
                                @endphp
                            </span></button>
                        <button class="btn btn-dark font-weight-bold shadow mt-1" type="button" data-toggle="collapse"
                            data-target="#multiCollapseExample4" aria-expanded="false"
                            aria-controls="multiCollapseExample4" style="width:138.512px; text-shadow: 1px 1px black">Sve ocene <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>BROJ PREDMETA</b>" data-html="true">
                                {{$student->ocene->count()}}
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
                                            @php
                                            $i=0;
                                            foreach($student->ocene as $ocena){
                                                if($ocena->predmet->godina_studija==1){
                                                    $i++;
                                                }
                                            }
                                            echo $i;
                                            @endphp
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
                                                        <th scope="col">Akcija</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($student->ocene as $ocena)
                                                    @if($ocena->predmet->godina_studija==1)
                                                    <tr>
                                                        <td>{{$ocena->predmet->sifra}}</td>
                                                        <td>{{$ocena->predmet->naziv}}</td>
                                                        <td>{{$ocena->predmet->obavezni_izborni}}</td>
                                                        <td>{{$ocena->predmet->espb}}</td>
                                                        <td>{{$ocena->ocena}}</td>
                                                        <td class="d-inline-flex">
                                                            <!-- Split dropright button -->
                                                            @foreach($pred as $p)
                                                            @if($p==$ocena->predmet->naziv)
                                                            <div class="btn-group dropright">
                                                                <button type="button" class="btn btn-info">
                                                                    Upravljaj
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <span class="sr-only">Toggle Dropright</span>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item"
                                                                        href={{route('ocena_izmena', ['id'=>$ocena->id, 'id1'=>$student->id])}}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{$ocena->predmet->sifra}}1">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>

                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{$ocena->predmet->sifra}}1"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header ">
                                                                            <h5 class="modal-title text-center text-dark"
                                                                                id="exampleModalLabel">
                                                                                Brisanje ocene
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-dark">
                                                                            <b>Da li stvarno želite da izbrišete ocenu
                                                                                {{$ocena->ocena}} iz
                                                                                predmeta
                                                                                "{{$ocena->predmet->naziv}}"
                                                                                studenta "{{ $student->ime }}"?</b>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-center">
                                                                            <form
                                                                                action={{ route('ocena_brisanje', ['id'=>$ocena->id, 'id1'=>$student->id]) }}
                                                                                method="POST">
                                                                                @csrf
                                                                                <button class="btn btn-danger">
                                                                                    Da</button>
                                                                            </form>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Ne</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @else
                                                            <div class="alert alert-danger p-1">
                                                            NE PREDAJETE
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    @endif
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
                                            @php
                                            $i=0;
                                            foreach($student->ocene as $ocena){
                                                if($ocena->predmet->godina_studija==2){
                                                    $i++;
                                                }
                                            }
                                            echo $i;
                                            @endphp
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
                                                        <th scope="col">Akcija</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($student->ocene as $ocena)
                                                    @if($ocena->predmet->godina_studija == 2)
                                                    <tr>
                                                        <td>{{$ocena->predmet->sifra}}</td>
                                                        <td>{{$ocena->predmet->naziv}}</td>
                                                        <td>{{$ocena->predmet->obavezni_izborni}}</td>
                                                        <td>{{$ocena->predmet->espb}}</td>
                                                        <td>{{$ocena->ocena}}</td>
                                                        <td class="d-inline-flex">
                                                            <!-- Split dropright button -->
                                                            @foreach($pred as $p)
                                                            @if($p==$ocena->predmet->naziv)
                                                            <div class="btn-group dropright">
                                                                <button type="button" class="btn btn-info">
                                                                    Upravljaj
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <span class="sr-only">Toggle Dropright</span>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item"
                                                                        href={{route('ocena_izmena', ['id'=>$ocena->id, 'id1'=>$student->id])}}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{$ocena->predmet->sifra}}2">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>

                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{$ocena->predmet->sifra}}2"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header ">
                                                                            <h5 class="modal-title text-center text-dark"
                                                                                id="exampleModalLabel">
                                                                                Brisanje ocene
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-dark">
                                                                            <b>Da li stvarno želite da izbrišete ocenu
                                                                                {{$ocena->ocena}} iz
                                                                                predmeta
                                                                                "{{$ocena->predmet->naziv}}"
                                                                                studenta "{{ $student->ime }}"?</b>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-center">
                                                                            <form
                                                                                action={{ route('ocena_brisanje', ['id'=>$ocena->id, 'id1'=>$student->id]) }}
                                                                                method="POST">
                                                                                @csrf
                                                                                <button class="btn btn-danger">
                                                                                    Da</button>
                                                                            </form>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Ne</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @else
                                                            <div class="alert alert-danger p-1">
                                                            NE PREDAJETE
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    @endif
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
                                            @php
                                                $i=0;
                                                foreach($student->ocene as $ocena){
                                                    if($ocena->predmet->godina_studija==3){
                                                        $i++;
                                                    }
                                                }
                                                echo $i;
                                            @endphp
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
                                                        <th scope="col">Akcija</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($student->ocene as $ocena)
                                                    @if($ocena->predmet->godina_studija==3)
                                                    <tr>
                                                        <td>{{$ocena->predmet->sifra}}</td>
                                                        <td>{{$ocena->predmet->naziv}}</td>
                                                        <td>{{$ocena->predmet->obavezni_izborni}}</td>
                                                        <td>{{$ocena->predmet->espb}}</td>
                                                        <td>{{$ocena->ocena}}</td>
                                                        <td class="d-inline-flex">
                                                            <!-- Split dropright button -->
                                                            @foreach($pred as $p)
                                                            @if($p==$ocena->predmet->naziv)
                                                            <div class="btn-group dropright">
                                                                <button type="button" class="btn btn-info">
                                                                    Upravljaj
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <span class="sr-only">Toggle Dropright</span>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item"
                                                                        href={{route('ocena_izmena', ['id'=>$ocena->id, 'id1'=>$student->id])}}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{$ocena->predmet->sifra}}3">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>

                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{$ocena->predmet->sifra}}3"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header ">
                                                                            <h5 class="modal-title text-center text-dark"
                                                                                id="exampleModalLabel">
                                                                                Brisanje ocene
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-dark">
                                                                            <b>Da li stvarno želite da izbrišete ocenu
                                                                                {{$ocena->ocena}} iz
                                                                                predmeta
                                                                                "{{$ocena->predmet->naziv}}"
                                                                                studenta "{{ $student->ime }}"?</b>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-center">
                                                                            <form
                                                                                action={{ route('ocena_brisanje', ['id'=>$ocena->id, 'id1'=>$student->id]) }}
                                                                                method="POST">
                                                                                @csrf
                                                                                <button class="btn btn-danger">
                                                                                    Da</button>
                                                                            </form>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Ne</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @else
                                                            <div class="alert alert-danger p-1">
                                                            NE PREDAJETE
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    @endif
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
                                <div class="card-header border border-dark p-2">
                                    <h4 class="text-center font-weight-bold " style="text-shadow: 1px 1px gray">Svi predmeti <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ PREDMETA</b>" data-html="true">
                                            {{$student->ocene->count()}}
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
                                                        <th scope="col">Godina Studija</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Ocena</th>
                                                        <th scope="col">Akcija</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($student->ocene as $ocena)
                                                    <tr>
                                                        <td>{{$ocena->predmet->sifra}}</td>
                                                        <td>{{$ocena->predmet->naziv}}</td>
                                                        <td>{{$ocena->predmet->godina_studija}}</td>
                                                        <td>{{$ocena->predmet->obavezni_izborni}}</td>
                                                        <td>{{$ocena->predmet->espb}}</td>
                                                        <td>{{$ocena->ocena}}</td>
                                                        <td class="d-inline-flex">
                                                            <!-- Split dropright button -->
                                                            @foreach($pred as $p)
                                                            @if($p==$ocena->predmet->naziv)
                                                            <div class="btn-group dropright">
                                                                <button type="button" class="btn btn-info">
                                                                    Upravljaj
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <span class="sr-only">Toggle Dropright</span>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item"
                                                                        href={{route('ocena_izmena', ['id'=>$ocena->id, 'id1'=>$student->id])}}
                                                                        role="button">
                                                                        <i class="fas fa-edit" style="color:orange"></i>
                                                                        Izmeni
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <!-- Button trigger modal -->
                                                                    <button class="dropdown-item" data-toggle="modal"
                                                                        data-target="#exampleModal{{$ocena->predmet->sifra}}4">
                                                                        <i class="fas fa-trash-alt"
                                                                            style="color:red"></i>
                                                                        Obriši
                                                                    </button>

                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{$ocena->predmet->sifra}}4"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header ">
                                                                            <h5 class="modal-title text-center text-dark"
                                                                                id="exampleModalLabel">
                                                                                Brisanje ocene
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-dark">
                                                                            <b>Da li stvarno želite da izbrišete ocenu
                                                                                {{$ocena->ocena}} iz
                                                                                predmeta
                                                                                "{{$ocena->predmet->naziv}}"
                                                                                studenta "{{ $student->ime }}"?</b>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer justify-content-center">
                                                                            <form
                                                                                action={{ route('ocena_brisanje', ['id'=>$ocena->id, 'id1'=>$student->id]) }}
                                                                                method="POST">
                                                                                @csrf
                                                                                <button class="btn btn-danger">
                                                                                    Da</button>
                                                                            </form>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Ne</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @else
                                                            <div class="alert alert-danger p-1">
                                                            NE PREDAJETE
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
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
