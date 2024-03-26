<?php
session_start();
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Beasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <!-- Bagian Menu -->
    <div class="menu">
        <a href="index.php">Pilihan Beasiswa</a>

        <a href="daftar.php">Daftar</a>
        <a href="hasil.php">Hasil</a>
    </div>
    &nbsp;&nbsp;
    
    <h5 class="text-center mt-5">DAFTAR BEASISWA</h5>

    
    <div class="container mt-2">
        <div class="col-md-12 d-flex justify-content-center">
            <div class="card mt-2 px-3 mb-5" style="width: 50%;">
                <div class="border-bottom mt-3">
                    <p>Registrasi Beasiswa</p>
                </div>
              
                <div class="card-body">
                    <form action="" method="POST" id="daftar" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="nama_pendaftar">Masukkan Nama <span class="text-danger"></span></label>
                                                <input type="text" min="0" class="form-control" name="nama_pendaftar" id="nama_pendaftar" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="email_pendaftar">Masukkan Email <span class="text-danger"></span></label>
                                                <input type="email" min="0" class="form-control" name="email_pendaftar" id="email_pendaftar" autocomplete="off" required onchange="get_ipk()">
                                            </div>

                                            <div class="form-group">
                                                <label for="no_hp">Masukan Nomor Hp <span class="text-danger"></span></label>
                                                <input type="number" min="0" class="form-control" name="no_hp" id="no_hp" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="semester">Semester Saat Ini <span class="text-danger"></span></label>
                                                <select class="form-control" name="semester" id="semester"  required>
                                                    <option value="" disabled selected>Pilih Semester</option>
                                                    
                                                     <option value="1">Semester 1</option>
                                                     <option value="2">Semester 2</option>
                                                     <option value="3">Semester 3</option>
                                                     <option value="4">Semester 4</option>
                                                     <option value="5">Semester 5</option>
                                                     <option value="6">Semester 6</option>
                                                     <option value="7">Semester 7</option>
                                                     <option value="8">Semester 8</option>
                                                    
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="ipk">IPK Mahasiswa <span class="text-danger"></span></label>
                                                <div class="d-flex justify-content-between w-100">
                                                    <input  min="0" class="form-control" name="ipk" id="ipk" autocomplete="off" readonly required>
                                                    
                                                </div>
    
                                            </div>

                                            <div class="form-group">
                                                <label for="jenis_beasiswa">Jenis Beasiswa <span class="text-danger"></span></label>
                                                <select class="form-control" name="jenis_beasiswa" id="jenis_beasiswa" autofocus="autofocus" disabled=false>
                                                    <option readonly selected>Pilih Jenis Beasiswa</option>
                                                    <option value="Beasiswa Akademik">Beasiswa Akademik</option>
                                                    <option value="Beasiswa Non Akademik">Beasiswa Non Akademik</option>
                                                 </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="file_syarat">Upload Berkas Syarat <span class="text-danger"></span></label>
                                                <input type="file" class="form-control" name="file_syarat" id="file_syarat" Accept="Application/Pdf" disabled=false>
                                                <p class="text-danger" style="font-size: 14px; margin-top: 5px; font-style: italic;">Pastikan File yang diunggah tipe file <b>PDF</b>.</p>
                                            </div>

                                            <a href="index.php" class="col-3 btn btn-sm btn-secondary offset-2" id="cancel" disabled='false'>Cancel</a>


                                            <button type="submit" id="btn-kirim" class="col-3 btn  btn-sm btn-primary" name="kirim"><i class="fa-solid fa-share"></i> Kirim Data</button>

                                        </form>

                                         <?php
                                            if (isset($_POST["kirim"])) {
                                                $nama   = $_FILES["file_syarat"]["name"];
                                                $lokasi = $_FILES["file_syarat"]["tmp_name"];
                                                move_uploaded_file($lokasi, "../filesyarat/" . $nama);
                                                
                                                $conn->query("INSERT INTO data_pendaftar
                                                (
                                                nama_pendaftar, 
                                                email_pendaftar, 
                                                no_hp,
                                                semester,
                                                ipk, 
                                                jenis_beasiswa,
                                                file_syarat) VALUES (
                                                '$_POST[nama_pendaftar]', 
                                                '$_POST[email_pendaftar]',
                                                '$_POST[no_hp]',
                                                '$_POST[semester]',
                                                '$_POST[ipk]',
                                                '$_POST[jenis_beasiswa]',
                                                '$nama')");
        
                                                echo "<script>alert('Data Berhasil Dikirim');</script>";
                                                echo "<script>location='index.php';</script>";
                                            }
                                            ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script type="text/javascript">
      async function get_ipk() {
        // mendapatkan nilai email yang diinput
        const email_pendaftar = (document.getElementById('email_pendaftar')).value

        // proses mendapatkan nilai ipk berdasarkan email ke url /serkom/get-ipk-by-email.php
        const response = await fetch(`${window.location.origin}/pendaftaran/dapatkan_email.php?email_mahasiswa=${email_pendaftar}`);
        
        // mengubah nilai supaya bisa dioperasikan
        const jsonData = await response.json() || 0;
      
        // mendefinisikan komponen input ipk
        const ipk_mahasiswa = document.getElementById('ipk')

        // selanjutnya mengubah value komponen yang telah didefinisikan sesuai value ipk yang didapat berdasarkan email yang dicari
        ipk_mahasiswa.value = jsonData

        // kondisi => jika ipk < 3 maka; input jenis beasiswa dan upload file syarat disable; 
        // selain dari itu maka input jenis beasiswa dan upload file syarat aktif/dapat digunakan;
        if (parseInt(jsonData) < 3) {
            document.getElementById('jenis_beasiswa').disabled = true;
            document.getElementById('file_syarat').disabled = true;
            document.getElementById('btn-kirim').disabled = true;
        } else {
            document.getElementById('jenis_beasiswa').disabled = false;
            document.getElementById('file_syarat').disabled = false;
            document.getElementById('btn-kirim').disabled = false;
        } 
    }
  </script>

    </body>
    
    </html>