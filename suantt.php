<?php
include('config/connect.php');

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
$id = $_GET['id'];
    $sua = "SELECT * FROM nhomtt WHERE id='$id'" ;
    $query_sua = mysqli_query($mysqli,$sua);
    $row = mysqli_fetch_array($query_sua);
    if (isset($_POST['edit'])) {
        $tennhom = $_POST['tennhom'];
        $detai = $_POST['detai'];
        $hotensinhvien = $_POST['hotensinhvien'];
        $ngaybd = $_POST['ngaybd'];
        $ngaykt = $_POST['ngaykt'];

        $query = "UPDATE nhomtt SET tennhom ='$tennhom',detai ='$detai', hotensinhvien = '$hotensinhvien', ngaybd ='$ngaybd',ngaykt ='$ngaykt' WHERE id='$id'";  
                
            if ($mysqli->query($query)) {
                $successNotification = "Cập nhật thông tin thành công.";
                echo "<script>
                    setTimeout(function() {
                    window.location.href = 'themxoasuanhomtt.php';
                    }, 2000); // 2000 milliseconds = 2 seconds
                </script>";
            } else {
               $successNotification = "<span style='color: red;'>Cập nhật thông tin thất bại!" . $mysqli->error . "</span>";
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
    </style>
</head>
<body>
    <h2>Quản lý Nhóm Thực Tập</h2>
<div class="form">
    <!-- Form Thêm Nhóm -->
    <form method="POST">
        <h3>Sửa Nhóm</h3>
        <label>Tên Nhóm:</label>
        <input type="text" name="tennhom" value="<?php echo $row['tennhom'] ?>" required>
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
        <select name="hotensinhvien" required>
            <?php
            // Query to fetch distinct values for 'tennhomnguoihuongdan' from your database
            $nhomQuery = "SELECT DISTINCT hotensinhvien FROM sinhvien";
            $nhomResult = $mysqli->query($nhomQuery);

            // Check if the query was successful
            if ($nhomResult) {
                while ($row = $nhomResult->fetch_assoc()) {
                    $selected = ($row['hotensinhvien'] == $editData['hotensinhvien']) ? 'selected' : '';
                    echo "<option value='{$row['hotensinhvien']}' $selected>{$row['hotensinhvien']}</option>";
                }
            }
            ?>
        </select>

        <br>
        <label>Ngày Bắt Đầu:</label>
        <input type="date" name="ngaybd" value="<?php echo $row['ngaybd'] ?>" required>
        <br>
        <label>Ngày Kết Thúc:</label>
        <input type="date" name="ngaykt" value="<?php echo $row['ngaykt'] ?>" required>
        <br>
        <button type="submit" name="edit">Cập nhật</button>
        <a href="themxoasuanhomtt.php"><button style="background-color: grey;" type="button" class="btnquayve">Quay Về </button></a>
    </form>
     <?php if (!empty($successNotification)): ?>
            <div id="successNotification" style="color: green;"><?php echo $successNotification; ?></div>
    <?php endif; ?>
</div>
    <?php if (!empty($notification)): ?>
        <div style="color: #ff0000;"><?php echo $notification; ?></div>
    <?php endif; ?>

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
