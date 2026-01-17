@extends('welcome')

@section('title', 'Dashboard User')

@section('content')
    <div class="section-header">
        <h1>Dashboard User</h1>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Akun</h4>
                </div>
                <div class="card-body">
                    <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                    <p><strong>Role:</strong> {{ auth()->user()->role }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
