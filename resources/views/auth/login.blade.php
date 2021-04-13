@extends('layouts.app')

@section('title','Login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class='row justify-content-center my-4 '>
                <img class="img-fluid" style="filter:drop-shadow(3px 3px 15px white)" src="{{asset('/images/logo.png')}}">
            </div>
            <div class="card border border-primary bg-light rounded-lg shadow-lg">
                <div class='row justify-content-center my-4 '>
                    <h3 class="font-weight-bold text-dark" style="text-shadow: 5px 5px 10px lightgray">EVIDENCIJA STUDENATA</h3>
                </div>
                <br>

                <div class="row justify-content-center">
                    <div class='col-8 '>
                        @if(!empty($poruka))
                        @section('poruka')
                        <div class="justify-content-center">
                            <div class="alert alert-danger shadow" id="poruka">
                                <?php echo $poruka ?>
                            </div>
                        </div>
                        @show
                        @endif
                        @if(session('login'))
                        <div class="justify-content-center">
                            <div class="alert alert-{{session('login')[0]}} shadow" id="login">
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
                                <input type="submit" role="button" class="btn btn-primary shadow border border-dark rounded"
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
