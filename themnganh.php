<?php
// Kết nối đến cơ sở dữ liệu
include('config/connect.php');

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Khởi tạo biến thông báo
$notification = "";
$successNotification = "";
// Xử lý khi form được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Thêm trường học
    if (isset($_POST['add'])) {
        $tennganh = $_POST['tennganh'];
        $kyhieu = $_POST['kyhieu'];

        // Kiểm tra xem trường đã tồn tại chưa
        $checkQuery = "SELECT * FROM nganh WHERE tennganh = '$tennganh'";
        $result = $mysqli->query($checkQuery);

        if ($result->num_rows > 0) {
            // Trường đã tồn tại, hiển thị thông báo
            $successNotification = "<span style='color: red;'>Ngành đã tồn tại!" . $mysqli->error . "</span>";
        } else {
            // Thực hiện truy vấn thêm trường học
            $query = "INSERT INTO nganh (tennganh, kyhieu) VALUES ('$tennganh', '$kyhieu')";

            if ($mysqli->query($query)) {
                $successNotification = "Thêm ngành thành công.";
            } else {
                $successNotification = "Thêm ngành thất bại: " . $mysqli->error;
            }
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
    <title>Quản lý Trường học</title>
</head>
<style>
     table{
            width:100%;
            text-align: left;
            color: black;
        }
        .w3-footer {
          margin-top: 355px;
        }
        .thetd , .theth{
            font-size: 13px;
            text-align: center;
        }
        html {
            background-color: #f0f7f9;
            color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            margin-left: 30px;
        }
        label {
            font-weight: bold;
        }
        .thebentrai{
          border: 1px solid black;
          margin-left: 0%;
          padding: 5px 10px;
          border-radius: 6px;
          width: 95%;
          background-color: #F5f5f5;
          height: 400px;
        }
        
        }
        .thebentrai .form-group1 .form-control{
          margin-right: 100px;
        }
        .btn-success1{
          border: 1px solid black;
          margin-bottom: 10px;
          text-align: center;
          cursor: pointer;
          font-size: 15px;
          background-color: green;
          border-radius: 6PX;
          color: white;
          width: 75px;
          height: 35px;
          opacity: 0.7;
        }
        .btn-success1:hover{
          opacity: 1;
        }
        .thebenphai{
          border: 1px solid black;
          
          margin-left: 820px;
          margin-top: -400px;
          width: 100%;
          padding: 10px 10px;
          border-radius: 6px;
          
          background-color: #f5f5f5;
          overflow-y: auto; /* Tạo thanh cuộn dọc khi nội dung vượt quá chiều cao */
          max-height: 400px;
        }
        .btnedit{
          background-color: #337ab7;
          border: 1px solid black;
          cursor: pointer;
          font-size: 21px;
          border-radius: 3PX;
          opacity: 0.7;
          width: 45px;
        }
        .btndel {
          background-color: red;
          border: 1px solid black;
          cursor: pointer;
          font-size: 21px;
          border-radius: 3PX;
          opacity: 0.7;
          width: 45px;
        }
        .btndel:hover ,.btnedit:hover{
          opacity: 1;
        }
        h3 {
          font-weight: bold;
          text-align: center;
          color: blue;
          font-size: 30px;
        }
        .home {
            background: #04AA6D;
            width: 89px;
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
    <h3>Quản lý ngành học</h3>
    
    <!-- Form Thêm Trường học -->
 
    <div style="float: left; width: 40%; margin-top: 20px;">
      <div class="thebentrai">
        <h2 style="text-align: center; font-size: 20px;margin-top: 5px; font-weight:500">THÊM NGÀNH HỌC</h2>
        <form method="post">
          <div class="form-group1">
            <label style="font-size:14px;">Tên ngành</label><br>
            <input required type="text" name="tennganh" class="form-control" autocomplete="off" style="font-size:15px;width: 100%" placeholder="Nhập vào tên ngành" >
          </div><p></p>
          <div class="form-group1">
            <label style="font-size:14px">Ký hiệu ngành</label><br>
            <input required name="kyhieu" class="form-control"autocomplete="off" style="font-size:15px;width: 100%" placeholder="Nhập vào ký hiệu ngành"></input>
          </div><br>
          <div class="form-group1" style="display: flex; justify-content: center;">
            <button class="btn-success1" name="add">Thêm</button>
          </div>
        </form>

         <?php if (!empty($successNotification)): ?>
            <div id="successNotification" style="color: green;text-align:center;"><?php echo $successNotification; ?></div>
        <?php endif; ?>
      </div>

    <script>
        function Del(tennganh){
            return confirm("Bạn có chắc chắn muốn xóa " + tennganh + " ra khỏi danh sách?");
        }
    </script> 
    <!-- Bảng Danh sách Trường học -->
          <div class="thebenphai">
            <table >
                <thead>
                    <tr>
                        <th class="theth" style="width: 50px; text-align: center" >STT</th>
                        <th class="theth" style="width: 300px;" ><center>Tên ngành</center></th>
                        <th class="theth" style="width: 300px;" ><center>Ký hiệu ngành</center></th>
                        <th class="theth" style="width: 50px;"> <center>Sửa</center></th>
                        <th class="theth" style="width: 50px;"> <center>Xóa</center></th>
                    </tr>
                </thead>
                <tbody>     
                    <?php
                    $sql = "SELECT * FROM `nganh` ";
                    $i = 0;     
                    $qr = $mysqli->query($sql);
                    while ($rows = mysqli_fetch_array($qr)){
                    $i++;
                    ?>
                                <tr>
                                        <td class="thetd" style=" text-align: center"><?php echo $i; ?></td>
                                        
                                        <td class="thetd" style="padding: 5px 10px;"><?php echo $rows['tennganh']; ?></td>
                                        
                                        <td class="thetd" style="padding: 5px 20px"><?php echo $rows['kyhieu']; ?></td>  
                                        
                                        <td style="padding: 5px 0px">
                                          <a href="suanganh.php?id=<?php echo $rows['tennganh']; ?>">
                                            <button class="btnedit"><i class="fa-solid fa-pen-to-square"></i></button>
                                          </a>
                                        </td>
                                        
                                        <td style="padding: 5px 0px">
                                          <a onclick="return Del('<?php echo $rows['tennganh']; ?>')" href="xoanganh.php?id=<?php echo $rows['tennganh']; ?>">
                                            <button class="btndel"><i class="fa-solid fa-trash-can"></i></button>
                                          </a>
                                        </td>
                                </tr>     
                    <?php } ?>     
                </tbody>
            </table>
      </div>
     <script>
        // Tự động đóng thông báo sau 3 giây
        setTimeout(function() {
            var successNotification = document.getElementById('successNotification');
            if (successNotification) {
                successNotification.style.display = 'none';
            }
        }, 3000);
    </script>
    <!-- Đóng kết nối -->
    <?php
    $mysqli->close();
    ?>
    <div class="w3-footer"><hr>
        <span class="text-sm text-blue" style="font-size:12px ; color: #0073B7">
            <p>TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG</p>
            <p>Địa chỉ: 73 Nguyễn Huệ, phường 2, thành phố Vỉnh Long, tỉnh Vỉnh Long<br>
            Điện thoại: (+84) 02703.822141 - Fax: (+84) 02703.821003 - Email: spktvl@vlute.edu.vn</p>
        </span>
    </div>
</body>
</html>
