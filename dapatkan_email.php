<?php
include_once("koneksi.php");
$email_input = $_GET['email_mahasiswa'];
$query =mysqli_query($conn, "SELECT daftar_ipk FROM tb_daftaremail WHERE daftar_email = '$email_input'");
$data = mysqli_fetch_array($query);

echo json_encode($data[0]);

?>