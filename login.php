<?php
session_start();
include('config/connect.php');

if (isset($_POST['dangnhap'])) {
    $taikhoan = $_POST['user'];
    $matkhau = $_POST['password'];

    $sql = "SELECT * FROM dangky WHERE username='" . $taikhoan . "' AND password='" . $matkhau . "' LIMIT 1 ";
    $result = mysqli_query($mysqli, $sql);

    if ($result) {
        $count = mysqli_num_rows($result);

        if ($count > 0) {
            $row = mysqli_fetch_assoc($result);
            // Lưu thông tin vào session
            $_SESSION['loggedin'] = true;
            $_SESSION['dangnhap'] = $row['tentk'];
            $_SESSION['quyen'] = $row['quyen'];

            header("Location: index.html");
            exit();
        } else {
            echo '<script>alert("Tài khoản hoặc mật khẩu không đúng!"); window.location.href = "login.php";</script>';
            exit();
        }
    } else {
        echo "Lỗi truy vấn: " . mysqli_error($mysqli);
    }
}

if (isset($_POST['dangky'])) {
    // Chuyển hướng đến trang đăng ký
    header("Location: register.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/lamdep.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Đăng Nhập ADMIN</title>
    <style type="text/css">
        body {
            margin-top: 250px; /* Điều chỉnh khoảng cách từ đỉnh trang */
        }
        .login-form {
            margin-top: 140px;
            }
        .login-form {
            width: 300px;
            margin: 0 auto;
            text-align: center;
            padding: 20px; /* Thêm khoảng cách xung quanh form */
            border: 1px solid #ccc; /* Thêm đường viền */
            border-radius: 10px; /* Bo góc của form */
        }

        .login-form input {
            display: block;
            width: calc(100% - 20px); /* Đặt chiều rộng cho input */
            margin-bottom: 10px;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-form button {
            display: inline-block;
            width: calc(45% - 5px); /* Đặt chiều rộng cho button và giảm khoảng cách giữa chúng */
            margin-right: 10px; /* Khoảng cách giữa nút Sign In và Đăng Ký */
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-form p {
            margin: 10px 0;
        }

        .login-form a {
            color: #4CAF50;
            text-decoration: none;
        }
        .form {
            text-align: center;
            margin-top: 140px;
        }
        img {
            width: 500px;
        }
        .head {
            margin-top: -240px;
            background: linear-gradient(rgba(135, 206, 250, 0), rgba(135, 204, 250, 0.7));
        }
    </style>
</head>
<body>
    <div class="head">
         <img src="image/logo.png" alt="Header Image">
    </div>
    <div class="form">
        <h2>ĐĂNG NHẬP HỆ THỐNG</h2>
    </div>
    <div class="login-form">
        <form method="post" action="">
            <input type="text" id="username" name="user" placeholder="Username">
            <input type="password" id="password" name="password" placeholder="Password">
            <button id = "sign-in" name="dangnhap">Đăng nhập</button>
            <button id="sign-up" name="dangky">Đăng ký</button>
        </form>
    </div>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="../js/app.js"></script>
</html>
