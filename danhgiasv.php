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
    <title>Quản lý Đánh giá</title>
</head>
<style>

    body {
        background-color: #3498db; /* Màu nền xanh dương */
        color: #ffffff; /* Màu chữ trắng */
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
    }

    tr:nth-child(even) {
        background-color: #3498db; /* Màu nền xanh dương cho các hàng chẵn */
    }

    tr:nth-child(odd) {
        background-color: #2072b3; /* Màu nền xanh dương đậm cho các hàng lẻ */
    }

    a {
        color: #ffffff; /* Màu chữ trắng cho các liên kết */
    }

    a:hover {
        color: #ffcc00; /* Màu chữ khi di chuột qua liên kết */
    }

    form {
        margin-top: 20px;
    }

    h2 {
        color: #ffffff; /* Màu chữ trắng cho tiêu đề h2 */
    }

    input[type="text"], select {
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

</style>

<body>
    <h2>Quản lý Đánh giá</h2>

    <!-- Form Thêm Đánh giá -->
    <form method="POST">
        <label>Họ tên Sinh viên:</label>
        <input type="text" name="hotensinhvien" required>
        <br>
        <label>Nhóm người hướng dẫn:</label>
        <input type="text" name="nhomnguoihuongdan" required>
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
        <div style="color: white;"><?php echo $notification; ?></div>
    <?php endif; ?>


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
                    <form method='POST'>
                        <input type='hidden' name='delete_id' value='{$row['id']}'>
                        <button type='submit' name='delete'>Xóa</button>
                    </form>
             
                  </td>";
            echo "</tr>";


            
            echo "<td>
            <form method='POST'>
                <input type='hidden' name='edit_id' value='{$row['id']}'>
                <button type='submit' name='edit'>Sửa</button>
            </form>
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
</html>

<p><a href="index.php">Quay lại trang chủ!</a></p>