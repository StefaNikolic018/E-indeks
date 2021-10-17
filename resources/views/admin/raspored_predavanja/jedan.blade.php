@extends('layouts.app')

@section('title','Evidencija Studenata | Raspored '.$raspored->godina_studija.'. godine "'.$raspored->smerovi->naziv.'"')

@section('content')
    {{-- PONEDELJAK START --}}
    <div class="container">
        {{-- ALERT MESSAGES START --}}
        @if(session('raspored'))
        <div class="row justify-content-center">
            <div class='col-lg-6 col-md-6 col-sm-12'>
                <div class="alert alert-{{ session('raspored')[0] }}" id="raspored">
                    {{ session('raspored')[1] }}</div>
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
        {{-- ALERT MESSAGES END --}}
    <div class="card">
        <div class="card-header text-center" style="text-shadow: 1px 1px gray">
            <h3>{{$raspored->smerovi->naziv}} <span
                class="badge badge-secondary shadow" data-toggle="tooltip"
                data-placement="top" title="<b>GODINA STUDIJA</b>" data-html="true">{{$raspored->godina_studija}}.</span>
        @can('isSuperAdmin')
                <span class="float-right mt-3 mt-sm-0">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{route('izmena_rasporeda',['id'=>$raspored->id])}}" class="btn btn-outline-dark"><i class="fas fa-edit" style="color:orange"></i> Izmeni</a>
                        <button type="button" class="btn btn-outline-dark"  data-toggle="modal"
                        data-target="#exampleModal{{$raspored->id}}"><i class="fas fa-trash-alt" style="color:red" ></i>
                            Obriši</button>
                    </div>
                </span>
            </h3>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal{{$raspored->id}}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title text-center" id="exampleModalLabel">Brisanje
                                rasporeda
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <b>Da li stvarno želite da izbrišete raspored {{$raspored->godina_studija}}. godine "{{ $raspored->smerovi->naziv }}"?</b>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <form action={{ route('brisanje_rasporeda', ['id'=>$raspored->id]) }} method="POST">
                                @csrf
                                <button class="btn btn-danger">
                                    Da</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Ne</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal end --}}
        @endcan
        </div>
        <div class="card-body">
            @if($raspored->ponedeljak[0] != 'Nema predavanja' && count($raspored->ponedeljak)>4)
            <table class="table table-bordered table-dark table-hover table-striped table-striped table-responsive-lg border">
                <thead>
                    <tr class="bg-light">
                        <td colspan="4" class="text-center text-dark">PONEDELJAK
                    </tr>
                <tr>
                    <th scope="col">VREME</th>
                    <th scope="col">PREDMET</th>
                    <th scope="col">VRSTA</th>
                    <th scope="col">PROSTORIJA</th>
                </tr>
                </thead>
                <tbody>
                    {{-- TREBA URADITI SA UMETANJEM PHPA --}}
                @for($i=0;$i<count($raspored->ponedeljak);$i=$i+4)

                    <tr>
                        <th scope="row">{{$raspored->ponedeljak[$i+1]}}</th>
                        <td>{{$predmeti->find($raspored->ponedeljak[$i])->naziv}}</td>
                        <td>{{$raspored->ponedeljak[$i+2]}}</td>
                        <td>{{$raspored->ponedeljak[$i+3]}}</td>
                    </tr>
                @endfor
                </tbody>
            </table>
            @elseif($raspored->ponedeljak[0] == 'Nema predavanja' || empty($raspored->ponedeljak[0]))
            <table class="table table-bordered table-dark table-hover table-striped table-responsive-xs border">
                <thead>
                    <tr class="bg-light">
                        <td colspan="4" class="text-center text-dark">PONEDELJAK
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center text-light"> Nema predavanja</td>
                    </tr>
                </tbody>
            </table>

            @else
            <table class="table table-bordered table-dark table-hover table-striped table-responsive-lg border">
                <thead>
                <tr class="bg-light">
                    <td colspan="4" class="text-center text-dark">PONEDELJAK
                </tr>
                <tr>
                    <th scope="col">VREME</th>
                    <th scope="col">PREDMET</th>
                    <th scope="col">VRSTA</th>
                    <th scope="col">PROSTORIJA</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">{{$raspored->ponedeljak[1]}}</th>
                    <td>{{$predmeti->find($raspored->ponedeljak[0])->naziv}}</td>
                    <td>{{$raspored->ponedeljak[2]}}</td>
                    <td>{{$raspored->ponedeljak[3]}}</td>
                </tr>
                </tbody>
            </table>


            @endif
            {{-- PONEDELJAK END --}}
            {{-- UTORAK START--}}
            @if($raspored->utorak[0] != 'Nema predavanja' && count($raspored->utorak)>4)
            <table class="table table-bordered table-dark table-hover table-striped table-responsive-lg border">
                <thead>
                <tr class="bg-light">
                    <td class="text-center text-dark" colspan="4">UTORAK
                </tr>
                <tr>
                    <th scope="col">VREME</th>
                    <th scope="col">PREDMET</th>
                    <th scope="col">VRSTA</th>
                    <th scope="col">PROSTORIJA</th>
                </tr>
                </thead>
                <tbody>
                @for($i=0;$i<count($raspored->utorak);$i=$i+4)
                <tr>
                        <th scope="row">{{$raspored->utorak[$i+1]}}</th>
                        <td>{{$predmeti->find($raspored->utorak[$i])->naziv}}</td>
                        <td>{{$raspored->utorak[$i+2]}}</td>
                        <td>{{$raspored->utorak[$i+3]}}</td>
                    </tr>



                @endfor
                </tbody>
            </table>
            @elseif($raspored->utorak[0]=='Nema predavanja' || empty($raspored->utorak[0]))
            <table class="table table-bordered table-dark table-hover table-striped table-responsive-xs border">
                <thead>
                    <tr class="bg-light">
                        <td class="text-center text-dark" colspan="4">UTORAK
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center text-light"> Nema predavanja</td>
                    </tr>
                </tbody>
            </table>

            @else
            <table class="table table-bordered table-dark table-hover table-striped table-responsive-lg border">
                <thead>
                    <tr class="bg-light">
                        <td class="text-center text-dark" colspan="4">UTORAK
                    </tr>
                <tr>
                    <th scope="col">VREME</th>
                    <th scope="col">PREDMET</th>
                    <th scope="col">VRSTA</th>
                    <th scope="col">PROSTORIJA</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <th scope="row">{{$raspored->utorak[1]}}</th>
                    <td>{{$predmeti->find($raspored->utorak[0])->naziv}}</td>
                    <td>{{$raspored->utorak[2]}}</td>
                    <td>{{$raspored->utorak[3]}}</td>
                </tr>
                </tbody>
            </table>
            @endif
            {{-- UTORAK END --}}
            {{-- SREDA START --}}
            @if($raspored->sreda[0] != 'Nema predavanja' && count($raspored->sreda)>4)
            <table class="table table-bordered table-dark table-hover table-striped table-striped table-responsive-lg border">
                <thead>
                    <tr class="bg-light">
                        <td colspan="4" class="text-center text-dark">SREDA
                    </tr>
                <tr>
                    <th scope="col">VREME</th>
                    <th scope="col">PREDMET</th>
                    <th scope="col">VRSTA</th>
                    <th scope="col">PROSTORIJA</th>
                </tr>
                </thead>
                <tbody>
                @for($i=0;$i<count($raspored->sreda);$i=$i+4)
                <tr>
                        <th scope="row">{{$raspored->sreda[$i+1]}}</th>
                        <td>{{$predmeti->find($raspored->sreda[$i])->naziv}}</td>
                        <td>{{$raspored->sreda[$i+2]}}</td>
                        <td>{{$raspored->sreda[$i+3]}}</td>
                    </tr>



                @endfor
                </tbody>
            </table>
            @elseif($raspored->sreda[0]=='Nema predavanja' || empty($raspored->sreda[0]))
            <table class="table table-bordered table-dark table-hover table-striped table-responsive-xs border">
                <thead>
                    <tr class="bg-light">
                        <td class="text-center text-dark" colspan="4">SREDA
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center text-light"> Nema predavanja</td>
                    </tr>
                </tbody>
            </table>
            @else
            <table class="table table-bordered table-dark table-hover table-striped table-striped table-responsive-lg border">
                <thead>
                    <tr class="bg-light">
                        <td colspan="4" class="text-center text-dark">SREDA
                    </tr>
                <tr>
                    <th scope="col">VREME</th>
                    <th scope="col">PREDMET</th>
                    <th scope="col">VRSTA</th>
                    <th scope="col">PROSTORIJA</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">{{$raspored->sreda[1]}}</th>
                    <td>{{$predmeti->find($raspored->sreda[0])->naziv}}</td>
                    <td>{{$raspored->sreda[2]}}</td>
                    <td>{{$raspored->sreda[3]}}</td>
                </tr>
                </tbody>
            </table>
            @endif
            {{-- SREDA END --}}
            {{-- CETVRTAK START --}}
            @if($raspored->cetvrtak[0] != 'Nema predavanja' && count($raspored->cetvrtak)>4)
            <table class="table table-bordered table-dark table-hover table-striped table-striped table-responsive-lg border">
                <thead>
                    <tr class="bg-light">
                        <td colspan="4" class="text-center text-dark">ČETVRTAK
                    </tr>
                <tr>
                    <th scope="col">VREME</th>
                    <th scope="col">PREDMET</th>
                    <th scope="col">VRSTA</th>
                    <th scope="col">PROSTORIJA</th>
                </tr>
                </thead>
                <tbody>
                @for($i=0;$i<count($raspored->cetvrtak);$i=$i+4)
                <tr>
                        <th scope="row">{{$raspored->cetvrtak[$i+1]}}</th>
                        <td>{{$predmeti->find($raspored->cetvrtak[$i])->naziv}}</td>
                        <td>{{$raspored->cetvrtak[$i+2]}}</td>
                        <td>{{$raspored->cetvrtak[$i+3]}}</td>
                    </tr>



                @endfor
                </tbody>
            </table>
            @elseif($raspored->cetvrtak[0]=='Nema predavanja' || empty($raspored->cetvrtak[0]))
            <table class="table table-bordered table-dark table-hover table-striped table-responsive-xs border">
                <thead>
                    <tr class="bg-light">
                        <td class="text-center text-dark" colspan="4">ČETVRTAK
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center text-light"> Nema predavanja</td>
                    </tr>
                </tbody>
            </table>
            @else
            <table class="table table-bordered table-dark table-hover table-striped table-striped table-responsive-lg border">
                <thead>
                    <tr class="bg-light">
                        <td colspan="4" class="text-center text-dark">ČETVRTAK
                    </tr>
                <tr>
                    <th scope="col">VREME</th>
                    <th scope="col">PREDMET</th>
                    <th scope="col">VRSTA</th>
                    <th scope="col">PROSTORIJA</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">{{$raspored->cetvrtak[1]}}</th>
                    <td>{{$predmeti->find($raspored->cetvrtak[0])->naziv}}</td>
                    <td>{{$raspored->cetvrtak[2]}}</td>
                    <td>{{$raspored->cetvrtak[3]}}</td>
                </tr>
                </tbody>
            </table>
            @endif
            {{-- CETVRTAK END --}}
            {{-- PETAK START --}}
            @if($raspored->petak[0] != 'Nema predavanja' && count($raspored->petak)>4)
            <table class="table table-bordered table-dark table-hover table-striped table-striped table-responsive-lg border">
                <thead>
                    <tr class="bg-light">
                        <td colspan="4" class="text-center text-dark">PETAK
                    </tr>
                <tr>
                    <th scope="col">VREME</th>
                    <th scope="col">PREDMET</th>
                    <th scope="col">VRSTA</th>
                    <th scope="col">PROSTORIJA</th>
                </tr>
                </thead>
                <tbody>
                @for($i=0;$i<count($raspored->petak);$i=$i+4)
                <tr>
                        <th scope="row">{{$raspored->petak[$i+1]}}</th>
                        <td>{{$predmeti->find($raspored->petak[$i])->naziv}}</td>
                        <td>{{$raspored->petak[$i+2]}}</td>
                        <td>{{$raspored->petak[$i+3]}}</td>
                    </tr>



                @endfor
            @elseif($raspored->petak[0]=='Nema predavanja' || empty($raspored->petak[0]))
            <table class="table table-bordered table-dark table-hover table-striped table-responsive-xs border">
                <thead>
                    <tr class="bg-light">
                        <td class="text-center text-dark" colspan="4">PETAK
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center text-light"> Nema predavanja</td>
                    </tr>
                </tbody>
            </table>
            @else
            <table class="table table-bordered table-dark table-hover table-striped table-striped table-responsive-lg border">
                <thead>
                    <tr class="bg-light">
                        <td colspan="4" class="text-center text-dark">PETAK
                    </tr>
                <tr>
                    <th scope="col">VREME</th>
                    <th scope="col">PREDMET</th>
                    <th scope="col">VRSTA</th>
                    <th scope="col">PROSTORIJA</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">{{$raspored->petak[1]}}</th>
                    <td>{{$predmeti->find($raspored->petak[0])->naziv}}</td>
                    <td>{{$raspored->petak[2]}}</td>
                    <td>{{$raspored->petak[3]}}</td>
                </tr>
                </tbody>
            </table>
            @endif
            {{-- PETAK END --}}

        </div>
    </div>
    </div>


@endsection
