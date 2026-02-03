@extends('welcome')

@section('title', 'Artikel Kesehatan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Artikel Kesehatan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('user.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active">Artikel Kesehatan</div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Daftar Artikel Kesehatan</h4>
            </div>

            <div class="card-body">
                <div class="row">
                    @forelse ($artikel as $item)
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card card-primary h-100">
                                {{-- Foto Artikel --}}
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                         class="card-img-top"
                                         alt="{{ $item->judul }}"
                                         style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                         style="height: 200px;">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                @endif

                                <div class="card-body d-flex flex-column">
                                    <h6 class="font-weight-bold">
                                        {{ $item->judul }}
                                    </h6>

                                    <div class="mb-2">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar"></i>
                                            {{ \Carbon\Carbon::parse($item->published_at)->format('d M Y') }}
                                        </small>
                                    </div>

                                    <p class="flex-grow-1">
                                        {{ Str::limit(strip_tags($item->konten), 120) }}
                                    </p>

                                    <div class="mt-auto">
                                        <a href="{{ route('user.artikel.show', $item->id) }}"
                                           class="btn btn-sm btn-outline-primary btn-block">
                                            <i class="fas fa-book-reader"></i> Baca Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                <i class="fas fa-info-circle"></i>
                                Belum ada artikel kesehatan yang dipublikasikan
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            @if($artikel->hasPages())
                <div class="card-footer text-right">
                    {{ $artikel->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
