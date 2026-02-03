@extends('welcome')

@section('title', 'Detail Artikel')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Artikel</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('user.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('user.artikel.index') }}">Artikel Kesehatan</a>
                </div>
                <div class="breadcrumb-item active">Detail</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- Judul Artikel --}}
                        <h2 class="mb-3">{{ $artikel->judul }}</h2>

                        {{-- Info Tanggal --}}
                        <div class="mb-4">
                            <span class="badge badge-primary">
                                <i class="fas fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($artikel->published_at)->format('d F Y') }}
                            </span>
                        </div>

                        {{-- Foto Artikel --}}
                        @if($artikel->foto)
                            <div class="mb-4 text-center">
                                <img src="{{ asset('storage/' . $artikel->foto) }}"
                                     alt="{{ $artikel->judul }}"
                                     class="img-fluid rounded shadow-sm"
                                     style="max-height: 500px; width: auto;">
                            </div>
                        @endif

                        {{-- Konten Artikel --}}
                        <div class="artikel-content">
                            {!! nl2br(e($artikel->konten)) !!}
                        </div>

                        {{-- Tombol Kembali --}}
                        <div class="mt-4">
                            <a href="{{ route('user.artikel.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Artikel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .artikel-content {
        font-size: 16px;
        line-height: 1.8;
        text-align: justify;
        color: #333;
    }

    .artikel-content p {
        margin-bottom: 1rem;
    }
</style>
@endpush
