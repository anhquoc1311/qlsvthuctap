<?php
    $mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }
    $id = $_GET['id'];
    $sua = "SELECT * FROM kythuctap WHERE id_kythuctap='$id'" ;
    $query_sua = mysqli_query($mysqli,$sua);
    $row = mysqli_fetch_array($query_sua);
    if (isset($_POST['edit'])) {
        $tenkythuctap = $_POST['tenkythuctap'];
        $tendetai = $_POST['tendetai'];
        $ngaybatdau = $_POST['ngaybatdau'];
        $ngayketthuc = $_POST['ngayketthuc'];

        $query = "UPDATE kythuctap SET tenkythuctap ='$tenkythuctap',tendetai ='$tendetai',ngaybatdau ='$ngaybatdau',ngayketthuc ='$ngayketthuc' WHERE id_kythuctap='$id'";  
                
            if ($mysqli->query($query)) {
                $successNotification = "Cập nhật thông tin thành công.";
                echo "<script>
                    setTimeout(function() {
                    window.location.href = 'kythuctap.php';
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

    <title>Quản Lý Kỳ Thực Tập</title>
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
    input[type="date"] {
        margin-top: 5px;
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
</head>
<body>
     <div class="home">
        <a href="index.php"> < Home</a>
    </div>
    <h2>Quản Lý Kỳ Thực Tập</h2>
    <div class="form">
    <!-- Form Thêm Kỳ Thực Tập -->
    <form method="POST">
        <h3>Thêm Kỳ Thực Tập</h3>
        <label>Tên kỳ thực tập:</label>
        <input type="text" name="tenkythuctap" value="<?php echo $row['tenkythuctap'] ?>" required>
        <br>
        <label>Đề tài:</label>
        <input type="text" name="tendetai" value="<?php echo $row['tendetai'] ?>"  required>
        <br>
        <label>Ngày bắt đầu:</label>
        <input type="date" name="ngaybatdau" value="<?php echo $row['tenkythuctap'] ?>"  required>
        <br>
        <label>Ngày kết thúc:</label>
        <input type="date" name="ngayketthuc" value="<?php echo $row['tenkythuctap'] ?>"  required>
        <br>
        <button type="submit" name="edit">Cập nhật</button>
    </form>
     <?php if (!empty($successNotification)): ?>
            <div id="successNotification" style="color: green;"><?php echo $successNotification; ?></div>
    <?php endif; ?>
</div>

<!-- Bảng Danh sách Kỳ Thực Tập -->
<h3>Danh Sách Kỳ Thực Tập</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Tên kỳ thực tập</th>
        <th>Đề tài</th>
        <th>Ngày bắt đầu</th>
        <th>Ngày kết thúc</th>
        <th>Chỉnh sửa</th>
    </tr>

    <?php
    $result = $mysqli->query("SELECT * FROM kythuctap");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id_kythuctap']}</td>";
        echo "<td>{$row['tenkythuctap']}</td>";
        echo "<td>{$row['tendetai']}</td>";
        echo "<td>{$row['ngaybatdau']}</td>";
        echo "<td>{$row['ngayketthuc']}</td>";
         echo "<td class='actions'>
                        <a href='suaktt.php?id=" . $row['id_kythuctap'] . "'>
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
