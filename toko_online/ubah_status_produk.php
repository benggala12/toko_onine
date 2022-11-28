<?php
include "koneksi.php";
$get_produk = mysqli_query($conn, "select * from transaksi where id_transaksi = '".$_GET['id_transaksi']."'");
$status_produk = mysqli_fetch_array($get_produk);
if ($status_produk['status_produk'] != NULL){
    $update_status = mysqli_query($conn, "update transaksi set status_produk ='".$_GET['status_produk']."' where id_transaksi = '".$_GET['id_transaksi']."'");
echo "<script>alert('Sukses mengupdate status Produk');location.href='histori_pembelian.php';</script>";
} else {
    echo "<script>alert('Gagal mengupdate status Produk');location.herf='histori_pembelian.php';</script>";
}