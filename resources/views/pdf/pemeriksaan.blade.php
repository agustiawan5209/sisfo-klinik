<!DOCTYPE html>
<html>
<head>
    <title>Data Pemeriksaan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .header h1, .header h2, .header p {
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .ttd *{
            border: 0px;
        }
    </style>
</head>
<body>
    <div class="header">
        {{-- <img src="{{ asset('path/to/logo.png') }}" alt="Logo Perusahaan"> --}}
        <h1>KLINIK FAHRI DENT K</h1>
        <h2>Laporan Pemeriksaan</h2>
        <p>Karunrung, Kec. Rappocini, Kota Makassar, Sulawesi Selatan 90221</p>
        <p>Telepon:  +62 812-4275-5965</p>
        <hr>
    </div>
    <div class="content">
        <h1>Data Laporan Pemeriksaan</h1>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th style="font-size:12px;">Nama Pasien | Tanggal Lahir Pasien</th>
                    <th>Nama Layanan | ID Layanan</th>
                    <th>Nama Petugas</th>
                    <th>Nama Dokter</th>
                    <th>Tanggal Pemeriksaan</th>
                    <th>Hasil Pemeriksaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_pasien }}

                            @if ($item->pasien != null)
                            <br> ||
                            {{ $item->pasien->tgl_lahir }}
                            @endif
                        </td>
                        <td>{{ $item->nama_layanan }}</td>
                        <td>{{ $item->nama_petugas }}</td>
                        <td>{{ $item->nama_dokter }}</td>
                        <td>{{ $item->tgl_pemeriksaan }}</td>
                        <td>{!! $item->hasil_pemeriksaan !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
      {{-- TTD --}}
      <div class="ttd" style="width:100%; position: relative; padding: 0px 0px; ">
        <table style="width: 300px; position: absolute; right:30px; top:0; margin-top: 30px;">
            <tr>
                <td style="font-weight: 0; padding: 4px 0px;"> Makassar, {{ date('j F Y') }}</td>
            </tr>
            <tr>
                <td style="font-weight: 0; padding: 20px 0px;"></td>
            </tr>
            <tr>
                <td style="font-weight: 0; padding: 20px 0px;"></td>
            </tr>
            <tr>
                <td style="font-weight: 0; padding: 4px 0px; text-align: center;">
                    <span>Admin KLINIK FAHRI DENT K
                    </span>
                    <hr>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
