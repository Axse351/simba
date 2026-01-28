@extends('welcome')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Jadwal Posyandu</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('desa.jadwal-posyandu.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Waktu</label>
                        <input type="time" name="waktu" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>

                    <button class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('desa.jadwal-posyandu.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </form>
            </div>
        </div>
    </section>
@endsection
