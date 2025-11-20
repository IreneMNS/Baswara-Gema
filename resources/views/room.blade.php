@extends('dashboard')

@section('content')
<div class="container">
    
    <h1 class="mb-3 fw-bold">Kelola Ruangan</h1>

    <!-- FORM -->
    <div class="card p-4 mb-4 shadow-sm">
        @if($room)
            <h4>Edit Ruangan</h4>
            <form action="{{ url('/room/'.$room->id) }}" method="POST">
                @csrf
                @method('PUT')
        @else
            <h4>Tambah Ruangan</h4>
            <form action="{{ url('/room') }}" method="POST">
                @csrf
        @endif
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Ruangan</label>
                        <input type="text" name="nama" class="form-control" 
                        value="{{ $room->nama ?? '' }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">URL Gambar</label>
                        <input type="text" name="gambar_url" class="form-control" 
                        placeholder="https://example.com/img.jpg"
                        value="{{ $room->gambar_url ?? '' }}">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control">{{ $room->deskripsi ?? '' }}</textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Harga / Jam</label>
                        <input type="number" name="harga" class="form-control"
                        value="{{ $room->harga ?? '' }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Kapasitas</label>
                        <input type="number" name="kapasitas" class="form-control"
                        value="{{ $room->kapasitas ?? '' }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Fasilitas</label>
                        <input type="text" name="fasilitas" class="form-control"
                        value="{{ $room->fasilitas ?? '' }}">
                    </div>
                </div>

                <button class="btn btn-primary mt-3" type="submit">
                    {{ $room ? 'Update' : 'Tambah' }}
                </button>
            </form>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- CARD LIST -->
    <div class="row">
        @foreach($rooms as $r)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    
                    <img src="{{ $r->gambar_url ?: 'https://via.placeholder.com/400x250?text=No+Image' }}" 
                         class="card-img-top" style="height: 200px; object-fit: cover;">

                    <div class="card-body">
                        <h5 class="fw-bold">{{ $r->nama }}</h5>
                        <p class="text-muted mb-1">{{ $r->deskripsi }}</p>
                        <p class="mb-1"><strong>Harga:</strong> Rp{{ number_format($r->harga,0,',','.') }}/jam</p>
                        <p class="mb-1"><strong>Kapasitas:</strong> {{ $r->kapasitas }} orang</p>
                        <p><strong>Fasilitas:</strong> {{ $r->fasilitas }}</p>

                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ url('/room/'.$r->id.'/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                            
                            <form action="{{ url('/room/'.$r->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus?')" 
                                class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
