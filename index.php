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
</head>
<body>
<style>
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
  background-color: darkslateblue;
}

.dropdown {
  float: right;
  position: relative;
  display: inline-block;
  background-color: darkblue;
  width: 100%;
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

.dropdown a:hover {background-color: darkslateblue;}

.show {display: block;}
img{
  width: 20px;
  line-height: 50px;
}
</style>
  <div class="dropdown">
    <button onclick="myFunction()" class="dropbtn"> Chào, <?php echo $tenDangNhap;  ?></button>
    <div id="myDropdown" class="dropdown-content">
      <a href="index.php?action=dangxuat"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
    </div>
  </div>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
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
<div class="w3-sidebar  w3-bar-block" style="width:18%; font-size: 13px; background-color: #222d32; color: #b8c7ce; margin-top: 0px">
        <a href="#" class="w3-bar-item w3-button"><i class="fas fa-chart-bar"></i> DASHBOARD</a>
        <a href="themsv_php.php" class="w3-bar-item w3-button"><i class="fas fa-users"></i> Quản lý sinh viên</a>
        <a href="them_xoa_suanganh.php" class="w3-bar-item w3-button"><i class="fas fa-book"></i> Quản lý ngành thực tập</a>
        <a href="hem_xoa_sua_truong.php" class="w3-bar-item w3-button"><i class="fas fa-book"></i> Quản lý trường thực tập</a>
        <a href="themxoasua_nguoihd.php" class="w3-bar-item w3-button"><i class="fas fa-book"></i> Danh sách người hướng dẫn</a>
        <a href="quandetai.php" class="w3-bar-item w3-button"><i class="fas fa-book"></i> Quản lý đề tài thực tập</a>
        <a href="kythuctap.php" class="w3-bar-item w3-button"><i class="fas fa-calendar-alt"></i> Quản lý kỳ thực tập</a>
        <a href="themxoasuanhomtt.php" class="w3-bar-item w3-button"><i class="fas fa-users"></i> Quản lý Nhóm Thực Tập</a>
        <a href="#" class="w3-bar-item w3-button"><i class="fas fa-file"></i> Xuất file</a>
        <a href="themxoasuacv.php" class="w3-bar-item w3-button"><i class="fas fa-briefcase"></i> Công việc</a>
        <a href="nhomhd.php" class="w3-bar-item w3-button"><i class="fas fa-briefcase"></i> Quản lý nhóm hướng dẫn</a>
        <a href="themxoasuanhomtt.php" class="w3-bar-item w3-button"><i class="fas fa-briefcase"></i>Quản lý nhóm thực tập</a>
        <a href="danhgiasv.php" class="w3-bar-item w3-button"><i class="fas fa-list-alt"></i> Quản lý đánh giá sinh vien</a>
        <a href="danhsachandanh.php" class="w3-bar-item w3-button"><i class="fas fa-list-alt"></i> Quản lý đánh giá ẩn danh</a>
        <a href="hienthiandanh.php" class="w3-bar-item w3-button"><i class="fas fa-list-alt"></i> Danh sách đánh giá ẩn danh</a>
        <a href="timkiem.php" class="w3-bar-item w3-button"><i class="fas fa-list-alt"></i> tìm kiếm</a>
        <a href="hiemthidanhgia.php" class="w3-bar-item w3-button"><i class="fas fa-list-alt"></i> sửa đánh giá</a>
</div>
<div style="margin-left:18%; background-color: #fff" >
  <div class="w3-container">
    <h2><strong>Trang chủ</strong> <small>- Tổng quan về website quản lý sinh viên thực tập</small></h2>
    <style>
      h2{
        margin-bottom: 50px;
        margin-top: 20px;
      }
    </style>
  </div>
  <div class="w3-footer"style="height:90px; background-color: white; margin-top: 400px; border-top: 1px solid black">
    <span class="text-sm text-blue" style="font-size:12px ; color: #0073B7">
      <p style="margin-left: 15px; font-weight:bold; margin-bottom: -5px">TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG</p>
      <p style="margin-left: 15px">Địa chỉ: 73 Nguyễn Huệ, phường 2, thành phố Vĩnh Long, tỉnh Vĩnh Long<br>
      Điện thoại: (+84) 02703.822141 - Fax: (+84) 02703.821003 - Email: spktvl@vlute.edu.vn</p>
    </span> 
  </div> 
</div>
</body>
</html>
