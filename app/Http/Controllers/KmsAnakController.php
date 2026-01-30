<?php

namespace App\Http\Controllers;

use App\Models\KmsAnak;
use App\Models\Anak;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KmsAnakController extends Controller
{
    public function index()
    {
        $data = KmsAnak::with('anak')->latest()->get();
        return view('kms_anak.index', compact('data'));
    }

    public function create()
    {
        $anak = Anak::all();
        return view('kms_anak.create', compact('anak'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anak_id' => 'required|exists:anak,id',
            'tanggal_pemeriksaan' => 'required|date',
            'berat_badan' => 'nullable|numeric',
            'tinggi_badan' => 'nullable|numeric',
            'lingkar_kepala' => 'nullable|numeric',
            'lila' => 'nullable|numeric',
        ]);

        $anak = Anak::findOrFail($request->anak_id);

        // hitung usia bulan otomatis
        $usiaBulan = Carbon::parse($anak->tanggal_lahir)
            ->diffInMonths($request->tanggal_pemeriksaan);

        KmsAnak::create([
            'anak_id' => $request->anak_id,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'usia_bulan' => $usiaBulan,
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'lingkar_kepala' => $request->lingkar_kepala,
            'lila' => $request->lila,
            'status_bb_u' => $request->status_bb_u,
            'status_tb_u' => $request->status_tb_u,
            'status_bb_tb' => $request->status_bb_tb,
            'asi_eksklusif' => $request->asi_eksklusif,
            'vitamin_a' => $request->vitamin_a,
            'imunisasi' => $request->imunisasi,
            'keluhan' => $request->keluhan,
            'catatan_petugas' => $request->catatan_petugas,
        ]);

        return redirect()->route('kms-anak.index')
            ->with('success', 'Data KMS Anak berhasil disimpan');
    }

    public function edit(KmsAnak $kmsAnak)
    {
        $anak = Anak::all();
        return view('kms_anak.edit', compact('kmsAnak', 'anak'));
    }

    public function update(Request $request, KmsAnak $kmsAnak)
    {
        $request->validate([
            'tanggal_pemeriksaan' => 'required|date',
        ]);

        $anak = $kmsAnak->anak;

        $usiaBulan = Carbon::parse($anak->tanggal_lahir)
            ->diffInMonths($request->tanggal_pemeriksaan);

        $kmsAnak->update(array_merge(
            $request->all(),
            ['usia_bulan' => $usiaBulan]
        ));

        return redirect()->route('kms-anak.index')
            ->with('success', 'Data KMS Anak berhasil diperbarui');
    }

    public function destroy(KmsAnak $kmsAnak)
    {
        $kmsAnak->delete();
        return back()->with('success', 'Data KMS Anak dihapus');
    }
}