<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sinh Viên</title>
    <style>
        body {
            background-color: #3498db;
            color: #fff;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        .message {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #fff;
            color: #333;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }

        .student-list {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }

        .student-list h3 {
            color: #fff;
        }

        .student-list table {
            width: 100%;
            border-collapse: collapse;
        }

        .student-list table th,
        .student-list table td {
            padding: 8px;
            border: 1px solid #fff;
        }
    </style>
</head>

<body>

    <h2>Quản Lý Sinh Viên</h2>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="mssv">MSSV:</label>
        <input type="text" name="mssv" pattern="\d{10}" title="MSSV must be 10 digits" required>

        <label for="hotensinhvien">Họ Tên Sinh Viên:</label>
        <input type="text" name="hotensinhvien" required>

        <label for="gioitinh">Giới Tính:</label>
        <select name="gioitinh" required>
            <option value="nam">Nam</option>
            <option value="nu">Nữ</option>
        </select>

        <label for="sdt">Số Điện Thoại:</label>
        <input type="tel" name="sdt" pattern="[0-9\s-]+" title="Please enter a valid phone number" required>

        <label for="gmail">Email:</label>
        <input type="email" name="gmail" required>

        <label for="diachi">Địa Chỉ:</label>
        <input type="text" name="diachi" required>

        <label for="malop">Mã Lớp:</label>
        <input type="text" name="malop" required>

        <label for="truonghoc">Trường Học:</label>
        <input type="text" name="truonghoc" required>

        <label for="nganh">Ngành:</label>
        <input type="text" name="nganh" required>

        <label for="khoa">Khoa:</label>
        <input type="text" name="khoa" required>

        <label for="nhomnguoihuongdan">Nhóm Người Hướng Dẫn:</label>
        <input type="text" name="nhomnguoihuongdan" required>

        <!-- Add a hidden input for the action -->
        <input type="hidden" name="action" value="Thêm Sinh Viên">

        <input type="submit" value="Thêm Sinh Viên">
    </form>

    <div class="message">
        <?php
        // Kết nối cơ sở dữ liệu MySQL
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'qlsvtp';

        $conn = mysqli_connect($host, $username, $password, $database);

        // Kiểm tra kết nối
        if (!$conn) {
            die('Kết nối không thành công: ' . mysqli_connect_error());
        }

        // Xử lý form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if "action" key is set in the $_POST array
            if (isset($_POST['action'])) {
                // Lấy giá trị của "action"
                $action = $_POST['action'];

                // Lấy dữ liệu từ form
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

                if ($action == 'Thêm Sinh Viên') {
                    // Insert dữ liệu vào bảng sinhvien
                    $sql = "INSERT INTO sinhvien (mssv, hotensinhvien, gioitinh, sdt, gmail, diachi, malop, truonghoc, nganh, khoa, nhomnguoihuongdan) VALUES ('$mssv', '$hotensinhvien', '$gioitinh', '$sdt', '$gmail', '$diachi', '$malop', '$truonghoc', '$nganh', '$khoa', '$nhomnguoihuongdan')";

                    if (mysqli_query($conn, $sql)) {
                        echo '<p class="success">Thêm sinh viên thành công!</p>';
                    } else {
                        echo '<p class="error">Lỗi: ' . $sql . '<br>' . mysqli_error($conn) . '</p>';
                    }
                }
            }
        }

        // Hiển thị danh sách sinh viên
        $result = mysqli_query($conn, "SELECT * FROM sinhvien");
        if ($result) {
            echo '<div class="student-list">';
            echo '<h3>Danh Sách Sinh Viên</h3>';
            echo '<table>';
            echo '<tr><th>MSSV</th><th>Họ Tên Sinh Viên</th><th>Giới Tính</th><th>Số Điện Thoại</th><th>Email</th><th>Địa Chỉ</th><th>Mã Lớp</th><th>Trường Học</th><th>Ngành</th><th>Khoa</th><th>Nhóm Người Hướng Dẫn</th></tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['mssv'] . '</td>';
                echo '<td>' . $row['hotensinhvien'] . '</td>';
                echo '<td>' . $row['gioitinh'] . '</td>';
                echo '<td>' . $row['sdt'] . '</td>';
                echo '<td>' . $row['gmail'] . '</td>';
                echo '<td>' . $row['diachi'] . '</td>';
                echo '<td>' . $row['malop'] . '</td>';
                echo '<td>' . $row['truonghoc'] . '</td>';
                echo '<td>' . $row['nganh'] . '</td>';
                echo '<td>' . $row['khoa'] . '</td>';
                echo '<td>' . $row['nhomnguoihuongdan'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
        }

        // Đóng kết nối
        mysqli_close($conn);
        ?>
    </div>

</body>

</html>
