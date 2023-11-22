<?php
$servername = "localhost"; // Sesuaikan dengan detail server Anda
$username = "root"; // Sesuaikan dengan username database Anda
$password = "Juan123.com"; // Sesuaikan dengan password database Anda
$dbname = "labornote";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];

        $sql = "UPDATE tbl_user SET nim_nil = ?, nik = ? WHERE user_id = ?";
        // Ganti bagian SET sesuai dengan kolom yang ingin Anda perbarui

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $_POST['nim_nil'], $_POST['nik'], $user_id);
        // Sesuaikan dengan data yang ingin Anda perbarui

        if ($stmt->execute()) {
            echo "User account updated successfully.";
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "User ID not provided.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
