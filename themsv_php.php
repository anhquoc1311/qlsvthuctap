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

        if (strlen($sdt) !== 10 || !is_numeric($sdt)) {
            // Kiểm tra sdt có đúng 10 số không
            $successNotification = "<span style='color: red;'>Số điện thoại phải có 10 và là số nguyên!</span>";
        } else {
            // Kiểm tra xem MSSV đã tồn tại chưa
            $checkQuery = "SELECT * FROM sinhvien WHERE mssv = '$mssv'";
            $checkResult = $mysqli->query($checkQuery);

            if ($checkResult->num_rows > 0) {
                $successNotification = "<span style='color: red;'>Sinh viên với MSSV $mssv đã tồn tại!</span>";
            } else {
                // Thực hiện truy vấn thêm sinh viên
                $query = "INSERT INTO sinhvien (mssv, hotensinhvien, gioitinh, sdt, gmail, diachi, malop, truonghoc, nganh, khoa, nhomnguoihuongdan) VALUES ('$mssv', '$hotensinhvien', '$gioitinh', '$sdt', '$gmail', '$diachi', '$malop', '$truonghoc', '$nganh', '$khoa', '$nhomnguoihuongdan')";

                if ($mysqli->query($query)) {
                    $successNotification = "Thêm sinh viên thành công.";
                } else {
                    $successNotification = "<span style='color: red;'>Thêm sinh viên thất bại! " . $mysqli->error . "</span>";
                }
            }
        }
    }
    // Thực hiện xóa sinh viên
    elseif (isset($_POST['delete'])) {
        $id = $_POST['delete_id'];
        if ($mysqli->query("DELETE FROM sinhvien WHERE id=$id")) {
             $successNotification = "Xóa sinh viên thành công.";
        } else {
            $successNotification = "<span style='color: red;'>Xoá sinh viên thất bại!" . $mysqli->error . "</span>";
        }
    }

    // Thực hiện sửa sinh viên
// Thực hiện sửa sinh viên
    elseif (isset($_POST['edit'])) {
        $id = isset($_POST['edit_id']) ? $_POST['edit_id'] : '';
        $new_hotensinhvien = isset($_POST['new_hotensinhvien']) ? $_POST['new_hotensinhvien'] : '';
        $new_gioitinh = isset($_POST['new_gioitinh']) ? $_POST['new_gioitinh'] : '';
        $new_sdt = isset($_POST['new_sdt']) ? $_POST['new_sdt'] : '';
        $new_gmail = isset($_POST['new_gmail']) ? $_POST['new_gmail'] : '';
        $new_diachi = isset($_POST['new_diachi']) ? $_POST['new_diachi'] : '';
        $new_malop = isset($_POST['new_malop']) ? $_POST['new_malop'] : '';
        $new_truonghoc = isset($_POST['new_truonghoc']) ? $_POST['new_truonghoc'] : '';
        $new_nganh = isset($_POST['new_nganh']) ? $_POST['new_nganh'] : '';
        $new_khoa = isset($_POST['new_khoa']) ? $_POST['new_khoa'] : '';
        $new_nhomnguoihuongdan = isset($_POST['new_nhomnguoihuongdan']) ? $_POST['new_nhomnguoihuongdan'] : '';

        // Kiểm tra sdt có đúng 10 số không
        if (strlen($new_sdt) !== 10 || !is_numeric($new_sdt)) {
            $successNotification = "Số điện thoại phải có 10 số và là số nguyên.";
        } else {
            // Thực hiện truy vấn sửa sinh viên
            $query = "UPDATE sinhvien SET hotensinhvien='$new_hotensinhvien', gioitinh='$new_gioitinh', sdt='$new_sdt', gmail='$new_gmail', diachi='$new_diachi', malop='$new_malop', truonghoc='$new_truonghoc', nganh='$new_nganh', khoa='$new_khoa', nhomnguoihuongdan='$new_nhomnguoihuongdan' WHERE id=$id";

            if ($mysqli->query($query)) {
                $successNotification = "Sửa sinh viên thành công.";
            } else {
                $successNotification = "<span style='color: red;'>Sửa sinh viên thất bại!" . $mysqli->error . "</span>";
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
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
        width: 215px;
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
        font-weight: bolder;
    }
    h3 {
        color: black;
        font-size: x-large; 
        font-weight: bolder;
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
    .btndel {
        background-color: red;
        border: 1px solid black;
        cursor: pointer;
        font-size: 15px;
        border-radius: 3PX;
        opacity: 0.7;
        width: 41px;
        height: 40px;
        }
        .btndel:hover ,.btnedit:hover{
          opacity: 1;
        }
        .btnedit{
          background-color: #337ab7;
          border: 1px solid black;
          cursor: pointer;
          font-size: 15px;
          border-radius: 3PX;
          opacity: 0.7;
          width: 41px;
          height: 40px;
        }
        td form {
            display: inline-block;
            margin-right: 10px;
        }
        .home {
            background: #04AA6D;
            /* width: auto; */
            width: 77px;
            margin-top: 20px;
            margin-left: 29px;
            /* text-decoration: none; */
            font-size: 20px;
            border-radius: 8px;
        }
        a {
            color: white;
            text-decoration: none;
        }
    </style>
<body>
    <div class="home">
        <a href="index.php"> < Home</a>
    </div>
    <h2>Quản lý Sinh viên</h2>
    <div class="form">
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
                    echo "<option value='{$rowNganh['tennganh']}'>{$rowNganh['tennganh']}</option>";
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
          <!-- Hiển thị thông báo thành công -->
        <?php if (!empty($successNotification)): ?>
            <div id="successNotification" style="color: green;"><?php echo $successNotification; ?></div>
        <?php endif; ?>
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
            <form method='POST' onsubmit='return confirm(\"Bạn có chắc chắn muốn xoá sinh viên này không?\");'>
                <input type='hidden' name='delete_id' value='{$row['id']}'>
                <button class='btndel' name='delete'><i class='fa-solid fa-trash-can'></i></button>
            </form>
            <a href='suasv.php' class = 'edit'>
                <button class='btnedit'><i class='fa-solid fa-pen-to-square'></i></button>
            </a>
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
    // Đóng kết nối
    $mysqli->close();
    ?>
</body>
<div class="w3-footer"><hr>
        <span class="text-sm text-blue" style="font-size:12px ; color: #0073B7">
            <p>TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG</p>
            <p>Địa chỉ: 73 Nguyễn Huệ, phường 2, thành phố Vỉnh Long, tỉnh Vỉnh Long<br>
            Điện thoại: (+84) 02703.822141 - Fax: (+84) 02703.821003 - Email: spktvl@vlute.edu.vn</p>
        </span>
    </div>
</html>
