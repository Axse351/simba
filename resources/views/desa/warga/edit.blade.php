@extends('welcome')

@section('title', 'Edit Data Warga')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Edit Data Warga</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('desa.warga.update', $warga->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- NIK --}}
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
                            value="{{ old('nik', $warga->nik) }}" required>
                        @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama --}}
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $warga->nama) }}"
                            required>
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="L"
                                {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="P"
                                {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                    </div>

                    {{-- Tempat Lahir --}}
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control"
                            value="{{ old('tempat_lahir', $warga->tempat_lahir) }}" required>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control"
                            value="{{ old('tanggal_lahir', $warga->tanggal_lahir) }}" required>
                    </div>

                    {{-- Alamat --}}
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $warga->alamat) }}</textarea>
                    </div>

                    {{-- RT / RW --}}
                    <div class="row">
                        <div class="col-md-6">
                            <label>RT</label>
                            <input type="text" name="rt" class="form-control" value="{{ old('rt', $warga->rt) }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label>RW</label>
                            <input type="text" name="rw" class="form-control" value="{{ old('rw', $warga->rw) }}"
                                required>
                        </div>
                    </div>

                    {{-- Desa --}}
                    <div class="form-group mt-3">
                        <label>Desa</label>
                        <input type="text" name="desa" class="form-control" value="{{ old('desa', $warga->desa) }}"
                            required>
                    </div>

                    {{-- Kecamatan --}}
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <input type="text" name="kecamatan" class="form-control"
                            value="{{ old('kecamatan', $warga->kecamatan) }}" required>
                    </div>

                    {{-- Kabupaten --}}
                    <div class="form-group">
                        <label>Kabupaten</label>
                        <input type="text" name="kabupaten" class="form-control"
                            value="{{ old('kabupaten', $warga->kabupaten) }}" required>
                    </div>

                    {{-- Provinsi --}}
                    <div class="form-group">
                        <label>Provinsi</label>
                        <input type="text" name="provinsi" class="form-control"
                            value="{{ old('provinsi', $warga->provinsi) }}" required>
                    </div>

                    {{-- No HP --}}
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="no_hp" class="form-control"
                            value="{{ old('no_hp', $warga->no_hp) }}">
                    </div>

                    {{-- Status --}}
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="aktif" {{ old('status', $warga->status) == 'aktif' ? 'selected' : '' }}>
                                Aktif
                            </option>
                            <option value="pindah" {{ old('status', $warga->status) == 'pindah' ? 'selected' : '' }}>
                                Pindah
                            </option>
                            <option value="meninggal" {{ old('status', $warga->status) == 'meninggal' ? 'selected' : '' }}>
                                Meninggal
                            </option>
                        </select>
                    </div>

                    {{-- Button --}}
                    <div class="mt-4">
                        <button class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('desa.warga.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
