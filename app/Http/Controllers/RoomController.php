<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;

class RoomController extends Controller
{
    // Tampilkan daftar ruangan + form tambah
    public function index()
    {
        $rooms = Ruangan::all();
        $room = null; // penting supaya Blade aman
        return view('room', compact('rooms', 'room'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar_url' => 'nullable|string',
            'harga' => 'required|integer',
            'kapasitas' => 'required|integer',
            'fasilitas' => 'nullable|string',
        ]);

        Ruangan::create($request->all());

        return redirect('/room')->with('success', 'Ruangan berhasil ditambahkan!');
    }

    // Tampilkan form edit di Blade yang sama
    public function edit(Ruangan $room)
    {
        $rooms = Ruangan::all();
        return view('room', compact('rooms', 'room'));
    }

    // Update data
    public function update(Request $request, Ruangan $room)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar_url' => 'nullable|string',
            'harga' => 'required|integer',
            'kapasitas' => 'required|integer',
            'fasilitas' => 'nullable|string',
        ]);

        $room->update($request->all());

        return redirect('/room')->with('success', 'Ruangan berhasil diupdate!');
    }

    // Hapus data
    public function destroy(Ruangan $room)
    {
        $room->delete();
        return redirect('/room')->with('success', 'Ruangan berhasil dihapus!');
    }
}
