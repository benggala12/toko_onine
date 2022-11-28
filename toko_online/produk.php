<?php
include "header.php";
?>
<br>
<ul>
    <br>
    <h3 align="center"><strong>List Produk</strong></h3>
    <br>
    <br>
    <div class="row">
        <?php
        include "koneksi.php";
        $qry_produk = mysqli_query($conn, "select * from produk");
        while ($dt_produk = mysqli_fetch_array($qry_produk)) {
        ?>

            <br>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="masukkankeranjang.php">
                            <img src="foto/<?= $dt_produk['foto'] ?>" class="card-img-top">
                            <h5 class="card-title"><?= $dt_produk['nama_produk'] ?></h5>
                            <br>
                            <tr>
                                <td>Jumlah Pesan</td>
                                <td><input type="number" name="jumlah_beli" value="0"></td>
                            </tr>
                            <br>
                            <br>
                            <br>
                            <h6 class="card-text">Rp.<?= substr($dt_produk['harga'], 0, 500) ?></h6>
                            <br>

                            <input type="hidden" name="id_produk" value="<?= $dt_produk['id_produk'] ?>">
                            <input class="btn btn-primary" type="submit" value="Pilih">
                        </form>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>


    <br>
    <hr>
    <h3 align="center"><strong>Pesanan Produk</strong></h3>
    <br>
    <div class="row">
        <div class="col-md-8">
            <form action="histori_pembelian.php?id_produk=<?= $dt_produk['id_produk'] ?>" method="post">
                <table class="table table-secondary table-striped">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Sub Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $index => $value) {
                                $subtotal = $value['qty'] * $value['harga'];
                                $total += $subtotal;
                        ?>
                                <tr>
                                    <td><?= $value['nama_produk'] ?></td>
                                    <td><?= $value['harga'] ?></td>
                                    <td><?= $value['qty'] ?></td>
                                    <td><?= $subtotal ?></td>
                                    <td><a href="hapus_cart.php?id=<?= $index ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger"><strong>X</strong></a></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>

                        <tr>
                            <td colspan="3">Total</td>
                            <td><?= $total ?></td>
                        </tr>

                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <div class="card-body">
        <form action="checkout.php" method="post">
        <h3 align="center"><strong><input class="btn btn-secondary me-md-2" type="submit" value="Checkout"></strong></h3>
        </form>
    </div>