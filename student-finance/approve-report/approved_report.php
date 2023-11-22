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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['student_name'])) {
        // Dapatkan nama siswa yang disetujui
        $student_name = $_POST['student_name'];
		echo $student_name;

        // Implementasikan query untuk memindahkan laporan yang disetujui ke tabel history
        $approveQuery = "INSERT INTO tbl_history (day, tanggal_kerja, student_name, no_regis, departemen, supervisor_name, report_status, total_jam_kerja)
                         SELECT day, tanggal_kerja, student_name, no_regis, departemen, supervisor_name, 'Approved', total_jam_kerja FROM tbl_finance_view_report WHERE student_name = '$student_name'";

        if ($conn->query($approveQuery) === TRUE) {
            echo "Data berhasil disalin ke Tabel History .<br>";

            // Perintah SQL untuk menghapus data dari tabel student finance
            $deleteQuery = "DELETE FROM tbl_finance_view_report WHERE student_name = '$student_name'";

            if ($conn->query($deleteQuery) === TRUE) {
                echo "Data berhasil dihapus dari Tabel Student Finance.";
            } else {
                echo "Gagal menghapus data dari Tabel Student Finance: " . $conn->error;
            }
        } else {
            echo "Gagal menyalin data ke Tabel History: " . $conn->error;
        }
    }
}

// Menutup koneksi
$conn->close();
?>
