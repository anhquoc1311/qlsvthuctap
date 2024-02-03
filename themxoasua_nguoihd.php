<?php
// Kết nối đến cơ sở dữ liệu
$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Khởi tạo biến thông báo
$notification = "";

// Xử lý khi form được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Thực hiện thêm người hướng dẫn
    if (isset($_POST['add'])) {
        // Lấy dữ liệu từ form
        $ten = $_POST['ten'];
        $sdt = $_POST['sdt'];
        $gmail = $_POST['gmail'];
        $chucdanh = $_POST['chucdanh'];
        $phong = $_POST['phong'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $zalo = $_POST['zalo'];
        $facebook = $_POST['facebook'];
        $github = $_POST['github'];
        $avata = $_POST['avata'];

        // Thực hiện kiểm tra username đã tồn tại hay chưa
        $checkQuery = "SELECT * FROM nguoihuongdan WHERE username = '$username'";
        $checkResult = $mysqli->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            $notification = "Tên người hướng dẫn đã tồn tại.";
        } else {
            // Thực hiện truy vấn thêm người hướng dẫn
            $query = "INSERT INTO nguoihuongdan (ten, sdt, gmail, chucdanh, phong, username, password, zalo, facebook, github, avata) VALUES ('$ten', '$sdt', '$gmail', '$chucdanh', '$phong', '$username', '$password', '$zalo', '$facebook', '$github', '$avata')";

            if ($mysqli->query($query)) {
                $notification = "Thêm người hướng dẫn thành công.";
            } else {
                $notification = "Thêm người hướng dẫn thất bại: " . $mysqli->error;
            }
        }
    }
    // Thực hiện xóa người hướng dẫn
    elseif (isset($_POST['delete'])) {
        $id = $_POST['delete_id'];
        if ($mysqli->query("DELETE FROM nguoihuongdan WHERE id_nguoihuongdan=$id")) {
            $notification = "Xóa người hướng dẫn thành công.";
        } else {
            $notification = "Xóa người hướng dẫn thất bại: " . $mysqli->error;
        }
    }

    elseif (isset($_POST['edit'])) {
        $id = $_POST['edit_id'];
        $new_ten = $_POST['new_ten'];
        $new_sdt = $_POST['new_sdt'];
        $new_gmail = $_POST['new_gmail'];
        $new_chucdanh = $_POST['new_chucdanh'];
        $new_phong = $_POST['new_phong'];
        $new_username = $_POST['new_username'];
        $new_password = $_POST['new_password'];
        $new_zalo = $_POST['new_zalo'];
        $new_facebook = $_POST['new_facebook'];
        $new_github = $_POST['new_github'];
        $new_avata = $_POST['new_avata'];
    
        // Kiểm tra xem có dữ liệu mới hay không
        $updateData = [];
        if (!empty($new_ten)) $updateData[] = "ten='$new_ten'";
        if (!empty($new_sdt)) $updateData[] = "sdt='$new_sdt'";
        if (!empty($new_gmail)) $updateData[] = "gmail='$new_gmail'";
        if (!empty($new_chucdanh)) $updateData[] = "chucdanh='$new_chucdanh'";
        if (!empty($new_phong)) $updateData[] = "phong='$new_phong'";
        if (!empty($new_username)) $updateData[] = "username='$new_username'";
        if (!empty($new_password)) $updateData[] = "password='$new_password'";
        if (!empty($new_zalo)) $updateData[] = "zalo='$new_zalo'";
        if (!empty($new_facebook)) $updateData[] = "facebook='$new_facebook'";
        if (!empty($new_github)) $updateData[] = "github='$new_github'";
        if (!empty($new_avata)) $updateData[] = "avata='$new_avata'";
    
        // Kiểm tra xem có dữ liệu mới để cập nhật hay không
        if (!empty($updateData)) {
            // Thực hiện truy vấn sửa người hướng dẫn
            $query = "UPDATE nguoihuongdan SET " . implode(", ", $updateData) . " WHERE id_nguoihuongdan=$id";
    
            if ($mysqli->query($query)) {
                $notification = "Sửa người hướng dẫn thành công.";
            } else {
                $notification = "Sửa người hướng dẫn thất bại: " . $mysqli->error;
            }
        } else {
            $notification = "Không có dữ liệu mới để cập nhật.";
        }
    }}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Người hướng dẫn</title>
    <style>
    body {
        background-color: #3498db; /* Màu nền xanh dương */
        color: #ffffff; /* Màu chữ trắng */
        font-family: Arial, sans-serif; /* Kiểu font chữ */
        margin: 0;
        padding: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table, th, td {
        border: 1px solid #ffffff; /* Màu đường biên trắng */
    }

    th, td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #2072b3; /* Màu nền xanh dương đậm cho phần header */
    }

    tr:nth-child(even) {
        background-color: #3498db; /* Màu nền xanh dương cho các hàng chẵn */
    }

    tr:nth-child(odd) {
        background-color: #2072b3; /* Màu nền xanh dương đậm cho các hàng lẻ */
    }

    a {
        color: #ffffff; /* Màu chữ trắng cho các liên kết */
    }

    a:hover {
        color: #ffcc00; /* Màu chữ khi di chuột qua liên kết */
    }

    form {
        margin-top: 20px;
    }

    h2 {
        color: #ffffff; /* Màu chữ trắng cho tiêu đề h2 */
    }

    input[type="text"], input[type="password"], input[type="email"], select {
        width: 10%;
        padding: 8px;
        margin: 5px 0;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #2072b3; /* Màu nền xanh dương đậm cho nút submit */
        color: #ffffff; /* Màu chữ trắng cho nút submit */
        padding: 10px;
        border: none;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #3498db; /* Màu nền xanh dương khi di chuột qua nút submit */
    }
    </style>
