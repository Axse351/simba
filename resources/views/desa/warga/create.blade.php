@extends('welcome')

@section('title', 'Tambah Warga')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Warga</h1>
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
                    <h4>Form Data Ibu</h4>
                </div>

                <form action="{{ route('desa.warga.store') }}" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Nama Lengkap</label>
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
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>RT</label>
                                <input type="text" name="rt" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>RW</label>
                                <input type="text" name="rw" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label>No HP</label>
                            <input type="text" name="no_hp" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Desa</label>
                            <input type="text" name="desa" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Kabupaten</label>
                            <input type="text" name="kabupaten" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" required>
                        </div>


                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="aktif">Aktif</option>
                                <option value="pindah">Pindah</option>
                                <option value="meninggal">Meninggal</option>
                            </select>
                        </div>

                    </div>

                    <div class="card-footer text-right">
                        <a href="{{ route('desa.warga.index') }}" class="btn btn-secondary">
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
