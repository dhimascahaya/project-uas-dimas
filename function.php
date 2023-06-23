<?php
// Periksa status sesi sebelum memulai sesi baru
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_transaksi");

// tambah stok hp
if (isset($_POST['inserhp'])) {   //periksa apakah tombol 'inserhp' telah dikrim dg metode POST. jika ya, eksekusi kode utk tambah stok hp
	$tipe_hp = $_POST['tipe_hp'];
	$harga_hp = $_POST['harga_hp'];
	$stock_hp = $_POST['stock_hp'];
	$spek_hp = $_POST['spek'];

	//menjalankan query SQL utk memasukan data hp baru ke tabel 'handphone'
	$tambahkb = mysqli_query($conn, "insert into handphone (merk, tipe, harga_hp, stock_hp, spesifikasi) values ('$merk_hp', '$tipe_hp', '$harga_hp', '$stock_hp', '$spek_hp')");
	if ($tambahkb) { 				//jika berhasil, blok kode akan di eksekusi diarahkan ke halaman index.php
		header('location:index.php');
	} else {
		echo "gagal"; 			//jika gagal dijalankan, tampilkan pesan "gagal"
		header('location:index.php');
	}
}

//update stok hp
if (isset($_POST['updatehp'])) {  //periksa tombol 'updatehp' tlah dikrim melalui POST, jika ya, eksekusi kode utk update stok hp
	$merk_hp = $_POST['merk'];	//ambil nilai dari input dg nama 'merk' di krim melalui metode POST dan di simpan dlm variabel '$merk_hp'
	$tipe_hp = $_POST['tipe'];
	$harga_hp = $_POST['harga'];
	$stock_hp = $_POST['stock'];
	$spek_hp = $_POST['spek'];
	$id_hp = $_POST['idhp'];
	// print_r($iduser);
	// exit();

	//jalankan query SQL utk update data hp yg memliki ID yg sesuai dg '$id_hp' dg nilai yg telah di ambil sebelumnya
	$updatehp = mysqli_query($conn, "update handphone set merk='$merk_hp', tipe='$tipe_hp', harga_hp='$harga_hp' , stock_hp='$stock_hp', spesifikasi='$spek_hp' where handphone.id_hp='$id_hp' ");
	if ($updatehp) {			//periksa query utk update data hp, jika berhasil eksekusi kode 
		header('location:index.php');  //arahkan pengguna ke halaman 'index.php'
	} else {
		echo "gagal";
		header('location:index.php');
	}
}

//delete stok hp
if (isset($_POST['deletehp'])) {		//jika query utk hapus data hp berhasil dijalankan, kode di eksekusi
	$id_hanphone = $_POST['idhp'];

		//jalankan query SQL utk hapus data hp yg memiliki ID yg sesuai dg '$id_hanphone'
	$deletehp = mysqli_query($conn, "delete from handphone where id_hp='$id_hanphone'");
	if ($deletehp) {			//jika query berhasil di jalankan, user kembali ke halaman 'index.php'
		header('location:index.php');
	} else {
		echo "gagal";
		header('location:index.php');
	}
}

//insert pegawai
if (isset($_POST['savepgw'])) {
	$nama = $_POST['nama'];
	$no_hp = $_POST['nohp'];
	$alamat = $_POST['alamat'];

	$tambahpgw = mysqli_query($conn, "insert into pegawai (nama_pgw, alamat_pgw, telp_pgw) values ('$nama', '$alamat', '$no_hp')");
	if ($tambahpgw) {
		header('location:pegawai.php');
	} else {
		echo "gagal";
		header('location:pegawai.php');
	}
}

//update pegawai
if (isset($_POST['updatepgw'])) {
	$nama = $_POST['nama'];
	$no_hp = $_POST['nohp'];
	$alamat = $_POST['alamat'];
	$id_pgw = $_POST['idpgw'];

	$updatepgw = mysqli_query($conn, "UPDATE pegawai SET nama_pgw='$nama', alamat_pgw='$alamat', telp_pgw='$no_hp' WHERE id_pegawai='$id_pgw'");
	if ($updatepgw) {
		header('location:pegawai.php');
	} else {
		echo "gagal";
		header('location:pegawai.php');
	}
}

//delete pegawai
if (isset($_POST['deletepgw'])) {
	$id_pgw = $_POST['idpgw'];

	$deletepgw = mysqli_query($conn, "delete from pegawai where id_pegawai='$id_pgw'");
	if ($deletepgw) {
		header('location:pegawai.php');
	} else {
		echo "gagal";
		header('location:pegawai.php');
	}
}


