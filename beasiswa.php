<?php
session_start();
include('koneksi.php');

// Pastikan pengguna telah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil nama pengguna dari sesi
$user_name = $_SESSION['user_name'];

// Ambil data pengguna dari database
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT nama, ipk FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($user_name, $user_ipk);
$stmt->fetch();
$stmt->close(); 


// echo "IPK yang diambil dari database: " . htmlspecialchars($user_ipk) . "<br>";


// Ambil data beasiswa dari database berdasarkan ID pengguna
$results = [];
if ($user_ipk >= 3.0) {
    $stmt = $conn->prepare("SELECT * FROM data_beasiswa WHERE user_id = ? AND status_ajuan = 'belum di verifikasi'");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }
    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            background-color: #333;
            color: white;
            padding: 10px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px;
        }
        .navbar .user-info {
            align-self: center;
        }
        .tab-container {
            display: flex;
            cursor: pointer;
            padding: 10px;
            background-color: #f1f1f1;
        }
        .tab-button {
            flex: 1;
            padding: 10px;
            text-align: center;
            background-color: #ddd;
            border: 1px solid #ccc;
        }
        .tab-button.active {
            background-color: #fff;
            border-bottom: 1px solid transparent;
            font-weight: bold;
        }
        .tab-content {
            padding: 20px;
            border: 1px solid #ccc;
            border-top: none;
        }
        .tab-content.hidden {
            display: none;
        }
        .photo-gallery {
        display: flex;
        justify-content: space-around;
        gap: 10px;
        padding: 10px;
        }

        .photo {
            width: 45%; /* Atur lebar foto sesuai kebutuhan */
            height: auto; /* Menjaga proporsi gambar */
            border: 2px solid #ccc;
            border-radius: 8px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.3);
        }

        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        
        footer {
            background: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
         
            width: 100%;
            bottom: 0;
        }

    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="beasiswa.php">BIE 2045</a>
        <div class="user-info">Welcome, <?php echo htmlspecialchars($user_name); ?> | <a href="index.php">Logout</a></div>
    </div>

    <!-- Tabs -->
    <div class="tab-container">
        <div class="tab-button" data-tab="pilihan" onclick="showTab('pilihan')">Pilihan Beasiswa</div>
        <div class="tab-button" data-tab="daftar" onclick="showTab('daftar')">Daftar</div>
        <div class="tab-button" data-tab="hasil" onclick="showTab('hasil')">Hasil</div>
    </div>

    <!-- Tab Contents -->
    <div id="pilihan" class="tab-content">
        <h2>Pilihan Beasiswa</h2>
        <!-- Konten untuk Pilihan Beasiswa -->
        <div class="photo-gallery">
        <img src="img/akademik.png" alt="Foto 1" class="photo">
        <img src="img/non-akademik.png" alt="Foto 2" class="photo"><br>
      
    </div>

    </div>
    <div id="daftar" class="tab-content hidden">
        <h2>Daftar</h2>
        <!-- Konten untuk Daftar -->
        <div class="my-5">
        <p><a href="https://docs.google.com/document/d/1f9ZjKvoaBbpjHUf81lbTML4csqwOzHL_/edit?usp=sharing&ouid=108556343030977305267&rtpof=true&sd=true" target="_blank"> Template Surat Pernyataan  </a></p>
        </div>
        <form id="registrationForm" action="proses_beasiswa.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Nomor HP:</label>
                <input type="tel" id="phone" name="phone" pattern="[0-9]*" inputmode="numeric" oninput="validateInput(this)" required>
                <small id="error-message" style="color:red; display:none;">Hanya boleh memasukkan angka!</small>
            </div>
            <div class="form-group">
                <label for="semester">Semester Saat Ini:</label>
                <select id="semester" name="semester" required>
                    <option value="">Pilih Semester</option>
                    <?php for ($i = 1; $i <= 8; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="ipk">IPK:</label>
                <input type="text" id="ipk" name="ipk" value="<?php echo htmlspecialchars($user_ipk); ?>" readonly>
            </div>

            <div class="form-group" id="warning-message" style="display: none;">
                <p style="color: red; font-weight: bold;">Maaf IPK Belum Cukup Untuk Mendaftar Besiswa ini, hanya Boleh diatas  ≥  3.00</p>
            </div>

            <div id="beasiswa-form">
                <div class="form-group" id="beasiswa-group">
                    <label for="beasiswa">Jenis Beasiswa:</label>
                    <select id="beasiswa" name="beasiswa">
                        <option value="">Pilih Jenis Beasiswa</option>
                        <option value="akademik">Beasiswa Akademik</option>
                        <option value="non-akademik">Beasiswa Non-Akademik</option>
                    </select>
                </div>
                <div class="form-group" id="surat-group">
                    <label for="surat">Upload Surat Pernyataan:</label>
                    <input type="file" id="surat" name="surat" accept=".pdf">
                </div>
                <div class="form-group" id="cv-group">
                    <label for="cv">Upload CV:</label>
                    <input type="file" id="cv" name="cv" accept=".pdf">
                </div>
                <div class="form-group" id="portofolio-group">
                    <label for="portofolio">Upload Portofolio:</label>
                    <input type="file" id="portofolio" name="portofolio" accept=".pdf">
                </div>

                <div class="form-group">
                <button type="submit" id="registerButton">Daftar</button>
                <button type="button" id="cancelButton" onclick="confirmReset()" style="background-color: red; color: white; border: none; padding: 10px 20px; cursor: pointer;">Batal</button>
                </div>
            </div>
           
        </form>
    </div>
    <div id="hasil" class="tab-content hidden">
        <h2>Hasil</h2>
        <!-- Konten untuk Hasil -->
        <?php if (!empty($results)): ?>
            <div>
                <?php foreach ($results as $result): ?>
                    <div class="entry">
                    <h2><?php echo htmlspecialchars($result['nama']); ?></h2>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($result['email']); ?></p>
                    <p><strong>Nomor HP:</strong> <?php echo htmlspecialchars($result['phone']); ?></p>
                    <p><strong>Semester:</strong> <?php echo htmlspecialchars($result['semester']); ?></p>
                    <p><strong>IPK:</strong> <?php echo htmlspecialchars($result['ipk']); ?></p>
                    <p><strong>Jenis Beasiswa:</strong> <?php echo htmlspecialchars($result['jenis_beasiswa']); ?></p>
                    <p><strong>Surat Pernyataan:</strong> <a href="uploads/<?php echo htmlspecialchars(basename($result['surat'])); ?>" target="_blank">Lihat</a></p>
                    <p><strong>CV:</strong> <a href="uploads/<?php echo htmlspecialchars(basename($result['cv'])); ?>" target="_blank">Lihat</a></p>
                    <p><strong>Portofolio:</strong> <a href="uploads/<?php echo htmlspecialchars(basename($result['portofolio'])); ?>" target="_blank">Lihat</a></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars($result['status_ajuan']); ?></p>
                    <hr>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Belum ada data beasiswa yang diajukan.</p>
        <?php endif; ?>

        

    </div>
    <footer>
        Copyright | BIE 2045
    </footer>
    <script>
        function showTab(tabId) {
            // Sembunyikan semua konten tab
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => content.classList.add('hidden'));

            // Hapus kelas aktif dari semua tombol
            const buttons = document.querySelectorAll('.tab-button');
            buttons.forEach(button => button.classList.remove('active'));

            // Tampilkan konten tab yang dipilih
            document.getElementById(tabId).classList.remove('hidden');

            // Tambahkan kelas aktif ke tombol yang dipilih
            const activeButton = document.querySelector(`.tab-button[data-tab="${tabId}"]`);
            activeButton.classList.add('active');

            // Simpan tab yang aktif di localStorage
            localStorage.setItem('activeTab', tabId);
        }

        // Ketika halaman dimuat, tampilkan tab yang terakhir aktif
        document.addEventListener('DOMContentLoaded', () => {
            const activeTab = localStorage.getItem('activeTab') || 'pilihan';
            showTab(activeTab);
        });

        document.addEventListener('DOMContentLoaded', function() {
        const ipkField = document.getElementById('ipk');
        const beasiswaForm = document.getElementById('beasiswa-form');
        const warningMessage = document.getElementById('warning-message');

        const userIPK = parseFloat(ipkField.value);

        if (userIPK < 3.00) {
            // Jika IPK kurang dari 3.00, tampilkan pesan peringatan dan sembunyikan form
            warningMessage.style.display = 'block';
            beasiswaForm.style.display = 'none';
        } else {
            // Jika IPK lebih dari atau sama dengan 3.00, sembunyikan pesan peringatan dan tampilkan form
            warningMessage.style.display = 'none';
            beasiswaForm.style.display = 'block';
        }
    });

    function validateInput(input) {
    const errorMessage = document.getElementById("error-message");
    const originalValue = input.value;
    const newValue = originalValue.replace(/[^0-9]/g, '');
    
    if (originalValue !== newValue) {
        // Tampilkan pesan error jika ada karakter yang bukan angka
        errorMessage.style.display = 'inline';
    } else {
        // Sembunyikan pesan error jika input valid
        errorMessage.style.display = 'none';
    }
    
    input.value = newValue; // Hapus karakter non-angka
}


        // Fungsi untuk mengosongkan form dengan konfirmasi
        function confirmReset() {
            // Tampilkan dialog konfirmasi
            var confirmation = confirm("Apakah Anda yakin ingin menghapus semua isian?");
            
            // Jika pengguna mengklik "OK", kosongkan form
            if (confirmation) {
                document.querySelector('form').reset();
            }
    }
    </script>


</body>
</html>
