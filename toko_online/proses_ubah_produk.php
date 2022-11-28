<?php
include "koneksi.php";
if ($_POST) {
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    $ekstensi = array('png', 'jpg', 'jpeg');
    $namafile = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    $tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
    $ukuran = $_FILES['file']['size'];

    if (empty($nama_produk)) {
        echo "<script>alert('nama_produk tidak boleh kosong');location.href='tambah_produk.php';</script>";
    } elseif (empty($deskripsi)) {
        echo "<script>alert('deskripsi tidak boleh kosong');location.href='tambah_produk.php';</script>";
    } elseif (empty($harga)) {
        echo "<script>alert('harga tidak boleh kosong');location.href='tambah_produk.php';</script>";
    } else {
        //if (!in_array($tipe_file, $ekstensi)) {
        //     header("location:ubah_produk.php?alert=gagal_ektensi");
        //} else {
            if ($ukuran < 1044070) {
                move_uploaded_file($tmp, 'foto/' . $namafile);
                $update = mysqli_query($conn, "update produk set nama_produk='" . $nama_produk . "', deskripsi='" . $deskripsi . "', harga='" . $harga . "', foto='" . $namafile . "' , id_produk='".$id_produk."' where id_produk = $id_produk") or die(mysqli_error($conn));
                if ($update) {
                    echo "<script>alert('Sukses update produk');location.href='tampil_produk.php';</script>";
                } else {
                    echo "<script>alert('Gagal update produk');location.href='ubah_produk.php?id_produk=" . $id_produk . "';</script>";
                }
            }else{
                echo "<script>alert('Ukuran Terlalu Besar');location.href='ubah_produk.php';</script>";
            }
        }
   // }
}
