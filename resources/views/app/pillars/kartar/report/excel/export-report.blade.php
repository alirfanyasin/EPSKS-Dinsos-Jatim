<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Bulanan</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800&family=Poppins:wght@200;300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Nunito Sans', sans-serif;
            /* font-family: 'Poppins', sans-serif; */
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
        }

        table thead {
            font-weight: 800;
        }
    </style>
</head>


<body>

    <h1 class="text-primary">Laporan</h1>

    <table border="1" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Karang Taruna</th>
                <th>Periode Laporan</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($data as $item)
                @if ($item->period == '1')
                    <tr>
                        <td align="center">{{ $no++ }}</td>
                        <td>{{ $item->name_kartar }}</td>
                        <td>{{ $item->period == '1' ? 'Bulanan' : 'Tahunan' }}</td>
                        <td>{{ date('M Y', strtotime($item->month)) }}</td>
                    </tr>
                @elseif($item->period == '2')
                    <tr>
                        <td align="center">{{ $no++ }}</td>
                        <td>{{ $item->name_kartar }}</td>
                        <td>{{ $item->period == '1' ? 'Bulanan' : 'Tahunan' }}</td>
                        <td>{{ $item->year }}</td>
                    </tr>
                @endif
            @endforeach
    </table>
</body>

</html>
