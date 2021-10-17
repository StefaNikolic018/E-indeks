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
    {{-- JUMBOTRON START --}}
    <div class="jumbotron jumbotron-fluid py-2 px-2 rounded bg-gradient-white border border-dark shadow-lg mb-2">
        <div class="container border border-secondary rounded shadow bg-gradient-light py-2">
            <h3 style="text-shadow: 2px 2px lightgray" class="font-weight-bold"><i class="far fa-calendar-alt"></i> Raspored Kolokvijuma\Ispita
            </h3>

            <p class="lead">U ovoj sekciji se upravlja rasporedom kolokvijuma i ispita
        </div>
    </div>
    {{-- JUMBOTRON END --}}
    {{-- CALENDAR START --}}
    <div id="calendar" class="bg-info p-3 border border-dark rounded shadow-lg"></div>
    {{-- CALENDAR END --}}
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Dodajte događaj</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('novi_dogadjaj')}}" method="POST" id="forma">
                @csrf
                <div class="form-group">
                    <label class="font-weight-bold" for="naslov">Naslov</label>
                    <input type="text" name="naslov" class="form-control @error("naslov") is-invalid @enderror" id="naslov" placeholder="Unesite naslov događaja"  oninvalid="this.setCustomValidity("Molimo unesite naslov!")" oninput="setCustomValidity("")" required>
                    @error("naslov")
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="predmet">Predmet</label>
                    <select class="form-control custom-select mr-sm-2 @error("predmet") is-invalid @enderror" id="predmet" name="predmet" oninvalid="this.setCustomValidity("Molimo izaberite predmet!")" oninput="setCustomValidity("")">
                        <option value="" id="izborPredmeta">Izaberite predmet</option>
                        @foreach($predmeti as $predmet)
                            <option value="{{$predmet->id}}" id="{{$predmet->id}}" >{{$predmet->naziv}}</option>
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
                        <option value="" id="izborGodine">Izaberite godinu studija</option>
                        @for($i=1;$i<4;$i++)
                            <option value="{{$i}}" id="{{$i}}">{{$i}}. godina</option>
                        @endfor
                    </select>
                    @error("godina_studija")
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="vreme">Kolokvijum \ Ispit</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="izbor" onclick="menjajBoju(this)" id="Ispit" value="Ispit" checked>
                        <label class="form-check-label" for="vreme2">
                        Ispit &nbsp;<span class="pl-3" style="background-color:#DB5461"></span>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="izbor" onclick="menjajBoju(this)" id="Kolokvijum" value="Kolokvijum">
                        <label class="form-check-label" for="vreme1">
                        Kolokvijum &nbsp;<span class="pl-3" style="background-color:#592E83"></span>
                        </label>
                    </div>
                    @error("izbor")
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                {{-- <div class="form-group">
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
                </div> --}}
                <div class="form-group d-none" id="vremeBox">
                    <div class="form-group">
                        <label class="font-weight-bold" for="pocetak">Vreme početka</label>
                        <input type="text" name="pocetak" id="pocetak" placeholder="Vreme početka ispita" class="form-control" >
                        @error("pocetak")
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="zavrsetak">Vreme završetka</label>
                        <input type="text" name="zavrsetak" id="zavrsetak" placeholder="Vreme završetka ispita" class="form-control" >
                        @error("zavrsetak")
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="boja">Boja pozadine</label>
                    <input type="color" name="boja1" class="form-control" id="boja1" disabled="1" value="#DB5461">
                    <p class="text-muted">Menja se prilikom izbora događaja(Ispit \ Kolokvijum)</p>
                    @error("boja")
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Objavi</button>

                </div>
                <input type="color" name="boja" class="form-control" id="boja" value="#DB5461" hidden>
                <input type="text" name="ceo_dan" id="ceo_dan" value="true" hidden>
            </form>
            <div class="form-group text-center">
                <button class="btn btn-outline-dark d-none brisanje" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-trash-alt"
                        style="color:red"></i>
                    Obriši
                </button>
            </div>
            <!-- Modal delete -->
            <div class="modal fade brisanjeModal shadow-lg" id="exampleModal"
                tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title text-center text-dark"
                                id="exampleModalLabel">Brisanje
                                događaja
                            </h5>
                            <button type="button" class="close"
                                data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center font-weight-bold" id="modalTelo">

                        </div>
                        <div
                            class="modal-footer justify-content-center">
                            <form
                                action=""
                                method="POST" id="formaBrisanje">
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
            {{-- Modal delete end --}}
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
{{-- @if(!empty(Session::get('dogadjaj_error')) && Session::get('dogadjaj_error') == '1')
<script>
$(function() {
    $('#exampleModal').modal('show');
});
</script>
@endif --}}
<script>
    // function prikazi(dugme){
    //     if(dugme.value==2){
    //         document.getElementById('vremeBox').classList.remove('d-none');
    //     } else {
    //         document.getElementById('vremeBox').classList.add('d-none');
    //     }
    // }
    // add the responsive classes after page initialization
    window.onload = function () {
        $('.fc-toolbar.fc-header-toolbar').addClass('row col-lg-12');
        // $('.fc-event-title').css('word-wrap','break-all');
        // $('.fc-event-title-container').addClass('text-break')
        // document.querySelector('.fc-event-title').style.wordWrap='break-all';
        // $('.fc-event-title').setAttribute('style','white-space:pre-line');
    };

    // add the responsive classes when navigating with calendar buttons
    $(document).on('click', '.fc-button', function(e) {
        $('.fc-toolbar.fc-header-toolbar').addClass('row col-lg-12');
    });
    function menjajBoju(izbor){
        if(izbor.value=='Ispit'){
            document.getElementById('boja1').setAttribute('value','#DB5461');
            document.getElementById('boja').setAttribute('value','#DB5461');
        } else {
            document.getElementById('boja1').setAttribute('value','#592E83');
            document.getElementById('boja').setAttribute('value','#592E83');
        }
    }