//insert pembeli
if (isset($_POST['savepembeli'])) {
	$nama = $_POST['nama'];
	$no_hp = $_POST['nohp'];
	$alamat = $_POST['alamat'];

	$tambahpembeli = mysqli_query($conn, "insert into pembeli (nama, alamat, no_hp) values ('$nama', '$alamat', '$no_hp')");
	if ($tambahpembeli) {
		header('location:pembeli.php');
	} else {
		echo "gagal";
		header('location:pembeli.php');
	}
}

//update pembeli
if (isset($_POST['updatepembeli'])) {
	$nama = $_POST['nama'];
	$no_hp = $_POST['nohp'];
	$alamat = $_POST['alamat'];
	$idpembeli = $_POST['id_pembeli'];

	$updatepembeli = mysqli_query($conn, "update pembeli set nama='$nama', alamat='$alamat', no_hp='$no_hp' where id_pembeli='$idpembeli'");
	if ($updatepembeli) {
		header('location:pembeli.php');
	} else {
		echo "gagal";
		header('location:pembeli.php');
	}
}

//delete pembeli
if (isset($_POST['deletepembeli'])) {
	$idpembeli = $_POST['id_pembeli'];

	$deletepembeli = mysqli_query($conn, "delete from pembeli where id_pembeli='$idpembeli'");
	if ($deletepembeli) {
		header('location:pembeli.php');
	} else {
		echo "gagal";
		header('location:pembeli.php');
	}
}

// insert transaksi
if (isset($_POST['savetransaksi'])) {
	$pembeli = $_POST['pembeli'];
	$pegawai = $_POST['pgw'];
	$handphone = explode('_', $_POST['handphone']); //[0]=>3, [1]=>1200
	$jumlah = $_POST['jumlah'];
	$harga = $_POST['harga'];

	$lihatstock = mysqli_query($conn, "select * from handphone where id_hp='$handphone[0]'");
	$stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
	$stockskrg = $stocknya['stock_hp'];

	if ($jumlah <= $stockskrg) {
		$stockupdate = $stockskrg - $jumlah;
		$updatestock = mysqli_query($conn, "update handphone set stock_hp='$stockupdate' where id_hp='$handphone[0]'");
		$tambahtransaksi = mysqli_query($conn, "insert into transaksi (id_pembeli, id_pegawai, id_hp, total_harga, jumlah) values ('$pembeli', '$pegawai', '$handphone[0]', '$harga', '$jumlah')");
		header('location:transaksi.php');
	} else {
		echo "gagal";
		header('location:transaksi.php');
	}
}


// delete transaksi
if (isset($_POST['deletetransaksi'])) {
	$id_transaksi = $_POST['id_transaksi'];
	$id_hp = $_POST['id_hp'];
	$jumlah = $_POST['jumlah'];

	$lihatstock = mysqli_query($conn, "select * from handphone where id_hp='$id_hp'");
	$stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
	$stockskrg = $stocknya['stock_hp'];

	$stockupdate = $stockskrg + $jumlah;
	$updatestock = mysqli_query($conn, "update handphone set stock_hp='$stockupdate' where id_hp='$id_hp'");
	$tambahtransaksi = mysqli_query($conn, "delete from transaksi where id_transaksi='$id_transaksi'");

	header('location:transaksi.php');
}


// Periksa apakah fungsi getDataTransaksiById sudah ada sebelumnya
if (!function_exists('getDataTransaksiById')) {
    // Fungsi untuk mendapatkan data transaksi berdasarkan ID
    function getDataTransaksiById($idTransaksi)
    {
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'db_transaksi';

        // Koneksi ke database
        $conn = mysqli_connect($host, $user, $password, $database);

        // Periksa koneksi
        if (!$conn) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }

        // Query untuk mendapatkan data transaksi berdasarkan ID
        $query = "SELECT * FROM transaksi
                  LEFT JOIN pembeli ON transaksi.id_pembeli = pembeli.id_pembeli
                  LEFT JOIN pegawai ON transaksi.id_pegawai = pegawai.id_pegawai
                  LEFT JOIN handphone ON transaksi.id_hp = handphone.id_hp
                  WHERE transaksi.id_transaksi = '$idTransaksi'";

        // Eksekusi query
        $result = mysqli_query($conn, $query);

        // Periksa eksekusi query
        if ($result && mysqli_num_rows($result) > 0) {
            // Ambil data transaksi sebagai array asosiatif
            $dataTransaksi = mysqli_fetch_assoc($result);

            // Tutup koneksi ke database
            mysqli_close($conn);

            // Mengembalikan data transaksi
            return $dataTransaksi;
        }

        // Jika tidak ada data transaksi ditemukan atau terjadi kesalahan, kembalikan null
        mysqli_close($conn);
        return null;
    }
}
?>