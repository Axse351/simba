<?php

namespace App\Http\Controllers\Desa;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        $wargas = Warga::latest()->paginate(10);
        return view('desa.warga.index', compact('wargas'));
    }

    public function create()
    {
        return view('desa.warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik'            => 'required|digits:16|unique:wargas,nik',
            'nama'           => 'required|string|max:255',
            'jenis_kelamin'  => 'required|in:L,P',
            'tempat_lahir'   => 'required|string|max:255',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string',
            'rt'             => 'required|string|max:5',
            'rw'             => 'required|string|max:5',
            'desa'           => 'required|string|max:255',
            'kecamatan'      => 'required|string|max:255',
            'kabupaten'      => 'required|string|max:255',
            'provinsi'       => 'required|string|max:255',
            'no_hp'          => 'nullable|string|max:20',
            'status'         => 'required|in:aktif,pindah,meninggal',
        ]);

        Warga::create($request->all());

        return redirect()
            ->route('desa.warga.index')
            ->with('success', 'Data warga berhasil ditambahkan');
    }

    public function edit(Warga $warga)
    {
        return view('desa.warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $request->validate([
            'nik'            => 'required|digits:16|unique:wargas,nik,' . $warga->id,
            'nama'           => 'required|string|max:255',
            'jenis_kelamin'  => 'required|in:L,P',
            'tempat_lahir'   => 'required|string|max:255',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string',
            'rt'             => 'required|string|max:5',
            'rw'             => 'required|string|max:5',
            'desa'           => 'required|string|max:255',
            'kecamatan'      => 'required|string|max:255',
            'kabupaten'      => 'required|string|max:255',
            'provinsi'       => 'required|string|max:255',
            'no_hp'          => 'nullable|string|max:20',
            'status'         => 'required|in:aktif,pindah,meninggal',
        ]);

        $warga->update($request->all());

        return redirect()
            ->route('desa.warga.index')
            ->with('success', 'Data warga berhasil diperbarui');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();

        return redirect()
            ->route('desa.warga.index')
            ->with('success', 'Data warga berhasil dihapus');
    }

    public function grafik($id)
    {
        $warga = Warga::with(['kmsIbu' => function ($q) {
            $q->orderBy('tanggal_pemeriksaan');
        }])->findOrFail($id);

        return view('desa.warga.grafik', compact('warga'));
    }
}
