<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nama'])) {
        $_SESSION['nama'] = $_POST['nama'];
    } elseif (isset($_POST['umur'])) {
        $_SESSION['umur'] = $_POST['umur'];
    } elseif (isset($_POST['hobi'])) {
        $_SESSION['hobi'] = $_POST['hobi'];
    } elseif (isset($_POST['reset'])) {
        session_destroy();
        header("Location: soal2.php");
        exit;
    }
}

if (!isset($_SESSION['nama'])) {
    $step = 1;
} elseif (!isset($_SESSION['umur'])) {
    $step = 2;
} elseif (!isset($_SESSION['hobi'])) {
    $step = 3;
} else {
    $step = 4;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Soal 2</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .box {
            border: 2px solid black;
            padding: 40px;
            width: 400px;
            text-align: center;
            background: white;
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
            border-radius: 12px;
        }
        label {
            font-size: 20px;
            font-weight: bold;
        }
        input[type=text] {
            width: 250px;
            padding: 12px;
            font-size: 18px;
            margin-top: 12px;
        }
        input[type=submit] {
            margin-top: 25px;
            padding: 12px 25px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 6px;
            border: none;
            background: black;
            color: white;
        }
        p {
            font-size: 20px;
            margin: 10px 0;
        }
        table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
            font-size: 18px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 10px;
        }
        th {
            background: #f0f0f0;
        }
    </style>
</head>
<body>

<div class="box">
    <?php if ($step == 1): ?>
        <form method="post">
            <label>Nama Anda:</label><br>
            <input type="text" name="nama" required>
            <br>
            <input type="submit" value="SUBMIT">
        </form>

    <?php elseif ($step == 2): ?>
        <form method="post">
            <label>Umur Anda:</label><br>
            <input type="text" name="umur" required>
            <br>
            <input type="submit" value="SUBMIT">
        </form>

    <?php elseif ($step == 3): ?>
        <form method="post">
            <label>Hobi Anda:</label><br>
            <input type="text" name="hobi" required>
            <br>
            <input type="submit" value="SUBMIT">
        </form>

    <?php elseif ($step == 4): ?>
        <h2>Hasil Data Anda</h2>
        <table>
            <tr>
                <th>Nama</th>
                <td><?= htmlspecialchars($_SESSION['nama']); ?></td>
            </tr>
            <tr>
                <th>Umur</th>
                <td><?= htmlspecialchars($_SESSION['umur']); ?></td>
            </tr>
            <tr>
                <th>Hobi</th>
                <td><?= htmlspecialchars($_SESSION['hobi']); ?></td>
            </tr>
        </table>
        <form method="post">
            <input type="hidden" name="reset" value="1">
            <input type="submit" value="RESET">
        </form>
    <?php endif; ?>
</div>

</body>
</html>
