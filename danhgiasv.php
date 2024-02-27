<?php
$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$notification = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Thực hiện thêm đánh giá
    if (isset($_POST['add'])) {
        // Lấy dữ liệu từ form
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
        $danhgiachung = ($_POST['diemythuckyluat'] + $_POST['diemtuanthuthoigian'] + $_POST['diemkienthuc'] + $_POST['diemkynangnghe'] + $_POST['diemkinangdoclap'] + $_POST['diemkhanangnhom'] + $_POST['diemkhananggiaiquyetcongviec']) ;
        $ngaydanhgia = $_POST['ngaydanhgia'];

        $query = "INSERT INTO danhgia (hotensinhvien, nhomnguoihuongdan, ythuckyluat, diemythuckyluat, tuanthuthoigian, diemtuanthuthoigian, kienthuc, diemkienthuc, kynangnghe, diemkynangnghe, kinangdoclap, diemkinangdoclap, khanangnhom, diemkhanangnhom, khananggiaiquyetcongviec, diemkhananggiaiquyetcongviec, danhgiachung, ngaydanhgia) VALUES ('$hotensinhvien', '$nhomnguoihuongdan', '$ythuckyluat', '$diemythuckyluat', '$tuanthuthoigian', '$diemtuanthuthoigian', '$kienthuc', '$diemkienthuc', '$kynangnghe', '$diemkynangnghe', '$kinangdoclap', '$diemkinangdoclap', '$khanangnhom', '$diemkhanangnhom', '$khananggiaiquyetcongviec', '$diemkhananggiaiquyetcongviec', '$danhgiachung', '$ngaydanhgia')";

        if ($mysqli->query($query)) {
            $notification = "Thêm đánh giá thành công.";
        } else {
            $notification = "Thêm đánh giá thất bại: " . $mysqli->error;
        }
        
    }
    // Thực hiện xóa đánh giá
    elseif (isset($_POST['delete'])) {
        $id = $_POST['delete_id'];
        if ($mysqli->query("DELETE FROM danhgia WHERE id=$id")) {
            $notification = "Xóa đánh giá thành công.";
        } else {
            $notification = "Xóa đánh giá thất bại: " . $mysqli->error;
        }
    }

    // Thực hiện sửa đánh giá
    elseif (isset($_POST['edit'])) {
        $id = $_POST['edit_id'];
     // Ensure $id_to_edit is set and is a valid number
     if (!isset($id_to_edit) || !is_numeric($id_to_edit)) {
        die('Invalid ID for editing.');
    }

    $result = $mysqli->query("SELECT * FROM danhgia WHERE id=$id_to_edit");

    // Check if the query was successful
    if (!$result) {
        die('Error retrieving data for editing: ' . $mysqli->error);
    }

    $row_to_edit = $result->fetch_assoc();

        $new_hotensinhvien = $_POST['new_hotensinhvien'];
        $new_nhomnguoihuongdan = $_POST['new_nhomnguoihuongdan'];
        $new_ythuckyluat = $_POST['new_ythuckyluat'];
        $new_diemythuckyluat = $_POST['new_diemythuckyluat'];
        $new_tuanthuthoigian = $_POST['new_tuanthuthoigian'];
        $new_diemtuanthuthoigian = $_POST['new_diemtuanthuthoigian'];
        $new_kienthuc = $_POST['new_kienthuc'];
        $new_diemkienthuc = $_POST['new_diemkienthuc'];
        $new_kynangnghe = $_POST['new_kynangnghe'];
        $new_diemkynangnghe = $_POST['new_diemkynangnghe'];
        $new_kinangdoclap = $_POST['new_kinangdoclap'];
        $new_diemkinangdoclap = $_POST['new_diemkinangdoclap'];
        $new_khanangnhom = $_POST['new_khanangnhom'];
        $new_diemkhanangnhom = $_POST['new_diemkhanangnhom'];
        $new_khananggiaiquyetcongviec = $_POST['new_khananggiaiquyetcongviec'];
        $new_diemkhananggiaiquyetcongviec = $_POST['new_diemkhananggiaiquyetcongviec'];
        $new_danhgiachung = ($new_diemythuckyluat + $new_diemtuanthuthoigian + $new_diemkienthuc + $new_diemkynangnghe + $new_diemkinangdoclap + $new_diemkhanangnhom + $new_diemkhananggiaiquyetcongviec) / 7;
        $new_ngaydanhgia = $_POST['new_ngaydanhgia'];

        $query = "UPDATE danhgia SET hotensinhvien='$new_hotensinhvien', nhomnguoihuongdan='$new_nhomnguoihuongdan', ythuckyluat='$new_ythuckyluat', diemythucklyuat='$new_diemythuckyluat', tuanthuthoigian='$new_tuanthuthoigian', diemtuanthuthoigian='$new_diemtuanthuthoigian', kienthuc='$new_kienthuc', diemkienthuc='$new_diemkienthuc', kynangnghe='$new_kynangnghe', diemkynangnghe='$new_diemkynangnghe', kinangdoclap='$new_kinangdoclap', diemkinangdoclap='$new_diemkinangdoclap', khanangnhom='$new_khanangnhom', diemkhanangnhom='$new_diemkhanangnhom', khananggiaiquyetcongviec='$new_khananggiaiquyetcongviec', diemkhananggiaiquyetcongviec='$new_diemkhananggiaiquyetcongviec', danhgiachung='$new_danhgiachung', ngaydanhgia='$new_ngaydanhgia' WHERE id=$id";

        if ($mysqli->query($query)) {
            $notification = "Sửa đánh giá thành công.";
        } else {
            $notification = "Sửa đánh giá thất bại: " . $mysqli->error;
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
    <title>Quản lý Đánh giá</title>
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
            width: 215px;
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
        margin-top: 12px;
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
    <h2>Quản lý Đánh giá</h2>
    <div class="form">
    <!-- Form Thêm Đánh giá -->
    <form method="POST">
        <label>Họ tên Sinh viên:</label>
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
        <label>Nhóm người hướng dẫn:</label>
        <select name="nhomnguoihuongdan" required>
        <?php
        // Query to fetch distinct values for 'tennhomnguoihuongdan' from your database
        $nhomQuery = "SELECT DISTINCT tennguoihuongdan FROM nhomnguoihd";
        $nhomResult = $mysqli->query($nhomQuery);

        // Check if the query was successful
        if ($nhomResult) {
            while ($row = $nhomResult->fetch_assoc()) {
                $selected = ($row['tennguoihuongdan'] == $editData['tennguoihuongdan']) ? 'selected' : '';
                echo "<option value='{$row['tennguoihuongdan']}' $selected>{$row['tennguoihuongdan']}</option>";
            }
        }
        ?>
        </select>
        <br>
        <label>Ý thức kỷ luật:</label>
        <select name="ythuckyluat" required>
            <option value="tốt">tốt</option>
            <option value="khá tốt">khá tốt</option>
            <option value="khá">khá</option>
            <option value="chưa đạt">chưa đạt</option>
        </select>
 <!-- 
        <input type="text" name="ythuckyluat" required>
        -->
        <br>
        <label>Điểm ý thức kỷ luật:</label>
        <input type="text" name="diemythuckyluat" required>
        <br>
        <label>Tuần thời gian:</label>
        <input type="text" name="tuanthuthoigian" required>
        <br>
        <label>Điểm tuần thời gian:</label>
        <input type="text" name="diemtuanthuthoigian" required>
        <br>
        <label>Kiến thức:</label>
        <select name="kienthuc" required>
            <option value="tốt">tốt</option>
            <option value="khá tốt">khá tốt</option>
            <option value="khá">khá</option>
            <option value="chưa đạt">chưa đạt</option>
        </select>

        <br>
        <label>Điểm kiến thức:</label>
        <input type="text" name="diemkienthuc" required>
        <br>
        <label>Kỹ năng nghề:</label>
        <select name="kynangnghe" required>
            <option value="tốt">tốt</option>
            <option value="khá tốt">khá tốt</option>
            <option value="khá">khá</option>
            <option value="chưa đạt">chưa đạt</option>
        </select>

        <br>
        <label>Điểm kỹ năng nghề:</label>
        <input type="text" name="diemkynangnghe" required>
        <br>
        <label>Kỹ năng độc lập:</label>
        <select name="kinangdoclap" required>
            <option value="tốt">tốt</option>
            <option value="khá tốt">khá tốt</option>
            <option value="khá">khá</option>
            <option value="chưa đạt">chưa đạt</option>
        </select>

        <br>
        <label>Điểm kỹ năng độc lập:</label>
        <input type="text" name="diemkinangdoclap" required>
        <br>
        <label>Kỹ năng nhóm:</label>

        <select name="khanangnhom" required>
            <option value="tốt">tốt</option>
            <option value="khá tốt">khá tốt</option>
            <option value="khá">khá</option>
            <option value="chưa đạt">chưa đạt</option>
        </select>
        

        <br>
        <label>Điểm kỹ năng nhóm:</label>
        <input type="text" name="diemkhanangnhom" required>
        <br>
        <label>Kỹ năng giải quyết công việc:</label>
        <select name="khananggiaiquyetcongviec" required>
            <option value="tốt">tốt</option>
            <option value="khá tốt">khá tốt</option>
            <option value="khá">khá</option>
            <option value="chưa đạt">chưa đạt</option>
        </select>
        <br>
        <label>Đánh giá chung:</label>
        <input type="text" name="danhgiachung" required>

        <br>
        <label>Điểm kỹ năng giải quyết công việc:</label>
        <input type="text" name="diemkhananggiaiquyetcongviec" required>
        <br>
        <label>Ngày đánh giá:</label>
        <input type="date" name="ngaydanhgia" required>
        <br>
        <button type="submit" name="add">Thêm</button>
        <br>

       

        * Tốt:100   Khá tốt:80  Khá:60  Chưa đạt:40
    </form>
    <?php if (!empty($notification)): ?>
        <div style="color: Green;"><?php echo $notification; ?></div>
        <script>
            setTimeout(function() {
            var successNotification = document.getElementById('successNotification');
            if (successNotification) {
                successNotification.style.display = 'none';
            }
        }, 2000);
        </script>
    <?php endif; ?>
    </div>

</table>





    <!-- Bảng Danh sách Đánh giá -->

    <h3>Danh sách Đánh giá</h3>
    <table border="1">
        <tr>
            <th>Họ tên Sinh viên</th>
            <th>Nhóm người hướng dẫn</th>
            <th>Ý thức kỷ luật</th>
            <th>Điểm ý thức kỷ luật</th>
            <th>Tuần thời gian</th>
            <th>Điểm tuần thời gian</th>
            <th>Kiến thức</th>
            <th>Điểm kiến thức</th>
            <th>Kỹ năng nghề</th>
            <th>Điểm kỹ năng nghề</th>
            <th>Kỹ năng độc lập</th>
            <th>Điểm kỹ năng độc lập</th>
            <th>Kỹ năng nhóm</th>
            <th>Điểm kỹ năng nhóm</th>
            <th>Kỹ năng giải quyết công việc</th>
            <th>Điểm kỹ năng giải quyết công việc</th>
            <th>Đánh giá chung</th>
            <th>Ngày đánh giá</th>
            <th>Thao tác</th>
        </tr>

        <?php
       $result = $mysqli->query("SELECT * FROM danhgia");

      


        while ($row = $result->fetch_assoc()) {
            echo "<td>{$row['hotensinhvien']}</td>";
            echo "<td>{$row['nhomnguoihuongdan']}</td>";
            echo "<td>{$row['ythuckyluat']}</td>";
            echo "<td>{$row['diemythuckyluat']}</td>";
            echo "<td>{$row['tuanthuthoigian']}</td>";
            echo "<td>{$row['diemtuanthuthoigian']}</td>";
            echo "<td>{$row['kienthuc']}</td>";
            echo "<td>{$row['diemkienthuc']}</td>";
            echo "<td>{$row['kynangnghe']}</td>";
            echo "<td>{$row['diemkynangnghe']}</td>";
            echo "<td>{$row['kinangdoclap']}</td>";
            echo "<td>{$row['diemkinangdoclap']}</td>";
            echo "<td>{$row['khanangnhom']}</td>";
            echo "<td>{$row['diemkhanangnhom']}</td>";
            echo "<td>{$row['khananggiaiquyetcongviec']}</td>";
            echo "<td>{$row['diemkhananggiaiquyetcongviec']}</td>";
            echo "<td>{$row['danhgiachung']}</td>";
            echo "<td>{$row['ngaydanhgia']}</td>";
            echo "<td>
                <form method='POST' onsubmit='return confirm(\"Bạn có chắc chắn muốn xoá đánh giá này không?\");'>
                    <input type='hidden' name='delete_id' value='{$row['id']}'>
                    <button class='btndel' name='delete'><i class='fa-solid fa-trash-can'></i></button>
                </form>
                <a href='suadgsv.php' class='edit'>
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

<p><a href="index.php">Quay lại trang chủ!</a></p>