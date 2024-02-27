<?php
// Assuming you have already established a connection to the database using mysqli_connect.
$conn = mysqli_connect('localhost', 'root', '', 'quanlysvtt');
if (mysqli_connect_error()) {
    die('Kết nối đến cơ sở dữ liệu thất bại: ' . mysqli_connect_error());
}

$id = $_GET['id'];
$loi1 = "";

$sql = "SELECT * FROM truong WHERE truonghoc='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$truonghoccu = $row["truonghoc"];

if (isset($_POST['submit'])) {
    $truonghoc = $_POST['truonghoc'];
    $kyhieutruong = $_POST['kyhieutruong'];

    if ($truonghoc != $truonghoccu) {
        $sql_check = "SELECT * FROM truong WHERE truonghoc = '$truonghoc'";
        $result_check = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result_check) > 0) {
            $loi1 = 'Tên đề tài đã tồn tại!';
        }
    }

    if (empty($loi1)) {
        $sql = "UPDATE truong SET truonghoc ='$truonghoc', kyhieutruong='$kyhieutruong' WHERE truonghoc='$id'";
        $result = mysqli_query($conn, $sql);
        $successNotification = "Cập nhật thông tin trường thành công.";
           echo "<script>
            setTimeout(function() {
                window.location.href = 'themth.php';
            }, 2000); // 2000 milliseconds = 2 seconds
         </script>";
    }
}

?>
<!DOCTYPE html>
<html>
<title>Danh sách trường học</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
<body>

<!-- Sidebar -->
<style>

.dropdown {
  float: right;
  position: relative;
  display: inline-block;
  background-color: blue;
  width: 100%;
  height: 60px;
}

</style>


<style>
    table{
            width:100%;
            text-align: left;
            color: black;
        }
        .thetd , .theth{
            font-size: 13px;
            text-align: center;
        }
        .w3-container{
            height: 525px;
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
          width: 100px;
          height: 35px;
          opacity: 0.7;
        }
        .btn-success1:hover{
          opacity: 1;
        }
        .thebenphai{
          border: 1px solid black;
          margin-left: 0%;
          padding: 10px 10px;
          border-radius: 6px;
          width: 100%;
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
        .btnquayve{
          border: 1px solid black;
          margin-bottom: 10px;
          text-align: center;
          cursor: pointer;
          font-size: 15px;
          background-color: grey;
          border-radius: 6PX;
          color: white;
          width: 100px;
          height: 35px;
          opacity: 0.7;
        }
        .btnquayve:hover{
          opacity: 1;
        }
        .w3-footer {
            margin-top: 525px;
        }
        body {
            background-color: #f0f7f9;
            color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            margin-left: 30px;
            margin-top: 74px;
        }
</style>
<!-- Page Content -->


    <h2 style="text-align:center; font-weight: bold;
          text-align: center;
          color: blue;
          font-size: 30px; 
          text-shadow: 10px 2px 4px rgba(0, 0, 0, 0.5);">
          <strong>Danh sách trường học </strong></h2>
    <div style="float: left; width: 40%; margin-top: 20px;">
      <div class="thebentrai">
        <h2 style="text-align: center; font-size: 20px;margin-top: 5px; font-weight:500">Sửa thông tin trường</h2>
        <form method="post">
          <div class="form-group1">
            <label style="font-size:14px;">Tên trường học</label><br>
            <input required type="text" name="truonghoc" class="form-control" autocomplete="off" style="font-size:15px;width: 100%" value="<?php echo $row['truonghoc']; ?>">
          </div><p></p>
          <div class="form-group1">
            <label style="font-size:14px">Ký hiệu trường</label><br>
             <input required type="text" name="kyhieutruong" class="form-control" autocomplete="off" style="font-size:15px;width: 100%" value="<?php echo $row['kyhieutruong']; ?>">
          </div><br>
          <div class="form-group1">
          <center><button class="btn-success1" name="submit" >Cập nhật</button>
                    <a href="themth.php"><button type="button" class="btnquayve">Quay Về </button></a></center>
                </div>
        </form>
        <?php if (!empty($successNotification)): ?>
                <div id="successNotification" style="color: green; text-align: center;"><?php echo $successNotification; ?></div>
        <?php endif; ?>
      </div>
    </div>
    <div style="float: right; width: 60%; margin-top: 20px">
    <script>
        function Del(truonghoc){
            
            return confirm("Bạn có chắc chắn muốn xóa " +  truonghoc + " ra khỏi danh sách?");
        }
    </script> 
      <div class="thebenphai">
            <table >
                <thead>
                    <tr>
                        <th class="theth" style="width: 50px; text-align: center" >STT</th>
                        <th class="theth" style="width: 300px;" ><center>Tên trường học</center></th>
                        <th class="theth" style="width: 800px;" ><center>ký hiệu trường</center></th>
                        <th class="theth" style="width: 50px;"> <center>Sửa</center></th>
                        <th class="theth" style="width: 50px;"> <center>Xóa</center></th>
                    </tr>
                </thead>
                <tbody>     
                    <?php
                    $sql = "SELECT * FROM `truong` ";
                    $qr = mysqli_query($conn, $sql);
                    $i = 0;
                    while ($rows = mysqli_fetch_array($qr)){
                    $i++;
                    ?>
                                <tr>
                                        <td class="thetd" style=" text-align: center"><?php echo $i; ?></td>
                                        
                                        <td class="thetd" style="padding: 5px 10px;"><?php echo $rows['truonghoc']; ?></td>
                                        
                                        <td class="thetd" style="padding: 5px 20px"><?php echo $rows['kyhieutruong']; ?></td>  
                                        
                                        <td style="padding: 5px 0px">
                                        <a href="suath.php?id=<?php echo $rows['truonghoc']; ?>"><button class="btnedit" ><i class="fa-solid fa-pen-to-square"></i></button></a>
                                        </td>
                                        <td style="padding: 5px 0px">
                                        <a onclick="return Del('<?php echo $rows['truonghoc']; ?>')" href="xoath.php?id=<?php echo $rows['truonghoc']; ?>"><button class="btndel" ><i class="fa-solid fa-trash-can"></i></button>
                                        </td>                                    
                                </tr>     
                    <?php } ?>     
                </tbody>
            </table>
      </div>
    </div>

   <div class="w3-footer"><hr>
        <span class="text-sm text-blue" style="font-size:12px ; color: #0073B7">
            <p>TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG</p>
            <p>Địa chỉ: 73 Nguyễn Huệ, phường 2, thành phố Vỉnh Long, tỉnh Vỉnh Long<br>
            Điện thoại: (+84) 02703.822141 - Fax: (+84) 02703.821003 - Email: spktvl@vlute.edu.vn</p>
        </span>
    </div>

</body>
</html>