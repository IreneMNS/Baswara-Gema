@extends('dashboard')

@section('content')

<h1 class="mt-4 fw-bold">Baswara Gema — Admin Dashboard</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Monitoring • Reservasi • Statistik</li>
</ol>

<!-- ================= PRIMARY CARDS ================= -->
<div class="row">

    <!-- Ruangan Terbanyak Dipesan -->
    <div class="col-xl-4 col-md-6">
    <div class="card text-white shadow mb-4" style="background: linear-gradient(135deg, #0061ff, #60efff);">
        <div class="card-body">
            <h5 class="fw-bold mb-1"><i class="fas fa-door-open me-2"></i>Ruangan Terpopuler</h5>
            <h3 class="mt-2">Studio A</h3>
        </div>
        <div class="card-footer text-white d-flex justify-content-between align-items-center">
            <span class="small">Lihat ruangan</span>
            <i class="fas fa-angle-right"></i>
        </div>
    </div>
</div>


    <!-- Pendapatan Bulan Ini -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card bg-success text-white shadow h-100">
            <div class="card-body">
                <h5 class="fw-bold mb-1">
                    <i class="fas fa-money-bill-wave me-2"></i>Pendapatan Bulan Ini
                </h5>
                <h3 class="mt-2">Rp {{ number_format($pendapatan ?? 12500000, 0, ',', '.') }}</h3>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <span class="small text-white">Detail pendapatan</span>
                <i class="fas fa-angle-right"></i>
            </div>
        </div>
    </div>

    <!-- Total Pengunjung -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card bg-warning text-white shadow h-100">
            <div class="card-body">
                <h5 class="fw-bold mb-1">
                    <i class="fas fa-users me-2"></i>Total Pengunjung
                </h5>
                <h3 class="mt-2">{{ $pengunjung ?? 328 }} Orang</h3>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <span class="small text-white">Data pengunjung</span>
                <i class="fas fa-angle-right"></i>
            </div>
        </div>
    </div>

</div>

<!-- ================= CHART ================= -->
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header d-flex align-items-center">
                <h6 class="fw-bold mb-0">
                    <i class="fas fa-chart-bar me-2"></i>Grafik Reservasi Bulanan
                </h6>
            </div>
            <div class="card-body">
                <canvas id="reservationChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script>
    const ctx = document.getElementById('reservationChart');

    const chartData = {!! json_encode($dataReservasi ?? [12, 19, 8, 15, 22, 30, 25, 18, 20, 27, 21, 31]) !!};

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"],
            datasets: [{
                label: "Jumlah Reservasi",
                backgroundColor: "#4e73df",
                borderColor: "#2e59d9",
                hoverBackgroundColor: "#2e59d9",
                data: chartData,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false }},
            scales: { y: { beginAtZero: true }}
        }
    });
</script>

@endsection
