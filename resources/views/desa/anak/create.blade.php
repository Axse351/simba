@extends('welcome')

@section('title', 'Tambah Anak')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Anak</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Form Data Anak</h4>
                </div>

                <form action="{{ route('desa.anak.store') }}" method="POST">
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label>Nama Ibu</label>
                            <select name="warga_id" class="form-control" required>
                                <option value="">- Pilih Ibu -</option>
                                @foreach ($ibus as $ibu)
                                    <option value="{{ $ibu->id }}">
                                        {{ $ibu->nama }} ({{ $ibu->nik }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>NIK Anak (Opsional)</label>
                            <input type="text" name="nik" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Nama Anak</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Anak Ke</label>
                            <input type="number" name="anak_ke" class="form-control" min="1" required>
                        </div>

                    </div>

                    <div class="card-footer text-right">
                        <a href="{{ route('desa.anak.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                        <button class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
