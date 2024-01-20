<?php
session_start();
include('config/connect.php');

// Kiểm tra nếu có dữ liệu được submit từ form
if (isset($_POST['dangky'])) {
    $tentk = $_POST['name'];
    $taikhoan = $_POST['username'];
    $matkhau = $_POST['password'];
    $quyen = isset($_POST['admin']) ? 'admin' : 'user';

    // Kiểm tra xem username đã tồn tại chưa
    $kiemTraUsername = mysqli_query($mysqli, "SELECT * FROM dangky WHERE username = '$taikhoan'");
    $soBanGhi = mysqli_num_rows($kiemTraUsername);

    if ($soBanGhi > 0) {
        // Nếu username đã tồn tại, hiển thị thông báo
        echo '<script>alert("Username đã tồn tại. Vui lòng chọn username khác!");</script>';
    } else {
        // Nếu username chưa tồn tại, thực hiện thêm vào cơ sở dữ liệu
        $sql_dangky = mysqli_query($mysqli, "INSERT INTO dangky(tentk, username, password, quyen) VALUES ('$tentk', '$taikhoan', '$matkhau', '$quyen')");

        if ($sql_dangky) {
            // Đăng ký thành công
            echo '<script>alert("Đăng ký thành công!"); 
            window.location.href = "login.php";</script>';
            exit(); // Đảm bảo dừng việc thực hiện script sau khi hiển thị thông báo
            $_SESSION['dangky'] = $quyen;
        } else {
            // Đăng ký không thành công
            echo '<script>alert("Đăng ký không thành công. Vui lòng thử lại!");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      margin-top: 250px;
    }

    .login-form {
      width: 300px;
      margin: 0 auto;
      text-align: center;
    }

    .login-form input {
      display: block;
      width: 100%;
      margin-bottom: 10px;
      padding: 10px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .login-form button {
      display: block;
      width: 100%;
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
    .form {
      margin-top: 140px;
      text-align: center;
    }
    .login-form a {
      color: #4CAF50;
      text-decoration: none;
    }
    .head {
      margin-top: -240px;
      background: linear-gradient(rgba(135, 206, 250, 0), rgba(135, 204, 250, 0.7));
    }
    img {
      width: 500px;
    }
    #log-container {
      display: none;
      margin-top: 20px;
    }

    #log-content {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="head">
         <img src="image/logo.png" alt="Header Image">
    </div>
  <div class="form">
        <h2>ĐĂNG KÝ TÀI KHOẢN</h2>
    </div>
  <div class="login-form">
    <form method="post" action="" onsubmit="return validateForm()">
      <input type="text" id="name" name="name" placeholder="Full Name">
      <input type="text" id="username" name="username" placeholder="Username">
      <input type="password" id="password" name="password"  placeholder="Password">
      <label><input type="checkbox" name="admin"> Admin</label>
      <button id="sign-up" name="dangky">Sign Up</button>
      <p><a href="login.php">Quay lại đăng nhập!</a></p>
    </form>
  </div>

  <div id="log-container">
    <div id="log-content"></div>
  </div>

  <script>
    function validateForm() {
      var name = document.getElementById('name').value;
      var username = document.getElementById('username').value;
      var password = document.getElementById('password').value;

      // Kiểm tra trống
      if (name === '' || username === '' || password === '') {
        alert('Vui lòng điền đầy đủ thông tin.');
        return false;
      }

      // Kiểm tra mật khẩu
      var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
      if (!passwordRegex.test(password)) {
        alert("Mật khẩu phải có ít nhất 8 ký tự, bao gồm ít nhất 1 chữ hoa, 1 chữ thường, 1 số, và 1 ký tự đặc biệt.");
        return false;
      }

      return true;
    }
  </script>
</body>
</html>
