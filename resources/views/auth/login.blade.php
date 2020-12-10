@extends('layouts.app')

@section('title','Login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class='row justify-content-center my-4 '>
                <img class="img-fluid" style="filter:drop-shadow(2px 2px 5px gray)" src="{{asset('/images/logo.png')}}">
            </div>
            <div class="card border bg-light rounded-lg shadow-lg">
                <div class='row justify-content-center my-4 '>
                    <h3 class="font-weight-bold " style="text-shadow: 2px 2px lightgray">Evidencija studenata</h3>
                </div>
                <br>

                <div class="row justify-content-center">
                    <div class='col-lg-6 col-xs-12'>
                        @if(!empty($poruka))
                        @section('poruka')
                        <div class="justify-content-center">
                            <div class="alert alert-danger shadow">
                                <?php echo $poruka ?>
                            </div>
                        </div>
                        @show
                        @endif
                        @if(session('login'))
                        <div class="justify-content-center">
                            <div class="alert alert-{{session('login')[0]}} shadow">
                                {{session('login')[1]}}
                            </div>
                        </div>
                        @endif
                        <form action="{{route('login')}}" method="POST">
                            @csrf
                            <!-- email -->

                            <div class="form-group">
                                <label for="email">{{ __('E-Mail Adresa') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required
                                    oninvalid="this.setCustomValidity('Molimo unesite email!')"
                                    oninput="setCustomValidity('')" autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <!-- password -->
                            <div class="form-group">
                                <label for="password">{{ __('Lozinka') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required oninvalid="this.setCustomValidity('Molimo unesite lozinku!')"
                                    oninput="setCustomValidity('')" autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            {{-- BUTTON --}}
                            <div class="row justify-content-center my-5">
                                <input type="submit" role="button" class="btn btn-primary shadow font-weight-bold"
                                    value="Prijavi se"></input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection