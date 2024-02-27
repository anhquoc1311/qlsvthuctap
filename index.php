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

        .dropdown {
            float: right;
            position: relative;
            display: inline-block;
            background-color: darkblue;
            width: 100%;
            }

            .dropbtn {
  background-color: darkblue;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  float: right;
  height: 50px;
  padding-right: 30px;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: blue;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: darkblue;
  min-width: 260px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  margin-top: 1px;
  right: 0;
  z-index: 1;
  top: 100%;
}

.dropdown-content a {
  color: white;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: blue;}

.show {display: block;}
img{
  width: 20px;
  line-height: 50px;
}

        .w3-sidebar {
            width: 17%;
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
            margin-left: 17%;
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
        <div class="dropdown">
            <button class="dropbtn">Chào, <?php echo $tenDangNhap;  ?></button>
            <div class="dropdown-content">
                <a href="index.php?action=dangxuat"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
            </div>
        </div>

    <div class="w3-sidebar">
        <a href="dashboard.php"><i class="fas fa-chart-bar"></i> DASHBOARD</a>
        <a href="timkiem.php"><i class="fas fa-list-alt"></i> Tìm kiếm</a>
        <a href="themsv_php.php"><i class="fas fa-users"></i> Danh sách sinh viên</a>
        <a href="themnganh.php"><i class="fas fa-book"></i> Quản lý thực tập ngành</a>
        <a href="themth.php"><i class="fas fa-book"></i> Quản lý thực tập trường</a>
        <a href="themxoasua_nguoihd.php"><i class="fas fa-book"></i> Quản lý người hướng dẫn</a>
        <a href="danhsachdetai.php"><i class="fas fa-book"></i> Quản lý đề tài</a>
        <a href="kythuctap.php"><i class="fas fa-calendar-alt"></i> Quản lý kỳ thực tập</a>
        <a href="themxoasuacv.php"><i class="fas fa-briefcase"></i> Quản lý công việc</a>
        <a href="nhomhd.php"><i class="fas fa-briefcase"></i> Quản lý nhóm hướng dẫn</a>
        <a href="themxoasuanhomtt.php"><i class="fas fa-briefcase"></i> Quản lý nhóm thực tập</a>
        <a href="danhgiasv.php"><i class="fas fa-list-alt"></i> Quản lý đánh giá sinh vien</a>
        <a href="danhsachandanh.php"><i class="fas fa-list-alt"></i> Quản lý đánh giá ẩn danh</a>
        <a href="hienthiandanh.php"><i class="fas fa-list-alt"></i> Danh sách đánh giá ẩn danh</a>
        <a href="suadgsv.php"><i class="fas fa-list-alt"></i> Sửa đánh giá</a>
    </div>

    <div class="content">
    <h2><strong>Trang chủ</strong> <small>- Tổng quan về website quản lý sinh viên thực tập</small></h2>
    <div class="sidebar" style="margin-top: 20px">
    <a href="danhgiasv.php" class="box"style="text-decoration: none; background-color: blue">
      <div class="left">
      <span style="font-size: 40px;">
      </span>
        <p>Quản Lý Đánh Giá Sinh Viên</p>
      </div>
      <i class="fa-regular fa-calendar-days"></i>
    </a>
    <a href="kythuctap.php" class="box"style="text-decoration: none; background-color: midnightblue">
      <div class="left">
      <span style="font-size: 40px;">
      </span>
        <p>Quản Lý Kỳ Thực Tập</p>
      </div>
      <i class="fa-regular fa-calendar-days"></i>
    </a>
    <a href="themxoasuacv.php" class="box"style="text-decoration: none; background-color: #605ca8">
      <div class="left">
      <span style="font-size: 40px;">
      </span>
        <p>Quản Lý Công Việc</p>
      </div>
      <i class="fa-solid fa-building"></i>
    </a>
    <a href="themxoasuanhomtt.php" class="box"style="text-decoration: none; background-color: #0073b7">
      <div class="left">
      <span style="font-size: 40px;">
      </span>
        <p>Quản Lý Nhóm Thực Tập</p>
      </div>
      <i class="fa-solid fa-door-open"></i>
    </a>
    <a href="themxoasua_nguoihd.php" class="box"style="text-decoration: none; background-color: #228B22">
      <div class="left">
      <span style="font-size: 40px;">
      </span>
        <p>Quản Lý Người Hướng Dẫn</p>
      </div>
      <i class="fa-solid fa-user-tie"></i> 
    </a>
    <a href="themsv_php.php" class="box"style="text-decoration: none; background-color: #00a65a">
      <div class="left">
      <span style="font-size: 40px;">
      </span>
        <p>Quản Lý Sinh Viên</p>
      </div>
      <i class="fa-regular fa-user"></i>
    </a>
    <a href="danhsachdetai.php" class="box"style="text-decoration: none; background-color: chocolate">
      <div class="left">
      <span style="font-size: 40px;">
      </span>
        <p>Quản Lý Đề Tài</p>
      </div>
      <i class="fa-solid fa-book"></i>
    </a>
    <a href="hienthiandanh.php" class="box"style="text-decoration: none; background-color: coral">
      <div class="left">
      <span style="font-size: 40px;">
      </span>
        <p>Danh Sách Đánh Giá Ẩn Danh</p>
      </div>
      <i class="fa-solid fa-chalkboard-user"></i>
    </a>
    </div>
    <style>
      span{
        font-weight: bold;
      }
      h2{
        margin-bottom: 50px;
        margin-top: 20px;
      }
      .sidebar {
        display: flex;
        flex-wrap: wrap;
      }
      .box {
        width: 30%;
        height: 150px;
        background: #eee;
        margin: 20px;
        opacity: 0.8;
        text-align: center;
        color: white;
        border-radius: 20px;
        display: flex;
        align-items: center;
      }
      .left {
        width: 50%; 
      }
      .left p{
        font-size: 15px;
        text-align: center;
        padding-left: 10px;
      }
      .box:hover{
        opacity: 1;
      }
      .box i {
        width: 50%;
        text-align: center;
        font-size: 70px;
      }
      .box i {
        transition: font-size 0.4s;
      }

      .box:hover i {
        font-size: 80px;
      }
</style>
  <div class="w3-footer"style="height:90px; background-color: white; margin-top: 40px; border-top: 1px solid black">
    <span class="text-sm text-blue" style="font-size:12px ; color: #0073B7">
      <p style="margin-left: 0px; font-weight:bold; margin-bottom: -5px">TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG</p>
      <p style="margin-left: 0px">Địa chỉ: 73 Nguyễn Huệ, phường 2, thành phố Vĩnh Long, tỉnh Vĩnh Long<br>
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


      

 