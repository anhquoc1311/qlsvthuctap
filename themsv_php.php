<?php
// Kết nối đến cơ sở dữ liệu
$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Khởi tạo biến thông báo
$notification = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Thực hiện thêm sinh viên
    if (isset($_POST['add'])) {
        // Lấy dữ liệu từ form
        $mssv = $_POST['mssv'];
        $hotensinhvien = $_POST['hotensinhvien'];
        $gioitinh = $_POST['gioitinh'];
        $sdt = $_POST['sdt'];
        $gmail = $_POST['gmail'];
        $diachi = $_POST['diachi'];
        $malop = $_POST['malop'];
        $truonghoc = $_POST['truonghoc'];
        $nganh = $_POST['nganh'];
        $khoa = $_POST['khoa'];
        $nhomnguoihuongdan = $_POST['nhomnguoihuongdan'];

       // Kiểm tra mssv có đúng 10 số không
       if (strlen($mssv) !== 10 || !is_numeric($mssv)) {
           $notification = "MSSV phải có 10 số và là số nguyên.";
       } elseif (strlen($sdt) !== 10 || !is_numeric($sdt)) {
           // Kiểm tra sdt có đúng 10 số không
           $notification = "Số điện thoại phải có 10 số và là số nguyên.";
        } else {
            // Kiểm tra xem MSSV đã tồn tại chưa
            $checkQuery = "SELECT * FROM sinhvien WHERE mssv = '$mssv'";
            $checkResult = $mysqli->query($checkQuery);

            if ($checkResult->num_rows > 0) {
                $notification = "Sinh viên với MSSV $mssv đã tồn tại.";
            } else {
                // Thực hiện truy vấn thêm sinh viên
                $query = "INSERT INTO sinhvien (mssv, hotensinhvien, gioitinh, sdt, gmail, diachi, malop, truonghoc, nganh, khoa, nhomnguoihuongdan) VALUES ('$mssv', '$hotensinhvien', '$gioitinh', '$sdt', '$gmail', '$diachi', '$malop', '$truonghoc', '$nganh', '$khoa', '$nhomnguoihuongdan')";
                
                if ($mysqli->query($query)) {
                    $notification = "Thêm sinh viên thành công.";
                } else {
                    $notification = "Thêm sinh viên thất bại: " . $mysqli->error;
                }
            }
        }
    }
    // Thực hiện xóa sinh viên
    elseif (isset($_POST['delete'])) {
        $id = $_POST['delete_id'];
        if ($mysqli->query("DELETE FROM sinhvien WHERE id=$id")) {
            $notification = "Xóa sinh viên thành công.";
        } else {
            $notification = "Xóa sinh viên thất bại: " . $mysqli->error;
        }
    }

    // Thực hiện sửa sinh viên
    elseif (isset($_POST['edit'])) {
        $id = $_POST['edit_id'];
        $new_hotensinhvien = $_POST['new_hotensinhvien'];
        $new_gioitinh = $_POST['new_gioitinh'];
        $new_sdt = $_POST['new_sdt'];
        $new_gmail = $_POST['new_gmail'];
        $new_diachi = $_POST['new_diachi'];
        $new_malop = $_POST['new_malop'];
        $new_truonghoc = $_POST['new_truonghoc'];
        $new_nganh = $_POST['new_nganh'];
        $new_khoa = $_POST['new_khoa'];
        $new_nhomnguoihuongdan = $_POST['new_nhomnguoihuongdan'];

        // Kiểm tra sdt có đúng 10 số không
        if (strlen($new_sdt) !== 10 || !is_numeric($new_sdt)) {
            $notification = "Số điện thoại phải có 10 số và là số nguyên.";
        } else {
            // Thực hiện truy vấn sửa sinh viên
            $query = "UPDATE sinhvien SET hotensinhvien='$new_hotensinhvien', gioitinh='$new_gioitinh', sdt='$new_sdt', gmail='$new_gmail', diachi='$new_diachi', malop='$new_malop', truonghoc='$new_truonghoc', nganh='$new_nganh', khoa='$new_khoa', nhomnguoihuongdan='$new_nhomnguoihuongdan' WHERE id=$id";

            if ($mysqli->query($query)) {
                $notification = "Sửa sinh viên thành công.";
            } else {
                $notification = "Sửa sinh viên thất bại: " . $mysqli->error;
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sinh viên</title>
</head>
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
<body>
    <h2>Quản lý Sinh viên</h2>

    <!-- Form Thêm Sinh viên -->
    <form method="POST">
        <h3>Thêm Sinh viên</h3>
        <label>MSSV:</label>
        <input type="text" name="mssv" required>
        <br>
        <label>Họ tên Sinh viên:</label>
        <input type="text" name="hotensinhvien" required>
        <br>
        <label>Giới tính:</label>
        <select name="gioitinh" required>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select>
        <br>
        <label>Số điện thoại:</label>
        <input type="text" name="sdt" required>
        <br>
        <label>Email:</label>
        <input type="email" name="gmail" required>
        <br>
        <label>Địa chỉ:</label>
        <input type="text" name="diachi" required>
        <br>
        <label>Mã lớp:</label>
        <input type="text" name="malop" required>
        <br>
        <label>Trường học:</label>
        <select name="truonghoc" required>
            <?php
            // Fetch trườnghoc options from truong table
            $resultTruong = $mysqli->query("SELECT * FROM truong");
            while ($rowTruong = $resultTruong->fetch_assoc()) {
                echo "<option value='{$rowTruong['truonghoc']}'>{$rowTruong['truonghoc']}</option>";
            }
            ?>
        </select>
        <br>
        <label>ngành học:</label>
        <select name="nganh" required>
            <?php
            // Fetch nganh options from nganh table
            $resultNganh = $mysqli->query("SELECT * FROM nganh");
            while ($rowNganh = $resultNganh->fetch_assoc()) {
                echo "<option value='{$rowNganh['nganh']}'>{$rowNganh['nganh']}</option>";
            }
            ?>
        </select>
        <br>
        <label>Khóa:</label>
        <input type="text" name="khoa" required>
        <br>
        <label>Nhóm người hướng dẫn:</label>
        <input type="text" name="nhomnguoihuongdan" required>
        <br>
        <button type="submit" name="add">Thêm</button>
    </form>
    <?php if (!empty($notification)): ?>
        <div style="color: while;"><?php echo $notification; ?></div>
    <?php endif; ?>
    <!-- Bảng Danh sách Sinh viên -->
    <h3>Danh sách Sinh viên</h3>
    <table border="1">
        <tr>
            <th>MSSV</th>
            <th>Họ tên Sinh viên</th>
            <th>Giới tính</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Mã lớp</th>
            <th>Trường học</th>
            <th>Ngành</th>
            <th>Khóa</th>
            <th>Nhóm người hướng dẫn</th>
            <th>Thao tác</th>
        </tr>

        <?php
        // Truy vấn danh sách sinh viên
        $result = $mysqli->query("SELECT * FROM sinhvien");

        // Hiển thị dữ liệu
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['mssv']}</td>";
            echo "<td>{$row['hotensinhvien']}</td>";
            echo "<td>{$row['gioitinh']}</td>";
            echo "<td>{$row['sdt']}</td>";
            echo "<td>{$row['gmail']}</td>";
            echo "<td>{$row['diachi']}</td>";
            echo "<td>{$row['malop']}</td>";
            echo "<td>{$row['truonghoc']}</td>";
            echo "<td>{$row['nganh']}</td>";
            echo "<td>{$row['khoa']}</td>";
            echo "<td>{$row['nhomnguoihuongdan']}</td>";
            echo "<td>
                    <form method='POST'>
                        <input type='hidden' name='delete_id' value='{$row['id']}'>
                        <button type='submit' name='delete'>Xóa</button>
                    </form>
             
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <script>
        function validateForm() {
            var mssv = document.getElementsByName("mssv")[0].value;
            
            // Kiểm tra mssv có đúng 10 số không
            if (mssv.length !== 10 || isNaN(mssv)) {
                showAlert("MSSV phải có 10 số và là số nguyên.");
                return false; // Ngăn chặn form gửi đi
            }

            // Các kiểm tra khác nếu cần

            return true; // Cho phép form gửi đi
        }
    </script>
    <?php
    // Đóng kết nối
    $mysqli->close();
    ?>
</body>
</html>
<p><a href="index.php">Quay lại trang chủ!</a></p>