<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "masuk2";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Ambil data dari form registrasi
$user = $_POST['username'];
$pass = $_POST['password'];

// Hash password
$hashedPassword = hash('sha256', $pass);

// Lindungi dari serangan SQL injection
$user = mysqli_real_escape_string($conn, $user);

// Simpan pengguna ke database
$query = "INSERT INTO datadata (nama_pengguna, password) VALUES ('$user', '$hashedPassword')";
$result = $conn->query($query);

if ($result) {
    header("location: beranda.php");
        exit(); // Pastikan untuk keluar setelah melakukan redirect
    // Lakukan sesuatu setelah registrasi berhasil
} else {
    echo "Registrasi gagal: " . $conn->error;
}

// Tutup koneksi ke database
$conn->close();
?>
