<?php
$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
$successNotification = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $tenkythuctap = $_POST['tenkythuctap'];
        $tendetai = $_POST['tendetai'];
        $ngaybatdau = $_POST['ngaybatdau'];
        $ngayketthuc = $_POST['ngayketthuc'];

        $checkQuery = "SELECT * FROM kythuctap WHERE tenkythuctap = '$tenkythuctap'";
        $checkResult = $mysqli->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            $notification = "Tên kỳ thực tập đã tồn tại.";
        } else {
            $query = "INSERT INTO kythuctap (tenkythuctap, tendetai, ngaybatdau, ngayketthuc) 
                      VALUES ('$tenkythuctap', '$tendetai', '$ngaybatdau', '$ngayketthuc')";

            if ($mysqli->query($query)) {
                $notification = "Thêm kỳ thực tập thành công.";
            } else {
                $notification = "Thêm kỳ thực tập thất bại: " . $mysqli->error;
            }
        }
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['delete_id'];
        if ($mysqli->query("DELETE FROM kythuctap WHERE id_kythuctap=$id")) {
            $notification = "Xóa kỳ thực tập thành công.";
        } else {
            $notification = "Xóa kỳ thực tập thất bại: " . $mysqli->error;
        }
    } elseif (isset($_POST['edit'])) {
        $id = $_POST['edit_id'];
        $new_tenkythuctap = $_POST['new_tenkythuctap'];
        $new_tendetai = $_POST['new_tendetai'];
        $new_ngaybatdau = $_POST['new_ngaybatdau'];
        $new_ngayketthuc = $_POST['new_ngayketthuc'];

        $updateData = [];
        if (!empty($new_tenkythuctap)) $updateData[] = "tenkythuctap='$new_tenkythuctap'";
        if (!empty($new_tendetai)) $updateData[] = "tendetai='$new_tendetai'";
        if (!empty($new_ngaybatdau)) $updateData[] = "ngaybatdau='$new_ngaybatdau'";
        if (!empty($new_ngayketthuc)) $updateData[] = "ngayketthuc='$new_ngayketthuc'";

        

        if (!empty($updateData)) {
            $query = "UPDATE kythuctap SET " . implode(", ", $updateData) . " WHERE id_kythuctap=$id";

            if ($mysqli->query($query)) {
                $notification = "Sửa kỳ thực tập thành công.";
            } else {
                $notification = "Sửa kỳ thực tập thất bại: " . $mysqli->error;
            }
        } else {
            $notification = "Không có dữ liệu mới để cập nhật.";
        }
    }   
}



// Add kỳ thực tập
if (isset($_POST['submit_add_kythuctap'])) {
    $tenkythuctap = $_POST['tenkythuctap'];
    $tendetai = $_POST['tendetai'];
    $ngaybatdau = $_POST['ngaybatdau'];
    $ngayketthuc = $_POST['ngayketthuc'];

    $insertKythuctapQuery = "INSERT INTO kythuctap (tenkythuctap, tendetai, ngaybatdau, ngayketthuc) 
                            VALUES ('$tenkythuctap', '$tendetai', '$ngaybatdau', '$ngayketthuc')";

    if ($mysqli->query($insertKythuctapQuery) === TRUE) {
        $successNotification = "Thêm kỳ thực tập thành công.";
        echo "<script>
            setTimeout(function() {
                var successNotification = document.getElementById('successNotification');
                if (successNotification) {
                    successNotification.style.display = 'none';
                }
            }, 2000); // 2000 milliseconds = 2 seconds
         </script>";
    } else {
        $successNotification = "Thêm kỳ thực tập thất bại: " . $mysqli->error;
    }
}

// Xóa kỳ thực tập

