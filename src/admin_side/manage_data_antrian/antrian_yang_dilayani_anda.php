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
        <a class="nav-link" href="index.php">Semua Data Antrian</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="antrian_terlayani.php">Antrian Terlayani</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="antrian_belum_terlayani.php">Antrian Belum terlayani</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#">Antrian Yang di layani anda</a>
      </li>
    </ul>
</div>

<div class="row">
<div class="mx-5">
<center>
<table>
<tr>
    <td class="px-2"><font size="+3">Antrian yang dilayani anda</font></td>
    <td class="px-2"><font><div class="card px-2 py-2" style="text-align: left">
    <b>Reset Antrian</b>
    <i>Kembali ke antrian pertama</i>
    <a href="proses_reset_antrian.php" class="btn btn-danger">Reset</a>
    </div></font></td>
    <td class="px-2"><font><div class="card px-2 py-2" style="text-align: left">
    <b>Cetak</b>
    <i>Cetak dalam bentuk kertas atau .pdf</i>
    <a href="#" class="btn btn-primary" onclick="openPrintPopup()">Print/Cetak</a>
    </div></font></td>
</tr>
</table>
</center>
</div>
</div>

<div class="col px-3 py-3">
<hr>
<table class="table table-hover table-bordered" style="height: 60%; overflow-y: scroll;">
    <tr>
        <td><b>ID Antrian</b></td>
        <td><b>NO Antrian</b></td>
        <td><b>Status Dilayani</b></td>
        <td><b>Waktu di Buat</b></td>
        <td><b>Waktu di Layani</b></td>
        <td><b>Dilayani Oleh (id admin)</b></td>
    </tr>
    <?php 
        $queri1 = mysqli_query($conn, "SELECT * FROM tbl_antrian_live WHERE no_antrian > 0 AND id_admin_melayani = '".$_SESSION['user']['id_admin']."'");
        $dataArray = []; // Initialize an array to hold the data

        while ($dataant = mysqli_fetch_array($queri1)) {  
            $dataArray[] = $dataant; // Collecting data in an array
    ?>
    <tr>
        <td><?= $dataant['id_data']; ?></td>
        <td><?= $dataant['no_antrian']; ?></td>
        <td><?php
            if ($dataant['status_dilayani'] == 'belum') {
                echo "<div class='badge badge-danger'>belum</div>"; 
            } else if ($dataant['status_dilayani'] == 'sudah dilayani') {
                echo "<div class='badge badge-success'>Sudah Dilayani</div>"; 
            }
        ?></td>
        <td><?= $dataant['waktu_buat']; ?></td>
        <td><?= $dataant['waktu_selesai_dilayani']; ?></td>
        <td><?= $dataant['id_admin_melayani']; ?> (Anda)</td>
    </tr>
    <?php } ?>
</table>
</div>

<?php include "../template/footer.php"; ?>

<script>
// Store the data in a JavaScript variable
var antrianData = <?php echo json_encode($dataArray); ?>;

function openPrintPopup() {
    // Open a new window
    var printWindow = window.open('', 'PrintWindow', 'width=800,height=600');
    
    // Prepare the HTML content for printing
    var content = `
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Antrian Yang Dilayani Anda</title>
        <style>
            body { font-family: Arial, sans-serif; }
            table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
            th, td { border: 1px solid #000; padding: 8px; text-align: left; }
            th { background-color: #f2f2f2; }
        </style>
    </head>
    <body>
    <h1>Antrian Yang Dilayani Anda</h1>
    <table>
        <tr>
            <th>ID Antrian</th>
            <th>NO Antrian</th>
            <th>Status Dilayani</th>
            <th>Waktu di Buat</th>
            <th>Waktu di Layani</th>
            <th>Dilayani Oleh (id admin)</th>
        </tr>`;

    // Generate table rows from the data
    antrianData.forEach(item => {
        content += '<tr>' +
            '<td>' + item.id_data + '</td>' +
            '<td>' + item.no_antrian + '</td>' +
            '<td>' + (item.status_dilayani == 'sudah dilayani' ? 'Sudah Dilayani' : 'Belum') + '</td>' +
            '<td>' + item.waktu_buat + '</td>' +
            '<td>' + item.waktu_selesai_dilayani + '</td>' +
            '<td>' + item.id_admin_melayani + '</td>' +
            '</tr>';
    });

    content += `
    </table>
    <script>window.print();<\/script>
    </body>
    </html>`;
    
    // Write the content to the new window
    printWindow.document.write(content);
    printWindow.document.close(); // Close the document for rendering
}
</script>
