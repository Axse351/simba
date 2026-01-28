@extends('welcome')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kelola Jadwal Posyandu</h1>
            <div class="section-header-button">
                <a href="{{ route('desa.jadwal-posyandu.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Jadwal
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Lokasi</th>
                            <th>Keterangan</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwal as $item)
                            <tr>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->waktu }}</td>
                                <td>{{ $item->lokasi }}</td>
                                <td>{{ $item->keterangan ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('desa.jadwal-posyandu.edit', $item->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('desa.jadwal-posyandu.destroy', $item->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin hapus jadwal ini?')">
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
                                <td colspan="5" class="text-center">Data jadwal belum ada</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
