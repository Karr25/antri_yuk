<?php include "../template/header.php"; ?>
<?php 
	include $_SERVER['DOCUMENT_ROOT'] . '/antriyuk/node_module/helper/db_helper.php'; 
	include "../koneksi.php";
	error_reporting(0);
?> 

<div class="container">
    <div class="row mt-5">
        <div class="col-12 px-3 py-3">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Semua Data Antrian</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="antrian_terlayani.php">Antrian Terlayani</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="antrian_belum_terlayani.php">Antrian Belum Terlayani</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="antrian_yang_dilayani_anda.php" tabindex="-1">Antrian Yang Dilayani Anda</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="mx-5">
                <center>
                    <table>
                        <tr>
                            <td class="px-2"><font size="+3">Semua Data Antrian </font></td>
                            <td class="px-2">
                                <div class="card px-2 py-2" style="text-align: left">
                                    <b>Reset Antrian</b>
                                    <i>Kembali ke antrian pertama</i>
                                    <a href="proses_reset_antrian.php" class="btn btn-danger">Reset</a>
                                </div>
                            </td>
                            <td class="px-2">
                                <div class="card px-2 py-2" style="text-align: left">
                                    <b>Cetak</b>
                                    <i>Cetak dalam bentuk kertas atau .pdf</i>
                                    <a href="javascript:void(0);" class="btn btn-primary" onclick="openPrintPopup()">Print/Cetak</a>
                                </div>
                            </td>
                        </tr>
                    </table>
                </center>
            </div>
        </div>

        <div class="col-12 px-3 py-3">
            <hr>
            <table class="table table-hover table-bordered">
                <tr>
                    <td><b>ID Antrian</b></td>
                    <td><b>NO Antrian</b></td>
                    <td><b>Status Dilayani</b></td>
                    <td><b>Waktu di Buat</b></td>
                    <td><b>Waktu di Layani</b></td>
                    <td><b>Dilayani Oleh (id admin)</b></td>
                </tr>
                <?php 
                    $queri1 = mysqli_query($conn, "SELECT * FROM tbl_antrian_live WHERE no_antrian > 0");
                    while($dataant = mysqli_fetch_array($queri1)) {  
                ?>
                <tr>
                    <td><?= $dataant['id_data']; ?></td>
                    <td><?= $dataant['no_antrian']; ?></td>
                    <td>
                        <?php
                            if($dataant['status_dilayani'] == 'belum') {
                                echo "<div class='badge badge-danger'>belum</div>"; 
                            } else if($dataant['status_dilayani'] == 'sudah dilayani') {
                                echo "<div class='badge badge-success'>Sudah Dilayani</div>"; 
                            } 
                        ?>
                    </td>
                    <td><?= $dataant['waktu_buat']; ?></td>
                    <td><?= $dataant['waktu_selesai_dilayani']; ?></td>
                    <td><?= $dataant['id_admin_melayani']; ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <?php include "../template/footer.php"; ?>

    <script>
    function openPrintPopup() {
        var printWindow = window.open('print_antrian.php?type=semua', 'PrintWindow', 'width=800,height=600');
        printWindow.focus();
    }
    </script>
</div>
