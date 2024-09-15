<?php
session_start();
include('koneksi.php');

// Pastikan pengguna telah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil data dari formulir
$nama = $_POST['nama'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$semester = $_POST['semester'];
$beasiswa = $_POST['beasiswa'];
$status_ajuan = 'belum di verifikasi'; // Status default
$user_id = $_SESSION['user_id']; // Ambil user_id dari sesi

// Proses upload berkas
$upload_dir = 'uploads/';
$upload_files = [
    'surat' => $_FILES['surat'],
    'cv' => $_FILES['cv'],
    'portofolio' => $_FILES['portofolio']
];

// Ambil data pengguna dari database
$stmt = $conn->prepare("SELECT ipk FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($user_ipk);
$stmt->fetch();
$stmt->close();




// Initialize variables for file paths
$surat_path = '';
$cv_path = '';
$portofolio_path = '';

foreach ($upload_files as $key => $file) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        $file_path = $upload_dir . basename($file['name']);
        
        $allowed_ext = ['pdf'];
        $file_ext = pathinfo($file_path, PATHINFO_EXTENSION);
        if (!in_array($file_ext, $allowed_ext)) {
            echo "Ekstensi file tidak diperbolehkan untuk $key.";
            exit();
        }
        
        if (!move_uploaded_file($file['tmp_name'], $file_path)) {
            echo "Error saat mengupload file $key.";
            exit();
        }

        if ($key === 'surat') {
            $surat_path = $file_path;
        } elseif ($key === 'cv') {
            $cv_path = $file_path;
        } elseif ($key === 'portofolio') {
            $portofolio_path = $file_path;
        }
    } else {
        echo "Error saat mengupload file $key: " . $file['error'];
        exit();
    }
}


// Debug nilai IPK setelah diambil dari database
echo "IPK dari database: " . htmlspecialchars($user_ipk) . "<br>";

// Debug nilai IPK sebelum disimpan
$stmt = $conn->prepare("INSERT INTO data_beasiswa (user_id, nama, email, phone, semester, ipk, jenis_beasiswa, surat, cv, portofolio, status_ajuan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issisdsssss", $user_id, $nama, $email, $phone, $semester, $user_ipk, $beasiswa, $surat_path, $cv_path, $portofolio_path, $status_ajuan);




if (!$stmt->execute()) {
    echo "Terjadi kesalahan saat menyimpan data: " . $stmt->error;
} else {
    
    header('Location: beasiswa.php');
}


$stmt->close();
$conn->close();
?>
