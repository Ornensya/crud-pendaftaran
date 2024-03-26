<?php 
	include 'koneksi.php'; //koneksi ke database

	if(isset($_POST['submit'])){ //fungsi button untuk submit
		$insert = mysqli_query($conn, "INSERT INTO tb_pendaftaran VALUES(
			'".$_POST['id']."',
			'".$_POST['nama']."',
			'".$_POST['daftar_email']."',
			'".$_POST['no_hp']."',
			'".$_POST['semester']."',
			'".$_POST['ipk']."',
			'".$_POST['pilihan_beasiswa']."',
			'".$_POST['berkas']."'
	)");

		if ($insert) {
			echo "<script>window.location='hasil.php'</script>"; //agar dapat mengarah ke halaman hasil jika submit berhasil
		} else {
			echo "Error, Mohon Maaf Untuk Diulang Kembali".mysqli_error($conn); //jika submit gagal maka akan muncul peringatan ini
		}
		
	}
 ?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pendaftaran Beasiswa</title>
		<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<!-- Bagian Menu -->
	<div class="menu">
		<a href="index.php">Pilihan Beasiswa</a>
		<a href="daftar.php">Daftar</a>
		<a href="hasil.php">Hasil</a>
	</div>

	<h2>Daftar Beasiswa</h2>
	

	<div>
		<section class="box-formulir">
			<p>Registrasi Beasiswa</p>

		<!-- Bagian Form -->
			<form action="" method="POST">
				<div class="box">
					<table class="table-form">
						<tr>
							<td>Masukan Nama</td>
							<td><input type="text" name="nama"></td>
						</tr>
						<tr>
							<td>Masukan Email</td>
							<input type="email" min="0" class="form-control" name="daftar_email" id="daftar_email" autocomplete="off" required onchange="get_ipk()">
							
						</tr>
						<tr>
							<td>Nomor HP</td>
							<td><input type="number" name="no_hp"></td>
						</tr>
						<tr>
							<td>Semester Saat Ini</td>
							<td>
								<select class="input-control" name="semester">
									<option value="">--Pilih--</option>
									<option value="1">Semester 1</option>
									<option value="2">Semester 2</option>
									<option value="3">Semester 3</option>
									<option value="4">Semester 4</option>
									<option value="5">Semester 5</option>
									<option value="6">Semester 6</option>
									<option value="7">Semester 7</option>
									<option value="8">Semester 8</option>
								</select>
							</td>
						</tr>
						
						<div class="form-group">
                            <label for="ipk">IPK Mahasiswa <span class="text-danger"></span></label>
							<div class="d-flex justify-content-between w-100">
                                 <input  min="0" class="form-control" name="ipk" id="ipk" autocomplete="off" disabled required>                                                   
                            </div>
						</div>
						<tr>
							<td>Pilihan Beasiswa</td>
							<td>
								<select class="input-control" name="pilihan_beasiswa" id="pilihan_beasiswa" disabled=false>
									<option value="">--Pilihan Beasiswa--</option>
									<option value="Akademik">Beasiswa Akademik</option>
									<option value="Non-Akademik">Beasiswa Non-Akademik</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Upload Berkas Syarat</td>
							<td><input type="file" name="berkas" accept="Application/Pdf" id="berkas" disabled=false></td>
						</tr>
						<tr>
							<td><input type="submit" name="submit" class="btn-daftar" value="Daftar"></td> <!-- button untuk submit -->
							<td><a href="index.php">Batal</a></td>
						</tr>
					</table>
				</div>
			</form>

		</section>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	
	<script type="text/javascript">

		function get_ipk(){ //fungsi untuk mendeklarasikan ipk yang lebih atau kurang dari 3
			// const ipk = document.getElementById('ipk');
			const daftar_email = (document.getElementById('daftar_email')).value

			const response = await fetch(`${window.location.origin}/pendaftaran/dapatkan_email.php?email_mahasiswa=${daftar_email}`);

			const jsonData = await response.json() || 0;

			const ipk_mahasiswa = document.getElementById('ipk')
			ipk_mahasiswa.value = jsonData

			if (parseInt(jsonData) < 3) {
		            document.getElementById('pilihan_beasiswa').disabled = true;
		            document.getElementById('berkas').disabled = true;
		            document.getElementById('btn-daftar').disabled = true;
		        } else {
		            document.getElementById('jpilihan_beasiswa').disabled = false;
		            document.getElementById('berkas').disabled = false;
		            document.getElementById('btn-daftar').disabled = false;
		        } 
		    }

			// if (ipk.value>=3) { //jika ipk lebih sama dengan 3 maka kolom pilihan beasiswa dan berkas dapat diinput
				// pilihan_beasiswa.removeAttribute('disabled', '');
				// berkas.removeAttribute('disabled', '');
			// }else{ //jika ipk kurang dari 3 maka kolom pilihan beasiswa dan berkas tidak dapat diinput
		// 		pilihan_beasiswa.setAttribute('disabled', '');
		// 		berkas.setAttribute('disabled', '');
		// 	}
		// }
	</script>

	<!-- Footer Section Start -->
        <div class="footer">
            <div class="wrapper">
                <p class="text-center">2023 All rights reserved, Rita Aishwarya Rao</p>
            </div>
        </div>
        <!-- Footer Section Ends -->

</body>
</html>