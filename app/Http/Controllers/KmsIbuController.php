<?php

namespace App\Http\Controllers;

use App\Models\KmsIbu;
use App\Models\Warga;
use Illuminate\Http\Request;

class KmsIbuController extends Controller
{
    public function index()
    {
        $data = KmsIbu::with('warga')->latest()->get();
        return view('kms_ibu.index', compact('data'));
    }


    public function create()
    {
        $ibu = Warga::all();

        return view('kms_ibu.create', compact('ibu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'tanggal_pemeriksaan' => 'required|date',
            'berat_badan' => 'nullable|numeric|min:20|max:200',
            'tinggi_badan' => 'nullable|numeric|min:100|max:200',
            'lila' => 'nullable|numeric|min:10|max:50',
            'usia_kehamilan' => 'nullable|integer|min:1|max:42',
            'tekanan_darah' => 'nullable|string',
            'status_gizi' => 'nullable|in:kurang,normal,lebih,obesitas,resiko_kek',
        ]);

        // HITUNG IMT OTOMATIS
        $imt = null;
        if ($request->berat_badan && $request->tinggi_badan) {
            $tinggiMeter = $request->tinggi_badan / 100;
            $imt = round(
                $request->berat_badan / ($tinggiMeter * $tinggiMeter),
                2
            );
        }

        KmsIbu::create([
            'warga_id' => $request->warga_id,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'lila' => $request->lila,
            'imt' => $imt,
            'status_gizi' => $request->status_gizi,
            'usia_kehamilan' => $request->usia_kehamilan,
            'tekanan_darah' => $request->tekanan_darah,
            'catatan' => $request->catatan,
        ]);

        return redirect()
            ->route('kms-ibu.index')
            ->with('success', 'Data KMS Ibu berhasil disimpan');
    }

    public function edit(KmsIbu $kmsIbu)
    {
        $ibu = Warga::where('jenis_kelamin', 'P')->get();
        return view('kms_ibu.edit', compact('kmsIbu', 'ibu'));
    }

    public function update(Request $request, KmsIbu $kmsIbu)
    {
        $request->validate([
            'tanggal_pemeriksaan' => 'required|date',
        ]);

        $imt = null;
        if ($request->berat_badan && $request->tinggi_badan) {
            $tinggiMeter = $request->tinggi_badan / 100;
            $imt = round(
                $request->berat_badan / ($tinggiMeter * $tinggiMeter),
                2
            );
        }

        $kmsIbu->update([
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'lila' => $request->lila,
            'imt' => $imt,
            'status_gizi' => $request->status_gizi,
            'usia_kehamilan' => $request->usia_kehamilan,
            'tekanan_darah' => $request->tekanan_darah,
            'catatan' => $request->catatan,
        ]);

        return redirect()
            ->route('kms-ibu.index')
            ->with('success', 'Data KMS Ibu berhasil diperbarui');
    }

    public function destroy(KmsIbu $kmsIbu)
    {
        $kmsIbu->delete();
        return back()->with('success', 'Data KMS Ibu berhasil dihapus');
    }
}