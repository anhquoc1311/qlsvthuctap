<?php
$conn = mysqli_connect('localhost', 'root','', 'quanlysvtt');
if (mysqli_connect_error()) {
  die('Kết nối đến cơ sở dữ liệu thất bại: ' . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html>
<title>Danh sách đề tài</title>
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
  <div class="dropdown">
    
  </div>

<style>
    table{
            width:100%;
            text-align: left;
            color: black;
        }
        .thetd , .theth{
            font-size: 13px;
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
          width: 70px;
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
</style>
<!-- Page Content -->
<div style=" background-color: #fff" >
  <div class="w3-container">
    <h2><strong>Danh sách đề tài </strong> <small>- Danh sách đề tài của kỳ thực tập</small></h2>
    <div style="float: left; width: 40%; margin-top: 20px;">
      <div class="thebentrai">
        <h2 style="text-align: center; font-size: 20px;margin-top: 5px; font-weight:500">THÊM ĐỀ TÀI</h2>
        <form method="post">
          <div class="form-group1">
            <label style="font-size:14px;">Tên đề tài</label><br>
            <input required type="text" name="tendetai" class="form-control" autocomplete="off" style="font-size:15px;width: 100%" placeholder="Nhập vào tên đề tài" >
          </div><p></p>
          <div class="form-group1">
            <label style="font-size:14px">Mô tả</label><br>
            <textarea required name="mota" class="form-control" style="font-size:15px;width: 100%; height: 180px;"placeholder="Nhập vào mô tả đề tài"></textarea>
          </div><br>
          <div class="form-group1" style="display: flex; justify-content: center;">
            <button class="btn-success1">Thêm</button>
          </div>
        </form>
      </div>
      <?php
                if(!empty($_POST)){

                      $tendetai = $_POST['tendetai'];  
                      $mota = $_POST['mota'];   
                      $sql_check = "SELECT * FROM detai WHERE tendetai = '$tendetai'";
                      $result_check = mysqli_query($conn, $sql_check);
                      function showErrorDiv($message) {
                        echo '<div style="text-align:center;line-height: 
                        50px;font-size: 16px; margin-top: 5px;margin-left:0%; 
                        height: 50px ;color:white; width: 95%;border-radius: 6px; background-color:red"><i class="fa-solid fa-triangle-exclamation"></i> ' . $message . '</div>';
                      } 
                      if (mysqli_num_rows($result_check) > 0) {
                        showErrorDiv("Tên đề tài đã tồn tại!");    
                        }
                      else {
                        $sql = "insert into detai(tendetai,mota)values('$tendetai','$mota')";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                          echo '<div style="text-align: center; line-height: 50px; font-size: 16px; margin-top: 5px; margin-left: 0%; height: 50px; color: white;
                          width: 95%; border-radius: 6px; background-color: green"><i class="fa-solid fa-check"></i> Thêm đề tài thành công!</div>';
                        }
                      }
                  } 
              ?>
    </div>
    <div style="float: right; width: 60%; margin-top: 20px">
    <script>
        function Del(tendetai){
            return confirm("Bạn có chắc chắn muốn xóa " + tendetai + " ra khỏi danh sách?");
        }
    </script> 
      <div class="thebenphai">
            <table >
                <thead>
                    <tr>
                        <th class="theth" style="width: 50px; text-align: center" >STT</th>
                        <th class="theth" style="width: 300px;" ><center>Tên đề tài</center></th>
                        <th class="theth" style="width: 800px;" ><center>Mô tả</center></th>
                        <th class="theth" style="width: 50px;"> <center>Sửa</center></th>
                        <th class="theth" style="width: 50px;"> <center>Xóa</center></th>
                    </tr>
                </thead>
                <tbody>     
                    <?php
                    $sql = "SELECT * FROM `detai` ";
                    $qr = mysqli_query($conn, $sql);
                    $i = 0;
                    while ($rows = mysqli_fetch_array($qr)){
                    $i++;
                    ?>
                                <tr>
                                        <td class="thetd" style=" text-align: center"><?php echo $i; ?></td>
                                        
                                        <td class="thetd" style="padding: 5px 10px;"><?php echo $rows['tendetai']; ?></td>
                                        
                                        <td class="thetd" style="padding: 5px 20px"><?php echo $rows['mota']; ?></td>  
                                        
                                        <td style="padding: 5px 0px">
                                        <a href="editdetai.php?id=<?php echo $rows['id_detai']; ?>"><button class="btnedit" ><i class="fa-solid fa-pen-to-square"></i></button></a>
                                        </td>
                                        <td style="padding: 5px 0px">
                                        <a onclick="return Del('<?php echo $rows['tendetai']; ?>')" href="xoadetai.php?id=<?php echo $rows['id_detai']; ?>"><button class="btndel" ><i class="fa-solid fa-trash-can"></i></button>
                                        </td>                                    
                                </tr>     
                    <?php } ?>     
                </tbody>
            </table>
      </div>
    </div>
  </div>
  <div class="w3-footer"style="height:90px; background-color: white; margin-top: 70px; border-top: 1px solid black">
    <span class="text-sm text-blue" style="font-size:12px ; color: #0073B7">
      <p style="margin-left: 15px; font-weight:bold; margin-bottom: -5px">TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG</p>
      <p style="margin-left: 15px">Địa chỉ: 73 Nguyễn Huệ, phường 2, thành phố Vĩnh Long, tỉnh Vĩnh Long<br>
      Điện thoại: (+84) 02703.822141 - Fax: (+84) 02703.821003 - Email: spktvl@vlute.edu.vn</p>
    </span> 
  </div> 
</div>
</body>
</html>