<?php

namespace App\Http\Controllers;

use App\Models\Header;
use App\Models\Tentangkami;
use App\Models\Website;
use Illuminate\Http\Request;
use App\Models\User;

class WebsiteController extends Controller
{

    public function index()
    {
        $website = Website::where('user_id', auth()->user()->id)->first();
        // $website = Website::first();

        return view('website.edit', [
            'title' => 'Edit Website',
            'website' => $website,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        $website = Website::find($id);
        $website->update($validatedData);

        return redirect()->route('website.edit')->with('success', 'Data berhasil diubah');
    }

    public function websitelist()
    {
        $website = Website::all();
        // $penulis = User::all();

        $penulis = User::where('role_id', 3)->get(); // Mengambil semua penulis dengan role_id 3

        // $user = auth()->user();
        // $editorpenulis = User::where('role_id', 4)
        //     ->where('desa_id', $user->desa_id)
        //     ->get();

        return view('superadmin.website-list', [
            'title' => 'Website',
            'website' => $website,
            // 'editorpenulis' => $editorpenulis,
            'penulis' => $penulis,
        ]);
    }
}
