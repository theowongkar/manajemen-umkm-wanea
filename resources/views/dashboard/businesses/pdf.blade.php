<!DOCTYPE html>
<html>

<head>
    <title>Data UMKM</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            white-space: nowrap;
        }

        th {
            background-color: #486284;
            color: white;
            text-align: center;
            text-transform: uppercase;
        }

        thead {
            display: table-row-group;
        }

        td.address {
            white-space: normal;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">DATA UMKM KECAMATAN WANEA</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemilik</th>
                <th>No. HP</th>
                <th>Usaha/Kerajinan</th>
                <th>Alamat</th>
                <th>Ket.</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($businesses as $i => $business)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $business->owner_name }}</td>
                    <td>{{ $business->owner_phone }}</td>
                    <td>{{ $business->product_name }}</td>
                    <td class="address">{{ $business->urbanVillage?->name }} {{ $business->address }}</td>
                    <td>{{ $business->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
