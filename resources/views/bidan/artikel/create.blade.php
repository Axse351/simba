@extends('welcome')

@section('title', 'Tambah Artikel')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Artikel Kesehatan</h1>
        </div>

        <div class="card">
            <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label>Judul Artikel</label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                            value="{{ old('judul') }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Ringkasan</label>
                        <textarea name="ringkasan" class="form-control" rows="3">{{ old('ringkasan') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Konten Artikel</label>
                        <textarea name="konten" class="form-control" rows="6" required>{{ old('konten') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Gambar Artikel</label>
                        <input type="file" name="gambar" class="form-control-file">
                        <small class="text-muted">jpg / png (max 2MB)</small>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="draft">Draft</option>
                            <option value="published">Publish</option>
                        </select>
                    </div>

                </div>

                <div class="card-footer text-right">
                    <button class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('artikel.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </section>
@endsection
