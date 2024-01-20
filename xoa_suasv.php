<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
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

<table border="1">
    <tr>
        <th>MSSV</th>
        <th>Họ tên</th>
        <th>Giới tính</th>
        <th>SDT</th>
        <th>Email</th>
        <th>Địa chỉ</th>
        <th>Mã lớp</th>
        <th>Trường học</th>
        <th>Ngành</th>
        <th>Khoa</th>
        <th>Nhóm người hướng dẫn</th>
        <th>Xóa</th>
        <th>Sửa</th>
    </tr>

    <?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'qlsvtp';

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die('Kết nối không thành công: ' . mysqli_connect_error());
    }

    $query = "SELECT * FROM sinhvien";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['mssv']}</td>";
        echo "<td>{$row['hotensinhvien']}</td>";
        echo "<td>{$row['gioitinh']}</td>";
        echo "<td>{$row['sdt']}</td>";
        echo "<td>{$row['gmail']}</td>";
        echo "<td>{$row['diachi']}</td>";
        echo "<td>{$row['malop']}</td>";
        echo "<td>{$row['truonghoc']}</td>";
        echo "<td>{$row['nganh']}</td>";
        echo "<td>{$row['khoa']}</td>";
        echo "<td>{$row['nhomnguoihuongdan']}</td>";
        echo "<td><a href='xoa_suasv.php?action=xoa&id={$row['id']}'>Xóa</a></td>";
        echo "<td><a href='xoa_suasv.php?action=sua&id={$row['id']}'>Sửa</a></td>";
        echo "</tr>";
    }

    mysqli_close($conn);
    ?>

</table>

</body>
</html>
<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'qlsvtp';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die('Kết nối không thành công: ' . mysqli_connect_error());
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action == 'xoa') {
        $query = "DELETE FROM sinhvien WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Xóa sinh viên thành công!";
        } else {
            echo "Lỗi xóa sinh viên: " . mysqli_error($conn);
        }
    } elseif ($action == 'sua') {
        // Lấy thông tin sinh viên từ cơ sở dữ liệu
        $query = "SELECT * FROM sinhvien WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Xử lý dữ liệu khi submit form
                $mssv = $_POST['mssv'];
                $hotensinhvien = $_POST['hotensinhvien'];
                $gioitinh = $_POST['gioitinh'];
                $sdt = $_POST['sdt'];
                $gmail = $_POST['gmail'];
                $diachi = $_POST['diachi'];
                $malop = $_POST['malop'];
                $truonghoc = $_POST['truonghoc'];
                $nganh = $_POST['nganh'];
                $khoa = $_POST['khoa'];
                $nhomnguoihuongdan = $_POST['nhomnguoihuongdan'];

                // Kiểm tra ràng buộc dữ liệu
                if (strlen($mssv) !== 10 || !is_numeric($mssv)) {
                    echo "MSSV phải là 10 số.";
                } elseif ($gioitinh !== "Nam" && $gioitinh !== "Nữ") {
                    echo "Chọn giới tính Nam hoặc Nữ.";
                } elseif (!is_numeric($sdt) || strlen($sdt) !== 10) {
                    echo "Số điện thoại phải là 10 số.";
                } else {
                    // Thực hiện cập nhật thông tin sinh viên
                    $query = "UPDATE sinhvien SET 
                                mssv = '$mssv',
                                hotensinhvien = '$hotensinhvien',
                                gioitinh = '$gioitinh',
                                sdt = '$sdt',
                                gmail = '$gmail',
                                diachi = '$diachi',
                                malop = '$malop',
                                truonghoc = '$truonghoc',
                                nganh = '$nganh',
                                khoa = '$khoa',
                                nhomnguoihuongdan = '$nhomnguoihuongdan'
                                WHERE id = $id";

                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        echo "Cập nhật thông tin sinh viên thành công!";
                    } else {
                        echo "Lỗi cập nhật sinh viên: " . mysqli_error($conn);
                    }
                }
            }

            // Hiển thị form sửa thông tin sinh viên
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Sửa thông tin sinh viên</title>
            </head>
            <body>
            
            <h2>Sửa thông tin sinh viên</h2>
            
            <form action="xoa_suasv.php?action=sua&id=<?php echo $row['id']; ?>" method="post">
                <!-- Hiển thị các trường thông tin và giá trị hiện tại -->
                MSSV: <input type="text" name="mssv" value="<?php echo $row['mssv']; ?>"><br>
                Họ tên: <input type="text" name="hotensinhvien" value="<?php echo $row['hotensinhvien']; ?>"><br>
                Giới tính: 
                <select name="gioitinh">
                    <option value="Nam" <?php if($row['gioitinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                    <option value="Nữ" <?php if($row['gioitinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                </select><br>
                SDT: <input type="text" name="sdt" value="<?php echo $row['sdt']; ?>"><br>
                Email: <input type="text" name="gmail" value="<?php echo $row['gmail']; ?>"><br>
                Địa chỉ: <input type="text" name="diachi" value="<?php echo $row['diachi']; ?>"><br>
                Mã lớp: <input type="text" name="malop" value="<?php echo $row['malop']; ?>"><br>
                Trường học: <input type="text" name="truonghoc" value="<?php echo $row['truonghoc']; ?>"><br>
                Ngành: <input type="text" name="nganh" value="<?php echo $row['nganh']; ?>"><br>
                Khoa: <input type="text" name="khoa" value="<?php echo $row['khoa']; ?>"><br>
                Nhóm người hướng dẫn: <input type="text" name="nhomnguoihuongdan" value="<?php echo $row['nhomnguoihuongdan']; ?>"><br>
                <input type="submit" value="Cập nhật">
            </form>
            
            </body>
            </html>
            <?php
        } else {
            echo "Không tìm thấy sinh viên có ID = $id";
        }
    }
}

mysqli_close($conn);
?>
