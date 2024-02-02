<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đánh giá và Cập nhật</title>
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
</head>
<body>
    <h2>Danh sách đánh giá và Cập nhật</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <input type="text" name="hoten" placeholder="Nhập họ tên sinh viên">
        <button type="submit">Tìm kiếm</button>
    </form>

    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'quanlysvtt');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_GET['hoten'])) {
        $hoten = $_GET['hoten'];
        $sql = "SELECT * FROM danhgia WHERE hotensinhvien LIKE '%$hoten%'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table border='1'>
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
            </tr>";
    
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<form action='".$_SERVER['PHP_SELF']."' method='POST'>";
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
        echo "</form>";
        echo "</tr>";
    }
    echo "</table>";
    
        } else {
            echo "Không tìm thấy kết quả!";
        }
    }

    if(isset($_POST['update'])) {
        $id = $_POST['update'];
        $hotensinhvien = $_POST['hotensinhvien'];
        $nhomnguoihuongdan = $_POST['nhomnguoihuongdan'];

        // Thực hiện câu lệnh cập nhật dữ liệu vào cơ sở dữ liệu
        $update_query = "UPDATE danhgia SET hotensinhvien='$hotensinhvien', nhomnguoihuongdan='$nhomnguoihuongdan' WHERE id='$id'";
        if (mysqli_query($conn, $update_query)) {
            echo "Cập nhật dữ liệu thành công!";
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    ?>

</body>
</html>
