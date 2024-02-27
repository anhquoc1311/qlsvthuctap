<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đánh giá và Cập nhật</title>
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
        .formds input[type="text"] {
            width: 78px;
            text-align: center;
            border-radius: 5px;
        }
        .formds textarea {
            width: 78px;
            text-align: center;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="home">
        <a href="index.php"> < Home</a>
    </div>
    <h2>Danh sách đánh giá và Cập nhật</h2>
    <div class="form">     
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <input type="text" name="hoten" placeholder="Nhập họ tên sinh viên">
        <button type="submit">Tìm kiếm</button>
    </form>
    </div >

    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'quanlysvtt');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $successNotification = "";
    if (isset($_GET['hoten'])) {
        $hoten = $_GET['hoten'];
        $sql = "SELECT * FROM danhgia WHERE hotensinhvien LIKE '%$hoten%'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<div class='formds'>";
            echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>";
            echo "<table>
            <tr>
            <th>ID</th>
            <th>Họ Tên Sinh Viên</th>
            <th>Nhóm Người Hướng Dẫn</th>
            <th>Ý Thức Kỷ Luật</th>
            <th>Điểm Ý Thức Kỷ Luật</th>
            <th>Tuần Thời Gian</th>
            <th>Điểm Tuần Thời Gian</th>
            <th>Kiến Thức</th>
            <th>Điểm Kiến Thức</th>
            <th>Kỹ Năng Nghe</th>
            <th>Điểm Kỹ Năng Nghe</th>
            <th>Kỹ Năng Độc Lập</th>
            <th>Điểm Kỹ Năng Độc Lập</th>
            <th>Khả Năng Nhóm</th>
            <th>Điểm Khả Năng Nhóm</th>
            <th>Khả Năng Giải Quyết Công Việc</th>
            <th>Điểm Khả Năng Giải Quyết Công Việc</th>
            <th>Đánh Giá Chung</th>
            <th>Ngày Đánh Giá</th>
            <th>Action</th>
            </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td><input type='text' name='hotensinhvien' value='" . $row['hotensinhvien'] . "'></td>";
                echo "<td><input type='text' name='nhomnguoihuongdan' value='" . $row['nhomnguoihuongdan'] . "'></td>";
                echo "<td><textarea name='ythuckyluat'>" . $row['ythuckyluat'] . "</textarea></td>";
                echo "<td><input type='text' name='diemythuckyluat' value='" . $row['diemythuckyluat'] . "'></td>";
                echo "<td><textarea name='tuanthuthoigian'>" . $row['tuanthuthoigian'] . "</textarea></td>";
                echo "<td><input type='text' name='diemtuanthuthoigian' value='" . $row['diemtuanthuthoigian'] . "'></td>";
                echo "<td><textarea name='kienthuc'>" . $row['kienthuc'] . "</textarea></td>";
                echo "<td><input type='text' name='diemkienthuc' value='" . $row['diemkienthuc'] . "'></td>";
                echo "<td><textarea name='kynangnghe'>" . $row['kynangnghe'] . "</textarea></td>";
                echo "<td><input type='text' name='diemkynangnghe' value='" . $row['diemkynangnghe'] . "'></td>";
                echo "<td><textarea name='kinangdoclap'>" . $row['kinangdoclap'] . "</textarea></td>";
                echo "<td><input type='text' name='diemkinangdoclap' value='" . $row['diemkinangdoclap'] . "'></td>";
                echo "<td><textarea name='khanangnhom'>" . $row['khanangnhom'] . "</textarea></td>";
                echo "<td><input type='text' name='diemkhanangnhom' value='" . $row['diemkhanangnhom'] . "'></td>";
                echo "<td><textarea name='khananggiaiquyetcongviec'>" . $row['khananggiaiquyetcongviec'] . "</textarea></td>";
                echo "<td><input type='text' name='diemkhananggiaiquyetcongviec' value='" . $row['diemkhananggiaiquyetcongviec'] . "'></td>";
                echo "<td><input type='text' name='danhgiachung' value='" . $row['danhgiachung'] . "'></td>";
                echo "<td><input type='text' name='ngaydanhgia' value='" . $row['ngaydanhgia'] . "'></td>";
                echo "<td><button type='submit' name='update' value='" . $row['id'] . "'>Cập nhật</button></td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</form>";
            echo "</div>";
        } else {
            $successNotification = "Không tìm thấy kết quả!";
        }
        if (!empty($successNotification)) {
        echo "<div id='searchNotification' style='color: red; font-weight: bold; text-align: center;'>$successNotification</div>";
        echo "<script>
            setTimeout(function() {
                var searchNotification = document.getElementById('searchNotification');
                if (searchNotification) {
                    searchNotification.style.display = 'none';
                }
            }, 2000);
        </script>";
    }
    }

    if (isset($_POST['update'])) {
        $id = $_POST['update'];
        $hotensinhvien = $_POST['hotensinhvien'];
        $nhomnguoihuongdan = $_POST['nhomnguoihuongdan'];
        $ythuckyluat = $_POST['ythuckyluat'];
        $diemythuckyluat = $_POST['diemythuckyluat'];
        $tuanthuthoigian = $_POST['tuanthuthoigian'];
        $diemtuanthuthoigian = $_POST['diemtuanthuthoigian'];
        $kienthuc = $_POST['kienthuc'];
        $diemkienthuc = $_POST['diemkienthuc'];
        $kynangnghe = $_POST['kynangnghe'];
        $diemkynangnghe = $_POST['diemkynangnghe'];
        $kinangdoclap = $_POST['kinangdoclap'];
        $diemkinangdoclap = $_POST['diemkinangdoclap'];
        $khanangnhom = $_POST['khanangnhom'];
        $diemkhanangnhom = $_POST['diemkhanangnhom'];
        $khananggiaiquyetcongviec = $_POST['khananggiaiquyetcongviec'];
        $diemkhananggiaiquyetcongviec = $_POST['diemkhananggiaiquyetcongviec'];
        $danhgiachung = $_POST['danhgiachung'];
        $ngaydanhgia = $_POST['ngaydanhgia'];

        // Thực hiện câu lệnh cập nhật dữ liệu vào cơ sở dữ liệu
        $update_query = "UPDATE danhgia SET hotensinhvien='$hotensinhvien', nhomnguoihuongdan='$nhomnguoihuongdan', ythuckyluat='$ythuckyluat', 
        diemythuckyluat='$diemythuckyluat', tuanthuthoigian='$tuanthuthoigian', diemtuanthuthoigian='$diemtuanthuthoigian', 
        kienthuc='$kienthuc', diemkienthuc='$diemkienthuc', kynangnghe='$kynangnghe', diemkynangnghe='$diemkynangnghe', 
        kinangdoclap='$kinangdoclap', diemkinangdoclap='$diemkinangdoclap', khanangnhom='$khanangnhom', diemkhanangnhom='$diemkhanangnhom', 
        khananggiaiquyetcongviec='$khananggiaiquyetcongviec', diemkhananggiaiquyetcongviec='$diemkhananggiaiquyetcongviec', 
        danhgiachung='$danhgiachung', ngaydanhgia='$ngaydanhgia' WHERE id='$id'";
        if (mysqli_query($conn, $update_query)) {
            echo "<p id='updateNotification' style='color:green; text-align:center;'>Cập nhật dữ liệu thành công!</p>";
            echo "<script>
            var updateNotification = document.getElementById('updateNotification');
            if (updateNotification) {
                updateNotification.style.display = 'block';
                setTimeout(function() {
                    updateNotification.style.display = 'none';
                }, 2000);
            }
          </script>";
        } else {
            echo "<p>Lỗi: " . mysqli_error($conn) . "</p>";
        }
    }
    mysqli_close($conn);
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
