@extends('welcome')

@section('title', 'Dashboard Petugas Desa')

@section('content')
    <div class="section-header">
        <h1>Dashboard Petugas Desa</h1>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Warga</h4>
                    </div>
                    <div class="card-body">
                        350
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Laporan Masuk</h4>
                    </div>
                    <div class="card-body">
                        27
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
