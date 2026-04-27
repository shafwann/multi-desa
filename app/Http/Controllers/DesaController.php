<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\User;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    public function index()
    {
        $desa = Desa::all();

        return view('desa.index', [
            'title' => 'Desa',
            'desa' => $desa
        ]);
    }

    public function create()
    {
        return view('desa.create', [
            'title' => 'Tambah Data Desa'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        $result = Desa::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        if ($result) {
            return redirect()->route('desa.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('desa.index')->with('error', 'Data gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $desa = Desa::find($id);

        return view('desa.edit', [
            'title' => 'Edit Data Desa',
            'desa' => $desa
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        $desa = Desa::find($id);
        $desa->nama = $request->nama;
        $desa->alamat = $request->alamat;
        $desa->no_telp = $request->no_telp;

        $result = $desa->save();

        if ($result) {
            return redirect()->route('desa.index')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('desa.index')->with('error', 'Data gagal diubah');
        }
    }

    public function destroy(string $id)
    {
        // Cari desa berdasarkan ID
        $desa = Desa::find($id);

        if ($desa) {
            // Cari semua user dengan role admin desa (role_id = 2) di desa ini
            $adminDesa = User::where('desa_id', $desa->id)->where('role_id', 2)->first();

            if ($adminDesa) {
                // Hapus website terkait admin desa
                $website = $adminDesa->website;

                if ($website) {
                    // Hapus header, footer, slider, tentang kami, dan layanan terkait
                    $website->header()->delete();
                    $website->footer()->delete();
                    $website->slider()->delete();
                    $website->tentangkami()->delete();
                    $website->layanan()->delete();

                    // Hapus website
                    $website->delete();
                }

                // Cari semua penulis di desa yang sama
                $penulis = User::where('desa_id', $adminDesa->desa_id)->where('role_id', 4)->get();

                // Hapus semua penulis di desa yang sama
                foreach ($penulis as $writer) {
                    $writerWebsite = $writer->website;
                    if ($writerWebsite) {
                        // Hapus konten terkait penulis
                        $writerWebsite->postingan()->delete();
                        $writerWebsite->kategori()->delete();
                        $writerWebsite->galeri()->delete();

                        // Hapus website penulis
                        $writerWebsite->delete();
                    }

                    // Hapus penulis
                    $writer->delete();
                }

                // Hapus admin desa
                $adminDesa->delete();
            }

            // Hapus semua user yang berhubungan dengan desa ini
            User::where('desa_id', $desa->id)->delete();

            // Hapus desa terkait
            $result = $desa->delete();

            if ($result) {
                return redirect()->route('desa.index')->with('success', 'Data berhasil dihapus');
            } else {
                return redirect()->route('desa.index')->with('error', 'Data gagal dihapus');
            }
        }

        return redirect()->route('desa.index')->with('error', 'Desa tidak ditemukan atau tidak valid.');
    }
}
