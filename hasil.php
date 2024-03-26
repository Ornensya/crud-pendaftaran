<?php
	include 'koneksi.php';
	include 'function.beasiswa.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pendaftaran Beasiswa</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/Chart.min.js"></script>
</head>
<body>

	<!-- Bagian Menu -->
	<div class="menu">
		<a href="index.php">Pilihan Beasiswa</a>
		<a href="daftar.php">Daftar</a>
		<a href="hasil.php">Hasil</a>
	</div><br><br>

	<h3 style="text-align: center;">Hasil Pendaftaran Beasiswa</h3><br>
	
	<table border="1" class="tbl-hasil">
		<tr>
			<th>ID</th>
			<th>Nama</th>
			<th>Email</th>
			<th>No HP</th>
			<th>Semester</th>
			<th>IPK</th>
			<th>Pilihan Beasiswa</th>
			<th>Berkas</th>
			<th>Status Ajuan</th>
		</tr>

		<?php 
			$id = 1;
			$result = mysqli_query($conn, "SELECT * FROM tb_pendaftaran");
			foreach ($result as $row) { //mengambil data dari tabel pendaftaran
			?>
			<tr>
				<td><?= $id++ ?></td>
				<td><?= $row['nama']; ?></td>
				<td><?= $row['email']; ?></td>
				<td><?= $row['no_hp']; ?></td>
				<td><?= $row['semester']; ?></td>
				<td><?= $row['ipk']; ?></td>
				<td><?= $row['pilihan_beasiswa']; ?></td>
				<td><?= $row['berkas']; ?></td>
				<td>Belum di Verifikasi</td>
			</tr>
		<?php } ?>
	</table><br><br>

	<h2 style="text-align: center;">Grafik Pilihan Beasiswa</h2>
	<?php 
		//panggil function data pendaftaran berdasarkan pilihan beasiswa
		$tampil=Chart_Tampil_Beasiswa();
		$tampilan=mysqli_fetch_array($tampil);
	?>

<canvas id="myPieChart"></canvas>
</body>
</html>
<script type="text/javascript">
	//set new default font family and font color to minic bootstrap.s default styling
	Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
	Chart.defaults.global.defaultFontColor = '#292b2c';

	//PIe Chart Example
	var ctx = document.getElementById("myPieChart");
	var myPieChart = new Chart(ctx, {
		type: 'pie',
		data: {
			labels: ["Akademik", "Non-Akademik"],
			datasets: [{
				label: '',
					data: [<?php echo $tampilan['jumlah_akademik']; ?>, <?php echo $tampilan['jumlah_nonakademik']; ?>],
					backgroundColor: ['#007bff', '#dc3545'],
			}],
		},
	});
</script>

<!-- Footer Section Start -->
        <div class="footer">
            <div class="wrapper">
                <p class="text-center">2023 All rights reserved, Rita Aishwarya Rao</p>
            </div>
        </div>
        <!-- Footer Section Ends -->