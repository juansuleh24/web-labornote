<!DOCTYPE html>
<html lang="en">
<head>
<style>
    body {
        background-image: url('../../../asset/ground.jpg');
        flex: 1;
    }

	.view-list-button {
            position: absolute;
            top: 22px;
            right: 80px;
            background-color: #4caf50;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            text-decoration: none;
            display: flex;
            align-items: center; /* Pusatkan ikon dan teks secara vertikal */
        }

        .view-list-button .icon {
            margin-right: 5px; /* Pindahkan ikon ke sebelah kanan teks */
        }

        .view-list-button:hover {
            background-color: #0056b3;
        }
</style>
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

// Mengambil data dari formulir
$username = $_POST["username"];
//$name = $_POST["name"];
$nim_nil_nik = $_POST["nim_nil_nik"];
//$nik = $_POST["nik"];
$no_regis = $_POST["no_regis"];
$fakultas = $_POST["fakultas"];
$prodi = $_POST["prodi"];
$status = $_POST["status"];
$departemen = $_POST["departemen"];
$supervisor_name = $_POST["supervisor_name"];
$role = $_POST["role"];
$password = $_POST["password"];


// Menyimpan data ke dalam tabel/database
if ($role == 'student'){
	//$sql = "INSERT INTO student (nim_nil, username, no_regis, fakultas, prodi, status, departemen, supervisor_name, role, password) VALUES ('$nim_nil_nik', '$username', '$no_regis', '$fakultas', '$prodi', '$status', '$departemen', '$supervisor_name', '$role', '$password')";
    //$sql1 = "INSERT INTO sign_in (nim_nil, nik, username, role, password) VALUES ('$nim_nil_nik', '', '$username', '$role', '$password')";
    $sql = "INSERT INTO tbl_user (nim_nil, nik, username, no_regis, fakultas, prodi, status, departemen, supervisor_name, role, password) VALUES ('$nim_nil_nik', '', '$username', '$no_regis', '$fakultas', '$prodi', '$status', '$departemen', '$supervisor_name', '$role', '$password')";
}else if ($role == 'supervisor'){
	//$sql = "INSERT INTO dosen (nik, username, departemen, status, role, password) VALUES ('$nim_nil_nik', '$username', '$departemen', '$status', '$role', '$password')";
	//$sql1 = "INSERT INTO sign_in (nim_nil, nik, username, role, password) VALUES ('', '$nim_nil_nik', '$username', '$role', '$password')";
	$sql = "INSERT INTO tbl_user (nim_nil, nik, username, no_regis, fakultas, prodi, status, departemen, supervisor_name, role, password) VALUES ('', '$nim_nil_nik', '$username', '', '', '', '$status', '$departemen', '', '$role', '$password')";
}else if($role == 'student_finance'){
	//$sql = "INSERT INTO dosen (nik, username, status, role, password) VALUES ('$nim_nil_nik', '$username', '$status', '$role', '$password')";
	//$sql1 = "INSERT INTO sign_in (nim_nil, nik, username, role, password) VALUES ('', '$nim_nil_nik', '$username', '$role', '$password')";
	$sql = "INSERT INTO tbl_user (nim_nil, nik, username, no_regis, fakultas, prodi, status, departemen, supervisor_name, role, password) VALUES ('', '$nim_nil_nik', '$username', '', '', '', '$status', '', '', '$role', '$password')";
}else {
    echo "Role tidak valid";
}	
//$sql = "INSERT INTO tbl_user (username, nim_nil, nik, no_regis, fakultas, prodi, status, departemen, supervisor_name, role, password) VALUES ('$username', '$nim_nil', '$nik', '$no_regis', '$fakultas', '$prodi', '$status', '$departemen', '$supervisor_name', '$role', '$password')";

//$sql1 = "INSERT INTO sign_in (nim_nil, nik, username, role, password) VALUES ('$nim_nil', '$nik', '$username', '$role', '$password')"; 

if ($conn->query($sql) === TRUE ) {
    echo '<script>alert("Data berhasil disimpan di database.");</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
    <div style="text-align: center;">
     <a class="view-list-button" href="../view-list-user/view_list_user.php">
        <i class="fas fa-list icon"></i> View List User
    </a>
</div>
</body>
</html>