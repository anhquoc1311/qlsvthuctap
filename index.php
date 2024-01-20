<?php
session_start();

// Kiểm tra nếu biến session không tồn tại hoặc có giá trị không mong muốn
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

// Truy xuất thông tin từ session
$tenDangNhap = isset($_SESSION['dangnhap']) ? $_SESSION['dangnhap'] : '';
$quyen = isset($_SESSION['quyen']) ? $_SESSION['quyen'] : '';

// Kiểm tra nếu có hành động đăng xuất
if (isset($_GET['action']) && $_GET['action'] == 'dangxuat') {
    unset($_SESSION['dangnhap']);
    unset($_SESSION['quyen']);
    session_destroy(); // Xóa toàn bộ session
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <!-- Thêm liên kết đến thư viện FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #3498db; /* Màu nền xanh */
            color: #fff; /* Màu chữ trắng */
        }

        header {
            background-color: #2980b9; /* Màu nền xanh đậm cho thanh menu */
            padding: 10px;
            text-align: center;
        }

        nav {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        nav a {
            text-decoration: none;
            color: #fff; /* Màu chữ trắng cho các liên kết */
            margin: 0 15px;
            font-weight: bold;
        }

        section {
            padding: 20px;
        }

        /* Tùy chỉnh icon trong thanh menu */
        nav i {
            margin-right: 5px;
        }

        /* Thêm phần đăng xuất ở góc trái */
        .dangxuat {
            position: absolute;
            top: 10px; /* Cách trên 10px */
            left: 10px; /* Cách trái 10px */
            font-weight: bold;
        }

        /* Thêm phần hiển thị thông tin người dùng */
        .thongtin {
            position: absolute;
            top: 40px; /* Cách trên 40px */
            left: 10px; /* Cách trái 10px */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <a href="index.php?action=dangxuat" class="dangxuat"><i class="fas fa-sign-out-alt"></i>Đăng xuất</a>
    <div class="thongtin">
        <a> Xin chào <?php echo $tenDangNhap; ?>!</a>
        <p>Quyền: <?php echo $quyen; ?></p>
    </div>

    <header>
        <h1>QUẢN LÝ SINH VIÊN THỰC TẬP</h1>
    </header>
    <nav>
        <!-- Thêm icon từ FontAwesome -->
        <a href="#"><i class="fas fa-chart-bar"></i>DASHBOARD</a>
        <a href="#"><i class="fas fa-users"></i>DANH SÁCH SINH VIÊN</a>
        <a href="#"><i class="fas fa-book"></i>ĐỀ TÀI</a>
        <a href="#"><i class="fas fa-calendar-alt"></i>Kỳ Thực Tập</a>
        <a href="#"><i class="fas fa-users"></i>Danh Sách Nhóm Thực Tập</a>
        <a href="#"><i class="fas fa-file"></i>Xuất ra file</a>
        <a href="#"><i class="fas fa-briefcase"></i>Công việc</a>
        <a href="#"><i class="fas fa-list-alt"></i>Danh sách đánh giá ẩn danh</a>
    </nav>

    <section>
        <!-- Nội dung trang chủ -->
        <h2>Chào mừng bạn đến trang chủ!</h2>
        <p>Đây là nơi để hiển thị thông tin và chức năng của ứng dụng của bạn.</p>
    </section>
</body>
</html>
