<?php

session_start();


$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_blog_zaskia";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}


$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nama   = mysqli_real_escape_string($conn, $_POST['nama']);
    $email  = mysqli_real_escape_string($conn, $_POST['email']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    
    if (empty($nama) || empty($email) || empty($alamat)) {
        $_SESSION['status'] = "error";
        $_SESSION['pesan']  = "Mohon isi semua data ya, Kia!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['status'] = "error";
        $_SESSION['pesan']  = "Format email tidak valid!";
    } else {
        
        $sql = "INSERT INTO kontak_masuk (nama, email, alamat) VALUES ('$nama', '$email', '$alamat')";
        
        if (mysqli_query($conn, $sql)) {
            $_SESSION['status'] = "success";
            $_SESSION['pesan']  = "Halo $nama! Data kamu berhasil disimpan ke database. ✨";
        } else {
            $_SESSION['status'] = "error";
            $_SESSION['pesan']  = "Gagal menyimpan data: " . mysqli_error($conn);
        }
    }
    
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Pribadi | Zaskia Qanita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --ocean-dark: #005f73;
            --ocean-mid: #0a9396;
            --ocean-light: #94d2bd;
            --coral: #ee9b00;
            --white: #ffffff;
            --bg-soft: #f0f9ff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-soft); color: #222; scroll-behavior: smooth; }

       
        .hero {
            background: linear-gradient(135deg, var(--ocean-dark), var(--ocean-mid), var(--ocean-light));
            color: white; padding: 80px 20px; text-align: center;
            clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
        }

        .profile-img {
            width: 140px; height: 140px; border-radius: 50%;
            border: 4px solid rgba(255,255,255,0.3); margin-bottom: 20px;
            object-fit: cover; box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .hero h1 { font-size: 2.2rem; margin-bottom: 5px; }

        
        .navbar {
            background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px);
            padding: 15px 0; position: sticky; top: 0; z-index: 100;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .nav-container { max-width: 900px; margin: 0 auto; display: flex; justify-content: center; gap: 30px; }
        .nav-link { text-decoration: none; color: var(--ocean-dark); font-weight: 600; cursor: pointer; transition: 0.3s; }
        .nav-link:hover { color: var(--coral); }

        
        .container { max-width: 800px; margin: 30px auto; padding: 0 20px; }
        .card {
            background: var(--white); border-radius: 20px; padding: 30px;
            margin-bottom: 25px; box-shadow: 0 8px 25px rgba(0,95,115,0.06);
            border-left: 5px solid var(--ocean-mid);
        }

        .card h2 { color: var(--ocean-dark); margin-bottom: 15px; font-size: 1.3rem; }

        
        .table-container { overflow-x: auto; margin-top: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: var(--ocean-mid); color: white; padding: 12px; text-align: left; }
        td { padding: 12px; border-bottom: 1px solid #f1f1f1; }

        
        .perfect-form { display: flex; flex-direction: column; gap: 15px; margin-top: 15px; }
        .perfect-form input, .perfect-form textarea {
            width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 10px;
            outline-color: var(--ocean-mid); font-family: inherit;
        }
        .perfect-form textarea { resize: vertical; min-height: 80px; }
        
        .perfect-form button {
            background: var(--ocean-dark); color: white; border: none;
            padding: 12px; border-radius: 10px; cursor: pointer; font-weight: 600; transition: 0.3s;
        }
        .perfect-form button:hover { background: var(--ocean-mid); transform: translateY(-2px); }

        
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 95, 115, 0.4); backdrop-filter: blur(5px);
            display: none; justify-content: center; align-items: center; z-index: 2000;
        }
        .modal-overlay.active { display: flex; }

        .modal-content {
            background: white; padding: 30px; border-radius: 25px;
            width: 90%; max-width: 350px; text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            transform: scale(0.7); transition: 0.3s ease; border: 4px solid var(--ocean-light);
        }
        .modal-overlay.active .modal-content { transform: scale(1); }

        .contact-item {
            background: var(--bg-soft); padding: 12px; border-radius: 15px;
            margin-bottom: 10px; display: flex; align-items: center; gap: 10px;
            text-decoration: none; color: var(--ocean-dark); font-weight: 600;
        }
        .close-btn {
            margin-top: 15px; background: var(--coral); color: white;
            border: none; padding: 10px 25px; border-radius: 20px;
            cursor: pointer; font-weight: 600;
        }

        footer { text-align: center; padding: 40px; color: #888; font-size: 0.8rem; }
    </style>
</head>
<body>

<header class="hero">
    <img src="zaskia1.jpeg" alt="Foto Profil" class="profile-img">
    <div class="hero-content">
        <h1>Zaskia Qanita Najiyah</h1>
        <p>Mahasiswa Teknik Informatika @ UMMI</p>
    </div>
</header>


</head>
<body>

<main class="container">
    <?php if (isset($_SESSION['pesan'])): ?>
        <div class="alert alert-<?php echo $_SESSION['status']; ?>">
            <?php 
                echo $_SESSION['pesan']; 
                unset($_SESSION['pesan']); 
                unset($_SESSION['status']);
            ?>
        </div>
    <?php endif; ?>

    <section class="card">
        <h2>Tentang Saya</h2>
        <p>Halo! Saya <strong>Kia</strong>. Mahasiswa fokus saya saat ini berkuliah di universitas muhammadiyah sukabumi prodi teknik informatika angkatan 2024.</p>
    </section>

    <section class="card">
        <h2>Form Identitas (Simpan ke MySQL)</h2>
        <form action="index.php" method="POST" class="perfect-form">
            <input type="text" name="nama" placeholder="Masukkan Nama" required>
            <input type="email" name="email" placeholder="Masukkan Email" required>
            <textarea name="alamat" placeholder="Masukkan Alamat Lengkap" required></textarea>
            <button type="submit">Kirim dan Simpan Data</button>
        </form>
    </section>

    <section class="card">
        <h2>Data Tersimpan</h2>
        <div class="table-container">
            <table border="1" width="100%">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM kontak_masuk ORDER BY waktu_kirim DESC LIMIT 5");
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['nama']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['waktu_kirim']}</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <section class="card" id="data-pengunjung">
    <h2>Daftar Pengunjung Terkini</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Waktu Submit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $sql = "SELECT * FROM kontak_masuk ORDER BY waktu_kirim DESC";
                $result = mysqli_query($conn, $sql);

                
                if (mysqli_num_rows($result) > 0) {
                    // 4. Perulangan untuk menampilkan setiap baris data
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
                        echo "<td>" . $row['waktu_kirim'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' style='text-align:center;'>Belum ada data yang dikirim. Ayo jadi yang pertama, Kia! 🌊</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>
</main>

<footer>
    <p>&copy; 2026 Zaskia Qanita Najiyah. Integrated PHP & MySQL</p>
</footer>

<script src="script.js"></script>
</body>
</html>