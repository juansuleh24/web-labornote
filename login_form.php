<!DOCTYPE html>
<html>
<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
 <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <title>Login Registrar|Student Finance</title>
    <style>
        body {
            background-image: url('../asset/backgroundunklab.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            flex: 1;
        }

        .div-container {
            /* flex: 1; */
        }
        #form {
            border-radius: 5px;
            background-image: url('../asset/blur.png');
            /* background-color: white; */
            width: 350px;
        }
        .logo-App {
            width: 150px;
            height: 150px;
            margin-right: -45px;
        }
        #garis {
            width: 5px;
            height: 50px;
            background-color: black;
            margin-right: 3px;
        }
        .logo-unklab {
            width: 58px;
            height: 58px;
            margin-left: 68%;
        }
        #App-logo-container {
            display: flex;
            align-items: center;
        }
        #App-nama-container{
            display: flex;
            align-items: center;
        }
        #labor {
            color: #B90059;
        }
        #note {
            color: #4254F6;
        }
        #div-form-container {
            display: flex;
            justify-content: center;
        }
        h2 {
            color: white;
            text-align: center;
        }
        p {
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }
        .password-container {
            /* position: relative; */
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 25px;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding-right: 35px;
            background-color: black;
            color: white;
        }

       input[type="submit"] {
		background-color: #0056b3;
		color: #ffffff;
		padding: 10px 15px;
		border: none;
		border-radius: 10px;
		cursor: pointer;
		width: 100%;
		transition: background-color 0.3s;
	}

	input[type="submit"]:hover {
		background-color: #0D1282;
	}
    </style>
</head>
<body>
<?php
// Konfigurasi database
$servername = "localhost"; // Ganti dengan nama server Anda jika berbeda
$username = "root"; // Ganti dengan nama pengguna MySQL Anda
$password = "Juan123.com"; // Ganti dengan kata sandi MySQL Anda
$database = "labornote";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

   // Indicate successful login in a variable
   $loginSuccess = false;
		
// Mengambil data dari formulir login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim_nil_nik = $_POST["nim_nil_nik"];
    $password = $_POST["password"];
    $role = $_POST["role"]; // Tambahkan peran (role)

    // Mengecek data pengguna dalam database
    $query = "SELECT * FROM `tbl_user` WHERE nik = '$nim_nil_nik' AND role = '$role'"; // Tambahkan peran (role)
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
        // Memeriksa apakah kata sandi cocok
        if ($password === $rows[0]["password"]) {
            // Autentikasi berhasil, membuat session
            session_start();
            $_SESSION["nik"] = $rows[0]["nik"];
            $_SESSION["role"] = $rows[0]["role"];
            $_SESSION["password"] = $rows[0]["password"];
			
			// Set the variable to indicate successful login
			$loginSuccess = true;

            // Redirect ke halaman sesuai peran (role) pengguna atau halaman lain yang sesuai
            if ($_SESSION["role"] === "registrar") {
                header("Location: registrar/home/home_registrar.php");
            } elseif ($_SESSION["role"] === "student_finance") {
                header("Location: student-finance/home/home_student_finance.php");
            }
            exit();
        } else {
            // Kata sandi tidak cocok
            //echo "WRONG PASSWORD";
        }
    } else {
        // Pengguna tidak ditemukan
        //echo "Pengguna tidak ditemukan.";
    }

    // Menutup koneksi database
    $conn->close();
}
?>
<div class="div-container">
    <div id="App-logo-container">
        <img class="logo-App" src="../asset/logoApp.png" />
        <div id="garis"></div>
        <div id="App-nama-container">
            <h1 id="labor">Labor</h1>
            <h1 id="note">Note</h1>
        </div>
        <img class="logo-unklab" src="../asset/unklab.png" />
    </div>
    <div id="div-form-container">
        <form id="form" method="POST" action="">
        <!-- Dropdown untuk memilih peran (role) -->
            <h2>Login</h2>
            <p>Registrar | Student Finance</p>
            <select id="role" name="role" required>
			<option value="" disabled selected>Pilih Role</option>
                <option value="registrar">Registrar</option>
                <option value="student_finance">Student Finance</option>
            </select>
            <input type="text" id="nim_nil_nik" name="nim_nil_nik" required placeholder="Masukkan NIK">
            <div class="password-container">
                <input type="password" id="password" name="password" required placeholder="Masukkan Password">
            </div>
            <input type="submit" value="Login">
            <div id="error-message" style="color: red; text-align: center; margin-top: 10px;"></div>
        </form>
    </div>
</div>
<script>


    // ...
    // Setelah memeriksa kata sandi atau pengguna yang tidak cocok
    if ("<?php echo $password; ?>" === "<?php echo $rows[0]['password']; ?>") {
        // Autentikasi berhasil, membuat sesi
        // ...
            <?php if($loginSuccess): ?>
				alert("Login berhasil. Selamat datang!");
			<?php endif; ?>
        // Jika autentikasi berhasil, kita bisa mengarahkan pengguna atau melakukan tindakan lainnya
    } else {
        // Kata sandi tidak cocok atau pengguna tidak ditemukan
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        var dataPosted = true;
		<?php else: ?>
			var dataPosted = false;
		<?php endif; ?>

		// Mengecek jika ada data yang dipost sebelum menampilkan pesan kesalahan
        if (dataPosted && "<?php echo $password; ?>" !== "<?php echo $rows[0]['password']; ?>") {
            // Autentikasi tidak berhasil, menampilkan pesan kesalahan
            var errorMessageElement = document.getElementById("error-message");

            // Mengatur teks dan warna pesan kesalahan
            errorMessageElement.innerHTML = "Kata sandi salah atau pengguna tidak ditemukan.";
            errorMessageElement.style.color = "black"; // Ganti dengan warna hitam yang diinginkan

            // Menggunakan setTimeout untuk menghapus pesan kesalahan setelah 3 detik
            setTimeout(function() {
                errorMessageElement.innerHTML = "";
            }, 3000); // 3000 milidetik sama dengan 3 detik
        }
	}
    // ...
</script>
</body>
</html>

<!-- if (dataPosted && "<?php echo $password; ?>" !== "<?php echo $rows[0]['password']; ?>") {
			// Autentikasi tidak berhasil, menampilkan pesan kesalahan
			document.getElementById("error-message").innerHTML = "Kata sandi salah atau pengguna tidak ditemukan.";

			// Menggunakan setTimeout untuk menghapus pesan kesalahan setelah 3 detik
			setTimeout(function() {
				document.getElementById("error-message").innerHTML = "";
			}, 3000); // 3000 milidetik sama dengan 3 detik
		} -->