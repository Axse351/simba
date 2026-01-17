@extends('welcome')

@section('title', 'Dashboard Bidan')

@section('content')
    <div class="section-header">
        <h1>Dashboard Bidan</h1>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-user-nurse"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Ibu Hamil</h4>
                    </div>
                    <div class="card-body">
                        120
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-baby"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Balita</h4>
                    </div>
                    <div class="card-body">
                        85
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
