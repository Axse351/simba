@extends('welcome')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Grafik Kesehatan Ibu - {{ $warga->nama }}</h4>
        </div>
        <div class="card-body">
            <canvas id="grafikBerat"></canvas>
            <hr>
            <canvas id="grafikIMT"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const labels = {!! json_encode(
            $warga->kmsIbu->pluck('tanggal_pemeriksaan')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d-m-Y')),
        ) !!};

        // Berat Badan
        new Chart(document.getElementById('grafikBerat'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Berat Badan (kg)',
                    data: {!! json_encode($warga->kmsIbu->pluck('berat_badan')) !!},
                    tension: 0.3
                }]
            }
        });

        // IMT
        new Chart(document.getElementById('grafikIMT'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'IMT',
                    data: {!! json_encode($warga->kmsIbu->pluck('imt')) !!},
                    tension: 0.3
                }]
            }
        });
    </script>
@endsection
