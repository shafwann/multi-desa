<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Website;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();

        return view('kategori.index', [
            'title' => 'Kategori',
            'kategori' => $kategori
        ]);
    }

    public function create()
    {
        return view('kategori.create', [
            'title' => 'Tambah Data Kategori'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        $validatedData['website_id'] = Website::where('desa_id', Auth::user()->desa_id)->first()->id;

        $website = Website::where('desa_id', Auth::user()->desa_id)->first();
        if (!$website) {
            return redirect()->route('kategori.index')->with('error', 'Website tidak ditemukan untuk desa pengguna saat ini.');
        }

        $validatedData['website_id'] = $website->id;
        $validatedData['desa_id'] = Auth::user()->desa_id;

        $result = Kategori::create($validatedData);

        if ($result) {
            return redirect()->route('kategori.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('kategori.index')->with('error', 'Data gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);

        return view('kategori.edit', [
            'title' => 'Edit Data Kategori',
            'kategori' => $kategori
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required',

        ]);

        $kategori = Kategori::find($id);
        $kategori->nama = $request->nama;

        $result = $kategori->save();

        if ($result) {
            return redirect()->route('kategori.index')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('kategori.index')->with('error', 'Data gagal diubah');
        }
    }

    public function destroy($id)
    {
        $result = Kategori::destroy($id);

        if ($result) {
            return redirect()->route('kategori.index')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('kategori.index')->with('error', 'Data gagal dihapus');
        }
    }
}
