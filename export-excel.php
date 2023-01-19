<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Buku Tamu.xls");
include("koneksi.php");
$result = mysqli_query($conn, "SELECT * FROM data WHERE diterima = 'ya'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Excel</title>
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">NAMA LENGKAP</th>
                <th scope="col">NOMOR HANDPHONE</th>
                <th scope="col">KELUHAN</th>
                <th scope="col">TANGGAL</th>
                <th scope="col">WAKTU</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr class="text-center">
                <td><?=$row['nama']?></td>
                <td><?=$row['nomor']?></td>
                <td><ul><li><?=implode("</li><li>", json_decode($row['keluhan']))?></li></ul></td>
                <td><?=$row['tanggal']?></td>
                <td><?=$row['waktu_from']?>-<?=$row['waktu_to']?></td>
            </tr>
        <?php endwhile ?>
        </tbody>
    </table>
</body>
</html>