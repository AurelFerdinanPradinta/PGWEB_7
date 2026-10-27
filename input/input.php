
<?php
// Mengambil data dari formulir
$kecamatan = trim($_POST['kecamatan'] ?? '');
$longitude = $_POST['longitude'] ?? '';
$latitude = $_POST['latitude'] ?? '';
$luas = $_POST['luas'] ?? '';
$jumlah_penduduk = $_POST['jumlah_penduduk'] ?? '';

// Memeriksa data yang wajib diisi
if (
    $kecamatan === '' ||
    $longitude === '' ||
    $latitude === '' ||
    $luas === '' ||
    $jumlah_penduduk === ''
) {
    die("Semua kolom harus diisi.");
}

// Memeriksa apakah data numerik valid
if (
    !is_numeric($longitude) ||
    !is_numeric($latitude) ||
    !is_numeric($luas) ||
    !is_numeric($jumlah_penduduk) ||
    (float)$luas < 1 ||
    (int)$jumlah_penduduk < 0
) {
    die("Periksa kembali koordinat, luas, dan jumlah penduduk.");
}

// Pengaturan koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan";

// Membuat koneksi
$conn = new mysqli(
    $servername,
    $username,
    $password,
    $dbname
);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menyimpan data ke tabel penduduk
$stmt = $conn->prepare(
    "INSERT INTO penduduk
    (kecamatan, longitude, latitude, luas, jumlah_penduduk)
    VALUES (?, ?, ?, ?, ?)"
);

$stmt->bind_param(
    "sdddi",
    $kecamatan,
    $longitude,
    $latitude,
    $luas,
    $jumlah_penduduk
);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();

    header("Location: ../index.php");
    exit;
} else {
    echo "Data gagal disimpan: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
