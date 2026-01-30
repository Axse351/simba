@extends('welcome')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah KMS Anak</h1>
        </div>

        <div class="card">
            <form action="{{ route('kms-anak.store') }}" method="POST">
                @csrf
                <div class="card-body">

                    {{-- Anak --}}
                    <div class="form-group">
                        <label>Nama Anak</label>
                        <select name="anak_id" class="form-control" required>
                            <option value="">-- Pilih Anak --</option>
                            @foreach ($anak as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama }} ({{ $item->tanggal_lahir }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Pemeriksaan</label>
                        <input type="date" name="tanggal_pemeriksaan" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Usia (bulan)</label>
                        <input type="number" name="usia_bulan" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Berat Badan (kg)</label>
                            <input type="number" step="0.01" name="berat_badan" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Tinggi Badan (cm)</label>
                            <input type="number" step="0.01" name="tinggi_badan" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Lingkar Kepala (cm)</label>
                            <input type="number" step="0.01" name="lingkar_kepala" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>LILA (cm)</label>
                            <input type="number" step="0.01" name="lila" class="form-control">
                        </div>
                    </div>

                    {{-- Status Gizi --}}
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Status BB/U</label>
                            <select name="status_bb_u" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="gizi_buruk">Gizi Buruk</option>
                                <option value="gizi_kurang">Gizi Kurang</option>
                                <option value="gizi_baik">Gizi Baik</option>
                                <option value="gizi_lebih">Gizi Lebih</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Status TB/U</label>
                            <select name="status_tb_u" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="sangat_pendek">Sangat Pendek</option>
                                <option value="pendek">Pendek</option>
                                <option value="normal">Normal</option>
                                <option value="tinggi">Tinggi</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Status BB/TB</label>
                            <select name="status_bb_tb" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="sangat_kurus">Sangat Kurus</option>
                                <option value="kurus">Kurus</option>
                                <option value="normal">Normal</option>
                                <option value="gemuk">Gemuk</option>
                            </select>
                        </div>
                    </div>

                    {{-- Kesehatan --}}
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>ASI Eksklusif</label>
                            <select name="asi_eksklusif" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Vitamin A</label>
                            <select name="vitamin_a" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Imunisasi</label>
                            <input type="text" name="imunisasi" class="form-control" placeholder="BCG, DPT, Polio">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Keluhan</label>
                        <textarea name="keluhan" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Catatan Petugas</label>
                        <textarea name="catatan_petugas" class="form-control"></textarea>
                    </div>

                </div>

                <div class="card-footer text-right">
                    <button class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('kms-anak.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </section>
@endsection
