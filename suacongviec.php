<?php
$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    $selectEditQuery = "SELECT c.*, d.tendetai FROM congviec c
                        JOIN tendetai d ON c.tendetai = d.tendetai
                        WHERE c.id_cv = $edit_id";
    $editResult = $mysqli->query($selectEditQuery);
    $editData = $editResult->fetch_assoc();
}

$selected_tendetai = isset($_GET['selected_tendetai']) ? $_GET['selected_tendetai'] : '';

if (isset($_POST['edit'])) {
    $edit_id = $_POST['edit_id'];
    $tencongviec = $_POST['tencongviec'];
    $tendetai = $_POST['tendetai'];
    $tennhomnguoihuongdan = $_POST['tennhomnguoihuongdan'];
    $ngaybatdau = $_POST['ngaybatdau'];
    $ngayketthuc = $_POST['ngayketthuc'];
    $nhanxet = $_POST['nhanxet'];

    $query = "UPDATE congviec SET tencongviec = '$tencongviec', tendetai = '$tendetai', tennhomnguoihuongdan = '$tennhomnguoihuongdan',
                    ngaybatdau = '$ngaybatdau', ngayketthuc = '$ngayketthuc', nhanxet = '$nhanxet' 
                WHERE id_cv = $edit_id";

    if ($mysqli->query($query)) {
        $successNotification = "Cập nhật thông tin thành công.";
        echo "<script>
                setTimeout(function() {
                window.location.href = 'themxoasuacv.php';
                }, 2000); // 2000 milliseconds = 2 seconds
            </script>";
    } else {
        $successNotification = "<span style='color: red;'>Cập nhật thông tin thất bại!" . $mysqli->error . "</span>";
    }
}

// Fetch the data for displaying in the table
$selectDataQuery = "SELECT * FROM congviec";
$result = $mysqli->query($selectDataQuery);
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

    <title>Quản Lý Công Việc</title>
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
        font-weight: bold;
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
            width: 216px;
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
        .form textarea {
            vertical-align: top; /* Adjust the vertical alignment to the top */
            width: 214px;
            border-radius: 7px;
            height: 60px;
            text-align: center;
        }
        input[type="date"] {
             margin-bottom: 10px;
            width: 216px; /* Set a fixed width for date input boxes */
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
<h2>Quản Lý Công Việc</h2>
    <div class="form">
    <!-- Form Thêm Kỳ Thực Tập -->
    <form method="POST">
        <h3>Sửa công việc</h3>
        <input type="hidden" name="edit_id" value="<?php echo $editData['id_cv']; ?>">
        <label>Tên công việc:</label>
        <input type="text" name="tencongviec" value="<?php echo $editData['tencongviec'] ?>" required>
        <br>
        <label>Đề tài:</label>
        <input type="text" name="tendetai" value="<?php echo $editData['tendetai'] ?>" required>
        <br>
        <label>Tên người hướng dẫn:</label>
        <input type="text" name="tennhomnguoihuongdan" value="<?php echo $editData['tennhomnguoihuongdan'] ?>"  required>
        <br>
        <label>Ngày bắt đầu:</label>
        <input type="date" name="ngaybatdau" value="<?php echo $editData['ngaybatdau'] ?>"  required>
        <br>
        <label>Ngày kết thúc:</label>
        <input type="date" name="ngayketthuc" value="<?php echo $editData['ngayketthuc'] ?>"  required>
        <br>
        <label>Nhận xét:</label>
        <textarea  style="width: 214px;border-radius: 7px; height: 60px;" type="text" name="nhanxet" value="<?php echo $editData['nhanxet'] ?>"  required></textarea>
        <br>
        <button type="submit" name="edit">Cập nhật</button>
        <a href="themxoasuacv.php"><button style="background-color: grey;" type="button" class="btnquayve">Quay Về </button></a>
    </form>
     <?php if (!empty($successNotification)): ?>
            <div id="successNotification" style="color: green;"><?php echo $successNotification; ?></div>
    <?php endif; ?>
</div>
<!-- Bảng Danh sách Kỳ Thực Tập -->
<h2>Danh sách công việc</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Tên công việc</th>
        <th>Tên đề tài</th>
        <th>Tên nhóm người hướng dẫn</th>
        <th>Ngày bắt đầu</th>
        <th>Ngày kết thúc</th>
        <th>Nhận xét</th>
        <th>Thao tác</th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id_cv']}</td>";
        echo "<td>{$row['tencongviec']}</td>";
        echo "<td>{$row['tendetai']}</td>";
        echo "<td>{$row['tennhomnguoihuongdan']}</td>";
        echo "<td>{$row['ngaybatdau']}</td>";
        echo "<td>{$row['ngayketthuc']}</td>";
        echo "<td>{$row['nhanxet']}</td>";
        echo "<td>    
            <a href='suacongviec.php?edit_id=" . $row['id_cv'] . "' class='edit'>
                <button class='btnedit'><i class='fa-solid fa-pen-to-square'></i></button>
            </a>
        </td>";

    }
    ?>
</table>
<div class="w3-footer"><hr>
        <span class="text-sm text-blue" style="font-size:12px ; color: #0073B7">
            <p>TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG</p>
            <p>Địa chỉ: 73 Nguyễn Huệ, phường 2, thành phố Vỉnh Long, tỉnh Vỉnh Long<br>
            Điện thoại: (+84) 02703.822141 - Fax: (+84) 02703.821003 - Email: spktvl@vlute.edu.vn</p>
        </span>
    </div>
<p><a href="index.php">Quay lại trang chủ!</a></p>

</body>
</html>
