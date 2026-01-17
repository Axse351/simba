@extends('welcome')

@section('title', 'Data Anak')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Anak</h1>
            <div class="section-header-button">
                <a href="{{ route('desa.anak.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Anak
                </a>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="section-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Daftar Anak</h4>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anak</th>
                                <th>Ibu</th>
                                <th>JK</th>
                                <th>Tgl Lahir</th>
                                <th>Anak Ke</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($anak as $item)
                                <tr>
                                    <td>{{ $loop->iteration + $anak->firstItem() - 1 }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->ibu->nama ?? '-' }}</td>
                                    <td>{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d-m-Y') }}</td>
                                    <td>{{ $item->anak_ke }}</td>
                                    <td>
                                        <a href="{{ route('desa.anak.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            Edit
                                        </a>

                                        <form action="{{ route('desa.anak.destroy', $item->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        Data anak belum tersedia
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer text-right">
                    {{ $anak->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
