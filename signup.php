<?php
// Koneksi ke database
session_start();
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $jurusan = $_POST['jurusan'];
    $nama_universitas = $_POST['nama_universitas'];
    $ipk = $_POST['ipk'];

    // Validasi IPK tidak boleh lebih dari 4.00
    if ($ipk > 4.00) {
        echo "IPK tidak boleh lebih dari 4.00!";
    } else {
        $check_email = $conn->query("SELECT email FROM users WHERE email='$email'");
        if ($check_email->num_rows > 0) {
            echo "Email sudah terdaftar!";
        } else {
            $sql = "INSERT INTO users (nama, email, no_hp, password, jurusan, nama_universitas, ipk) 
                    VALUES ('$nama', '$email', '$no_hp', '$password', '$jurusan', '$nama_universitas', '$ipk')";

            if ($conn->query($sql) === TRUE) {
                header('location:login.php');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}


?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h2>Sign Up</h2>
    <form action="sign_up.php" method="post">
        Nama: <input type="text" name="nama" required><br>
        Email: <input type="email" name="email" required><br>
        No HP: <input type="text" name="no_hp" required><br>
        Password: <input type="password" name="password" required><br>
        Jurusan: <input type="text" name="jurusan"><br>
        Nama Universitas: <input type="text" name="nama_universitas"><br>
        <button type="submit">Sign Up</button>
    </form>
</body>
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url("img/budaya_bali.png");
            background-size: cover;
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            margin-bottom: 20px;
        }
        .login-container .form-group {
            margin-bottom: 15px;
        }
        .login-container .form-control {
            border-radius: 4px;
        }
        .login-container .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .login-container .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .login-container .text-center {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center">Sign Up</h2>
        <form  method="post" action="signup.php" >
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="username" placeholder="Masukan Nama" required>
            </div>
            <div class="form-group">
                <label for="nama">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Masukan Email" required>
            </div>
            <div class="form-group">
                <label for="nama">No HP</label>
                <input type="text" name="no_hp"  class="form-control" id="no_hp" placeholder="Masukan No HP" required>
            </div>
            <div class="form-group">
                <label for="nama">Jurusan</label>
                <input type="text" name="jurusan" class="form-control" id="jusrusan" placeholder="Masukan Jurusan/Prodi" required>
            </div> 
            <div class="form-group">
                <label for="nama">IPK</label>
                <input type="number" step="0.01" name="ipk" class="form-control" id="ipk"  min="0" max="4.00" placeholder="Masukan IPK" required>
            </div> 
            <div class="form-group">
                <label for="nama">Universitas</label>
                <input type="text" name="nama_universitas" class="form-control" id="jusrusan" placeholder="Masukan Universitas" required>
            </div>            
            <div class="form-group">
                <label for="nama">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
            
        </form>
    </div>


    <script>
    function togglePassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