if (isset($_POST['delete_kythuctap'])) {
    $delete_id_kythuctap = $_POST['delete_id_kythuctap'];

    $deleteKythuctapQuery = "DELETE FROM kythuctap WHERE id_kythuctap=$delete_id_kythuctap";

    if ($mysqli->query($deleteKythuctapQuery)) {
        $notification = "Xóa kỳ thực tập thành công.";
    } else {
        $notification = "Xóa kỳ thực tập thất bại: " . $mysqli->error;
    }
    
}
// Sửa kỳ thực tập
if (isset($_POST['edit_kythuctap'])) {
    $edit_id_kythuctap = $_POST['edit_id_kythuctap'];
    $new_tenkythuctap = $_POST['new_tenkythuctap'];
    $new_tendetai = $_POST['new_tendetai'];
    $new_ngaybatdau = $_POST['new_ngaybatdau'];
    $new_ngayketthuc = $_POST['new_ngayketthuc'];

    $updateData = [];
    if (!empty($new_tenkythuctap)) $updateData[] = "tenkythuctap='$new_tenkythuctap'";
    if (!empty($new_tendetai)) $updateData[] = "tendetai='$new_tendetai'";
    if (!empty($new_ngaybatdau)) $updateData[] = "ngaybatdau='$new_ngaybatdau'";
    if (!empty($new_ngayketthuc)) $updateData[] = "ngayketthuc='$new_ngayketthuc'";

    if (!empty($updateData)) {
        $query = "UPDATE kythuctap SET " . implode(", ", $updateData) . " WHERE id_kythuctap=$edit_id_kythuctap";

        if ($mysqli->query($query)) {
            $notification = "Sửa kỳ thực tập thành công.";
        } else {
            $notification = "Sửa kỳ thực tập thất bại: " . $mysqli->error;
        }
    } else {
        $notification = "Không có dữ liệu mới để cập nhật.";
    }
}


// Fetch tên đề tài for dropdown
$detaiQuery = "SELECT * FROM tendetai";
$detaiResult = $mysqli->query($detaiQuery);

// Fetch danh sách kỳ thực tập
$kythuctapQuery = "SELECT * FROM kythuctap";
$kythuctapResult = $mysqli->query($kythuctapQuery);

?>
<?php
$notification = "";
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

    input[type="text"], input[type="password"], input[type="email"], select {
        width: 10%;
        padding: 8px;
        margin: 5px 0;
        box-sizing: border-box;
    }
    input[type="date"] {
        margin-top: 5px;
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
        margin-top: 20px;
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
        <input type="text" name="tenkythuctap" required>
        <br>
        <label>Đề tài:</label>
        <select name="tendetai">
            <?php while ($row = $detaiResult->fetch_assoc()) : ?>
                <option value="<?php echo $row['tendetai']; ?>"><?php echo $row['tendetai']; ?></option>
            <?php endwhile; ?>
        </select>
        <br>
        <label>Ngày bắt đầu:</label>
        <input type="date" name="ngaybatdau" required>
        <br>
        <label>Ngày kết thúc:</label>
        <input type="date" name="ngayketthuc" required>
        <br>
        <button type="submit" name="submit_add_kythuctap">Thêm</button>
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
            while ($row = $kythuctapResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id_kythuctap']}</td>";
                echo "<td>{$row['tenkythuctap']}</td>";
                echo "<td>{$row['tendetai']}</td>";
                echo "<td>{$row['ngaybatdau']}</td>";
                echo "<td>{$row['ngayketthuc']}</td>";
                echo "<td class='actions'>
                        <form method='POST' onsubmit='return confirm(\"Bạn có chắc chắn muốn xoá kỳ thực tập này không?\");'>
                            <input type='hidden' name='delete_id_kythuctap' value='{$row['id_kythuctap']}'>
                            <button class='btndel' name='delete_kythuctap'><i class='fa-solid fa-trash-can'></i></button>
                        </form>
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
<p class="notification"><?php echo $notification; ?></p>
<p><a href="index.php">Quay lại trang chủ!</a></p>

</body>
</html>
