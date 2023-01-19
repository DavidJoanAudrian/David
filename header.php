<?php
session_start();
include("koneksi.php");

$url = $_SERVER["REQUEST_URI"];
$filename = basename($url);

$dashboard = 'link-dark';
$daftar = 'link-dark';
$data = 'link-dark';
$bt = 'link-dark';
if($filename == "daftar.php"){
    $daftar = 'link-secondary';
}elseif($filename == "data.php"){
    $data = 'link-secondary';
}elseif($filename == "index.php"){
    $dashboard = 'link-secondary';
}elseif($filename == "buku-tamu.php"){
    $bt = 'link-secondary';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Bootstrap JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Pendaftaran Bidan</title>
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #section-to-print, #section-to-print * {
                visibility: visible;
            }
            #section-to-print {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none"></div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.php" class="nav-link px-2 <?=@$dashboard?>">Dashboard</a></li>
                <li><a href="daftar.php" class="nav-link px-2 <?=$daftar?>">Daftar Konsultasi</a></li>
                <li><a href="data.php" class="nav-link px-2 <?=$data?>">Data Konsultasi</a></li>
                <?php if(@$_SESSION['role'] == 'admin'): ?>
                    <li><a href="buku-tamu.php" class="nav-link px-2 <?=$bt?>">Buku Tamu</a></li>
                <?php endif ?>
                
            </ul>

            <div class="col-md-3 text-end">
                <?php if(isset($_SESSION['akun'])): ?>
                    <h5>Halo, <?=$_SESSION['akun']?> <a href="logout.php" class="btn btn-outline-danger me-2">Logout</a></h5>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline-primary me-2">Login</a>
                <?php endif ?>
            </div>
        </header>
        