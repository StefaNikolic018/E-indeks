
@extends('layouts.app')
@section('title','Evidencija Studenata | Studenti')

@section('content')
{{-- SADRŽAJ STRANICE --}}
<div class="container">
    {{-- ALERT MESSAGES START --}}
    @if(session('student'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-md-6 col-sm-12'>
            <div class="alert alert-{{ session('student')[0] }}" id="student">
                {{ session('student')[1] }}</div>
        </div>
    </div>
    @endif
    @if(url()->previous()==url('/login'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-md-6  col-sm-12'>
            <div class="alert alert-success shadow" id="welcome">Dobrodošli {{ Auth::user()->ime }}!</div>
        </div>
    </div>
    @endif
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card-header border border-white bg-dark py-2">
                <h4 class="text-center font-weight-bold pt-1 text-light" style="text-shadow: 2px 2px 5px black">Spisak
                    studenata po godini</h4>
            </div>
            <div class="card border-dark shadow-lg">
                <div class="card-header pt-3">
                    <p class="text-center justify-content-around">
                        <a class="btn btn-outline-primary font-weight-bold shadow mt-1" data-toggle="collapse"
                            href="#multiCollapseExample1" role="button" aria-expanded="false"
                            aria-controls="multiCollapseExample1" style="width:138.512px; text-shadow: 1px 1px black">Prva godina <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>BROJ STUDENATA</b>" data-html="true">
                                {{$stud->where('godina_studija',1)->count()}}
                            </span></a>
                        <button class="btn btn-primary font-weight-bold shadow mt-1 border border-dark rounded" type="button"
                            data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false"
                            aria-controls="multiCollapseExample2" style="width:138.512px; text-shadow: 1px 1px black">Druga godina <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>BROJ STUDENATA</b>" data-html="true">
                                {{$stud->where('godina_studija',2)->count()}}
                            </span></button>
                        <button class="btn btn-info font-weight-bold shadow mt-1 border border-dark rounded" type="button" data-toggle="collapse"
                            data-target="#multiCollapseExample3" aria-expanded="false"
                            aria-controls="multiCollapseExample2" style="width:138.512px; text-shadow: 1px 1px gray">Treća godina <span
                                class="badge badge-secondary shadow" data-toggle="tooltip" data-placement="top"
                                title="<b>BROJ STUDENATA</b>" data-html="true">
                                {{$stud->where('godina_studija',3)->count()}}
                            </span></button>
                        <button class="btn btn-dark font-weight-bold shadow mt-1" type="button" data-toggle="collapse"
                            data-target="#multiCollapseExample4" aria-expanded="false"
                            aria-controls="multiCollapseExample4" style="width:138.512px; text-shadow: 1px 1px black">Svi
                            studenti <span class="badge badge-secondary shadow" data-toggle="tooltip"
                                data-placement="top" title="<b>BROJ STUDENATA</b>" data-html="true">
                                {{$stud->count()}}
                            </span></button>
                    </p>
                    {{-- SEARCH START --}}
                    <div class="input-group col-12 col-sm-6 offset-sm-3">
                        <input type="text" id="pretragaStudenata" class="form-control" placeholder="Pronađite studenta" aria-label="Pronađite studenta" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                          <button class="input-group-text btn btn-primary" id="basic-addon2" disabled> <i class="fas fa-search"></i> </button>
                        </div>
                    </div>
                    {{-- SEARCH END --}}
                </div>
                <div class="row">
                    {{-- PRVA GODINA START --}}
                    <div class="col-lg-12 col-mg-12 col-sm-12">
                        <div class="collapse multi-collapse" id="multiCollapseExample1">
                            <div class="card">
                                <div class="card-header">
                                    <h4 style="text-shadow: 1px 1px gray" class="text-center font-weight-bold pt-2" >PRVA GODINA <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ STUDENATA</b>" data-html="true">
                                            {{$stud->where('godina_studija',1)->count()}}
                                        </span></h4>
                                </div>
                                <div class="card-body bg-dark">
                                    {{-- TABLE ALL STUDENTS START --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-lg table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Broj indeksa</th>
                                                        <th scope="col">Ime</th>
                                                        <th scope="col">Prezime</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Prosek ocena</th>
                                                        <th scope="col"> &nbsp;Akcije</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($stud as $student)
                                                    @if($student->godina_studija == 1)
                                                    <tr>
                                                        <td>{{ $student->broj_indeksa }}</td>
                                                        <td>{{ $student->ime }}</td>
                                                        <td>{{ $student->prezime }}</td>
                                                        <td>{{ $student->espb }}</td>
                                                        <td>{{ $student->prosek_ocena }}</td>

                                                        <td class="d-inline-flex">


                                                                    <a href="{{ route('jedan_student',['id'=>$student->id]) }}"
                                                                        class="btn btn-info" role="button">
                                                                        <i class="fas fa-eye"
                                                                            style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>


                                                        </td>

                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    {{-- TABLE ALL SUBJECTS END --}}
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
                                    <h4 style="text-shadow: 1px 1px gray" class="text-center font-weight-bold pt-2">DRUGA GODINA <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ STUDENATA</b>" data-html="true">
                                            {{$stud->where('godina_studija',2)->count()}}
                                        </span></h4>
                                </div>
                                {{-- TABLE ALL STUDENTS START --}}
                                <div class="card-body bg-dark">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-lg table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Broj indeksa</th>
                                                        <th scope="col">Ime</th>
                                                        <th scope="col">Prezime</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Prosek ocena</th>
                                                        <th scope="col"> &nbsp;Akcije</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($stud as $student)
                                                    @if($student->godina_studija == 2)
                                                    <tr>
                                                        <td>{{ $student->broj_indeksa }}</td>
                                                        <td>{{ $student->ime }}</td>
                                                        <td>{{ $student->prezime }}</td>
                                                        <td>{{ $student->espb }}</td>
                                                        <td>{{ $student->prosek_ocena }}</td>

                                                        <td class="d-inline-flex">


                                                                    <a href="{{ route('jedan_student',['id'=>$student->id]) }}"
                                                                        class="btn btn-info" role="button">
                                                                        <i class="fas fa-eye"
                                                                            style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>


                                                        </td>

                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                {{-- TABLE ALL SUBJECTS END --}}
                            </div>
                        </div>
                    </div>
                    {{-- DRUGA GODINA END --}}
                    {{-- TRECA GODINA START --}}
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="collapse multi-collapse" id="multiCollapseExample3">
                            <div class="card">
                                <div class="card-header">
                                    <h4 style="text-shadow: 1px 1px gray" class="text-center font-weight-bold pt-2">TREĆA GODINA <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ STUDENATA</b>" data-html="true">
                                            {{$stud->where('godina_studija',3)->count()}}
                                        </span></h4>
                                </div>
                                <div class="card-body bg-dark">
                                    {{-- TABLE ALL SUBJECTS START --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-lg table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Broj indeksa</th>
                                                        <th scope="col">Ime</th>
                                                        <th scope="col">Prezime</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Prosek ocena</th>
                                                        <th scope="col"> &nbsp;Akcije</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($stud as $student)
                                                    @if($student->godina_studija == 3)
                                                    <tr>
                                                        <td>{{ $student->broj_indeksa }}</td>
                                                        <td>{{ $student->ime }}</td>
                                                        <td>{{ $student->prezime }}</td>
                                                        <td>{{ $student->espb }}</td>
                                                        <td>{{ $student->prosek_ocena }}</td>

                                                        <td class="d-inline-flex">


                                                                    <a href="{{ route('jedan_student',['id'=>$student->id]) }}"
                                                                        class="btn btn-info" role="button">
                                                                        <i class="fas fa-eye"
                                                                            style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>


                                                        </td>

                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    {{-- TABLE ALL SUBJECTS END --}}
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- TRECA GODINA END --}}
                    {{-- SVI STUDENTI START --}}
                    {{-- BEZ PRETRAGE START --}}
                    <div class="col-lg-12 col-mg-12 col-sm-12" id="sviStudenti">
                        <div class="collapse multi-collapse show" id="multiCollapseExample4">
                            <div class="card">
                                <div class="card-header border border-dark p-2">
                                    <h4 style="text-shadow: 1px 1px gray" class="text-center font-weight-bold">Svi studenti <span
                                            class="badge badge-secondary shadow" data-toggle="tooltip"
                                            data-placement="top" title="<b>BROJ STUDENATA</b>" data-html="true">
                                            {{$stud->count()}}
                                        </span></h4>
                                </div>
                                <div class="card-body bg-dark">
                                    {{-- TABLE ALL SUBJECTS START --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-lg table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Broj indeksa</th>
                                                        <th scope="col">Ime</th>
                                                        <th scope="col">Prezime</th>
                                                        <th scope="col">Godina</th>
                                                        <th scope="col">Smer</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Prosek</th>
                                                        <th scope="col"> &nbsp;Akcije</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($stud as $student)
                                                    <tr>
                                                        <td>{{ $student->broj_indeksa }}</td>
                                                        <td>{{ $student->ime }}</td>
                                                        <td>{{ $student->prezime }}</td>
                                                        <td>{{ $student->godina_studija }}.</td>
                                                        <td>{{ $student->smers->naziv }}</td>
                                                        <td>{{ $student->espb }}</td>
                                                        <td>
                                                            @if($student->prosek_ocena != NULL)
                                                            {{ $student->prosek_ocena }}
                                                            @else
                                                                0.00
                                                            @endif
                                                        </td>

                                                        <td class="d-inline-flex">


                                                                    <a href="{{ route('jedan_student',['id'=>$student->id]) }}"
                                                                        class="btn btn-info" role="button">
                                                                        <i class="fas fa-eye"
                                                                            style="color: #227dc7"></i>
                                                                        Pogledaj
                                                                    </a>


                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    {{-- TABLE ALL SUBJECTS END --}}
                                </div>

                            </div>

                        </div>
                    </div>
                    {{-- BEZ PRETRAGE END --}}
                    {{-- SA PRETRAGOM START --}}
                    <div class="col-lg-12 col-mg-12 col-sm-12 d-none" id="sviStudentiPretraga">
                        <div class="collapse multi-collapse show" id="multiCollapseExample4">
                            <div class="card">
                                <div class="card-header border border-dark p-2">
                                    <h4 style="text-shadow: 1px 1px gray" class="text-center font-weight-bold">Rezultati pretrage <span
                                        class="badge badge-secondary shadow" data-toggle="tooltip"
                                        data-placement="top" title="<b>BROJ STUDENATA</b>" data-html="true" id="brojacStudenata">

                                    </span></h4>
                                </div>
                                <div class="card-body bg-dark">
                                    {{-- TABLE ALL SUBJECTS START --}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-dark table-hover table-responsive-lg table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Broj indeksa</th>
                                                        <th scope="col">Ime</th>
                                                        <th scope="col">Prezime</th>
                                                        <th scope="col">Godina</th>
                                                        <th scope="col">Smer</th>
                                                        <th scope="col">ESPB</th>
                                                        <th scope="col">Prosek</th>
                                                        <th scope="col"> &nbsp;Akcije</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="bodyTabela">

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    {{-- TABLE ALL SUBJECTS END --}}
                                </div>

                            </div>

                        </div>
                    </div>
                    {{-- SA PRETRAGOM END --}}

                    {{-- SVI STUDENTI END --}}
                </div>
            </div>
        </div>
    </div>
    {{-- COLLAPSE FOR STUDENTS END --}}
    <script>
        var studenti = {!!$stud!!};
        var tabela=document.getElementById('sviStudenti');
        var tabelaPretraga=document.getElementById('sviStudentiPretraga');
        var tabelaBody=document.getElementById('bodyTabela');
        var brojacStudenata=document.getElementById('brojacStudenata');
        document.getElementById('pretragaStudenata').addEventListener('keyup',function(event){
            var value = event.target.value.toUpperCase();
            var html ='';
            var br = 0;
            tabelaBody.innerHTML=html;
            if(value!=''){
                br=0;
                html='';
                studenti.forEach(st => {
                    var ime = st.ime.toUpperCase()+' '+st.prezime.toUpperCase();
                    if(ime.includes(value) || st.ime_roditelja.toUpperCase().includes(value) || st.broj_indeksa.toUpperCase().includes(value) || String(st.godina_studija).includes(value) || String(st.jmbg).includes(value) || String(st.datum_rodjenja).includes(value) || String(st.broj_telefona).includes(value) || st.email.toUpperCase().includes(value) && value!=''){
                        let Url = '{{ route("jedan_student",[":id"]) }}';
                        Url = Url.replace(':id',st.id);
                        ++br;
                        html+='<tr>';
                        html+='<td>'+st.broj_indeksa+'</td>';
                        html+='<td>'+st.ime+'</td>';
                        html+='<td>'+st.prezime+'</td>';
                        html+='<td>'+st.godina_studija+'.</td>';
                        html+='<td>'+st.smers.naziv+'</td>';
                        html+='<td>'+st.espb+'</td>';
                        html+='<td>'+(st.prosek_ocena ? st.prosek_ocena : 0.00) +'</td>';
                        html+='<td class="d-inline-flex">';
                        html+='<a href="'+Url+'" class="btn btn-info" role="button">';
                        html+='<i class="fas fa-eye" style="color: #227dc7"></i> Pogledaj </a>';
                        html+='</td>';
                        html+='</tr>';
                        tabelaBody.innerHTML=html;
                        tabela.classList.add('d-none');
                        tabelaPretraga.classList.remove('d-none');
                        brojacStudenata.innerHTML=br;
                    } else {
                        brojacStudenata.innerHTML=br;
                        tabelaBody.innerHTML=html;
                    }

                });
            } else {
                html='';
                tabelaBody.innerHTML='';
                tabelaPretraga.classList.add('d-none');
                tabela.classList.remove('d-none');
                br=0
                brojacStudenata.innerHTML=0;
            }


        });
    </script>



</div>
@endsection
