<?php
header('Access-Control-Allow-Origin: http://localhost:5173');

// Konfigurasi database
$servername = "localhost:3306"; // Ganti dengan nama server Anda jika berbeda
$username = "root"; // Ganti dengan nama pengguna MySQL Anda
$password = "Juan123.com"; // Ganti dengan kata sandi MySQL Anda
$database = "labornote";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Mengambil data dari formulir login
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST["nik"];
    $password = $_POST["password"];
    
	echo $nik;
	echo $password;
	
    // Mengecek data pengguna dalam database
    $query = "SELECT * FROM `registrar` WHERE nik = '$nik' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        //$row = $result->fetch_assoc(); 
		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
		//var_dump($rows);

        // Memeriksa apakah kata sandi cocok
        if ($password === $rows[0]["password"]) {
            // Autentikasi berhasil, lakukan sesuatu sesuai peran (role) pengguna
            echo "SUCCESS LOGIN";
			
			// to json format
			$json_data = json_encode($rows[0]);
			echo $json_data;
			
        } else {
            // Kata sandi tidak cocok
            echo "WRONG PASSWORD";
        }
    } else {
        // Pengguna tidak ditemukan
        echo "Pengguna tidak ditemukan.";
    }

    // Menutup koneksi database
    $conn->close();
//}
?>