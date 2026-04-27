<?php

namespace App\Http\Controllers;

use App\Models\UploadKonten;
use Illuminate\Http\Request;

class UploadKontenController extends Controller
{
    public function index()
    {
        return view('upload-konten.index', [
            'title' => 'Upload Konten'
        ]);
    }

    public function create()
    {
        return view('upload-konten.create', [
            'title' => 'Tambah Data Konten',
            'case' => 'post'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'konten' => 'required',
        ]);

        $result = UploadKonten::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
        ]);

        if ($result) {
            return redirect()->route('upload-konten.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('upload-konten.index')->with('error', 'Data gagal ditambahkan');
        }
    }
}
