<?php
include $_SERVER['DOCUMENT_ROOT'] . "/antriyuk/node_module/helper/db_helper.php";
?>

<?php
include 'template/header.php';
$dbh = new DBHelper();
$dataantrian = $dbh->getDataSatuan();
$datainfoinstansi = $dbh->getDataInfoInstansi();
date_default_timezone_set('Asia/Bangkok');
?>

<header>
	<nav class="navbar navbar-expand-lg navbar-light">
		<a class="navbar-brand " href="#" id="brandnavbar"><b>Setting</b></a>
	</nav>
</header>

<div class="container-fluid" id="about" style="background: #1aabef; height: 1000px;">
	<div class="row" style="color: white; text-align: center;">
		<div class="col-12 mt-3">
			<h2><b>PT. 1/2 SEHAT </b></h2>
		</div>
		<div class="col-12">
			<h3><b>Lokasi Loket : Loket 1</b></h3>
			<hr style="width: 60%; background-color: white;">
		</div>
	</div>
	<div class="row">
		<div class="mt-3 col-lg-6 col-12 mx-auto">
			<center>
				<div class="shadow-sm pt-5 pb-5" id="printableArea"
					style="width: 400px; height: 300px; background-color: #123545; border-radius: 10px;">
					<h3 class="text-light"><b>Ambil Antrian ke -</b></h3>
					<br>
					<h1 class="text-light display-2"><b><?= $dataantrian['no_antrian'] + 1; ?></b></h1>
				</div>
				<a href="proses_tambah_antrian.php?antrianbaru=<?= $dataantrian['no_antrian'] + 1; ?>"
					class="btn btn-primary mt-3" style="background-color: #123545;"><b>Ambil Antrian</b></a>
				<a href="#" onclick="printAntrian()" style="background-color: #123545;" class="btn btn-primary mt-3"><b>Cetak Antrian</b></a>
			</center>
		</div>
	</div>
	<br>
                <div class="text-center">
                    <a href="http://localhost/antriyuk/client_side/index.php" class="btn btn-secondary">Back</a>
                </div>
</div>

<script>
	function printAntrian() {
		var printContents = document.getElementById('printableArea').innerHTML;
		var originalContents = document.body.innerHTML;
		var popupWin = window.open('', '_blank', 'width=800,height=600');
		var date = new Date();

		popupWin.document.open();
		popupWin.document.write(`
		<html>
		<head>
			<title>Print tab</title>
			<style>
				body { font-family: 'Times New Roman', serif; text-align: center; }
				.container { padding: 50px; }
				.header { font-size: 30px; font-weight: bold; margin-bottom: 5px; }
				.sub-header { font-size: 22px; color: #555; margin-bottom: 10px; }
				.ticket { background-color: #f0f0f0; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
				h1 { color: #333; font-size: 64px; margin: 20px 0; }
				hr { border: none; height: 2px; background-color: #ddd; margin: 20px 0; }
				.footer { font-size: 18px; color: #777; }
			</style>
		</head>
		<body onload="window.print()">
			<div class="container">
				<div class="header">PT. 1/2 SEHAT</div>
				<div class="sub-header">Lokasi Loket: Loket 1</div>
				<div class="ticket">
					${printContents}
					<div class="footer">
						<p>Tanggal: ${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}</p>
						<p>Jam: ${date.getHours()}:${date.getMinutes()}</p>
					</div>
				</div>
				<div style="margin-top: 20px;">
					<img src="logoppl.png" alt="Logo" style="width: 100px;">
					<p>Terima kasih telah menggunakan layanan kami.</p>
				</div>
			</div>
		</body>
		</html>`
		);

		popupWin.document.close();
	}
</script>

<?php include 'template/footer.php'; ?>