<?php
if($_POST){
    $id_user=$_POST['id_user'];
    $nama_user=$_POST['nama_user'];
    $username=$_POST['username'];
    $alamat = $_POST['alamat'];
    $tlp = $_POST['tlp'];
    $password=$_POST['password'];
    $role=$_POST['role'];
    if(empty($nama_user)){
        echo "<script>alert('nama user tidak boleh kosong');location.href='tambah_user.php';</script>";
 
    } elseif(empty($username)){
        echo "<script>alert('username tidak boleh kosong');location.href='tambah_user.php';</script>";
    } elseif (empty($alamat)) {
        echo "<script>alert('alamat tidak boleh kosong');location.href='tambah_user.php';</script>";
    } elseif (empty($tlp)) {
        echo "<script>alert('tlp tidak boleh kosong');location.href='tambah_user.php';</script>";
    } elseif(empty($role)){
        echo "<script>alert('role tidak boleh kosong');location.href='tambah_user.php';</script>";
    }else {
        include "koneksi.php";
        $update = mysqli_query($conn, "update user set nama_user='" . $nama_user . "', username='" . $username . "', alamat='" . $alamat . "', tlp='" . $tlp . "', password='".md5($password)."', role ='".$role."' where id_user = $id_user") or die(mysqli_error($conn));
            if($update){
                echo "<script>alert('Sukses update user');location.href='tampil_user.php';</script>";
            } else {
                echo "<script>alert('Gagal update user');location.href='ubah_user.php?id_user=".$id_user."';</script>";
            }
        
        
    } 
}
