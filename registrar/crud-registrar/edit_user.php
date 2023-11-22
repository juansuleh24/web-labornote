<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <!-- Tambahkan stylesheet dan skrip eksternal sesuai kebutuhan -->
</head>
<body>
    <?php
    $servername = "localhost"; // Ganti dengan nama server Anda jika berbeda
    $username = "root"; // Ganti dengan nama pengguna MySQL Anda
    $password = "Juan123.com"; // Ganti dengan kata sandi MySQL Anda
    $dbname = "labornote";

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $id = $_GET["id"];

        // Mengambil data pengguna yang akan diubah
        $sql = "SELECT * FROM tbl_user WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Tampilkan formulir pengeditan data dengan nilai yang ada dalam database
            echo '<form method="post" action="update_user.php?id=' . $id . '">';
            echo 'NIM/NIL: <input type="text" name="nim_nil" value="' . $row["nim_nil"] . '"><br>';
            echo 'NIK: <input type="text" name="nik" value="' . $row["nik"] . '"><br>';
            // Tambahkan field lain sesuai kebutuhan
            echo '<input type="submit" value="Update">';
            echo '</form>';
        }
    }

    // Menutup koneksi
    $conn->close();
    ?>
</body>
</html>
