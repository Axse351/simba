@extends('welcome')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data KMS Anak</h1>
            <div class="section-header-button">
                <a href="{{ route('kms-anak.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Pemeriksaan
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Anak</th>
                            <th>Tanggal</th>
                            <th>Usia (bln)</th>
                            <th>BB (kg)</th>
                            <th>TB (cm)</th>
                            <th>Status Gizi</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->anak->nama ?? '-' }}</td>
                                <td>{{ $item->tanggal_pemeriksaan }}</td>
                                <td>{{ $item->usia_bulan }}</td>
                                <td>{{ $item->berat_badan }}</td>
                                <td>{{ $item->tinggi_badan }}</td>
                                <td>
                                    BB/U: {{ $item->status_bb_u ?? '-' }} <br>
                                    TB/U: {{ $item->status_tb_u ?? '-' }}
                                </td>
                                <td>
                                    <a href="{{ route('kms-anak.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('kms-anak.destroy', $item->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Hapus data ini?')">
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
                                <td colspan="8" class="text-center">
                                    Data belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
