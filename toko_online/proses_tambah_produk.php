<?php
include "koneksi.php";
if ($_POST['simpan']) {
	$nama_produk = $_POST['nama_produk'];
	$deskripsi = $_POST['deskripsi'];
	$harga = $_POST['harga'];

	$ekstensi = array('png', 'jpg', 'jpeg');
	$namafile = $_FILES['file']['name'];
	$tmp = $_FILES['file']['tmp_name'];
	$tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
	$ukuran = $_FILES['file']['size'];

	if (empty($nama_produk)) {
		echo "<script>alert('nama produk tidak boleh kosong');location.href='tambah_produk.php';</script>";
	} elseif (empty($deskripsi)) {
		echo "<script>alert('deskripsi tidak boleh kosong');location.href='tambah_produk.php';</script>";
	} elseif (empty($harga)) {
		echo "<script>alert('harga tidak boleh kosong');location.href='tambah_produk.php';</script>";
	} else {
		if (!in_array($tipe_file, $ekstensi)) {
			header("location:tambah_produk.php?alert=gagal_ektensi");
		} else {
			if ($ukuran < 1044070) {
				move_uploaded_file($tmp, 'foto/' . $namafile);

				$query = mysqli_query($conn, "insert into produk (nama_produk, deskripsi, harga, foto) value ('" . $nama_produk . "','" . $deskripsi . "','" . $harga . "','" . $namafile . "')") or die(mysqli_error($conn));
				if ($query) {
					echo "<script>alert('Sukses menambahkan produk');location.href='tampil_produk.php';</script>";
				} else {
					echo "<script>alert('Gagal menambahkan produk');location.href='tambah_produk.php';</script>";
				}
			} else {
				echo "<script>alert('Ukuran Terlalu Besar');location.href='tambah_produk.php';</script>";
			}
		}
	}
}


