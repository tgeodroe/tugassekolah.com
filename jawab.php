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

// Assuming you have a database connection
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "masuk2";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the comment ID is provided in the URL
if (!isset($_GET['pertanyaan_id'])) {
    echo "Invalid comment ID";
    exit();
}

$commentId = $_GET['pertanyaan_id'];


// Retrieve the comment from the database based on the comment ID
$sql = "SELECT id, nama, komen FROM komentar WHERE id = $commentId";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $commentId = $row['id'];
    $commenterName = $row['nama'];
    $commentContent = $row['komen'];
} else {
    echo "Comment not found";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $responseContent = $_POST['response_content'];
    $responderName = $_SESSION['username'];

    // Insert the response into the database
    $insertResponseSql = "INSERT INTO respon (id, nama, isirespon) VALUES ($commentId, '$responderName', '$responseContent')";
    if ($conn->query($insertResponseSql) === TRUE) {
        header("Location: responjawaban.php?question_id=$commentId");
            exit();
    } else {
        echo "Error adding response: " . $conn->error;
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<body >
<header>
    <a href="beranda.php"><img src="logoweb2.png" width="5%" alt="logo1"></a>
    <h2><a href="beranda.php" style="font-color: white;" class="judul">ARISINIJ<a href="https://tgeodroe.github.io/klikklikgabut.com/" class="hehe">O</a></a> <span><a href="beranda.php">Beranda</a></span><span><a href="maunanya.php">Bertanya?</a></span>
    <div class="nav">
        <h1><a href="logout2.php"><?php echo $username; ?> </a></h1>
    </div>
</header>
    <br><br><br><br><br><br>

	<center>
    <h3>Pertanyaan:</h3>
    <p><strong><?php echo $commenterName; ?>:</strong> <?php echo $commentContent; ?></p>

    <h3>Respon Anda:</h3>
    <form action="" method="POST">
        
        <textarea name="response_content" id="response_content" rows="5" cols="35" required></textarea><br>
        <button type="submit">Kirim Respon</button>
    </form>
    
    </center>
</body>
</html>