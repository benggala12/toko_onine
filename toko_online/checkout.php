<?php 
session_start();
include "koneksi.php";
$cart=@$_SESSION['cart'];
//$id_user = $_POST['id_user'];
if(count($cart)>0){
    $tgl_transaksi=date('Y-m-d',mktime(0,0,0,date('m'),(date('d')),date('Y')));
    mysqli_query($conn,"insert into transaksi(id_user,tgl_transaksi)value('".$_SESSION['id_user']."','".$tgl_transaksi."')");
    // echo "insert into transaksi(id_user,tgl_transaksi)value('".$_SESSION['id_user']."','".$tgl_transaksi."')";

    $id=mysqli_insert_id($conn);
    foreach ($cart as $key_produk=>$val_produk){
        mysqli_query($conn,"insert into detail_transaksi(id_transaksi,id_produk,qty)value('".$id."','".$val_produk['id_produk']."','".$val_produk['qty']."')");
    }
    unset($_SESSION['cart']);
    echo'<script>alert("Anda berhasil membeli produk");location.href="histori_pembelian.php"</script>';
    
}


?>