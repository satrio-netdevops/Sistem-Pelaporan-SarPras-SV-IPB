<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Masuk</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; }
        th { background: #f4f4f4; }
        .small { font-size: 11px; color: #555; }
    </style>
</head>
<body>
    <h3>Laporan Masuk</h3>
    <p class="small">Dicetak: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Waktu</th>
                <th>Pelapor</th>
                <th>Objek</th>
                <th>Lokasi</th>
                <th>Tipe</th>
                <th>Aset</th>
                <th>Deskripsi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ optional($report->user)->name }}</td>
                    <td>{{ $report->object_name }}</td>
                    <td>{{ $report->location }}</td>
                    <td>{{ $report->report_type }}</td>
                    <td>{{ $report->asset_type }}</td>
                    <td>{{ $report->description }}</td>
                    <td>{{ $report->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
