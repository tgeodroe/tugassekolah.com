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
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        form{
            font-family: cursive;
            background-color: #32bceb;
            height: 60vh;
            display: flex;
            justify-content: center;
            align-items: center;
            
        }

        .txt{
            background-color: #006e94;
            border-radius: 8px;
            border: 3px solid black;
            color: white;
        }

    </style>
</head>
<body>
<header>
    <a href="beranda.php"><img src="logoweb2.png" width="5%" alt="logo1"></a>
    <h2><a href="beranda.php" style="font-color: white;" class="judul">ARISINIJ<a href="https://tgeodroe.github.io/klikklikgabut.com/" class="hehe">O</a></a> <span><a href="beranda.php">Beranda</a></span><span><a href="maunanya.php">Bertanya?</a></span>
    <div class="nav">
        <h1><a href="logout2.php"><?php echo $username; ?>  </a></h1>
    </div>
</header>

    <center>
    <div class="form-wrapper">
            <form action="bertanya.php" method="POST">
                <table>
                    <tr>
                        <td align="center"><label for="komentar">Masukan pertanyaan anda:</label></td>
                    </tr>
                    <tr>
                        <td align="center"><textarea class="txt" name="komentar" id="komentar" rows="5" cols="35" required></textarea></td>
                    </tr>
                    <tr>
                        <td align="center"><button type="submit">Kirim</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </center>
    
</body>
</html>