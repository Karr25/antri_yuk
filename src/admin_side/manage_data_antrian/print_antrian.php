<?php
include "../koneksi.php";

// Get the type of queue from the URL parameter
$queueType = isset($_GET['type']) ? $_GET['type'] : 'semua';

switch ($queueType) {
    case 'terlayani':
        $query = "SELECT * FROM tbl_antrian_live WHERE status_dilayani = 'sudah dilayani'";
        break;
    case 'belum':
        $query = "SELECT * FROM tbl_antrian_live WHERE status_dilayani = 'belum'";
        break;
    case 'dilayani':
        // Replace 'your_admin_id' with the actual admin ID logic if needed
        $adminId = $_GET['admin_id'] ?? '1'; // Example admin ID
        $query = "SELECT * FROM tbl_antrian_live WHERE id_admin_melayani = '$adminId'";
        break;
    default: // 'semua'
        $query = "SELECT * FROM tbl_antrian_live WHERE no_antrian > 0";
        break;
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Antrian</title>
    <style>
        /* Add any custom styles for your print layout */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Data Antrian</h1>
<table>
    <tr>
        <th>ID Antrian</th>
        <th>NO Antrian</th>
        <th>Status Dilayani</th>
        <th>Waktu di Buat</th>
        <th>Waktu di Layani</th>
        <th>Dilayani Oleh (id admin)</th>
    </tr>
    <?php while ($dataant = mysqli_fetch_array($result)) { ?>
        <tr>
            <td><?= $dataant['id_data']; ?></td>
            <td><?= $dataant['no_antrian']; ?></td>
            <td>
                <?php
                if ($dataant['status_dilayani'] == 'belum') {
                    echo "<div class='badge badge-danger'>belum</div>";
                } else if ($dataant['status_dilayani'] == 'sudah dilayani') {
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

<script>
    window.print(); // Automatically trigger the print dialog
</script>

</body>
</html>
