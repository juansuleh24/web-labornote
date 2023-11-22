<?php
$servername = "localhost"; // Ganti dengan nama server database Anda
$username = "root"; // Ganti dengan nama pengguna database Anda
$password = "Juan123.com"; // Ganti dengan kata sandi database Anda
$dbname = "labornote";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user_id from the URL
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Use prepared statement to delete the user
    $sql = "DELETE FROM tbl_user WHERE user_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // Deletion successful
        echo "User account deleted successfully.";
    } else {
        // Error in deletion
        echo "Error: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "User ID not provided.";
}
?>
