<?php
include "header.php";
?>
<h3 align="center"><strong>History Pembelian</strong></h3>
<table class="table table-hover table-striped">
    <thead>
        <th>NO</th>
        <th>Tanggal Beli</th>
        <?php
        if ($_SESSION['role'] == 'petugas') {
        ?>
            <th>Nama Pelanggan</th>
        <?php
        }
        ?>
        <th>Nama Produk - Jumlah - Harga</th>
        <th>Total</th>
        <th>Status Produk</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        <?php
        include "koneksi.php";
        $qry_histori = mysqli_query($conn, "select * from transaksi order by id_transaksi desc");
        $qry_histori = mysqli_query($conn, "select transaksi.*, user.nama_user from transaksi join user ON user.id_user = transaksi.id_user order by id_transaksi desc");
        $no = 0;
        while ($dt_histori = mysqli_fetch_array($qry_histori)) {
            $total = 0;
            $no++;
            $produk_dipesan = "<ol>";
            $qry_produk = mysqli_query($conn, "select * from detail_transaksi join produk on produk.id_produk=detail_transaksi.id_produk where id_transaksi ='" . $dt_histori['id_transaksi'] . "'");
            while ($dt_produk = mysqli_fetch_array($qry_produk)) {
                $subtotal = 0;
                $subtotal += $dt_produk['harga'] * $dt_produk['qty'];
                $produk_dipesan .= "<li class = 'produk'>" . $dt_produk['nama_produk'] . "&nbsp;&nbsp;-&nbsp;&nbsp;" . $dt_produk['qty'] . "&nbsp;&nbsp;-&nbsp;&nbsp;" . "Rp. " . number_format($subtotal, 2, ',', '.') . "" . "</li>";
                $total += $dt_produk['harga'] * $dt_produk['qty'];
            }
            $produk_dipesan .= "</ol>";

        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $dt_histori['tgl_transaksi'] ?></td>
                <?php
                if ($_SESSION['role'] == 'petugas') {
                ?>
                    <td><?= $dt_histori['nama_user'] ?></td>
                <?php
                }
                ?>
                <td><?= $produk_dipesan ?></td>
                <td> <?php
                        echo "Rp. " . number_format($total, 2, ',', '.') . "";
                        ?>
                </td>


                <td><?= $dt_histori['status_produk'] ?></td>
                <td>
                    <?php
                    if ($dt_histori['status_produk'] == "barang dikemas") {
                    ?>
                        <?php
                        if ($_SESSION['role'] == 'petugas') {
                        ?>
                            <a href="ubah_status_produk.php?id_transaksi=<?= $dt_histori['id_transaksi'] ?>&status_produk=barang dikirim"><button class="btn btn-primary">barang dikirim</button></a>
                        <?php
                        }
                        ?>
                    <?php
                    } elseif ($dt_histori['status_produk'] == "barang dikirim") {
                    ?>
                        <?php
                        if ($_SESSION['role'] == 'pelanggan') {
                        ?>
                            <a href="ubah_status_produk.php?id_transaksi=<?= $dt_histori['id_transaksi'] ?>&status_produk=barang diterima"><button class="btn btn-primary">barang diterima</button></a>
                        <?php
                        }
                        ?>
                    <?php
                    } elseif ($dt_histori['status_produk'] == "barang diterima") {
                    ?>
                        <a href="ubah_status_produk.php?id_transaksi=<?= $dt_histori['id_transaksi'] ?>&status_produk=barang diterima"><button class="btn btn-primary">Selesai</button></a>
                    <?php
                    }
                    ?>

                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<a href="hapus_histori_pembelian.php" onclick="return confirm('Apakah anda ingin menghapus semua history?')" class="btn btn-secondary"> Hapus Histori</a>
<?php
include "footer.php";
?>