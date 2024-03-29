<?php
// Kết nối đến cơ sở dữ liệu
include('config/connect.php');
// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Khởi tạo biến thông báo
$notification = "";
$avata = "";
$successNotification = "";
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

        $avata = $_FILES['avata']['name'];
        $avata_tmp = $_FILES['avata']['tmp_name'];
        $avata = time() . '_' . $avata;
            
        // Thực hiện kiểm tra username đã tồn tại hay chưa
        $checkQuery = "SELECT * FROM nguoihuongdan WHERE username = '$username'";
        $checkResult = $mysqli->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            $successNotification = "<span style='color: red;'>Tên người hướng dẫn tồn tại!" . $mysqli->error . "</span>";
        } else {
            // Thực hiện truy vấn thêm người hướng dẫn
            $query = "INSERT INTO nguoihuongdan (ten, sdt, gmail, chucdanh, phong, username, password, zalo, facebook, github, avata) VALUES ('$ten', '$sdt', '$gmail', '$chucdanh', '$phong', '$username', '$password', '$zalo', '$facebook', '$github', '$avata')";
            move_uploaded_file($avata_tmp, 'image/' . $avata);

            if ($mysqli->query($query)) {
                $successNotification = "Thêm người hướng dẫn thành công.";
            } else {
               $successNotification = "<span style='color: red;'>Thêm người hướng dẫn thất bại!" . $mysqli->error . "</span>";
            }
        }
    }
    // Thực hiện xóa người hướng dẫn
    elseif (isset($_POST['delete'])) {
        $id = $_POST['delete_id'];
        if ($mysqli->query("DELETE FROM nguoihuongdan WHERE id_nguoihuongdan=$id")) {
            $successNotification = "Xóa người hướng dẫn thành công.";
        } else {
           $successNotification = "<span style='color: red;'>Xoá người hướng dẫn thất bại!" . $mysqli->error . "</span>";
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

        $new_avata = $_FILES['new_avata']['name'];
        $new_avata_tmp = $_FILES['new_avata']['tmp_name'];

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
        // Check if 'new_avata' is set in $_FILES
        if (isset($_FILES['new_avata'])) {
            // Check if 'name' and 'tmp_name' are set in $_FILES['new_avata']
            if (isset($_FILES['new_avata']['name']) && isset($_FILES['new_avata']['tmp_name'])) {
                $new_avata = $_FILES['new_avata']['name'];
                $new_avata_tmp = $_FILES['new_avata']['tmp_name'];
            } else {
                // Set default values or handle the case where no new file is selected.
                $new_avata = "";
                $new_avata_tmp = "";
            }
        } else {
            // Set default values or handle the case where 'new_avata' is not set in $_FILES.
            $new_avata = "";
            $new_avata_tmp = "";
        }



        // Kiểm tra xem có dữ liệu mới để cập nhật hay không
        if (!empty($updateData)) {
            // Thực hiện truy vấn sửa người hướng dẫn
            $query = "UPDATE nguoihuongdan SET " . implode(", ", $updateData) . " WHERE id_nguoihuongdan=$id";
            move_uploaded_file($new_avata_tmp, 'image/' . $new_avata);
            if ($mysqli->query($query)) {
                $successNotification = "Sửa người hướng dẫn thành công.";
            } else {
                $successNotification = "<span style='color: red;'>Sửa người hướng dẫn thất bại!" . $mysqli->error . "</span>";
            }
        } else {
            $successNotification = "<span style='color: red;'>Không có dữ liệu mới để cập nhật!" . $mysqli->error . "</span>";
        }
    }}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <title>Quản lý Người hướng dẫn</title>
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
    <div class="home">
        <a href="index.php"> < Home</a>
    </div>
    <h2>Quản lý Người hướng dẫn</h2>

    <!-- Form Thêm Người hướng dẫn -->
    <div class="form">
    <form method="POST" enctype="multipart/form-data">
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
        <input type="file" name="avata" >
        <br>
        <button type="submit" name="add">Thêm</button>
    </form>
      <?php if (!empty($successNotification)): ?>
            <div id="successNotification" style="color: green;"><?php echo $successNotification; ?></div>
    <?php endif; ?>
    </div>
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
            echo "<td>" . str_repeat('*', strlen($row['password'])) . "</td>";
            echo "<td>{$row['zalo']}</td>";
            echo "<td>{$row['facebook']}</td>";
            echo "<td>{$row['github']}</td>";
            echo "<td>";
                if (!empty($row['avata'])) {
                    $imagePath = 'image/' . $row['avata'];
                    echo "<img src='$imagePath' alt='Avatar' style='width: 50px; height: 50px;'>";
                } else {
                    echo "No Avatar";
                }
            echo "</td>";
            echo "<td class='actions'>
                    <form method='POST' onsubmit='return confirm(\"Bạn có chắc chắn muốn xoá người hướng dẫn này không?\");'>
                    <input type='hidden' name='delete_id' value='{$row['id_nguoihuongdan']}'>
                    <button class='btndel' name='delete'><i class='fa-solid fa-trash-can'></i></button>
                    </form>
                    <a href='suanguoihd.php?id=" . $row['id_nguoihuongdan'] . "'>
                        <button class='btnedit'><i class='fa-solid fa-pen-to-square'></i></button>
                    </a> 
                  </td>";
            echo "</tr>";

        }
        ?>
       
    </table>
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
    <div class="w3-footer"><hr>
        <span class="text-sm text-blue" style="font-size:12px ; color: #0073B7">
            <p>TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG</p>
            <p>Địa chỉ: 73 Nguyễn Huệ, phường 2, thành phố Vỉnh Long, tỉnh Vỉnh Long<br>
            Điện thoại: (+84) 02703.822141 - Fax: (+84) 02703.821003 - Email: spktvl@vlute.edu.vn</p>
        </span>
    </div>
</body>
</html>
