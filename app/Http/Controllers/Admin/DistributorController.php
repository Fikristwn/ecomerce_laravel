<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Distributor;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class DistributorController extends Controller
{
    public function index()
    {
        $distributors = Distributor::all();
        return view('pages.admin.distributor.index', compact('distributors'));
    }

    // Menampilkan form untuk menambahkan distributor baru
    public function create()
    {
        return view('pages.admin.distributor.create');
    }

    // Menyimpan data distributor baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_distributor' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'kontak' => 'required',
            'email' => 'required|email|unique:distributors,email',
        ]);

        Distributor::create($request->all());

        return redirect()->route('admin.distributor')->with('success', 'Distributor berhasil ditambahkan');
    }

    // Menampilkan detail distributor untuk edit
    public function edit($id)
    {
        $distributor = Distributor::findOrFail($id);
        return view('pages.admin.distributor.edit', compact('distributor'));
    }

    // Mengupdate data distributor
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_distributor' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'kontak' => 'required',
            'email' => 'required|email|unique:distributors,email,'.$id,
        ]);

        $distributor = Distributor::findOrFail($id);
        $distributor->update($request->all());

        return redirect()->route('admin.distributor')->with('success', 'Distributor berhasil diperbarui');
    }

    // Menghapus data distributor
    public function delete($id)
    {
        $distributor = Distributor::findOrFail($id);
        $distributor->delete();

        return redirect()->route('admin.distributor')->with('success', 'Distributor berhasil dihapus');
    }
}