</head>
<body>
    <h2>Quản lý Người hướng dẫn</h2>

    <!-- Form Thêm Người hướng dẫn -->
    <form method="POST">
        <h3>Thêm Người hướng dẫn</h3>
        <label>Tên:</label>
        <input type="text" name="ten" required>
        <br>
        <label>Số điện thoại:</label>
        <input type="text" name="sdt" required>
        <br>
        <label>Email:</label>
        <input type="email" name="gmail" required>
        <br>
        <label>Chức danh:</label>
        <input type="text" name="chucdanh" required>
        <br>
        <label>Phòng:</label>
        <input type="text" name="phong" required>
        <br>
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <label>Zalo:</label>
        <input type="text" name="zalo" required>
        <br>
        <label>Facebook:</label>
        <input type="text" name="facebook" required>
        <br>
        <label>Github:</label>
        <input type="text" name="github" required>
        <br>
        <label>Avata:</label>
        <input type="text" name="avata" required>
        <br>
        <button type="submit" name="add">Thêm</button>
    </form>
    <?php if (!empty($notification)): ?>
        <div style="color: #ff0000;"><?php echo $notification; ?></div>
    <?php endif; ?>
    <!-- Bảng Danh sách Người hướng dẫn -->
    <h3>Danh sách Người hướng dẫn</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Chức danh</th>
            <th>Phòng</th>
            <th>Username</th>
            <th>Password</th>
            <th>Zalo</th>
            <th>Facebook</th>
            <th>Github</th>
            <th>Avata</th>
            <th>Thao tác</th>
        </tr>

        <?php
        // Truy vấn danh sách người hướng dẫn
        $result = $mysqli->query("SELECT * FROM nguoihuongdan");

        // Hiển thị dữ liệu
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id_nguoihuongdan']}</td>";
            echo "<td>{$row['ten']}</td>";
            echo "<td>{$row['sdt']}</td>";
            echo "<td>{$row['gmail']}</td>";
            echo "<td>{$row['chucdanh']}</td>";
            echo "<td>{$row['phong']}</td>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['password']}</td>";
            echo "<td>{$row['zalo']}</td>";
            echo "<td>{$row['facebook']}</td>";
            echo "<td>{$row['github']}</td>";
            echo "<td>{$row['avata']}</td>";
            echo "<td class='actions'>
                    <form method='POST'>
                        <input type='hidden' name='delete_id' value='{$row['id_nguoihuongdan']}'>
                        <button type='submit' name='delete'>Xóa</button>
                    </form>
                    <form method='POST'>
                        <input type='hidden' name='edit_id' value='{$row['id_nguoihuongdan']}'>
                        <input type='text' name='new_ten' placeholder='Tên mới'>
                        <input type='text' name='new_sdt' placeholder='Số điện thoại mới'>
                        <input type='text' name='new_gmail' placeholder='Email mới'>
                        <input type='text' name='new_chucdanh' placeholder='Chức danh mới'>
                        <input type='text' name='new_phong' placeholder='Phòng mới'>
                        <input type='text' name='new_username' placeholder='Username mới'>
                        <input type='password' name='new_password' placeholder='Password mới'>
                        <input type='text' name='new_zalo' placeholder='Zalo mới'>
                        <input type='text' name='new_facebook' placeholder='Facebook mới'>
                        <input type='text' name='new_github' placeholder='Github mới'>
                        <input type='text' name='new_avata' placeholder='Avata mới'>
                        <button type='submit' name='edit'>Sửa</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <p><?php echo $notification; ?></p>
    <?php
    // Đóng kết nối
    $mysqli->close();
    ?>
</body>
</html>
<p><a href="index.php">Quay lại trang chủ!</a></p>