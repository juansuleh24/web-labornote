<?php
$servername = "localhost"; // Ganti dengan nama server Anda
$username = "root"; // Ganti dengan username MySQL Anda
$password = "Juan123.com"; // Ganti dengan password MySQL Anda
$dbname = "labornote"; // Ganti dengan nama basis data Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim_nil_nik = $_POST['nim_nil_nik'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    // Validasi data masukan
    if ($newPassword !== $confirmNewPassword) {
        echo "Konfirmasi Password Baru tidak sesuai.";
    } else {
        // Ambil data dari database berdasarkan NIM/NIL/NIK user
        $result = $conn->query("SELECT * FROM tbl_user WHERE nik = '$nim_nil_nik' AND BINARY password = '$oldPassword';");

        if ($result->num_rows > 0) {
            // Update password berdasarkan NIM/NIL/NIK
            $updateResult = $conn->query("UPDATE tbl_user SET password = '$newPassword' WHERE nik = '$nim_nil_nik';");

            if ($updateResult === TRUE) {
                // Jika berhasil, tampilkan pesan alert dan arahkan pengguna
                echo "SUCCESS";
				header("Location: ../../login_form.php");
            } else {
                echo "ERROR";
            }
        } else {
            echo "INCORRECT";
        }
    }

    // Menutup koneksi
    $conn->close();
} else {
    echo "Metode permintaan tidak valid";
}
?>
