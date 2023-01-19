<?php
session_start();
include("koneksi.php");
if(@$_SESSION['role'] != "admin" || !isset($_GET['id']))
    header("Location: data.php");

mysqli_query($conn, "UPDATE data SET diterima = 'tidak' WHERE id = " . $_GET['id']);
mysqli_close($conn);
header("Location: data.php");