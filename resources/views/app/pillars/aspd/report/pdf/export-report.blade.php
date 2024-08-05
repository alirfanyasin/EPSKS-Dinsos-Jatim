<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan ASPD</title>

    <style>
        .page-break {
            page-break-after: always;
        }

        .row {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>

    <section>
        <center>
            <h1 class="text-center">Laporan ASPD</h1>
            <h1 class="text-center">Asistensi Sosial Pendamping Disabilitas</h1>
            <h3>Bulan {{ date('F Y', strtotime($data_export['month'])) }}</h3>
        </center>
    </section>
    <div class="page-break"></div>
    <section>
        <header style="margin-bottom: 50px;">
            <table>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>:</td>
                    <td>{{ $data_export['name'] }}</td>
                </tr>
                <tr>
                    <td>Bulan</td>
                    <td>:</td>
                    <td>{{ date('F Y', strtotime($data_export['month'])) }}</td>
                </tr>
            </table>
        </header>

        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col">Waktu</th>
                    <th scope="col">Tempat</th>
                    <th scope="col">Aktifitas yang dilakukan</th>
                    <th scope="col">Kendala</th>
                    <th scope="col">Dokumentasi</th>
                    <th scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    {{-- {{ dd($item) }} --}}
                    {{-- {{ dd($item->aspd) }} --}}
                    @if (date('Y-m', strtotime($item->date)) == $data_export['month'] && $item->status == 'approved')
                        <tr>
                            <td>{{ date('d F Y', strtotime($item->date)) }}</td>
                            <td>{{ $item->venue }}</td>
                            <td>{{ $item->activity }}</td>
                            <td>{{ $item->constraint }}</td>
                            @php
                                $path = public_path('storage/image/pillars/ASPD/report/' . $item->attachment_daily);
                                $imageContents = file_get_contents($path);
                                $imageBase64 = base64_encode($imageContents);
                            @endphp
                            {{-- {{ dd('jao') }} --}}
                            <td>
                                <img src="data:image/jpg;base64,{{ $imageBase64 }}" alt=""
                                    style="width: 150px;">
                            </td>
                            <td>{{ $item->description }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

    </section>
</body>

</html>
