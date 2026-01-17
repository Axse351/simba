<?php

namespace App\Http\Controllers\Desa;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\Warga;
use Illuminate\Http\Request;

class AnakController extends Controller
{
    public function index()
    {
        $anak = Anak::with('ibu')->latest()->paginate(10);
        return view('desa.anak.index', compact('anak'));
    }

    public function create()
    {
        $ibus = Warga::where('jenis_kelamin', 'P')
            ->orderBy('nama')
            ->get();

        return view('desa.anak.create', compact('ibus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id'       => 'required|exists:wargas,id',
            'nik'            => 'nullable|digits:16',
            'nama'           => 'required|string|max:255',
            'jenis_kelamin'  => 'required|in:L,P',
            'tempat_lahir'   => 'required|string|max:255',
            'tanggal_lahir'  => 'required|date',
            'anak_ke'        => 'required|integer|min:1',
        ]);

        Anak::create($request->all());

        return redirect()
            ->route('desa.anak.index')
            ->with('success', 'Data anak berhasil ditambahkan');
    }

    public function edit(Anak $anak)
    {
        $ibus = Warga::where('jenis_kelamin', 'P')
            ->orderBy('nama')
            ->get();

        return view('desa.anak.edit', compact('anak', 'ibus'));
    }

    public function update(Request $request, Anak $anak)
    {
        $request->validate([
            'warga_id'       => 'required|exists:wargas,id',
            'nik'            => 'nullable|digits:16',
            'nama'           => 'required|string|max:255',
            'jenis_kelamin'  => 'required|in:L,P',
            'tempat_lahir'   => 'required|string|max:255',
            'tanggal_lahir'  => 'required|date',
            'anak_ke'        => 'required|integer|min:1',
        ]);

        $anak->update($request->all());

        return redirect()
            ->route('desa.anak.index')
            ->with('success', 'Data anak berhasil diperbarui');
    }

    public function destroy(Anak $anak)
    {
        $anak->delete();

        return back()->with('success', 'Data anak berhasil dihapus');
    }
}
