<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>View Report</title>
    <style>
        body {
            background-image: url('../../../asset/backgroundunklab.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            flex: 1;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
            background-color: rgba(255, 255, 255, 0.5);
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
        #approve-button {
            background-color: #0056b3;
            color: white;
            margin-right: 10px;
        }
        #print-button {
            background-color: #FD8D14;
            color: white;
            margin-right: 10px;
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
        #data-student {
            color: white;
            font-family: 'Arial', sans-serif;
            font-size: 18px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            color: black;
            font-weight: bold;
            font-family: 'Arial', sans-serif;
        }
        th {
            background-color: black;
            color: white;
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
            background-color: #0056b3;
            color: #fff;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
        @media print {
            .search-form, .detail-button, .print-button {
                display: none;
            }
        }
        .totalHoursPerStudent {
            color: white;
            text-align: right;
            font-size: 20px;
            margin-right: 20px;
        }
    </style>
</head>
<body>

    <div class="search-form">
        <form method="post" action="">
            <input type="text" name="search" placeholder="Masukkan nama student labor" value="<?php echo isset($search) ? $search : ''; ?>">
            <input type="submit" value="Cari">
        </form>
        <a class="home-button" href="../home/home_student_finance.php"><i class="fas fa-home icon"></i>Home</a>
        <a class="logout-button" href="../../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "Juan123.com";
    $dbname = "labornote";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    date_default_timezone_set('Asia/Jakarta');
    $search = "";

    if (isset($_POST['search'])) {
        $search = $_POST['search'];
        $sql = "SELECT * FROM tbl_finance_view_report WHERE student_name LIKE '%$search%'";
    } else {
        $sql = "SELECT * FROM tbl_finance_view_report";
    }

    $result = $conn->query($sql);

    $totalHoursPerStudent = array();
    $studentData = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $student_name = $row["student_name"];

            if (!isset($studentData[$student_name])) {
                $studentData[$student_name] = array();
                $studentData[$student_name]['general_info'] = array(
                    'regis_number' => $row["no_regis"],
                    'department' => $row["departemen"],
                    'supervisor_name' => $row["supervisor_name"]
                );
                $studentData[$student_name]['work_data'] = array();
            }

            $formatted_date = date("d/m/Y", strtotime($row["tanggal_kerja"]));
            $workInfo = array(
                'day' => $row["day"],
                'formatted_date' => $formatted_date,
                'gambar_mulai' => $row["gambar_mulai"],
                'gambar_selesai' => $row["gambar_selesai"],
                'jam_mulai_selesai' => $row["jam_mulai_selesai"],
                'total_jam_kerja' => $row["total_jam_kerja"]
            );
            $studentData[$student_name]['work_data'][] = $workInfo;
        }

        foreach ($studentData as $student_name => $data) {
            echo "<label for='data-student' id='data-student'>Student Name: $student_name</label>";
            echo "<label for='data-student' id='data-student'>Regis Number: S" . $data['general_info']['regis_number'] . "</label>";
            echo "<label for='data-student' id='data-student'>Department: " . $data['general_info']['department'] . "</label>";
            echo "<label for='data-student' id='data-student'>Supervisor Name: " . $data['general_info']['supervisor_name'] . "</label>";
            echo "<td><button id='approve-button' onclick='approveReport(this)'>Approve</button></td>";
            //echo "<td><button id='print-button' onclick='printReport(this)'>Print Report</button></td>";

            echo "<table>
                <tr>
                    <th>Hari</th>
                    <th>Tanggal Kerja</th>
                    <th>Gambar Mulai Kerja</th>
                    <th>Gambar Selesai Kerja</th>
                    <th>Rentang Jam Kerja</th>
                    <th>Total Jam Kerja</th>
                </tr>";

            $totalHoursPerWeek = 0;

            foreach ($data['work_data'] as $work) {
                echo "<tr>";
                echo "<td>" . $work['day'] . "</td>";
                echo "<td>" . $work['formatted_date'] . "</td>";
                echo "<td><img src='https://labornote.site/labornote/api/uploadGambar/image/" . $work['gambar_mulai'] . "' alt='gambar mulai' width='150' height='150'></td>";
                echo "<td><img src='https://labornote.site/labornote/api/uploadGambar/image/" . $work['gambar_selesai'] . "' alt='gambar selesai' width='150' height='150'></td>";
                echo "<td>" . $work['jam_mulai_selesai'] . "</td>";
                echo "<td>" . $work['total_jam_kerja'] . "</td>";
                echo "</tr>";

                $totalHoursPerWeek += (float) $work['total_jam_kerja'];
            }

            echo "<tr>";
            echo "<td colspan='4'></td>";
            echo "<td>Total Jam Kerja $student_name:</td>";
            echo "<td>" . $totalHoursPerWeek . " Jam/minggu</td>";
            echo "</tr>";

            echo "</table>";
        }
    } else {
        echo "Tidak ada data laporan kerja student labor";
    }

    $conn->close();
    ?>
<script>
function approveReport(button) {
	const studentName = button.parentElement.parentElement.querySelector('#data-student').textContent.replace("Student Name: ", "");

	if (confirm("Apakah Anda yakin ingin menyetujui laporan ini?")) {
		// Kirim data-student ke backend PHP menggunakan Fetch API
		fetch("../approve-report/approved_report.php", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: "student_name=" + studentName,
		})
		.then(response => {
			if (response.ok) {
				// Laporan berhasil disetujui, hapus baris dari tabel
				const row = button.parentElement.parentElement;
				row.remove();
				alert("Laporan berhasil disetujui.");
			} else {
				alert("Error: " + response.statusText);
			}
		})
		.catch(error => {
			alert("Network Error: " + error.message);
		});
	}
}

function printReport(button) {
    const currentTable = button.parentElement.parentElement.querySelector('table');
    const studentData = Array.from(button.parentElement.parentElement.querySelectorAll('#data-student'));
    const studentInfo = [];

    // Fetch and store all data above the table
    studentData.forEach(data => {
        if (data.closest('table') !== currentTable) {
            studentInfo.push(data.textContent);
        }
    });

    const printContent = `
        <html>
            <head>
                <title>Print Report</title>
                <style>
                    /* Add your print styles here */
                </style>
            </head>
            <body>
                <div>
                    ${studentInfo.map(info => `<p>${info}</p>`).join('')} <!-- Display info above the table -->
                </div>
                <table border="1">
                    ${currentTable.outerHTML} <!-- Adding entire table content -->
                </table>
            </body>
        </html>
    `;

    const newWindow = window.open('', '_blank');
    newWindow.document.open();
    newWindow.document.write(printContent);
    newWindow.document.close();

    newWindow.onload = function() {
        newWindow.print();
    };
}
</script>
</body>
</html>