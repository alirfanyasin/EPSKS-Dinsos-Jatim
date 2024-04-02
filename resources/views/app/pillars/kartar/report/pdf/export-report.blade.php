<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan</title>

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
      <h1 class="text-center">Laporan <br> Karang Taruna</h1>
      <h3>Bulan {{ date('F Y', strtotime($data_export['month'])) }}</h3>

      <div style="margin-top: 700px">
        <h3>Karang Taruna {{ $data_export['name_kartar'] }}</h3>
        <h3>{{ $data_export['regency'] }}</h3>
      </div>
    </center>
  </section>
  <div class="page-break"></div>
  <section>
    <header style="margin-bottom: 50px;">
      <table>
        <tr>
          <td>Karang Taruna</td>
          <td>:</td>
          <td>{{ $data_export['name_kartar'] }}</td>
        </tr>
        <tr>
          <td>Wilayah Kerja</td>
          <td>:</td>
          <td>{{ $data_export['regency'] . ', ' . $data_export['distric'] . ', ' . $data_export['village'] }}</td>
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
          <th scope="col">No</th>
          <th scope="col">Waktu</th>
          <th scope="col">Tempat</th>
          <th scope="col">Aktifitas yang dilakukan</th>
          <th scope="col">Kendala</th>
          <th scope="col">Dokumentasi</th>
        </tr>
      </thead>
      <tbody>
        @php
          $no = 1;
        @endphp
        @foreach ($data as $item)
          @if (date('Y-m', strtotime($item->date)) == $data_export['month'])
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ date('d F Y', strtotime($item->date)) }}</td>
              <td>{{ $item->place }}</td>
              <td>{{ $item->activity }}</td>
              <td>{{ $item->constraint }}</td>
              <td><img src="{{ public_path('storage/image/pillars/kartar/report/' . $item->image) }}" alt=""
                  style="width: 150px;">
              </td>
            </tr>
          @endif
        @endforeach
      </tbody>
    </table>




    <table style="margin-top: 50px;">
      <tr>
        <td style="padding: 0 60px;">
          <div style="text-align: center;">
            <div>Mengetahui:</div>
            <b style="text-transform: uppercase;">Karang Taruna {{ $data_export['name_kartar'] }}</b>
            </br></br></br></br><br><br>
            <div style="text-transform: uppercase;">{{ $data_export['name_kartar'] }}</div>
          </div>
        </td>
        <td style="padding: 0 60px;">
          <div style="text-align: center;">
            <div>Mengetahui,</div>
            <b style="text-transform: uppercase;">Kepala Desa {{ $data_export['village'] }}</b>
            </br></br></br></br><br><br>
            <div style="border-bottom: 1px solid black; text-transform: uppercase;">{{ $data_export['head_village'] }}
            </div>
            <div>NIP. {{ $data_export['nip_village'] }}</div>
          </div>
        </td>
      </tr>
    </table>

    <table>
      <tr>
        <td style="padding: 0 170px;">
          <div style="text-align: center; padding-top: 100px">
            <div>Mengetahui,</div>
            <b style="text-transform: uppercase;">Kepala Dinas Sosial {{ $data_export['regency'] }}</b>
            <div style="text-transform: uppercase;">{{ $data_export['position_dinas'] }}</div>
            </br></br></br><br>


            <div style="text-transform: uppercase;"><span style="border-bottom: 1px solid black;">
                {{ $data_export['head_dinas'] }}</span>
            </div>
            <div> <span style="border-bottom: 1px solid black;">{{ $data_export['class_dinas'] }}</span></div>
            <div>NIP. {{ $data_export['nip_dinas'] }}</div>
          </div>
        </td>
      </tr>
    </table>
  </section>
</body>

</html>
