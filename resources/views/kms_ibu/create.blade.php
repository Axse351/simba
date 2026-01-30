@extends('welcome')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah KMS Ibu</h1>
    </div>

    <div class="card">
        <form action="{{ route('kms-ibu.store') }}" method="POST">
            @csrf
            <div class="card-body">
@if ($errors->any())
    <div class="alert alert-danger">
        <div class="alert-title">Gagal menyimpan data</div>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <div class="form-group">
                    <label>Nama Ibu</label>
                    <select name="warga_id" class="form-control" required>
                        <option value="">-- Pilih Ibu --</option>
                        @foreach($ibu as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }} ({{ $item->nik }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal Pemeriksaan</label>
                    <input type="date" name="tanggal_pemeriksaan" class="form-control" required>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Berat Badan (kg)</label>
                        <input type="number" step="0.01" name="berat_badan" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tinggi Badan (cm)</label>
                        <input type="number" step="0.01" name="tinggi_badan" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>LILA (cm)</label>
                        <input type="number" step="0.01" name="lila" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label>Status Gizi</label>
                    <select name="status_gizi" class="form-control">
                        <option value="">-- Pilih --</option>
                        <option value="kurang">Kurang</option>
                        <option value="normal">Normal</option>
                        <option value="lebih">Lebih</option>
                        <option value="obesitas">Obesitas</option>
                        <option value="resiko_kek">Resiko KEK</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Usia Kehamilan (minggu)</label>
                    <input type="number" name="usia_kehamilan" class="form-control">
                </div>

                <div class="form-group">
                    <label>Tekanan Darah</label>
                    <input type="text" name="tekanan_darah" class="form-control" placeholder="Contoh: 120/80">
                </div>

                <div class="form-group">
                    <label>Catatan</label>
                    <textarea name="catatan" class="form-control"></textarea>
                </div>

            </div>

            <div class="card-footer text-right">
                <button class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('kms-ibu.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</section>
@endsection