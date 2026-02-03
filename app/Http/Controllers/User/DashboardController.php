<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ArtikelKesehatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index()
    {
        // Ambil artikel yang sudah published dengan pagination
        $artikel = ArtikelKesehatan::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        return view('user.dashboard', compact('artikel'));
    }

    public function show($id)
    {
        // Ambil detail artikel
        $artikel = ArtikelKesehatan::where('status', 'published')
            ->findOrFail($id);

        return view('user.artikel-show', compact('artikel'));
    }

    public function artikelIndex()
    {
        // Halaman khusus daftar semua artikel
        $artikel = ArtikelKesehatan::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('user.artikel-index', compact('artikel'));
    }
}
