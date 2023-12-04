<?php
session_start(); // Mulai sesi

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Pengguna belum login, arahkan ke halaman login
    header("Location: login.html");
    exit(); // Pastikan untuk keluar agar kode di bawahnya tidak dieksekusi setelah pengalihan header
}

// Pengguna sudah login, dapatkan nama pengguna dari sesi
$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link rel="stylesheet" href="style.css"> 
    <style>
        /* Gaya CSS untuk menempatkan nama pengguna di pojok kanan atas */
        

        .form-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh;
            margin: 0;
        }


        
    </style>
</head>
<body >
    <header>
    <a href="beranda.php"><img src="logoweb2.png" width="5%" alt="logo1"></a>
    <h2><a href="beranda.php" style="font-color: white;" class="judul">ARISINIJ<a href="https://tgeodroe.github.io/klikklikgabut.com/" class="hehe">O</a></a> <span><a href="beranda.php">Beranda</a></span><span><a href="maunanya.php">Bertanya?</a></span>
    <div class="nav">
        <h1>Selamat datang,<a href="logout2.php"><?php echo $username; ?> </a></h1>
    </div>
</header>
<br><br><br><br><br>

    <center>
        <h3>Pertanyaan Terbaru</h3>
        <?php 
        // Sesuaikan konfigurasi database Anda
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "masuk2";

        // Membuat koneksi ke database
        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

        // Memeriksa koneksi
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Menyusun query SQL untuk mengambil data dari kolom tertentu
        $sql = "SELECT id, nama, komen FROM komentar ORDER BY id DESC";

        // Menjalankan query
        $result = $conn->query($sql);

        // Memeriksa apakah query berhasil dijalankan
        if ($result) {
            // Menampilkan hasil jika ada data
            if ($result->num_rows > 0) {
                echo "<table>";
                while ($row = $result->fetch_assoc()) {
                    $commentId = $row["id"];
                    $commentContent = $row["komen"];
                    
                    // Limit the display to 50 characters
                    $shortenedContent = strlen($commentContent) > 50 ? substr($commentContent, 0, 50) . "..." : $commentContent;
                    
                    // Output the table row with a link to reply and view responses
                    echo "<tr><td>" . $row["nama"] . ":</td><td>" . nl2br($shortenedContent) . "</td><td><a href=\"jawab.php?pertanyaan_id=$commentId\">Jawab</a>/</td><td><a href=\"responjawaban.php?question_id=$commentId\">Lihat respon</a></td></tr>";
                }
                echo "</table>";
            } else {
                echo "Tidak ada pertanyaan";
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Menutup koneksi ke database
        $conn->close();
        ?>
    </center>

</body>
</html>