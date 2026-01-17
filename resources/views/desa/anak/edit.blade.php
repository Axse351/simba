@extends('welcome')

@section('title', 'Edit Anak')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Anak</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Form Edit Anak</h4>
                </div>

                <form action="{{ route('desa.anak.update', $anak->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group">
                            <label>Nama Ibu</label>
                            <select name="warga_id" class="form-control" required>
                                @foreach ($ibus as $ibu)
                                    <option value="{{ $ibu->id }}" {{ $anak->warga_id == $ibu->id ? 'selected' : '' }}>
                                        {{ $ibu->nama }} ({{ $ibu->nik }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>NIK Anak</label>
                            <input type="text" name="nik" value="{{ $anak->nik }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Nama Anak</label>
                            <input type="text" name="nama" value="{{ $anak->nama }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="L" {{ $anak->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="P" {{ $anak->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ $anak->tempat_lahir }}" class="form-control"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ $anak->tanggal_lahir }}"
                                class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Anak Ke</label>
                            <input type="number" name="anak_ke" value="{{ $anak->anak_ke }}" class="form-control"
                                min="1" required>
                        </div>

                    </div>

                    <div class="card-footer text-right">
                        <a href="{{ route('desa.anak.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                        <button class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
