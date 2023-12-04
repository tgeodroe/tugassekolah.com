<?php
session_start(); // Mulai sesi

// Pengguna sudah login, dapatkan nama pengguna dari sesi
$usernameSession = $_SESSION['username'];

// Jika sudah ada sesi username, langsung redirect ke beranda.php
if(isset($usernameSession)) {
    header("location: beranda.php");
    exit();
}

// Koneksi ke database
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$database = "masuk2";

$conn = new mysqli($host, $dbUsername, $dbPassword, $database);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Ambil data dari form login
$user = $_POST['username'];
$pass = $_POST['password'];

// Lindungi dari serangan SQL injection
$user = mysqli_real_escape_string($conn, $user);

// Query untuk mencari user di database
$query = "SELECT * FROM datadata WHERE nama_pengguna='$user'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // User ditemukan, periksa password
    $row = $result->fetch_assoc();
    if (hash('sha256', $pass) === $row['password']) {
        // Lakukan sesuatu setelah login berhasil
        // ...
        $_SESSION['username'] = $user;

        // Redirect ke beranda.php
        header("location: beranda.php");
        exit(); // Pastikan untuk keluar setelah melakukan redirect
    } else {
        echo "Password salah!";
    }
} else {
    echo "Username tidak ditemukan!";
}

// Tutup koneksi ke database
$conn->close();
?>
