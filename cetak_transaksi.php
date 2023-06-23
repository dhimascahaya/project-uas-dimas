<?php
require 'function.php';
require 'ceklog.php';



// Cek apakah ada data transaksi dari transaksi.php yang dipilih untuk dicetak
if (isset($_GET['id_transaksi'])) {
    $idTransaksi = $_GET['id_transaksi'];

    // Panggil fungsi untuk mendapatkan data transaksi berdasarkan ID
    $dataTransaksi = getDataTransaksiById($idTransaksi);

    if ($dataTransaksi) {
        // Mendapatkan data transaksi berhasil
        $tanggal = $dataTransaksi['tanggal'];
        $nama = $dataTransaksi['nama'];
        $nama_pgw = $dataTransaksi['nama_pgw'];
        $merk = $dataTransaksi['merk'];
        $tipe = $dataTransaksi['tipe'];
        $jumlah = $dataTransaksi['jumlah'];
        $totalHarga = $dataTransaksi['total_harga'];
    } else {
        echo "Data transaksi tidak ditemukan.";
        exit; // Hentikan eksekusi jika data transaksi tidak ditemukan
    }
} else {
    echo "ID transaksi tidak ditemukan.";
    exit; // Hentikan eksekusi jika ID transaksi tidak ditemukan
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Record Transaksi - Cetak</title>
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        body {
            font-size: 12px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
            padding: 20px;
            box-sizing: border-box;
        }

        .data-item {
            display: flex;
            justify-content: space-between;
            width: 300px;
            margin-bottom: 10px;
        }

        .data-item p {
            margin: 0;
        }

        .outline-table {
            border-collapse: collapse;
            width: 100%;
        }

        .outline-table th,
        .outline-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .outline-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
<div class="container">
        
        <div class="header">
            <h2 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100%;">Nota Penjualan hp</h2>
            <p>Jl. Raya Jalan, Bantarkawung</p>
            <p>Telp: 087705028469</p>
        </div>
        <table class="outline-table">
            <tr>
                <th colspan="2" style="text-align: center;">Detail Transaksi</th>
            </tr>
            <tr>
                <th>Tanggal:</th>
                <td><?php echo $tanggal; ?></td>
            </tr>
            <tr>
                <th>Nama Pembeli:</th>
                <td><?php echo $nama; ?></td>
            </tr>
            <tr>
                <th>Nama Pegawai:</th>
                <td><?php echo $nama_pgw; ?></td>
            </tr>
            <tr>
                <th>Merk:</th>
                <td><?php echo $merk; ?></td>
            </tr>
            <tr>
                <th>Tipe:</th>
                <td><?php echo $tipe; ?></td>
            </tr>
            <tr>
                <th>Jumlah:</th>
                <td><?php echo $jumlah; ?></td>
            </tr>
            <tr>
                <th>Total Harga:</th>
                <td>Rp <?php echo $totalHarga; ?></td>
            </tr>
        </table>
        <div class="footer">
            <p>Terima kasih atas kunjungan Anda!</p>
        </div>
    </div>

    <style>
        .container {
            width: 300px;
            margin: auto;
            padding: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>

    <script>
        // Cetak halaman saat halaman selesai dimuat
        window.onload = function() { //kerika halaman selesai di muat
            window.print();         //panggil fungsi 'print()' pd objek 'window' utk memnuculkan box cetak
        };
    </script>

</body>


</html>
