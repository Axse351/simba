<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ArtikelKesehatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $artikel = ArtikelKesehatan::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        return view('user.dashboard', compact('artikel'));
    }
    public function show($id)
    {
        $artikel = ArtikelKesehatan::where('status', 'published')->findOrFail($id);
        return view('artikel.show', compact('artikel'));
    }
}
