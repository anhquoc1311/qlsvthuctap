<?php
// Kết nối đến cơ sở dữ liệu
include('config/connect.php');


// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Khởi tạo biến thông báo
$notification = "";
$successNotification = "";
// Xử lý khi form được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Thực hiện sửa sinh viên
    if (isset($_POST['edit'])) {
        $mssv_to_edit = $_POST['mssv_to_edit'];

        // Placeholder code for fetching student details based on MSSV
        $resultStudent = $mysqli->query("SELECT * FROM sinhvien WHERE mssv = '$mssv_to_edit'");

        if ($resultStudent->num_rows > 0) {
            $row = $resultStudent->fetch_assoc();
            // Retrieve student details
            $edit_hotensinhvien = $row['hotensinhvien'];
            $edit_gioitinh = $row['gioitinh'];
            $edit_sdt = $row['sdt'];
            $edit_gmail = $row['gmail'];
            $edit_diachi = $row['diachi'];
            $edit_malop = $row['malop'];
            $edit_truonghoc = $row['truonghoc'];
            $edit_nganh = $row['nganh'];
            $edit_khoa = $row['khoa'];
            $edit_nhomnguoihuongdan = $row['nhomnguoihuongdan'];
            // Display student details in the form
            echo "<div class='form'>";
            echo "<form method='POST'>";
            echo "<h3>Sửa Sinh viên</h3>";
            echo "<label>MSSV:</label>";
            echo "<input type='text' name='mssv_to_edit' value='$mssv_to_edit' readonly>";
            echo "<br>";
            echo "<label>Họ tên Sinh viên:</label>";
            echo "<input type='text' name='edit_hotensinhvien' value='$edit_hotensinhvien' required>";
            echo "<br>";
            echo "<label>Giới tính:</label>";
            echo "<select name='edit_gioitinh' required>";
            echo "<option value='Nam' " . ($edit_gioitinh == 'Nam' ? 'selected' : '') . ">Nam</option>";
            echo "<option value='Nữ' " . ($edit_gioitinh == 'Nữ' ? 'selected' : '') . ">Nữ</option>";
            echo "</select>";
            echo "<br>";
            echo "<label>Số điện thoại:</label>";
            echo "<input type='text' name='edit_sdt' value='$edit_sdt' required>";
            echo "<br>";
            echo "<label>Email:</label>";
            echo "<input type='email' name='edit_gmail' value='$edit_gmail' required>";
            echo "<br>";
            echo "<label>Địa chỉ:</label>";
            echo "<input type='text' name='edit_diachi' value='$edit_diachi' required>";
            echo "<br>";
            echo "<label>Mã lớp:</label>";
            echo "<input type='text' name='edit_malop' value='$edit_malop' required>";
            echo "<br>";
            echo "<label>Trường học:</label>";
            echo "<select name='edit_truonghoc' required>";
            $resultTruong = $mysqli->query("SELECT * FROM truong");
            while ($rowTruong = $resultTruong->fetch_assoc()) {
                echo "<option value='{$rowTruong['truonghoc']}' " . ($edit_truonghoc == $rowTruong['truonghoc'] ? 'selected' : '') . ">{$rowTruong['truonghoc']}</option>";
            }
            echo "</select>";
            echo "<br>";
            echo "<label>Ngành:</label>";
            echo "<select name='edit_nganh' required>";
            $resultNganh = $mysqli->query("SELECT * FROM nganh");
            while ($rowNganh = $resultNganh->fetch_assoc()) {
                echo "<option value='{$rowNganh['tennganh']}' " . ($edit_nganh == $rowNganh['tennganh'] ? 'selected' : '') . ">{$rowNganh['tennganh']}</option>";
            }
            echo "</select>";
            echo "<br>";
            echo "<label>Khóa:</label>";
            echo "<input type='text' name='edit_khoa' value='$edit_khoa' required>";
            echo "<br>";
            echo "<label>Nhóm người hướng dẫn:</label>";
            echo "<input type='text' name='edit_nhomnguoihuongdan' value='$edit_nhomnguoihuongdan' required>";
            echo "<br>";
            echo "<button type='submit' name='update'>Cập nhật</button>";
            echo "<a href='themsv_php.php'><button style='background-color: grey;' type='button' class='btnquayve'>Quay Về </button></a>";
            echo "</form>";
            echo "</div>"; // Closing div for form-container
        } else {
            $successNotification = "<span style='color: red;'>Không tìm thấy sinh viên với MSSV: $mssv_to_edit</span>";

        }
    }

    // Placeholder for update functionality
    elseif (isset($_POST['update'])) {
        // Retrieve updated student details from the form
        $mssv_to_update = $_POST['mssv_to_edit'];
        $updated_hotensinhvien = $_POST['edit_hotensinhvien'];
        $updated_gioitinh = $_POST['edit_gioitinh'];
        $updated_sdt = $_POST['edit_sdt'];
        $updated_gmail = $_POST['edit_gmail'];
        $updated_diachi = $_POST['edit_diachi'];
        $updated_malop = $_POST['edit_malop'];
        $updated_truonghoc = $_POST['edit_truonghoc'];
        $updated_nganh = $_POST['edit_nganh'];
        $updated_khoa = $_POST['edit_khoa'];
        $updated_nhomnguoihuongdan = $_POST['edit_nhomnguoihuongdan'];

        // Placeholder code for updating student details in the database
        $update_query = "UPDATE sinhvien SET hotensinhvien='$updated_hotensinhvien', gioitinh='$updated_gioitinh', sdt='$updated_sdt', gmail='$updated_gmail', diachi='$updated_diachi', malop='$updated_malop', truonghoc='$updated_truonghoc', nganh='$updated_nganh', khoa='$updated_khoa', nhomnguoihuongdan='$updated_nhomnguoihuongdan' WHERE mssv='$mssv_to_update'";

        if ($mysqli->query($update_query)) {
           $successNotification = "Cập nhật thông tin sinh viên thành công.";
           echo "<script>
            setTimeout(function() {
                window.location.href = 'themsv_php.php';
            }, 2000); // 2000 milliseconds = 2 seconds
         </script>";
        } else {
            $successNotification = "<span style='color: red;'>Cập nhật thông tin sinh viên thất bại!" . $mysqli->error . "</span>";
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
        background-color: #f0f7f9; /* Màu nền xanh dương */
        color: #333; /* Màu chữ trắng */
        font-family: Arial, sans-serif; /* Kiểu font chữ */
        margin: 0;
        padding: 0;
    }
    h3 {
    text-align: center;
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
        color: white;
    }

    tr:nth-child(even) {
        background-color: #e1edf4; /* Màu nền xanh dương cho các hàng chẵn */
    }

    tr:nth-child(odd) {
        background-color: #d4e5f7; /* Màu nền xanh dương đậm cho các hàng lẻ */
    }

    a {
        color: #2072b3; /* Màu chữ trắng cho các liên kết */
    }

    a:hover {
        color: #ff6600; /* Màu chữ khi di chuột qua liên kết */
    }

    form {
        margin-top: 20px;
    }

    h2 {
        color: #2072b3; /* Màu chữ trắng cho tiêu đề h2 */
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
    .form {
            background: linear-gradient(rgba(135, 206, 250, 0), rgba(135, 204, 250, 0.7));
            width: 700px;
            margin: 0 auto;
            text-align: center;
            padding: 20px; /* Thêm khoảng cách xung quanh form */
            border: 1px solid #ccc; /* Thêm đường viền */
            border-radius: 10px; /* Bo góc của form */
        }
    .form input {
            width: auto;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;

        }
    .form label {
        display: inline-block;
        width: 150px; 
        text-align: right; 
        margin-right: 10px;
        font-weight: bold;
    }
    .form select{
        width: 190px;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: center;

    }
    h2 {
        text-align: center;
        color: blue;
        font-size: 30px;
        /* background: cadetblue; */
        text-shadow: 10px 2px 4px rgba(0, 0, 0, 0.5);
    }
    h3 {
        color: black;
        font-size: x-large; 
    }
    button {
        display: inline-block;
        /* width: calc(45% - 5px); */
        margin-right: 10px;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 130px;
        /* text-align: center; */
    }
    </style>
<body>
    
    <h2>Quản lý Sinh viên</h2>
    <div class="form">
    <!-- Form Sửa Sinh viên -->
    <form method="POST">
        <h3>Sửa Sinh viên</h3>
        <label>MSSV:</label>
        <input type="text" name="mssv_to_edit" required>
        <button type="submit" name="edit">Tìm kiếm</button>
        <?php if (!empty($successNotification)): ?>
                <div id="successNotification" style="color: green;"><?php echo $successNotification; ?></div>
        <?php endif; ?>
    </form>
    </div>
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
                       
                    </form>
             
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <!-- Placeholder for Update Form -->
    <!-- This section is dynamically generated based on the search result -->
    
    <!-- Đóng kết nối -->
    <script>
        // Tự động đóng thông báo sau 3 giây
        setTimeout(function() {
            var successNotification = document.getElementById('successNotification');
            if (successNotification) {
                successNotification.style.display = 'none';
            }
        }, 3000);
    </script>
    <?php
    $mysqli->close();
    ?>
    <div class="w3-footer"><hr>
        <span class="text-sm text-blue" style="font-size:12px ; color: #0073B7">
            <p>TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG</p>
            <p>Địa chỉ: 73 Nguyễn Huệ, phường 2, thành phố Vỉnh Long, tỉnh Vỉnh Long<br>
            Điện thoại: (+84) 02703.822141 - Fax: (+84) 02703.821003 - Email: spktvl@vlute.edu.vn</p>
        </span>
    </div>
</body>

</html>
