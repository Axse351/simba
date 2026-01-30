@extends('welcome')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit KMS Anak</h1>
        </div>

        <div class="card">
            <form action="{{ route('kms-anak.update', $kmsAnak->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="form-group">
                        <label>Nama Anak</label>
                        <input type="text" class="form-control" value="{{ $kmsAnak->anak->nama }}" readonly>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Pemeriksaan</label>
                        <input type="date" name="tanggal_pemeriksaan" value="{{ $kmsAnak->tanggal_pemeriksaan }}"
                            class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Usia (bulan)</label>
                        <input type="number" name="usia_bulan" value="{{ $kmsAnak->usia_bulan }}" class="form-control">
                    </div>

                    {{-- sisanya sama seperti create, tinggal isi value --}}
                    {{-- (kalau mau aku rapikan full juga) --}}

                </div>

                <div class="card-footer text-right">
                    <button class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('kms-anak.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </section>
@endsection
