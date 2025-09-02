<?php
$host = "localhost";
$user = "root";
$pass = ""; 
$db   = "php-mysql-project";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$nama = "";
$alamat = "";
$where = [];

if (isset($_GET['nama']) && $_GET['nama'] != "") {
    $nama = $conn->real_escape_string($_GET['nama']);
    $where[] = "p.nama LIKE '%$nama%'";
}

if (isset($_GET['alamat']) && $_GET['alamat'] != "") {
    $alamat = $conn->real_escape_string($_GET['alamat']);
    $where[] = "p.alamat LIKE '%$alamat%'";
}

$where_sql = "";
if (!empty($where)) {
    $where_sql = "WHERE " . implode(" AND ", $where);
}

$sql = "SELECT p.id, p.nama, p.alamat, GROUP_CONCAT(h.hobi SEPARATOR ', ') AS hobi
        FROM person p
        LEFT JOIN hobi h ON p.id = h.person_id
        $where_sql
        GROUP BY p.id
        ORDER BY p.id ASC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Soal 3</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 20px; }
        .card {
            border: 1px solid #333;
            border-radius: 8px;
            padding: 15px;
            margin: 10px auto;
            width: 400px;
            text-align: left;
        }
        .search-box {
            margin: 20px;
        }
        input[type="text"] {
            padding: 8px;
            width: 180px;
            margin: 5px;
        }
        input[type="submit"] {
            padding: 8px 15px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Daftar Person & Hobinya</h2>

<div class="search-box">
    <form method="GET">
        <input type="text" name="nama" placeholder="Cari nama" value="<?php echo htmlspecialchars($nama); ?>">
        <input type="text" name="alamat" placeholder="Cari alamat" value="<?php echo htmlspecialchars($alamat); ?>">
        <input type="submit" value="SEARCH">
    </form>
</div>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='card'>";
        echo "<b>Nama:</b> " . htmlspecialchars($row['nama']) . "<br>";
        echo "<b>Alamat:</b> " . htmlspecialchars($row['alamat']) . "<br>";
        echo "<b>Hobi:</b> " . htmlspecialchars($row['hobi'] ?? '-') . "<br>";
        echo "</div>";
    }
} else {
    echo "<p>Tidak ada data ditemukan.</p>";
}
$conn->close();
?>

</body>
</html>
