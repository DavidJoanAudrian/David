<?php
session_start();
include("koneksi.php");
if(isset($_SESSION['akun']))
    header("Location: index.php");

$alert = "";

if(isset($_POST["username"])){
    $username = $_POST["username"];
    $pwd = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$username'");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pwd, $row["password"])) {
            $_SESSION['akun'] = $username;
            $_SESSION['role'] = 'admin';
            header("Location: index.php");
        } else {
            $alert = '<div class="alert alert-danger" role="alert">Password salah!!!</div>';
        }
    } else {
        $alert = '<div class="alert alert-danger" role="alert">Username atau password salah!!!</div>';
    }

    mysqli_close($conn);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Bootstrap JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
    <style>
        html,
        body {
        height: 100%;
        }

        body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
        }

        .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
        }

        .form-signin .checkbox {
        font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
        z-index: 2;
        }

        .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
    </style>
</head>
<body class="text-center">
    
    <main class="form-signin">
    <form method="POST">
        <h1 class="h3 mb-3 fw-normal">Login</h1>
        <?= $alert ?>

        <div class="form-floating">
        <input type="text" class="form-control" name="username" id="floatingInput" placeholder="Username">
        <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
        <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Masuk</button>
    </form>
    </main>
</body>
</html>
