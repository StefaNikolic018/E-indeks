@extends('layouts.app')
@section('title','Raspored Ispita\Kolokvijuma')

@section('content')
<div class="container">
    <div id="calendar" class="bg-light p-3"></div>
        {{-- ALERT MESSAGES START --}}
        @if(session('raspored'))
        <div class="row justify-content-center">
            <div class='col-lg-6 col-md-6 col-sm-12'>
                <div class="alert alert-{{ session('raspored')[0] }}">
                    {{ session('raspored')[1] }}</div>
            </div>
        </div>
        @endif
        @if(url()->previous()==url('/login'))
        <div class="row justify-content-center">
            <div class='col-lg-6 col-md-6  col-sm-12'>
                <div class="alert alert-success shadow">Dobrodošli {{ Auth::user()->ime }}!</div>
            </div>
        </div>
        @endif
        {{-- ALERT MESSAGES END --}}
        {{-- JUMBOTRON START --}}
        <div class="jumbotron jumbotron-fluid py-2 px-2 rounded bg-gradient-light border border-dark shadow-lg">
            <div class="container">
                <h1 style="text-shadow: 2px 2px lightgray"><i class="fas fa-table"></i> Raspored časova
                </h1>

                <p class="lead">U ovoj sekciji se upravlja rasporedom <a
                        class="btn btn-outline-primary float-right font-weight-bold shadow" href={{ route('novi_raspored') }}
                        role="button">Dodaj
                        Raspored</a></p>
            </div>
        </div>
            {{-- DIALOG START --}}
<div id="dialog">
    <div id="dialog-body" class="bg-light border rounded border-dark p-3">
        <form action="{{route('novi_dogadjaj')}}" id="dayClick">
            @csrf
            <div class="form-group">
                <label class="font-weight-bold" for="predmet">Predmet</label>
                <select class="form-control custom-select mr-sm-2 @error("predmet") is-invalid @enderror" id="predmet" name="predmet" oninvalid="this.setCustomValidity("Molimo izaberite predmet!")" oninput="setCustomValidity("")">
                    <option value="">Izaberite predmet</option>
                    @foreach($predmeti as $predmet)
                        <option value="{{$predmet->id}}">{{$predmet->naziv}}</option>
                    @endforeach
                </select>
                @error("predmet")
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="godina_studija">Godina studija</label>
                <select class="form-control custom-select mr-sm-2 @error("godina_studija") is-invalid @enderror" id="godina_studija" name="godina_studija" oninvalid="this.setCustomValidity("Molimo izaberite godinu studija!")" oninput="setCustomValidity("")">
                    <option value="">Izaberite godinu studija</option>
                    @for($i=1;$i<4;$i++)
                        <option value="{{$i}}">{{$i}}. godina</option>
                    @endfor
                </select>
                @error("predmet")
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="vreme">Kolokvijum \ Ispit</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="izbor" id="ispit" value="Ispit" checked>
                    <label class="form-check-label" for="vreme2">
                    Ispit
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="izbor" id="kolokvijum" value="Kolokvijum" >
                    <label class="form-check-label" for="vreme1">
                      Kolokvijum
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="vreme">Vreme</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" onclick="prikazi(this)" name="vreme" id="vreme" value="1" checked>
                    <label class="form-check-label" for="vreme1">
                      Ceo dan
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" onclick="prikazi(this)" name="vreme" id="vreme" value="2">
                    <label class="form-check-label" for="vreme2">
                      Po satu
                    </label>
                  </div>
            </div>
            <div class="form-group d-none" id="vremeBox">
                <div class="form-group">
                    <label class="font-weight-bold" for="pocetak">Vreme početka</label>
                    <input type="text" name="pocetak" id="pocetak" placeholder="Vreme početka ispita" class="form-control" >
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="zavrsetak">Vreme završetka</label>
                    <input type="text" name="zavrsetak" id="zavrsetak" placeholder="Vreme završetka ispita" class="form-control" >
                </div>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="boja">Boja pozadine</label>
                <input type="color" name="boja" class="form-control">
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Objavi</button>
            </div>
        </form>
    </div>
</div>
{{-- DIALOG END --}}

</div>
<script>
    function prikazi(dugme){
        if(dugme.value==2){
            document.getElementById('vremeBox').classList.remove('d-none');
        } else {
            document.getElementById('vremeBox').classList.add('d-none');
        }
    }
</script>

<script>

// TO DO: Implementirati putem vec kreirane biblioteke sa githaba ili neceg slicnog posto ovako zahteva jQuery koji ne bih zeleo da koristim
// $(document).ready(function(){
//     var calendar = $('#calendar').fullCalendar({
//         locale: 'sr-ME',
//         initialView: 'dayGridMonth',
//         editable: true,
//         selectable: true,
//         yearColumns: 1,

//         // themeSystem: 'bootstrap',
//         headerToolbar: {
//             left: 'prev,next today',
//             center: 'title',
//             right: 'year,dayGridMonth,timeGridWeek,timeGridDay'
//         },
//         dayClick:function(date,event,view){
//             calendarEl.dialog({
//                 title: 'Dodavanje Ispita \ Kolokvijuma',
//                 width: 600,
//                 height: 600,
//                 modal:true,
//                 show: {effect: 'clip', duration:350},
//                 hide: {effect:'clip',duration:250}
//             })
//         }
//     })
// });
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'sr-ME',
        initialView: 'dayGridMonth',
        editable: true,
        selectable: true,
        // themeSystem: 'bootstrap',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        dayClick(date,event,view){
            calendarEl.dialog({
                title: 'Dodavanje Ispita \ Kolokvijuma',
                width: 600,
                height: 600,
                modal:true,
                show: {effect: 'clip', duration:350},
                hide: {effect:'clip',duration:250}
            })
        }
      });
      calendar.render();
    });

</script>

@endsection
