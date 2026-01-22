@extends('layouts.indexDashboard')

@section('headerTitle', 'Dashboard Admin')
@section('pageTitle', 'Dashboard')

@section('routePrimary', route('admin.attendances.scan.form'))
@section('primaryButtonText', 'Pindai Kode Batang')

@section('routeSecondary', route('admin.attendances.index'))
@section('secondaryButtonText', 'Lihat Absensi')

@section('title')
<div class="space-y-8">

    {{-- STAT CARDS --}}
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @php
$statusCards = [
    [
        'title' => 'Hadir',
        'value' => $statusStats['hadir'] ?? 0,
        'icon'  => '',
        'color' => 'green',
        'url'   => url('/admin/attendances?search=&filter_field=status&filter_value=hadir&sort_order=latest')
    ],
    [
        'title' => 'Tidak Hadir',
        'value' => $statusStats['tidak hadir'] ?? 0,
        'icon'  => '',
        'color' => 'red',
        'url'   => url('/admin/attendances?search=&filter_field=status&filter_value=tidak+hadir&sort_order=latest')
    ],
    [
        'title' => 'Sakit',
        'value' => $statusStats['sakit'] ?? 0,
        'icon'  => '',
        'color' => 'yellow',
        'url'   => url('/admin/attendances?search=&filter_field=status&filter_value=sakit&sort_order=latest')
    ],
    [
        'title' => 'Izin',
        'value' => $statusStats['izin'] ?? 0,
        'icon'  => '',
        'color' => 'blue',
        'url'   => url('/admin/attendances?search=&filter_field=status&filter_value=izin&sort_order=latest')
    ],
];
@endphp



        @foreach ($statusCards as $c)
<a href="{{ $c['url'] }}"
   class="block bg-white/10 backdrop-blur-2xl border border-white/10
          rounded-2xl p-5 shadow-xl
          hover:scale-[1.03] hover:bg-white/20
          transition-all group">

    <div class="flex items-center justify-between">
        <p class="text-sm text-white/70 group-hover:text-white">
            {{ $c['title'] }}
        </p>
        <span class="text-xl opacity-80">{{ $c['icon'] }}</span>
    </div>

    <p class="text-3xl font-bold mt-2 text-{{ $c['color'] }}-400">
        {{ $c['value'] }}
    </p>

    <p class="text-xs mt-2 text-white/50 group-hover:text-white/80">
        Klik untuk lihat detail
    </p>
</a>
@endforeach


    </section>

    


    {{-- CHARTS --}}
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- PIE --}}
        <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl p-5 shadow-2xl">
            <h2 class="font-bold mb-4 text-lg">Status Absensi Hari Ini</h2>
            <div class="relative h-[300px]">
                <canvas id="statusChart"></canvas>
            </div>
        </div>

        {{-- BAR --}}
        <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl p-5 shadow-2xl">
            <h2 class="font-bold mb-4 text-lg">Absensi 7 Hari Terakhir</h2>
            <div class="relative h-[300px]">
                <canvas id="weeklyChart"></canvas>
            </div>
        </div>

    </section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const statusData = @json($statusStats);
const weeklyData = @json($weeklyAttendance);

/* ================= PIE CHART ================= */
new Chart(document.getElementById('statusChart'), {
    type: 'doughnut',
    data: {
        labels: Object.keys(statusData),
        datasets: [{
            data: Object.values(statusData),
            backgroundColor: [
                '#22c55e', // Hadir
                '#3b82f6', // Izin
                '#facc15', // Sakit
                '#ef4444', // Alpha
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: { color: 'white' }
            },
            tooltip: {
                backgroundColor: 'rgba(0,0,0,0.75)',
                callbacks: {
                    label: ctx => `${ctx.label}: ${ctx.parsed} siswa`
                }
            }
        }
    }
});

/* ================= BAR CHART ================= */
new Chart(document.getElementById('weeklyChart'), {
    type: 'bar',
    data: {
        labels: weeklyData.map(d => d.date),
        datasets: [{
            label: 'Total Absensi',
            data: weeklyData.map(d => d.total),
            borderRadius: 8,
            barThickness: 28,
            backgroundColor: 'rgba(34, 197, 94, 0.8)',   // hijau
            hoverBackgroundColor: 'rgba(34, 197, 94, 1)' // hijau saat hover
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: 'rgba(0,0,0,0.75)',
                callbacks: {
                    title: ctx => `Tanggal: ${ctx[0].label}`,
                    label: ctx => `Total Absensi: ${ctx.parsed.y} siswa`
                }
            }
        },
        scales: {
            x: {
                ticks: { color: 'white' },
                grid: { display: false }
            },
            y: {
                beginAtZero: true,
                ticks: { color: 'white', stepSize: 1 },
                grid: { color: 'rgba(255,255,255,0.1)' }
            }
        }
    }
});

</script>

</div>

@endsection

@section('tableRowsData')
<tr>
    <td colspan="10" class="py-6 text-center text-white/40">
        Dashboard tidak menggunakan tabel
    </td>
</tr>
@endsection
