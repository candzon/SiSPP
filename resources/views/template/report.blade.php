<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @page {
            size: A4;
        }

        .container {
            margin: 10px auto;
            width: 100%;
        }

        .header {
            text-align: start;
        }

        .header img {
            width: 200px;
            float: left;
        }

        .header h3,
        .header p {
            margin: 2px;
            word-wrap: break-word;
        }

        .divider {
            border: 1px solid #000;
            margin: 20px 0;
            width: 100%;
        }

        .isi-body {
            margin: 10px;
        }

        .isi-header {
            text-align: center;
        }

        .underline-text {
            text-decoration: underline;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 8px;
        }

        .td-quantity {
            text-align: center;
        }

        .td-background {
            border: 1px solid #000;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h3>SEKOLAH MENENGAH ATAS</h3>
            <p>Jl. Pendidikan No. 123, Kecamatan Maju, Indonesia</p>
            <p>Telepon : (021) 555-0123 | E-mail : info@sekolah.sch.id</p>
        </div>
        <hr class="divider">

        <div class="isi-body">
            <h3 class="isi-header underline-text">LAPORAN PEMBAYARAN SPP</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Status</th>
                        <th>Tanggal Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalPembayaran = 0;
                    @endphp
                    @foreach ($workOrders as $spp)
                        @php
                            $totalPembayaran += $spp->jumlah;
                            
                            $name = DB::table('users')
                                ->where('id', $spp->user_id)
                                ->value('name');
                        @endphp
                        <tr>
                            <td>{{ $name }}</td>
                            <td class="td-quantity">Rp {{ number_format($spp->jumlah, 0, ',', '.') }}</td>
                            <td class="td-quantity">{{ $spp->status }}</td>
                            <td class="td-quantity">{{ date('d/m/Y', strtotime($spp->tanggal_pembayaran)) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" style="text-align: right;"><strong>Total Pembayaran</strong></td>
                        <td class="td-quantity"><strong>Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>