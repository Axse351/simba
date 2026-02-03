@extends('welcome')

@section('title', 'Dashboard User')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        {{-- INFO SELAMAT DATANG --}}
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <h5>Selamat Datang, {{ Auth::user()->name }}!</h5>
                        <p class="text-muted">
                            Pantau informasi kesehatan dan perkembangan keluarga Anda melalui sistem ini.
                        </p>
                        <div class="alert alert-info">
                            <i class="fas fa-robot"></i>
                            <strong>Ada yang ingin ditanyakan?</strong>
                            Klik tombol chat di pojok kanan bawah untuk konsultasi dengan asisten kesehatan virtual kami!
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ARTIKEL KESEHATAN TERBARU --}}
        <div class="card">
            <div class="card-header">
                <h4>Artikel Kesehatan Terbaru</h4>
                <div class="card-header-action">
                    <a href="{{ route('user.artikel.index') }}" class="btn btn-primary">
                        Lihat Semua Artikel
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    @forelse ($artikel as $item)
                        <div class="col-md-4 col-sm-6">
                            <div class="card card-primary">
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

                                <div class="card-body">
                                    <h6 class="font-weight-bold">
                                        {{ $item->judul }}
                                    </h6>

                                    <small class="text-muted">
                                        <i class="fas fa-calendar"></i>
                                        {{ \Carbon\Carbon::parse($item->published_at)->format('d M Y') }}
                                    </small>

                                    <p class="mt-2">
                                        {{ Str::limit(strip_tags($item->konten), 100) }}
                                    </p>

                                    <a href="{{ route('user.artikel.show', $item->id) }}"
                                       class="btn btn-sm btn-outline-primary btn-block">
                                        <i class="fas fa-book-reader"></i> Baca Selengkapnya
                                    </a>
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

    {{-- Include Chatbot Widget --}}
    @include('components.chatbot-widget')
@endsection
