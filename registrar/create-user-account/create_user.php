<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Create User Account</title>
    <style>
        body {
            background-image: url('../../../asset/backgroundunklab.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            flex: 1;
        }

        table {
            margin-top: 3.5cm;
            border-collapse: collapse;
            width: 100%;
            background-image: url('../../../asset/bgcreateaccount.png');
            /* background-color: rgba(0, 0, 0, 0.7); */
        }

        label {
            font-size: 20px;
            display: block;
            color: black;
        }

        input[type="text"], input[type="number"], select {
            width: 70%;
            font-size: 18px;
            background-color: black;
            height: 30px;
            color: white;
        }
        input::placeholder {
            color: gray; 
        }

        /* #role::placeholder {
            color: gray;
        }

        label[for="role"] {
            color: white; 
        } */
        #role {
            background-color: black;
            width: 11.6cm;
            margin-right: -11.6cm;
            color: gray;
        }
        
        select option {
            color: white;
        }

        #icondown {
           /* background-color: blue; */
           /* width: 20px;
           height: 20px; */
           margin-left: 11cm;
           margin-right: -6cm;
           margin-top: -42px;
           margin-bottom: 27px;
        }

        th, td {
            /* border: 1px solid #dddddd; */
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .home-button {
            position: absolute;
            top: 22px;
            right: 330px;
            color: #ffffff;
            padding: 15px 25px;
            border: none;
            border-radius: 3px;
            display: flex;
            align-items: center;
            transition: background-color 0.3s, color 0.3s;
            font-size: 18px;
        }

        .home-button .icon {
            margin-right: 5px;
        }

        .home-button:hover {
            background-color: #0056b3;
        }

        .view-list-button {
            position: absolute;
            top: 22px;
            right: 140px;
            color: #ffffff;
            padding: 15px 25px;
            border: none;
            border-radius: 3px;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: background-color 0.3s, color 0.3s;
            font-size: 18px;
        }

        .view-list-button .icon {
            margin-right: 5px;
        }

        .view-list-button:hover {
            background-color: #0056b3;
        }

        .logout-button {
            position: absolute;
            top: 22px;
            right: 10px;
            color: #ffffff;
            padding: 15px 25px;
            border: none;
            border-radius: 3px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            font-size: 18px;
        }

        .logout-button:hover {
            background-color: #0056b3;
        }

        .create_user {
            color: white;
        }

        .submit {
            background-color: #4254F6;
            color: #fff;
            font-size: 18px;
            padding: 15px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .submit:hover {
            background-color: #292E57;
            color: #fff;
        }

        .student-fields,
        .supervisor-fields,
        .finance-fields {
            display: none;
        }
    </style>
</head>
<body>
<div>
    <div>
        <h1 class="create_user">Create User Account</h1>
        <a class="home-button" href="../home/home_registrar.php"><i class="fas fa-home icon"></i> Home</a>
        <a class="view-list-button" href="../view-list-user/view_list_user.php"><i class="fas fa-list icon"></i> View List User</a>
        <a class="logout-button" href="../../logout.php"><i class="fas fa-sign-out-alt icon"></i> Logout</a>
    </div>
    <form method="post" action="simpan_data_user.php">
        <table>
            <tr>
                <td>
                    <label for="username">FullName:</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan Nama Lengkap" required><br><br>

                    <label for="nim_nil_nik">NIM/NIL/NIK:</label>
                    <input type="number" id="nim_nil_nik" name="nim_nil_nik" placeholder="Masukan NIM/NIL/NIK" required><br><br>
					
					<label for="role">Role:</label>
                    <select id="role" name="role" required onchange="showFieldsByRole()">
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="student">Student</option>
                        <option value="supervisor">Supervisor</option>
                    </select><br><br>
                    <div id="icondown" >
                        <img src="../../../asset/down.png" />
                    </div>
                    <div class="student-fields">
						<label for="no_regis">No.Regis:</label>
						<input type="number" id="no_regis" name="no_regis" placeholder="Masukan hanya angka setelah (S)" required><br><br>

                        <label for="fakultas">Fakultas:</label>
                        <select id="fakultas" name="fakultas">
                            <option value="" disabled selected>Pilih Fakultas</option>
                            <option value="Fakultas Ilmu Komputer">Fakultas Ilmu Komputer</option>
                            <option value="Fakultas Ekonomi dan Bisnis">Fakultas Ekonomi dan Bisnis</option>
                            <option value="Fakultas Filsafat">Fakultas Filsafat</option>
                            <option value="Fakultas Pendidikan">Fakultas Pendidikan</option>
                            <option value="Fakultas Keperawatan">Fakultas Keperawatan</option>
                            <option value="Fakultas Pertanian">Fakultas Pertanian</option>
                        </select><br><br>

                        <label for="prodi">Prodi:</label>
                        <select id="prodi" name="prodi">
                        <option value="" disabled selected>Pilih Prodi</option>
                        <option value="Informatika">Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknologi Informasi">Teknologi Informasi</option>
                        <option value="Manajemen">Manajemen</option>
                        <option value="Akuntansi">Akuntansi</option>
                        <option value="Filsafat Agama">Filsafat Agama</option>
                        <option value="Pendidikan Agama">Pendidikan Agama</option>
                        <option value="Pendidikan Bahasa Inggris">Pendidikan Bahasa Inggris</option>
                        <option value="Pendidikan Ekonomi">Pendidikan Ekonomi</option>
                        <option value="Administrasi Perkantoran">Administrasi Perkantoran</option>
                        </select><br><br>

                        <label for="student_status">Status:</label>
                           <select id="student_status" name="status" required>
                           <option value="" disabled selected>Pilih Status</option>
                           <option value="Student Labor">Student Labor</option>
                           <option value="Supervisor">Supervisor</option>
                        </select><br><br>

                        <label for="student_departemen">Departemen:</label>
                        <select id="student_departemen" name="departemen" required>
                        <option value="" disabled selected>Pilih Departemen</option>
                        <option value="Accounting Office">Accounting Office</option>
                        <option value="Bidang Kemahasiswaan">Bidang Kemahasiswaan</option>
                        <option value="UBS">UBS</option>
                        <option value="Filkom">Filkom</option>
                        <option value="Filsafat">Filsafat</option>
                        <option value="FKIP">FKIP</option>
                        <option value="NURSE">NURSE</option>
                        <option value="Pertanian">Pertanian</option>
                        <option value="Boys Dorm">Boys Dorm</option>
                        <option value="Girls Dorm">Girls Dorm</option>
                        <option value="Ground">Ground</option>
                        <option value="Custodial">Custodial</option>
                        <option value="Cafetaria">Cafetaria</option>
                        <option value="Computer Lab">Computer Lab</option>
                        <option value="Housing">Housing</option>
                        <option value="Library">Library</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="NOC/SIU">NOC/SIU</option>
                        <option value="Registrar">Registrar</option>
                        <option value="Research">Research</option>
                        <option value="Security">Security</option>
                        <option value="Akademi Sekretari Klabat">Akademi Sekretari Klabat</option>
                        <option value="Unklab Information Center">Unklab Information Center</option>
                        <option value="HUMAS">HUMAS</option>
                        <option value="E-marketing">E-marketing</option>
                        <option value="Gereja & Konseling">Gereja & Konseling</option>
                        <option value="Bakery">Bakery</option>
                        <option value="President Office">President Office</option>
                        <option value="LPMI">LPMI</option>
                        <option value="Clinic">Clinic</option>
                    </select><br><br>

                        <label for="supervisor_name">Supervisor Name:</label>
                        <input type="text" id="supervisor_name" name="supervisor_name" placeholder="Masukkan Nama Supervisor"><br><br>
                    </div>

                    <div class="supervisor-fields">
                        <label for="supervisor_status">Status:</label>
                           <select id="supervisor_status" name="status" required>
                           <option value="" disabled selected>Pilih Status</option>
                           <option value="Student Labor">Student Labor</option>
                           <option value="Supervisor">Supervisor</option>
                        </select><br><br>

                        <label for="supervisor_departemen">Departemen:</label>
                        <select id="supervisor_departemen" name="departemen" required>
							<option value="" disabled selected>Pilih Departemen</option>
							<option value="Accounting Office">Accounting Office</option>
							<option value="Bidang Kemahasiswaan">Bidang Kemahasiswaan</option>
							<option value="UBS">UBS</option>
							<option value="Filkom">Filkom</option>
							<option value="Filsafat">Filsafat</option>
							<option value="FKIP">FKIP</option>
							<option value="NURSE">NURSE</option>
							<option value="Pertanian">Pertanian</option>
							<option value="Boys Dorm">Boys Dorm</option>
							<option value="Girls Dorm">Girls Dorm</option>
							<option value="Ground">Ground</option>
							<option value="Custodial">Custodial</option>
							<option value="Cafetaria">Cafetaria</option>
							<option value="Computer Lab">Computer Lab</option>
							<option value="Housing">Housing</option>
							<option value="Library">Library</option>
							<option value="Maintenance">Maintenance</option>
							<option value="NOC/SIU">NOC/SIU</option>
							<option value="Registrar">Registrar</option>
							<option value="Research">Research</option>
							<option value="Security">Security</option>
							<option value="Akademi Sekretari Klabat">Akademi Sekretari Klabat</option>
							<option value="Unklab Information Center">Unklab Information Center</option>
							<option value="HUMAS">HUMAS</option>
							<option value="E-marketing">E-marketing</option>
							<option value="Gereja & Konseling">Gereja & Konseling</option>
							<option value="Bakery">Bakery</option>
							<option value="President Office">President Office</option>
							<option value="LPMI">LPMI</option>
							<option value="Clinic">Clinic</option>
                    </select><br><br>
                    </div>

                    <div class="finance-fields">
                           <label for="student_finance_status">Status:</label>
                           <select id="student_finance_status" name="status" required>
                           <option value="" disabled selected>Pilih Status</option>
                           <option value="Student Labor">Student Labor</option>
                           <option value="Supervisor">Supervisor</option>
                           <option value="Student Finance">Student Finance</option>
                        </select><br><br>
                    </div>
                </td>
                <td>
                    <div>
                        <label for="password">Password:</label>
                        <input type="text" id="password" name="password" placeholder="Masukkan Password" required><br><br>

                        <!-- Ubah tipe tombol "Submit" menjadi "button" dan tambahkan onclick -->
                        <button type="button" class="submit" onclick="validateForm()">Simpan Data</button>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>

<script>
function validateForm() {
    var username = document.getElementById("username").value;
    var nimNilNik = document.getElementById("nim_nil_nik").value;
    var role = document.getElementById("role").value;

    // Get values based on the selected role
    var status, departemen;
    if (role === "student") {
        status = document.getElementById("student_status").value;
        departemen = document.getElementById("student_departemen").value;
    } else if (role === "supervisor") {
        status = document.getElementById("supervisor_status").value;
        departemen = document.getElementById("supervisor_departemen").value;
    } else if (role === "student_finance") {
        // Finance does not have specific departemen, so leave it empty
        status = document.getElementById("student_finance_status").value;
        departemen = "";
    }

    if (username === "" || nimNilNik === "" || status === "" || role === "") {
        alert("Semua data wajib di isi.");
    } else {
        // Jika semua data telah diisi, formulir akan di-submit
        document.querySelector("form").submit();
    }
}



function showFieldsByRole() {
    var role = document.getElementById("role").value;

    // Semua elemen terkait peran disembunyikan terlebih dahulu
    document.querySelector(".student-fields").style.display = "none";
    document.querySelector(".supervisor-fields").style.display = "none";
    document.querySelector(".finance-fields").style.display = "none";

    // Tampilkan elemen sesuai dengan peran yang dipilih
    if (role === "student") {
        document.querySelector(".student-fields").style.display = "block";
    } else if (role === "supervisor") {
        document.querySelector(".supervisor-fields").style.display = "block";
    } else if (role === "student_finance") {
        document.querySelector(".finance-fields").style.display = "block";
    }
}
</script>
</body>
</html>