</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'bootstrap',
        locale: 'sr-ME',
        initialView: 'dayGridMonth',
        editable: true,
        droppable: true,
        selectable: true,
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
        // TODO: Alertuje kao da je uspesno, ali u bazi nema promene, resiti to
        eventDrop: function(eventDropInfo){
            let izmenaUrl = "{{route('izmena_dogadjaja',':id')}}";
            izmenaUrl = izmenaUrl.replace(':id',eventDropInfo.event.id);
            $.ajax({
                type: 'POST',
                url: izmenaUrl,
                data:{
                    id:eventDropInfo.event.id,
                    pocetak:eventDropInfo.event.start.toLocaleString('sr-RS'),
                    zavrsetak:eventDropInfo.event.end.toLocaleString('sr-RS')
                },
                // 'id='+eventDropInfo.event.id+'&pocetak='+eventDropInfo.event.start.toLocaleString('sr-RS')+'&zavrsetak='+eventDropInfo.event.end.toLocaleString('sr-RS'),
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success:function(){
                    document.getElementById('izmenaUspeh').classList.remove('d-none');
                    $("#izmenaUspeh").fadeTo(2000, 500).slideUp(500, function(){
                        $("#izmenaUspeh").slideUp(500);
                    });
                    let html='<div class="row justify-content-center d-none" id="izmenaUspeh">';
                    html+='<div class="col-lg-6 col-md-6 col-sm-12">';
                    html+='<div class="alert alert-success">';
                    html+='Uspešno pomeren događaj!';
                    html+='</div>';
                    html+='</div>';
                    html+='</div>';
                    document.getElementById('kontejner').insertAdjacentHTML('beforeBegin',html);
                },error:function(){
                    document.getElementById('izmenaGreska').classList.remove('d-none');
                    $("#izmenaGreska").fadeTo(2000, 500).slideUp(500, function(){
                        $("#izmenaGreska").slideUp(500);
                    });
                    let html='<div class="row justify-content-center d-none" id="izmenaGreska">';
                    html+='<div class="col-lg-6 col-md-6 col-sm-12">';
                    html+='<div class="alert alert-danger">';
                    html+='Došlo je do greške, pokušajte ponovo!';
                    html+='</div>';
                    html+='</div>';
                    html+='</div>';
                    document.getElementById('kontejner').insertAdjacentHTML('beforeBegin',html);
                }
            });
        },
        select: function(selectInfo){
            if(document.getElementById('exampleModal').classList.contains('show')){
                $('#exampleModal').modal('hide');
            } else {
                $('#exampleModal').modal('show');
                    document.getElementById('pocetak').setAttribute('value',selectInfo.start.toLocaleString('sr-RS'));
                    document.getElementById('zavrsetak').setAttribute('value',selectInfo.end.toLocaleString('sr-RS'));
                    document.querySelector('.modal-title').innerHTML="Novi događaj";
                    document.getElementById('forma').setAttribute('action','{{route("novi_dogadjaj")}}');
                    document.getElementById('naslov').setAttribute('value',"")
                    let options = document.getElementsByTagName('option');
                    for(let i=0;i<options.length;i++){
                        options[i].removeAttribute('selected');
                    }
                    document.getElementById('izborPredmeta').setAttribute('selected','selected');
                    document.getElementById('izborGodine').setAttribute('selected','selected');
                    $('#Ispit').trigger('click');
                    document.getElementById('boja').setAttribute('value','#DB5461');
                    document.getElementById('boja1').setAttribute('value','#DB5461');
                    // Vracanje modala na pocetno stanje
                    if(!document.querySelector('.brisanje').classList.contains('d-none')){
                        document.querySelector('.brisanje').classList.add('d-none');
                        document.querySelector('.brisanje').setAttribute('data-target','#exampleModal');
                        document.querySelector('.brisanjeModal').setAttribute('id','exampleModal');
                        document.getElementById('modalTelo').innerHTML='Da li stvarno želite da izbrišete događaj ?';
                        document.getElementById('formaBrisanje').setAttribute('action','');
                    }
                    if(selectInfo.allDay){
                        document.getElementById('vremeBox').classList.add('d-none');
                        document.getElementById('ceo_dan').setAttribute('value','true');
                    } else {
                        document.getElementById('vremeBox').classList.remove('d-none');
                        document.getElementById('ceo_dan').setAttribute('value','false');
                    }
            }
        },
        dateClick: function(dateClickInfo){
            if(document.getElementById('exampleModal').classList.contains('show')){
                $('#exampleModal').modal('hide');
            } else {
                $('#exampleModal').modal('show');
                    document.getElementById('pocetak').setAttribute('value',dateClickInfo.start.toLocaleString('sr-RS'));
                    document.getElementById('zavrsetak').setAttribute('value',dateClickInfo.end.toLocaleString('sr-RS'));
                    document.querySelector('.modal-title').innerHTML="Novi događaj";
                    document.getElementById('forma').setAttribute('action','{{route("novi_dogadjaj")}}');
                    document.getElementById('naslov').setAttribute('value',"")
                    let options = document.getElementsByTagName('option');
                    for(let i=0;i<options.length;i++){
                        options[i].removeAttribute('selected');
                    }
                    document.getElementById('izborPredmeta').setAttribute('selected','selected');
                    document.getElementById('izborGodine').setAttribute('selected','selected');
                    // Mora ovako
                    $("#Ispit").trigger('click');
                    document.getElementById('boja').setAttribute('value','#DB5461');
                    document.getElementById('boja1').setAttribute('value','#DB5461');
                    // Vracanje modala na pocetno stanje
                    if(!document.querySelector('.brisanje').classList.contains('d-none')){
                        document.querySelector('.brisanje').classList.add('d-none');
                        document.querySelector('.brisanje').setAttribute('data-target','#exampleModal');
                        document.querySelector('.brisanjeModal').setAttribute('id','exampleModal');
                        document.getElementById('modalTelo').innerHTML='Da li stvarno želite da izbrišete događaj ?';
                        document.getElementById('formaBrisanje').setAttribute('action','');
                    }
                    if(dateClickInfo.allDay){
                        document.getElementById('vremeBox').classList.add('d-none');
                        document.getElementById('ceo_dan').setAttribute('value','true');
                    } else {
                        document.getElementById('vremeBox').classList.remove('d-none');
                        document.getElementById('ceo_dan').setAttribute('value','false');
                    }
            }
        },
        eventClick: function(info){
            if(document.getElementById('exampleModal').classList.contains('show')){
                $('#exampleModal').modal('hide');
            } else {
                $('#exampleModal').modal('show');
                document.getElementById('pocetak').setAttribute('value',info.event.start.toLocaleString('sr-RS'));
                document.getElementById('zavrsetak').setAttribute('value',info.event.end.toLocaleString('sr-RS'));
                document.getElementById('naslov').setAttribute('value',info.event.title);
                document.querySelector('.modal-title').innerHTML="Izmenite događaj";
                let izmenaUrl = "{{route('izmena_dogadjaja',':id')}}";
                izmenaUrl = izmenaUrl.replace(':id',info.event.id);
                document.getElementById('forma').setAttribute('action',izmenaUrl);
                document.getElementById(info.event.extendedProps['predmet']).setAttribute('selected','selected');
                document.getElementById(info.event.extendedProps['godina_studija']).setAttribute('selected','selected');
                $('#'+info.event.extendedProps['izbor']).trigger('click');
                document.getElementById('boja').setAttribute('value',info.event.backgroundColor);
                document.getElementById('boja1').setAttribute('value',info.event.backgroundColor);
                document.querySelector('.brisanje').classList.remove('d-none');
                document.querySelector('.brisanje').setAttribute('data-target','#exampleModal'+info.event.id);
                document.querySelector('.brisanjeModal').setAttribute('id','exampleModal'+info.event.id);
                document.getElementById('modalTelo').innerHTML='Da li stvarno želite da izbrišete događaj "'+info.event.title+'" ?';
                let deleteUrl = "{{route('brisanje_dogadjaja',':id')}}";
                deleteUrl = deleteUrl.replace(':id',info.event.id);
                document.getElementById('formaBrisanje').setAttribute('action',deleteUrl);
                document.getElementById('vremeBox').classList.remove('d-none');
                if(info.event.allDay){
                        document.getElementById('ceo_dan').setAttribute('value','true');
                } else {
                        document.getElementById('ceo_dan').setAttribute('value','false');
                }

            }
        }
      });
      calendar.render();
    });

</script>

@endsection
