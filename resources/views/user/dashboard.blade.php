@extends('welcome')

@section('title', 'Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        {{-- ARTIKEL KESEHATAN --}}
        <div class="card">
            <div class="card-header">
                <h4>Artikel Kesehatan</h4>
            </div>

            <div class="card-body">
                <div class="row">
                    @forelse ($artikel as $item)
                        <div class="col-md-4">
                            <div class="card card-primary">
                                <div class="card-body">
                                    <h6 class="font-weight-bold">
                                        {{ $item->judul }}
                                    </h6>

                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($item->published_at)->format('d M Y') }}
                                    </small>

                                    <p class="mt-2">
                                        {{ Str::limit(strip_tags($item->konten), 100) }}
                                    </p>

                                    <a href="{{ route('artikel.show', $item->id) }}" class="btn btn-sm btn-outline-primary">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>Belum ada artikel kesehatan</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="card-footer text-right">
                {{ $artikel->links() }}
            </div>
        </div>
    </section>
@endsection
