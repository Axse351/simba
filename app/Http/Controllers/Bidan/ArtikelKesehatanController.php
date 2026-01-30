<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\ArtikelKesehatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ArtikelKesehatanController extends Controller
{
    /**
     * Tampilkan daftar artikel
     */
    public function index()
    {
        $artikel = ArtikelKesehatan::where('penulis_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('bidan.artikel.index', compact('artikel'));
    }

    /**
     * Form tambah artikel
     */
    public function create()
    {
        return view('bidan.artikel.create');
    }

    /**
     * Simpan artikel baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'ringkasan'  => 'nullable|string',
            'konten'     => 'required',
            'gambar'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'     => 'required|in:draft,published',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')
                ->store('artikel', 'public');
        }

        ArtikelKesehatan::create([
            'judul'        => $request->judul,
            'slug'         => Str::slug($request->judul) . '-' . time(),
            'ringkasan'    => $request->ringkasan,
            'konten'       => $request->konten,
            'gambar'       => $gambar,
            'status'       => $request->status,
            'penulis_id'   => auth()->id(),
            'published_at' => $request->status === 'published'
                ? Carbon::now()
                : null,
        ]);

        return redirect()
            ->route('bidan.artikel.index')
            ->with('success', 'Artikel berhasil disimpan');
    }

    /**
     * Form edit artikel
     */
    public function edit(ArtikelKesehatan $artikel)
    {
        $this->authorizeArtikel($artikel);

        return view('bidan.artikel.edit', compact('artikel'));
    }

    /**
     * Update artikel
     */
    public function update(Request $request, ArtikelKesehatan $artikel)
    {
        $this->authorizeArtikel($artikel);

        $request->validate([
            'judul'      => 'required|string|max:255',
            'ringkasan'  => 'nullable|string',
            'konten'     => 'required',
            'gambar'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'     => 'required|in:draft,published',
        ]);

        if ($request->hasFile('gambar')) {
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }

            $artikel->gambar = $request->file('gambar')
                ->store('artikel', 'public');
        }

        $artikel->update([
            'judul'        => $request->judul,
            'slug'         => Str::slug($request->judul) . '-' . time(),
            'ringkasan'    => $request->ringkasan,
            'konten'       => $request->konten,
            'status'       => $request->status,
            'published_at' => $request->status === 'published'
                ? ($artikel->published_at ?? Carbon::now())
                : null,
        ]);

        return redirect()
            ->route('bidan.artikel.index')
            ->with('success', 'Artikel berhasil diperbarui');
    }

    /**
     * Hapus artikel
     */
    public function destroy(ArtikelKesehatan $artikel)
    {
        $this->authorizeArtikel($artikel);

        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();

        return back()->with('success', 'Artikel berhasil dihapus');
    }

    /**
     * Cegah bidan edit artikel orang lain
     */
    private function authorizeArtikel(ArtikelKesehatan $artikel)
    {
        if ($artikel->penulis_id !== auth()->id()) {
            abort(403, 'Tidak diizinkan');
        }
    }
}
