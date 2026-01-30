<!DOCTYPE html>
<html>

<head>
    <title>KMS Anak</title>
    <style>
        body {
            font-family: Arial;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }
    </style>
</head>

<body>

    <h3>KARTU MENUJU SEHAT (KMS)</h3>

    <p>
        Nama Anak: {{ $anak->nama }} <br>
        Ibu: {{ $anak->ibu->nama ?? '-' }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Usia (bln)</th>
                <th>BB</th>
                <th>TB</th>
                <th>Status BB/U</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kms as $k)
                <tr>
                    <td>{{ $k->usia_bulan }}</td>
                    <td>{{ $k->berat_badan }}</td>
                    <td>{{ $k->tinggi_badan }}</td>
                    <td>{{ $k->status_bb_u }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        window.print();
    </script>

</body>

</html>
