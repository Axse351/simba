@extends('welcome')

@section('title', 'Edit Artikel')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Artikel Kesehatan</h1>
        </div>

        <div class="card">
            <form action="{{ route('artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="form-group">
                        <label>Judul Artikel</label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul', $artikel->judul) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Ringkasan</label>
                        <textarea name="ringkasan" class="form-control" rows="3">{{ old('ringkasan', $artikel->ringkasan) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Konten Artikel</label>
                        <textarea name="konten" class="form-control" rows="6" required>{{ old('konten', $artikel->konten) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Gambar</label><br>
                        @if ($artikel->gambar)
                            <img src="{{ asset('storage/' . $artikel->gambar) }}" class="img-fluid mb-2"
                                style="max-height:150px">
                        @endif
                        <input type="file" name="gambar" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="draft" {{ $artikel->status == 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>
                            <option value="published" {{ $artikel->status == 'published' ? 'selected' : '' }}>
                                Publish
                            </option>
                        </select>
                    </div>

                </div>

                <div class="card-footer text-right">
                    <button class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('artikel.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </section>
@endsection
