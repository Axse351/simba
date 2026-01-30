@extends('welcome')

@section('title', 'Data Warga')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Warga</h1>
            <div class="section-header-button">
                @if (auth()->user()->role === 'desa')
                    <a href="{{ route('desa.warga.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Warga
                    </a>
                @endif
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Warga (Ibu)</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>JK</th>
                                    <th>TTL</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wargas as $warga)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $warga->nik }}</td>
                                        <td>{{ $warga->nama }}</td>
                                        <td>{{ $warga->jenis_kelamin }}</td>
                                        <td>{{ $warga->tempat_lahir }}, {{ $warga->tanggal_lahir }}</td>
                                        <td>
                                            {{ $warga->alamat }},
                                            RT {{ $warga->rt }}/RW {{ $warga->rw }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $warga->status === 'aktif' ? 'success' : 'danger' }}">
                                                {{ ucfirst($warga->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('desa.warga.edit', $warga->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="float-right">
                        {{ $wargas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
