<?php
if($_POST){
    //$id_user=$_POST['id_user'];
    $nama_user=$_POST['nama_user'];
    $username=$_POST['username'];
    $alamat=$_POST['alamat'];
    $tlp=$_POST['tlp'];
    $password= $_POST['password'];
    $role=$_POST['role'];
    if(empty($nama_user)){
        echo "<script>alert('nama_user tidak boleh kosong');location.href='tambah_user.php';</script>";
 
    } elseif(empty($username)){
        echo "<script>alert('username tidak boleh kosong');location.href='tambah_user.php';</script>";
    } elseif(empty($alamat)){
        echo "<script>alert('alamat tidak boleh kosong');location.href='tambah_user.php';</script>";
    }  elseif(empty($tlp)){
        echo "<script>alert('telepon tidak boleh kosong');location.href='tambah_user.php';</script>";
    } elseif(empty($password)){
        echo "<script>alert('password tidak boleh kosong');location.href='tambah_user.php';</script>";
    } else {
        include "koneksi.php";
        $insert=mysqli_query($conn,"insert into user (nama_user, username, alamat, tlp, password, role) value ('".$nama_user."','".$username."','".$alamat."','".$tlp."','".md5($password)."','".$role."')") or die(mysqli_error($conn));
        if($insert){
            echo "<script>alert('Sukses menambahkan user');location.href='tampil_user.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan user');location.href='tambah_user.php';</script>";
        }
    }
}
?>