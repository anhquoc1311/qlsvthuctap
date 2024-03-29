<?php
include('config/connect.php');

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$successNotification = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $tennhom = $_POST['tennhom'];
        $detai = $_POST['detai'];
        $hotensinhvien = $_POST['hotensinhvien'];
        $ngaybd = $_POST['ngaybd'];
        $ngaykt = $_POST['ngaykt'];

        $checkQuery = "SELECT * FROM nhomtt WHERE tennhom = '$tennhom'";
        $checkResult = $mysqli->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            $successNotification = "Tên nhóm đã tồn tại.";
        } else {
            $query = "INSERT INTO nhomtt (tennhom, detai, hotensinhvien, ngaybd, ngaykt) 
                      VALUES ('$tennhom', '$detai', '$hotensinhvien', '$ngaybd', '$ngaykt')";

            if ($mysqli->query($query)) {
                $successNotification = "Thêm nhóm thành công.";
            } else {
                $successNotification = "Thêm nhóm thất bại: " . $mysqli->error;
            }
        }
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['delete_id'];
        if ($mysqli->query("DELETE FROM nhomtt WHERE id=$id")) {
            $successNotification = "Xóa nhóm thành công.";
        } else {
            $successNotification = "Xóa nhóm thất bại: " . $mysqli->error;
        }
    } elseif (isset($_POST['edit'])) {
        $id = $_POST['edit_id'];
        $new_tennhom = $_POST['new_tennhom'];
        $new_detai = $_POST['new_detai'];
        $new_hotensinhvien = $_POST['new_hotensinhvien'];
        $new_ngaybd = $_POST['new_ngaybd'];
        $new_ngaykt = $_POST['new_ngaykt'];

        $updateData = [];
        if (!empty($new_tennhom)) $updateData[] = "tennhom='$new_tennhom'";
        if (!empty($new_detai)) $updateData[] = "detai='$new_detai'";
        if (!empty($new_hotensinhvien)) $updateData[] = "hotensinhvien='$new_hotensinhvien'";
        if (!empty($new_ngaybd)) $updateData[] = "ngaybd='$new_ngaybd'";
        if (!empty($new_ngaykt)) $updateData[] = "ngaykt='$new_ngaykt'";

        if (!empty($updateData)) {
            $query = "UPDATE nhomtt SET " . implode(", ", $updateData) . " WHERE id=$id";

            if ($mysqli->query($query)) {
                $successNotification = "Sửa nhóm thành công.";
            } else {
                $successNotification = "Sửa nhóm thất bại: " . $mysqli->error;
            }
        } else {
            $notification = "Không có dữ liệu mới để cập nhật.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <title>Quản lý Nhóm Thực Tập</title>
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
        margin-top: 5px;
        width: 191px;
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
        margin-top: 12px;
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
    input[type="file"] {
    width: 190px;
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
    </style>
</head>
<body>
    <div class="home">
        <a href="index.php"> < Home</a>
    </div>
    <h2>Quản lý Nhóm Thực Tập</h2>
<div class="form">
    <!-- Form Thêm Nhóm -->
    <form method="POST">
        <h3>Thêm Nhóm</h3>
        <label>Tên Nhóm:</label>
        <input type="text" name="tennhom" required>
        <br>
        <label>Đề Tài:</label>
        <select name="detai" required>
        <?php
        // Query to fetch distinct values for 'tennhomnguoihuongdan' from your database
        $nhomQuery = "SELECT DISTINCT tendetai FROM tendetai";
        $nhomResult = $mysqli->query($nhomQuery);

        // Check if the query was successful
        if ($nhomResult) {
            while ($row = $nhomResult->fetch_assoc()) {
                $selected = ($row['tendetai'] == $editData['tendetai']) ? 'selected' : '';
                echo "<option value='{$row['tendetai']}' $selected>{$row['tendetai']}</option>";
            }
        }
        ?>
        </select>
        <br>
        <label>Họ Tên Sinh Viên:</label>
        <select id="selectSinhVien" class="select2" name="hotensinhvien" required>
            <!-- Options will be dynamically loaded -->
        </select>
        <br>
        <label>Ngày Bắt Đầu:</label>
        <input type="date" name="ngaybd" required>
        <br>
        <label>Ngày Kết Thúc:</label>
        <input type="date" name="ngaykt" required>
        <br>
        <button type="submit" name="add">Thêm</button>
    </form>
        <?php if (!empty($successNotification)): ?>
            <div id="successNotification" style="color: green;"><?php echo $successNotification; ?></div>
            <script>
            setTimeout(function() {
            var successNotification = document.getElementById('successNotification');
                if (successNotification) {
                    successNotification.style.display = 'none';
                }
            }, 2000); // 2000 milliseconds = 2 seconds
            </script>
        <?php endif; ?>
</div>

    <!-- Bảng Danh sách Nhóm -->
    <h3>Danh sách Nhóm</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tên Nhóm</th>
            <th>Đề Tài</th>
            <th>Họ Tên Sinh Viên</th>
            <th>Ngày Bắt Đầu</th>
            <th>Ngày Kết Thúc</th>
            <th>Thao tác</th>
        </tr>

        <?php
        $result = $mysqli->query("SELECT * FROM nhomtt");

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['tennhom']}</td>";
            echo "<td>{$row['detai']}</td>";
            echo "<td>{$row['hotensinhvien']}</td>";
            echo "<td>{$row['ngaybd']}</td>";
            echo "<td>{$row['ngaykt']}</td>";
            echo "<td class='actions'>
                    <form <form method='POST' onsubmit='return confirm(\"Bạn có chắc chắn muốn xoá nhóm thực tập này không?\");'>
                        <input type='hidden' name='delete_id' value='{$row['id']}'>
                        <button class='btndel' name='delete'><i class='fa-solid fa-trash-can'></i></button>
                    </form>  
                        <a href='suantt.php?id=" . $row['id'] . "'>
                            <button class='btnedit'><i class='fa-solid fa-pen-to-square'></i></button>
                        </a> 
                   
                </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php
$resultSinhVien = $mysqli->query("SELECT hotensinhvien FROM sinhvien");
$sinhVienArray = array();

while ($rowSinhVien = $resultSinhVien->fetch_assoc()) {
    $sinhVienArray[] = $rowSinhVien['hotensinhvien'];
}
?>

<script>
    // Đưa danh sách sinh viên vào Select2 và cho phép chọn nhiều giá trị
    var sinhVienData = <?php echo json_encode($sinhVienArray); ?>;
    $('#selectSinhVien').select2({
        data: sinhVienData,
        multiple: true
    });
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
