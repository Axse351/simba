@extends('welcome')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>KMS Ibu</h1>
        <div class="section-header-button">
            <a href="{{ route('kms-ibu.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Ibu</th>
                            <th>Tanggal</th>
                            <th>BB (kg)</th>
                            <th>TB (cm)</th>
                            <th>IMT</th>
                            <th>Status Gizi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->warga->nama }}</td>
                            <td>{{ $item->tanggal_pemeriksaan }}</td>
                            <td>{{ $item->berat_badan ?? '-' }}</td>
                            <td>{{ $item->tinggi_badan ?? '-' }}</td>
                            <td>{{ $item->imt ?? '-' }}</td>
                            <td>
                                <span class="badge badge-info">
                                    {{ $item->status_gizi ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('kms-ibu.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('kms-ibu.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus data?')" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if($data->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center">Data belum tersedia</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection