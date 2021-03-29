@extends('layouts.app')
@section('title','Raspored Ispita\Kolokvijuma')

@section('content')
<div class="container" id="kontejner">
    {{-- ALERT MESSAGES START --}}
    <div class="row justify-content-center d-none" id="izmenaUspeh">
        <div class='col-lg-6 col-md-6 col-sm-12'>
            <div class="alert alert-success">
                Uspešno pomeren događaj!
            </div>
        </div>
    </div>
    <div class="row justify-content-center d-none" id="izmenaGreska">
        <div class='col-lg-6 col-md-6 col-sm-12'>
            <div class="alert alert-danger">
                Došlo je do greške, pokušajte ponovo!
            </div>
        </div>
    </div>
    @if(session('raspored_ispita'))
    <div class="row justify-content-center">
        <div class='col-lg-6 col-md-6 col-sm-12'>
            <div class="alert alert-{{ session('raspored_ispita')[0] }}" id="raspored_ispita">
                {{ session('raspored_ispita')[1] }}</div>
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
    {{-- CALENDAR START --}}
    <div id="calendar" class="bg-info p-3 border border-dark rounded shadow-lg"></div>
    {{-- CALENDAR END --}}
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center">Događaj</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <ul class="list-group">
                <li class="list-group-item">Predmet: <span class="predmet font-weight-bold"></span> </li>
                <li class="list-group-item">Godina studija: <span class="godina_studija font-weight-bold"></span></li>
                <li class="list-group-item" id="vrsta">Vrsta: <span class="vrsta font-weight-bold"></span></li>
                <li class="list-group-item">Početak: <span class="pocetak font-weight-bold"></span></li>
                <li class="list-group-item">Završetak: <span class="zavrsetak font-weight-bold"></span></li>
            </ul>
        </div>
      </div>
    </div>
  </div>
        {{-- ALERT MESSAGES END --}}

</div>
<style>
    /* TO DO: SATNICA SE NE VIDI OD TACKE KADA JE RESPONSIVE */
    @media screen and (max-width: 414px){
        .fc-event-title-container div:first-child {
            white-space: pre-line;
            overflow: scroll !important;
        }
        .fc-daygrid-event-harness a {
            white-space: pre-line !important;
            overflow: scroll !important;
        }
    }

</style>
<script>
    // add the responsive classes after page initialization
    window.onload = function () {
        $('.fc-toolbar.fc-header-toolbar').addClass('row col-lg-12');
    };

    // add the responsive classes when navigating with calendar buttons
    $(document).on('click', '.fc-button', function(e) {
        $('.fc-toolbar.fc-header-toolbar').addClass('row col-lg-12');
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'bootstrap',
        locale: 'sr-ME',
        initialView: 'dayGridMonth',
        windowResize: function(view) {
            if ($(window).width() < 514){
                let dot=document.querySelector('.fc-daygrid-event-dot');
                let time=document.querySelector('.fc-event-time')
                document.querySelector('.fc-daygrid-event-dot').remove();
                document.querySelector('.fc-event-time').remove();
                document.querySelector('.fc-event-title').insertAdjacentHTML('afterBegin',dot);
                document.querySelector('.fc-event-title').insertAdjacentHTML('afterBegin',time);
                calendar.changeView( 'timeGridWeek' );
            } else {
                calendar.changeView( 'dayGridMonth' );
            }
        },
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        //TODO: POKUSATI RESPONSIVE EVENTS ZA MOBILNI
        eventDidMount: function(info) {
            let opis = "<span style='text-decoration: underline "+info.event.backgroundColor+"'>"+info.event.extendedProps['izbor']+'</span> <br/>'+"<span style='text-decoration: underline'>"+info.event.extendedProps['godina_studija']+'. godina </span> <br/><span>"'+info.event.extendedProps['naziv_predmeta']+'"</span>';
            opis=" <div class='bg-light text-dark p-2 border text-center border-dark rounded shadow-lg' style='white-space:pre-line; overflow:scroll;'><b>" + opis + "</b></div>";
            // document.querySelector('.fc-event-title').setAttribute('style','word-wrap:break-word !important')

            info.el.querySelector('.fc-event-title').setAttribute('data-toggle', 'tooltip');
            info.el.querySelector('.fc-event-title').setAttribute('data-html', 'true');
            info.el.querySelector('.fc-event-title').setAttribute('title', opis);
            // info.el.querySelector('.fc-event-title').insertAdjacentHTML('beforeend', opis);
        },
        events:[
        @foreach ($dogadjaji as $dogadjaj)
            {
                id: "{{ $dogadjaj->id }}",
                title: "{{ $dogadjaj->naslov }}",
                start: (new Date("{{$dogadjaj->pocetak }}").toISOString()),
                end: (new Date("{{ $dogadjaj->zavrsetak }}").toISOString()),
                backgroundColor: "{{ $dogadjaj->boja }}",
                predmet: "{{ $dogadjaj->predmet }}",
                naziv_predmeta: "{{$dogadjaj->predmeti->naziv}}",
                godina_studija: "{{ $dogadjaj->godina_studija }}",
                izbor: " {{ $dogadjaj->izbor }}".replace(' ',''),
                @if($dogadjaj->ceo_dan=='true')
                    allDay: " {{ $dogadjaj->ceo_dan}}",
                @endif
            },
        @endforeach
        ],
        eventClick: function(info){
            if(document.getElementById('exampleModal').classList.contains('show')){
                $('#exampleModal').modal('hide');
            } else {
                $('#exampleModal').modal('show');
                document.querySelector('.modal-header').style.backgroundColor=info.event.backgroundColor;
                document.querySelector('.modal-title').innerHTML=info.event.title;
                document.querySelector('.predmet').innerHTML=info.event.extendedProps['naziv_predmeta'];
                document.querySelector('.godina_studija').innerHTML=info.event.extendedProps['godina_studija']+'.';
                document.querySelector('.vrsta').innerHTML=info.event.extendedProps['izbor'];
                document.querySelector('.pocetak').innerHTML=info.event.start.toLocaleString('sr');
                document.querySelector('.zavrsetak').innerHTML=info.event.end.toLocaleString('sr');
            }
        }
      });
      calendar.render();
    });

</script>

@endsection
