<!DOCTYPE html>
<html>

<head>
    <title>Laporan Peminjaman Inventsel</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
        }

        table {
            w-full;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            bg-color: #f2f2f2;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            margin-top: 0;
            color: #666;
        }
    </style>
</head>

<body>
    <h2>LAPORAN DATA PEMINJAMAN BARANG</h2>
    <p>PT Telkomsel Indonesia - Diunduh pada: {{ date('d-m-Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Nama Peminjam</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Daftar Unit Aset</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrowings as $borrowing)
                <tr>
                    <td><strong>{{ $borrowing->user->name }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($borrowing->tanggal_pinjam)->format('d/m/Y') }}</td>
                    <td>{{ $borrowing->tanggal_kembali ? \Carbon\Carbon::parse($borrowing->tanggal_kembali)->format('d/m/Y') : '-' }}
                    </td>
                    <td>{{ $borrowing->status }}</td>
                    <td>
                        @foreach($borrowing->borrowingDetails as $detail)
                            • {{ $detail->productInstance->product->nama_barang }}
                            ({{ $detail->productInstance->kode_unik }})<br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>