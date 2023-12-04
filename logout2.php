<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Pengguna belum login, arahkan ke halaman login
    header("Location: login.html");
    exit();
}

// Pengguna sudah login, dapatkan informasi pengguna
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
        .button {

            background-color: ##006e94;
            border: none;
            color: white;
            zoom: 2;
            width: 100px;
            height: 50px;
            font-size: 20px;
            cursor: pointer;
            border-radius: 5px; /* Add rounded corners */
            margin-top: 50px;
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
<br><br><br><br><br><br><br>
<center>
<button id="logoutButton" class="button">Logout</button>
</center>

    

    <script>
        // Menangkap klik tombol logout
        document.getElementById('logoutButton').addEventListener('click', function() {
            // Menggunakan AJAX untuk memanggil logout.php
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'logout.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Redirect ke halaman login setelah logout
                    window.location.href = 'login.html';
                }
            };
            xhr.send();
        });
    </script>
</body>
</html>