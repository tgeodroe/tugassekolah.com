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
$dbname = "masuk2"; // Replace with your actual database name

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the question ID is provided in the URL
if (!isset($_GET['question_id'])) {
    echo "Invalid question ID";
    exit();
}

$questionId = $_GET['question_id'];

// Retrieve the question details from the database
$questionSql = "SELECT * FROM komentar WHERE id = $questionId";
$questionResult = $conn->query($questionSql);

if ($questionResult && $questionResult->num_rows > 0) {
    $questionRow = $questionResult->fetch_assoc();
    $questionerName = $questionRow['nama'];
    $questionContent = $questionRow['komen'];
} else {
    echo "Question not found";
    exit();
}

// Retrieve responses for the question
$responseSql = "SELECT * FROM respon WHERE id = $questionId ORDER BY id_respon DESC";
$responseResult = $conn->query($responseSql);
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
<header>
    <a href="beranda.php"><img src="logoweb2.png" width="5%" alt="logo1"></a>
    <h2><a href="beranda.php" style="font-color: white;" class="judul">ARISINIJ<a href="https://tgeodroe.github.io/klikklikgabut.com/" class="hehe">O</a></a> <span><a href="beranda.php">Beranda</a></span><span><a href="maunanya.php">Bertanya?</a></span>
    <div class="nav">
        <h1><a href="logout2.php"><?php echo $username; ?> </a></h1>
    </div>
</header>
    <br><br><br><br><br><br><br>
    <center class="centered-left">
    <h3>pertanyaan:</h3>
    <p><?php echo $questionerName; ?>: <?php echo $questionContent; ?></p>

    <h3>Respon:</h3>
    <?php
    if ($responseResult && $responseResult->num_rows > 0) {
        while ($responseRow = $responseResult->fetch_assoc()) {
            echo "<p>" . $responseRow['nama'] . ": " . $responseRow['isirespon'] . "</p>";
        }
    } else {
        echo "*Belum ada respon*";
    }
    ?>
    </center>

    <!-- Add a form for submitting new responses if needed -->

    

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>