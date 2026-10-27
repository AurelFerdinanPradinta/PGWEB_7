
<?php
// Pengaturan koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil seluruh data penduduk
$sql = "SELECT * FROM penduduk";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Penduduk</title>
</head>
<body>

    <h2>Data Penduduk Kecamatan</h2>

    <a href="input/index.html">Input Data</a>
    <br><br>

    <?php
    if ($result && $result->num_rows > 0) {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr>
                <th>Kecamatan</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Luas</th>
                <th>Jumlah Penduduk</th>
              </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["kecamatan"]) . "</td>";
            echo "<td>" . $row["longitude"] . "</td>";
            echo "<td>" . $row["latitude"] . "</td>";
            echo "<td>" . $row["luas"] . "</td>";
            echo "<td>" . $row["jumlah_penduduk"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Belum ada data penduduk.";
    }

    $conn->close();
    ?>

</body>
</html>
