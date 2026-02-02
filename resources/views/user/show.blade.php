@extends('welcome')

@section('title', $artikel->judul)

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>{{ $artikel->judul }}</h4>
            </div>

            <div class="card-body">
                <small class="text-muted">
                    Dipublish:
                    {{ \Carbon\Carbon::parse($artikel->published_at)->format('d M Y') }}
                </small>

                <hr>

                {!! $artikel->konten !!}
            </div>

            <div class="card-footer">
                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </div>
    </section>
@endsection
