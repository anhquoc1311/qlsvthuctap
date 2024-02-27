<?php
    include('config/connect.php');
    $id = $_GET['id'];
    $sua = "SELECT * FROM nguoihuongdan WHERE id_nguoihuongdan='$id'" ;
    $query_sua = mysqli_query($mysqli,$sua);
    $row = mysqli_fetch_array($query_sua);

    if(isset($_POST['edit'])) {
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
            
        // // Thực hiện kiểm tra username đã tồn tại hay chưa
        // $checkQuery = "SELECT * FROM nguoihuongdan WHERE ten = '$ten'" ;
        // $checkResult = $mysqli->query($checkQuery);

        // if ($checkResult->num_rows > 0) {
        //     $successNotification = "<span style='color: red;'>Tên người hướng dẫn tồn tại!" . $mysqli->error . "</span>";
        // } else {
            // Thực hiện truy vấn thêm người hướng dẫn
            move_uploaded_file ($avata_tmp, 'image/'.$avata);
            $query = "UPDATE nguoihuongdan SET ten ='$ten',sdt ='$sdt',gmail ='$gmail',chucdanh ='$chucdanh',phong ='$phong',username ='$username',password ='$password',zalo ='$zalo',facebook ='$facebook',github ='$github', avata='$avata' WHERE id_nguoihuongdan='$id'";  
                
            if ($mysqli->query($query)) {
                $successNotification = "Cập nhật thông tin thành công.";
                echo "<script>
                    setTimeout(function() {
                    window.location.href = 'themxoasua_nguoihd.php';
                    }, 2000); // 2000 milliseconds = 2 seconds
                </script>";
            } else {
               $successNotification = "<span style='color: red;'>Cập nhật thông tin thất bại!" . $mysqli->error . "</span>";
            }
        // }
    }
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
    </style>
</head>
<body>
    <h2>Quản lý Người hướng dẫn</h2>

    <!-- Form Thêm Người hướng dẫn -->
    <div class="form">
    <form method="POST" enctype="multipart/form-data">
        <h3>Sửa thông tin người hướng dẫn</h3>
        <label>Tên:</label>
        <input type="text" name="ten" value="<?php echo $row['ten'] ?>" required>
        <br>
        <label>Số điện thoại:</label>
        <input type="text" name="sdt" value="<?php echo $row['sdt'] ?>" required>
        <br>
        <label>Email:</label>
        <input type="email" name="gmail" value="<?php echo $row['gmail'] ?>" required>
        <br>
        <label>Chức danh:</label>
        <input type="text" name="chucdanh" value="<?php echo $row['chucdanh'] ?>" required>
        <br>
        <label>Phòng:</label>
        <input type="text" name="phong" value="<?php echo $row['phong'] ?>" required>
        <br>
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $row['username'] ?>" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" value="<?php echo $row['password'] ?>" required>
        <br>
        <label>Zalo:</label>
        <input type="text" name="zalo" value="<?php echo $row['zalo'] ?>" required>
        <br>
        <label>Facebook:</label>
        <input type="text" name="facebook" value="<?php echo $row['facebook'] ?>" required>
        <br>
        <label>Github:</label>
        <input type="text" name="github" value="<?php echo $row['github'] ?>" required>
        <br>
        <label>Avata:</label>
        <input type="file" name="avata" value="<?php echo $row['avata'] ?>" >
        <br>
        <button type="submit" name="edit">Cập nhật</button>
        <a href="themxoasua_nguoihd.php"><button style="background-color: grey;" type="button" class="btnquayve">Quay Về </button></a>
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


