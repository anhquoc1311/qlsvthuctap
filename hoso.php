<?php
session_start();

// Kết nối đến cơ sở dữ liệu
include('config/connect.php');

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Truy xuất thông tin từ session
$tenDangNhap = isset($_SESSION['dangnhap']) ? $_SESSION['dangnhap'] : '';

// Truy vấn thông tin người dùng dựa trên tên đăng nhập
$query = "SELECT * FROM nguoihuongdan WHERE ten = '$tenDangNhap'";
$result = $mysqli->query($query);

// Lấy dữ liệu từ kết quả truy vấn
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<div class='form'>";
    // Hiển thị thông tin
    echo "<h2>Thông tin người đăng nhập</h2>";
    echo "<p><strong>Tên:</strong> {$row['ten']}</p>";
    echo "<p><strong>Số điện thoại:</strong> {$row['sdt']}</p>";
    echo "<p><strong>Email:</strong> {$row['gmail']}</p>";
    echo "<p><strong>Chức danh:</strong> {$row['chucdanh']}</p>";
    echo "<p><strong>Phòng:</strong> {$row['phong']}</p>";
    echo "<p><strong>Zalo:</strong> {$row['zalo']}</p>";
    echo "<p><strong>Facebook:</strong> {$row['facebook']}</p>";
    echo "<p><strong>Github:</strong> {$row['github']}</p>";
        echo "<div class='avata'>";
        // Hiển thị avatar (tương tự như bạn đã làm trong trang chủ)
            if (!empty($row['avata'])) {
                $imagePath = 'image/' . $row['avata'];
                echo "<img src='$imagePath' alt='Avatar'>";
            } else {
                echo "No Avatar";
            }
            } else {
                // Nếu không tìm thấy thông tin
                echo "<p>Không tìm thấy thông tin người đăng nhập.</p>";
            }
        echo "</div>";
    echo "</div>";

// Đóng kết nối
$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>
<style type="text/css">
    p {
    margin-left: 300px;  
    width: 604px;
    text-align: left;
    font-weight: bold;
    }
    .form {
        text-align: center;
        background: linear-gradient(rgba(135, 206, 250, 0), rgba(135, 204, 250, 0.7));
        width: 900px;
        margin: 0 auto;
        text-align: center;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        height: auto;
        height: 418px;
        font-size: 20px;
        color: darkslategrey;
    }
    
    .avata {
        margin-top: -250px;
        margin-left: 300px;
    }
    .avata img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        overflow: hidden;
        margin-left: -900px;
        margin-top: -90px;
    }
</style>
<div class="w3-footer"><hr>
        <span class="text-sm text-blue" style="font-size:12px ; color: #0073B7">
            <p>TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG</p>
            <p>Địa chỉ: 73 Nguyễn Huệ, phường 2, thành phố Vỉnh Long, tỉnh Vỉnh Long<br>
            Điện thoại: (+84) 02703.822141 - Fax: (+84) 02703.821003 - Email: spktvl@vlute.edu.vn</p>
        </span>
    </div>
</body>
</html>
