<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Report</title>
    <style>
        * {
            box-sizing: border-box;
        }
        html {
            font-size: 12px;
        }

        .table {
            border-collapse: collapse !important;
            width: 100%;
        }

        .table-bordered th,
        .table-bordered td {
            padding: 0.5rem;
            border: 1px solid black !important;
        }
        /* Float four columns side by side */
        .column {
            float: left;
            width: 30%;
            padding: 0 10px;
        }

        /* Remove extra left and right margins, due to padding */
        .row {margin: 0 -5px;}

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive columns */
        @media screen and (max-width: 600px) {
            .column {
                width: 100%;
                display: block;
                margin-bottom: 20px;
            }
        }

        /* Style the counter cards */
        .card {
            padding: 16px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div style="text-align: center">
        <h1>Laporan</h1>
        <h1>Lembaga Kesejateraan Sosial (LKS)</h1>
    </div>
    <div style="margin-bottom: 20px">
        <table>
            <tr>
                <td>Nama Lembaga</td>
                <td>:</td>
                <td>{{ auth()->user()->name }}</td>
            </tr>
            <tr>
                <td>NPWP</td>
                <td>:</td>
                <td>{{ auth()->user()->username }}</td>
            </tr>
            <tr>
                <td>Lokasi Lembaga</td>
                <td>:</td>
                <td>{{ auth()->user()->lks->address['regency'] }}, {{ auth()->user()->lks->address['district'] }}, {{ auth()->user()->lks->address['village'] }}, {{ auth()->user()->lks->address['full_address'] }}, RW {{ auth()->user()->lks->address['rw'] }}, RT {{ auth()->user()->lks->address['rt'] }}</td>
            </tr>
            <tr>
                <td>Bulan</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($date)->translatedFormat('F Y') }}</td>
            </tr>
        </table>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Tempat Kegiatan</th>
                <th>Aktivitas</th>
                <th>Kendala</th>
                <th>Uraian / Keterangan Foto</th>
                <th>Dokumentasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $index => $report)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($report->date)->translatedFormat('d F Y') }}</td>
                    <td>{{ $report->venue }}</td>
                    <td>{{ $report->activity }}</td>
                    <td>{{ $report->constraint }}</td>
                    <td>{{ $report->description }}</td>
                    <td>
                        <img src="{{ public_path('storage/pillars/lks/report/daily/'. $report->attachment) }}" alt="" style="width: 150px;">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-left: 450px; font-size: 15px">
        <p>{{ auth()->user()->lks->address['district'] }}, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
    </div>

    <div class="row" style="font-size: 13px">
        <div class="column">
            <div class="card">
                <h3>LKS {{ auth()->user()->name }}</h3>
                <p>Pimpinan LKS</p>
                <p style="margin-top: 100px; text-transform: uppercase; font-weight: bold">{{ auth()->user()->lks->leader_name }}</p>
            </div>
        </div>

        <div class="column" style="margin-left: 230px">
            <div class="card">
                <h3>Desa {{ auth()->user()->lks->address['village'] }}</h3>
                <p>{{ $positionHeadman }}</p>
                <p style="margin-top: 100px; text-transform: uppercase; font-weight: bold">{{ $headman }}</p>
                @if ($nip != null)
                    <p>NIP. {{ $nip }}</p>
                @endif
            </div>
        </div>
    </div>

    <center>
        <div style="font-size: 13px">
            <h3>{{ auth()->user()->office->name }}</h3>
            <p>{{ $positionDepartement }}</p>
            <p style="margin-top: 100px; text-transform: uppercase; font-weight: bold">{{ $headOfDepartement }}</p>
            <p>{{ $grade }}</p>
            <p>NIP. {{ $nipDepartement }}</p>
        </div>
    </center>
</body>
</html>
