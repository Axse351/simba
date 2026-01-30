@extends('welcome')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit KMS Ibu</h1>
    </div>

    <div class="card">
        <form action="{{ route('kms-ibu.update', $kmsIbu->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="form-group">
                    <label>Nama Ibu</label>
                    <select class="form-control" disabled>
                        <option>{{ $kmsIbu->warga->nama }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal Pemeriksaan</label>
                    <input type="date" name="tanggal_pemeriksaan" class="form-control"
                        value="{{ $kmsIbu->tanggal_pemeriksaan }}" required>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Berat Badan</label>
                        <input type="number" step="0.01" name="berat_badan"
                            value="{{ $kmsIbu->berat_badan }}" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tinggi Badan</label>
                        <input type="number" step="0.01" name="tinggi_badan"
                            value="{{ $kmsIbu->tinggi_badan }}" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>LILA</label>
                        <input type="number" step="0.01" name="lila"
                            value="{{ $kmsIbu->lila }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label>Status Gizi</label>
                    <select name="status_gizi" class="form-control">
                        @foreach(['kurang','normal','lebih','obesitas','resiko_kek'] as $status)
                            <option value="{{ $status }}"
                                {{ $kmsIbu->status_gizi == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Usia Kehamilan</label>
                    <input type="number" name="usia_kehamilan"
                        value="{{ $kmsIbu->usia_kehamilan }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Tekanan Darah</label>
                    <input type="text" name="tekanan_darah"
                        value="{{ $kmsIbu->tekanan_darah }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Catatan</label>
                    <textarea name="catatan" class="form-control">{{ $kmsIbu->catatan }}</textarea>
                </div>

            </div>

            <div class="card-footer text-right">
                <button class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('kms-ibu.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</section>
@endsection