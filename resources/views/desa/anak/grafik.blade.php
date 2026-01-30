@extends('welcome')

@section('title', 'Grafik Pertumbuhan Anak')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Grafik Pertumbuhan Anak</h1>
            <div class="section-header-button">
                <a href="{{ route('desa.anak.cetak', $anak->id) }}" class="btn btn-success">
                    <i class="fas fa-print"></i> Cetak KMS
                </a>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $anak->nama }}</h4>
                    <small>Ibu: {{ $anak->ibu->nama ?? '-' }}</small>
                </div>

                <div class="card-body">
                    <canvas id="grafikAnak" height="120"></canvas>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const labels = {!! json_encode($kms->pluck('usia_bulan')) !!};
        const bb = {!! json_encode($kms->pluck('berat_badan')) !!};
        const tb = {!! json_encode($kms->pluck('tinggi_badan')) !!};

        const ctx = document.getElementById('grafikAnak').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Berat Badan (kg)',
                        data: bb,
                        borderWidth: 2,
                        tension: 0.3
                    },
                    {
                        label: 'Tinggi Badan (cm)',
                        data: tb,
                        borderWidth: 2,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Usia (bulan)'
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
