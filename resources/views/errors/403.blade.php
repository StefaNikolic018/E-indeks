@extends('layouts.app')

@section('title', __('Nemate ovlašćenje'))
@section('content')

<div class="container">
    <div class="row text-center justify-content-center align-content-center">

        <div class="col-lg-6 col-md-8 col-sm-12">
            <div class="alert alert-danger">
                <h1>Nemate ovlašćenje da pristupite resursima ove stranice <i class="fas fa-sad-tear"></i></h1>
                <br>
                <a class="btn btn-primary font-weight-bold" href={{redirect()->back()}}><i
                        class="fas fa-arrow-circle-left"></i> Nazad</a>
            </div>
        </div>
    </div>
</div>


@endsection
