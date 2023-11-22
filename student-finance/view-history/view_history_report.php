<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Riwayat Kerja Siswa Labor</title>
    <style>
        body {
            background-image: url('../../../asset/backgroundunklab.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            flex: 1;
        }
        
        .home-button {
            position: absolute;
            top: 22px;
            right: 130px;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .home-button:hover {
            background-color: #0056b3;
            box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2);
        }
        
        .logout-button {
            position: absolute;
            top: 22px;
            right: 22px;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .logout-button:hover {
            background-color: #B90000;
            box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2);
        }
        
        #cari {
            background-color: #0056b3;
        }
		
		    #print-button {
            background-color: #FD8D14;
            color: white;
            margin-right: 10px;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
            color: black;
            font-weight: bold;
            background-color: rgba(255, 255, 255, 0.5);
        }
        
        label {
            font-size: 25px;
            display: block;
        }
        
        input[type="text"] {
            width: 100%;
            font-size: 16px;
            padding: 5px;
        }
        
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
			font-family: 'Arial', sans-serif;
        }
        
        th {
            background-color: black;
            color: white;
        }

		.student-name {
			color: white;
			font-size: 17px;
			font-family: 'Arial', sans-serif;
		}
        
        .search-form {
            margin: 20px 0;
            display: flex;
        }
        
        .search-form input[type="text"] {
            width: 400px;
            font-size: 16px;
            padding: 10px;
        }
        
        .search-form input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
    </style>
</head>
<body>
    <div class="search-form">
        <form method="POST">
            <input type="text" name="search" id="search" placeholder="Masukkan nama student labor">
            <input type="submit" value="Cari">
        </form>
    </div>
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

    $search = ""; // Inisialisasi variabel pencarian

    // Memproses pencarian jika ada input dari pengguna
    if (isset($_POST['search'])) {
        $search = $_POST['search'];
        $sql = "SELECT * FROM tbl_history WHERE student_name LIKE '%$search%' ORDER BY student_name";
    } else {
        $sql = "SELECT * FROM tbl_history ORDER BY student_name";
    }

    $result = $conn->query($sql);

$current_student = null; // Initialize variable to track the current student
$totalHoursPerDay = 0; // Initialize variable to store total hours per day

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Jika nama student berbeda, buat tabel baru
        if ($row["student_name"] != $current_student) {
            // Tutup tabel sebelumnya jika ada
            if ($current_student != null) {
                // Display the total hours per day below the table
                echo "<tr>";
                echo "<td colspan='1'></td>";
                echo "<td>Total Jam Kerja keseluruhan:</td>";
                echo "<td>" . $totalHoursPerDay . " jam/minggu</td>";
                echo "<td colspan='1'></td>";
                echo "</tr>";

                echo "</table>";
                $totalHoursPerDay = 0; // Reset total hours per day for the new student
            }

            $current_student = $row["student_name"];
            echo "<h1 class='student-name'>Riwayat Kerja Student Labor: " . $current_student . "</h1>";
            echo "<h1 class='student-name'>No Regis: S" . $row["no_regis"] . "</h1>";
            echo "<h1 class='student-name'>Departemen: " . $row["departemen"] . "</h1>";
            echo "<h1 class='student-name'>Nama Supervisor: " . $row["supervisor_name"] . "</h1>";
            //echo "<td><button id='print-button' onclick='printReport(this)'>Print Report</button></td>";
            echo "<table>";
            echo "<tr><th>Hari</th><th>Tanggal Kerja</th><th>Total Jam Kerja (/jam)</th><th>Status Laporan</th></tr>";
        }

        $formatted_date = date("d/m/Y", strtotime($row["tanggal_kerja"]));

        echo "<tr>";
        echo "<td>" . $row["day"] . "</td>";
        echo "<td>" . $formatted_date . "</td>";
        echo "<td>" . $row["total_jam_kerja"] . "</td>";

        // Set status otomatis menjadi "approved"
        $approval_status = "approved";

        // Di sini, Anda dapat menambahkan logika untuk memeriksa kapan data harus diatur sebagai "approved" secara otomatis.

        echo "<td>" . $approval_status . "</td>";
        echo "</tr>";

        // Hitung total jam kerja per hari
        $totalHoursPerDay += (float) $row["total_jam_kerja"];

        // Kemudian, Anda dapat menambahkan kode untuk memasukkan data ke dalam tabel histori dengan status "approved".
        // ...
    }

    // Tutup tabel terakhir dan tampilkan total jam kerja per hari untuk terakhir kali
    echo "<tr>";
    echo "<td colspan='1'></td>";
    echo "<td>Total Jam Kerja Keseluruhan:</td>";
    echo "<td>" . $totalHoursPerDay . " jam/minggu</td>";
    echo "<td colspan='1'></td>";
    echo "</tr>";

    echo "</table>";
} else {
    echo "Tidak ada data history laporan kerja";
}

// Menutup koneksi
$conn->close();
?>
    <div class="content">
        <a class="home-button" href="../home/home_student_finance.php"><i class="fas fa-home icon"></i> Home</a>
        <a class="logout-button" href="../../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

<script>
function printReport(button) {
    const table = button.parentElement.parentElement.querySelector('table');
    const studentData = button.parentElement.parentElement.querySelectorAll('.student-name');

    let newWindow = window.open('', '_blank');
    newWindow.document.write('<html><head><title>Print Report</title></head><body>');

    // Adding additional details before the table content
    newWindow.document.write('<div>');
    studentData.forEach(data => {
        newWindow.document.write(`<p>${data.textContent}</p>`);
    });
    newWindow.document.write('</div>');

    newWindow.document.write('<table border="1">');
    newWindow.document.write(table.innerHTML); // Append table content

    newWindow.document.write('</table></body></html>');

    newWindow.document.close();
    newWindow.print();
}

</script>
</body>
</html>
