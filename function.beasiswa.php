

<?php
	//membuat fungsi untuk menghubungkan pada koneksi database
	function query($sql){
	    global $conn;
	    $perintah=mysqli_query($conn,$sql);
	    if(!$perintah) die ("Gagal melakukan koneksi: ".mysqli_connect_error());
	    return $perintah;
}


	//membuat fungsi untuk menampilkan chartjs
	function Chart_Tampil_Beasiswa(){
		$sql="SELECT SUM(IF(pilihan_beasiswa='Akademik',1,0)) AS jumlah_akademik, SUM(IF(pilihan_beasiswa='Non-Akademik',1,0)) AS jumlah_nonakademik FROM tb_pendaftaran";
		$perintah=query($sql);
		return $perintah;
	}

?>