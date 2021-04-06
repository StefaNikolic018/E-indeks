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
        <div class='col-xs-12 col-sm-4'>
            <div class="card border border-dark shadow-lg">
                <div class="card-header">
                    <h5>
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
                            <span class="d-flex justify-content-center mt-2 btn-group shadow"><a class="btn btn-outline-dark font-weight-bold"
                                href={{ route('izmena_studenta', ['id'=>$student->id]) }} role="button">
                                <i class="fas fa-edit" style="color:orange"></i> Izmeni
                            </a>
                            <button class="btn btn-outline-dark font-weight-bold" data-toggle="modal"
                                data-target="#exampleModal{{$student->id}}">
                                <i class="fas fa-trash-alt" style="color:red"></i>
                                Obriši
                            </button>
                        </span>

                    </h3>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{$student->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h5 class="modal-title text-center" id="exampleModalLabel">Brisanje
                                        studenta
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <b>Da li stvarno želite da izbrišete studenta "{{ $student->ime }}"?</b>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <form action={{ route('brisanje_studenta', ['id'=>$student->id]) }} method="POST">
                                        @csrf
                                        <button class="btn btn-danger">
                                            Da</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ne</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-hover table-responsive" id="studenti">
                    <tbody>
                        <tr>
                            <th>Smer</th>
                            <td><a class="font-weight-bold" href="{{route('smer',['id'=>$student->smers->id])}}" style="color:inherit;">{{$student->smers->naziv}}</a></td>


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
        {{-- COLLAPSE FOR GRADES START --}}
        <div class="col-xs-12 col-sm-8 mt-2 mt-sm-0">
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
                            aria-controls="multiCollapseExample1" style="width:138.512px">I godina <span
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
                        <button class="btn btn-primary font-weight-bold shadow mt-1" type="button"
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
                        <button class="btn btn-info font-weight-bold shadow mt-1" type="button" data-toggle="collapse"
                            data-target="#multiCollapseExample3" aria-expanded="false"
                            aria-controls="multiCollapseExample2" style="width:138.512px">III godina <span
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
                            aria-controls="multiCollapseExample4" style="width:138.512px">Sve ocene <span
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
                                            <table class="table table-dark table-hover table-responsive-md">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Sifra</th>
                                                        <th scope="col">Naziv</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Ocena</th>
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
                                            <table class="table table-dark table-hover table-responsive-md">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Sifra</th>
                                                        <th scope="col">Naziv</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Ocena</th>

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
                                            <table class="table table-dark table-hover table-responsive-md">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Sifra</th>
                                                        <th scope="col">Naziv</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Ocena</th>

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
                                            <table class="table table-dark table-hover table-responsive-md">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Sifra</th>
                                                        <th scope="col">Naziv</th>
                                                        <th scope="col">Godina </th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Ocena</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($student->ocene as $ocena)
                                                    <tr>
                                                        <td>{{$ocena->predmet->sifra}}</td>
                                                        <td>{{$ocena->predmet->naziv}}</td>
                                                        <td>{{$ocena->predmet->godina_studija}}.</td>
                                                        <td>{{$ocena->predmet->obavezni_izborni}}</td>
                                                        <td>{{$ocena->predmet->espb}}</td>
                                                        <td>{{$ocena->ocena}}</td>
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
        {{-- COLLAPSE FOR GRADES END --}}



    </div>
    {{-- STUDENT INFO END --}}
    <br>


</div>
@endsection
