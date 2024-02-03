<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đánh giá và Cập nhật</title>
    <style>
        body {
            background-color: #3498db;
            color: #ffffff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            color: #ffffff;
            margin-top: 20px;
        }

        form {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        input[type="text"] {
            width: 200px;
            padding: 8px;
            margin-right: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #2072b3;
            color: #ffffff;
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #3498db;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ffffff;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #2072b3;
        }

        tr:nth-child(even) {
            background-color: #3498db;
        }

        tr:nth-child(odd) {
            background-color: #2072b3;
        }

        form table {
            width: 100%;
        }

        form table input[type="text"],
        form table textarea {
            width: 90%;
            padding: 8px;
            margin-bottom: 5px;
            box-sizing: border-box;
        }

        form table button {
            background-color: #2072b3;
            color: #ffffff;
            padding: 8px;
            border: none;
            cursor: pointer;
        }

        form table button:hover {
            background-color: #3498db;
        }

        a {
            color: #ffffff;
            text-decoration: none;
        }

        a:hover {
            color: #ffcc00;
        }

        p {
            margin-top: 20px;
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
        } else {
            echo "<p>Không tìm thấy kết quả!</p>";
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
            echo "<p>Cập nhật dữ liệu thành công!</p>";
        } else {
            echo "<p>Lỗi: " . mysqli_error($conn) . "</p>";
        }
    }

    mysqli_close($conn);
    ?>

    <p><a href="index.php">Quay lại trang chủ!</a></p>
</body>

</html>
