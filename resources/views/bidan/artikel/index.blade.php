@extends('welcome')

@section('title', 'Artikel Kesehatan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Artikel Kesehatan</h1>
            <div class="section-header-button">
                <a href="{{ route('artikel.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Artikel
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>Daftar Artikel</h4>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($artikel as $item)
                            <tr>
                                <td>{{ $loop->iteration + $artikel->firstItem() - 1 }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>
                                    @if ($item->status == 'published')
                                        <span class="badge badge-success">Publish</span>
                                    @else
                                        <span class="badge badge-warning">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->published_at ? $item->published_at->format('d-m-Y') : '-' }}
                                </td>
                                <td>
                                    <a href="{{ route('bidan.artikel.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('bidan.artikel.destroy', $item->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Hapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    Belum ada artikel
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer text-right">
                {{ $artikel->links() }}
            </div>
        </div>
    </section>
@endsection
