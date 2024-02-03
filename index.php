<?php
session_start();

// Kiểm tra nếu biến session không tồn tại hoặc có giá trị không mong muốn
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

// Truy xuất thông tin từ session
$tenDangNhap = isset($_SESSION['dangnhap']) ? $_SESSION['dangnhap'] : '';
$quyen = isset($_SESSION['quyen']) ? $_SESSION['quyen'] : '';

// Kiểm tra nếu có hành động đăng xuất
if (isset($_GET['action']) && $_GET['action'] == 'dangxuat') {
    unset($_SESSION['dangnhap']);
    unset($_SESSION['quyen']);
    session_destroy(); // Xóa toàn bộ session
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <!-- Thêm liên kết đến thư viện FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
        }

        .navbar {
            background-color: darkblue;
            overflow: hidden;
        }

        .navbar a {
            float: right;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: darkslateblue;
        }

        .dropdown {
            float: right;
            overflow: hidden;
        }

        .dropdown .dropbtn {
            font-size: 16px;
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }

        .navbar a, .dropdown .dropbtn {
            display: inline;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: darkblue;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            float: none;
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: darkslateblue;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .w3-sidebar {
            width: 18%;
            font-size: 13px;
            background-color: #222d32;
            color: #b8c7ce;
            margin-top: 0;
            height: 100%;
            position: fixed;
            overflow: auto;
        }

        .w3-sidebar a {
            padding: 8px 8px 8px 16px;
            text-decoration: none;
            font-size: 15px;
            color: white;
            display: block;
        }

        .w3-sidebar a:hover {
            background-color: darkblue;
            color: white;
        }

        .content {
            margin-left: 18%;
            background-color: #fff;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .w3-footer {
            height: 90px;
            background-color: white;
            margin-top: 20px;
            border-top: 1px solid black;
        }

        .w3-footer p {
            margin-left: 290px;
            font-weight: bold;
            margin-bottom: -5px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="dropdown">
            <button class="dropbtn">Chào, <?php echo $tenDangNhap;  ?></button>
            <div class="dropdown-content">
                <a href="index.php?action=dangxuat"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
            </div>
        </div>
    </div>

    <div class="w3-sidebar">
        <a href="dashboard.php"><i class="fas fa-chart-bar"></i> DASHBOARD</a>
        <a href="timkiem.php"><i class="fas fa-list-alt"></i> tìm kiếm</a>
        <a href="themsv_php.php"><i class="fas fa-users"></i> Quản lý sinh viên</a>
        <a href="them_xoa_suanganh.php"><i class="fas fa-book"></i> Quản lý ngành thực tập</a>
        <a href="hem_xoa_sua_truong.php"><i class="fas fa-book"></i> Quản lý trường thực tập</a>
        <a href="themxoasua_nguoihd.php"><i class="fas fa-book"></i> Danh sách người hướng dẫn</a>
        <a href="quandetai.php"><i class="fas fa-book"></i> Quản lý đề tài thực tập</a>
        <a href="kythuctap.php"><i class="fas fa-calendar-alt"></i> Quản lý kỳ thực tập</a>
        <a href="themxoasuanhomtt.php"><i class="fas fa-users"></i> Quản lý Nhóm Thực Tập</a>
        <a href="#"><i class="fas fa-file"></i> Xuất file</a>
        <a href="themxoasuacv.php"><i class="fas fa-briefcase"></i> Công việc</a>
        <a href="nhomhd.php"><i class="fas fa-briefcase"></i> Quản lý nhóm hướng dẫn</a>
        <a href="themxoasuanhomtt.php"><i class="fas fa-briefcase"></i>Quản lý nhóm thực tập</a>
        <a href="danhgiasv.php"><i class="fas fa-list-alt"></i> Quản lý đánh giá sinh vien</a>
        <a href="danhsachandanh.php"><i class="fas fa-list-alt"></i> Quản lý đánh giá ẩn danh</a>
        <a href="hienthiandanh.php"><i class="fas fa-list-alt"></i> Danh sách đánh giá ẩn danh</a>
        <a href="suadgsv.php"><i class="fas fa-list-alt"></i> sửa đánh giá</a>
    </div>

    <div class="content">
        <h1>Trang chủ</h1>
        <?php
        $mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

        if ($mysqli->connect_error) {
            die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
        }

        function executeQuery($sql)
        {
            global $mysqli;
            $result = $mysqli->query($sql);
            return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        }

        $tables = ['congviec', 'danhgia', 'kythuctap', 'nganh', 'nguoihuongdan', 'nhomnguoihd', 'nhomtt', 'sinhvien', 'tendetai', 'truong'];

        foreach ($tables as $table) {
            $query = "SELECT * FROM $table";
            $data = executeQuery($query);

            echo "<h2>$table Table</h2>";
            if (!empty($data)) {
                echo '<table>';
                echo '<tr>';
                foreach ($data[0] as $key => $value) {
                    echo '<th>' . htmlspecialchars($key) . '</th>';
                }
                echo '</tr>';
                foreach ($data as $row) {
                    echo '<tr>';
                    foreach ($row as $value) {
                        echo '<td>' . htmlspecialchars($value) . '</td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo '<p>No data available.</p>';
            }
        }

        $mysqli->close();
        ?>
  </div>

    <div class="w3-footer">
        <span class="text-sm text-blue" style="font-size:12px ; color: #0073B7">
            <p>TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG</p>
            <p>Địa chỉ: 73 Nguyễn Huệ, phường 2, thành phố Vỉnh Long, tỉnh Vỉnh Long<br>
            Điện thoại: (+84) 02703.822141 - Fax: (+84) 02703.821003 - Email: spktvl@vlute.edu.vn</p>
        </span>
    </div>
    <script>
        /* When the user clicks on the button, toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>

</html>
