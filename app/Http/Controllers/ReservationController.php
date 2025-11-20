<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Ruangan;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservasi::with('ruangan')->get();
        $rooms = Ruangan::all();

        $events = $reservations->map(function ($r) {
            return [
                'title' => $r->nama_customer . ' - ' . $r->ruangan->nama,
                'start' => $r->tanggal . 'T' . $r->jam_mulai,
                'end'   => $r->tanggal . 'T' . $r->jam_selesai,
            ];
        });

        return view('reservation', compact('reservations', 'rooms', 'events'));
    }

    public function list()
    {
        $reservations = Reservasi::with('ruangan')->get();
        $rooms = Ruangan::all();

        return view('listbook', compact('reservations', 'rooms'));
    }

    public function cancel($id)
    {
        $reservation = Reservasi::findOrFail($id);
        $reservation->status = 'batal';
        $reservation->save();

        return redirect()->back()->with('success', 'Reservasi berhasil dibatalkan.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_customer' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'ruangan_id' => 'required|exists:ruangan,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        Reservasi::create($request->all());

        return redirect()->route('reservation.index')->with('success', 'Reservasi berhasil dibuat!');
    }


    public function edit($id)
    {
        $reservation = Reservasi::findOrFail($id);
        $reservations = Reservasi::with('ruangan')->get();
        $rooms = Ruangan::all();

        return view('listbook', compact('reservation', 'reservations', 'rooms'));
    }


    public function update(Request $request, $id)
    {
        $reservation = Reservasi::findOrFail($id);

        $request->validate([
            'nama_customer' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'ruangan_id' => 'required|exists:ruangan,id',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        $reservation->update([
            'nama_customer' => $request->nama_customer,
            'ruangan_id' => $request->ruangan_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('reservation.list')->with('success', 'Reservasi berhasil diperbarui!');
    }


    public function destroy($id)
    {
        Reservasi::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Reservasi berhasil dihapus!');
    }
}
