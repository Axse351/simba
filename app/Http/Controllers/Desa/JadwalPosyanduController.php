<?php

namespace App\Http\Controllers\Desa;

use App\Http\Controllers\Controller;
use App\Models\JadwalPosyandu;
use Illuminate\Http\Request;

class JadwalPosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = JadwalPosyandu::orderBy('tanggal', 'desc')->get();
        return view('desa.jadwal-posyandu.index', compact('jadwal'));
    }


    public function create()
    {
        return view('desa.jadwal-posyandu.create');
    }


    public function store(Request $request)
    {
        JadwalPosyandu::create($request->all());
        return redirect()->route('desa.jadwal-posyandu.index');
    }


    public function edit($id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);
        return view('desa.jadwal-posyandu.edit', compact('jadwal'));
    }


    public function update(Request $request, $id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);
        $jadwal->update($request->all());
        return redirect()->route('desa.jadwal-posyandu.index');
    }


    public function destroy($id)
    {
        JadwalPosyandu::destroy($id);
        return redirect()->route('desa.jadwal-posyandu.index');
    }
}
