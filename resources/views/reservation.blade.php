@extends('dashboard')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet" />

<style>
#calendar {
    min-height: 600px;
}
</style>
@endsection


@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 style="font-weight:700;">Reservasi Studio</h1>

    <button id="openForm" class="btn btn-warning">+ Tambah Reservasi</button>
</div>

{{-- CARD FORM (HIDDEN AWALNYA) --}}
<div id="formBox" class="card shadow p-4 mb-4" style="display:none; max-width:500px;">
    <form action="{{ route('reservation.store') }}" method="POST">
        @csrf

        <input type="text" name="nama_customer" placeholder="Nama Customer" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="telepon" placeholder="Telepon" required>

        <select name="ruangan_id" required>
            <option value="">-- Pilih Ruangan --</option>
            @foreach($rooms as $r)
            <option value="{{ $r->id }}">{{ $r->nama }}</option>
            @endforeach
        </select>

        <input type="date" name="tanggal" required>
        <input type="time" name="jam_mulai" required>
        <input type="time" name="jam_selesai" required>

        <button type="submit" class="btn btn-warning w-100 mt-3">Simpan Reservasi</button>
    </form>
</div>

{{-- FULLCALENDAR --}}
<div class="card shadow p-4">
    <div id="calendar"></div>
</div>

@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function(){

    document.getElementById('openForm').addEventListener('click', () => {
        document.getElementById('formBox').style.display = 'block';
    });

    const calendarEl = document.getElementById('calendar');
    const events = @json($events);

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: "650px",
        events: events
    });

    calendar.render();
});
</script>
@endsection
