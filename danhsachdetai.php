<?php
// Database Connection
$conn = mysqli_connect('localhost', 'root', '', 'quanlysvtt');

if (mysqli_connect_error()) {
    die('Kết nối đến cơ sở dữ liệu thất bại: ' . mysqli_connect_error());
}

// Handle Form Submission
if (!empty($_POST)) {
    $tendetai = mysqli_real_escape_string($conn, $_POST['tendetai']);
    $mota = mysqli_real_escape_string($conn, $_POST['mota']);

    $sql_check = "SELECT * FROM tendetai WHERE tendetai = '$tendetai'";
    $result_check = mysqli_query($conn, $sql_check);

    function showErrorDiv($message) {
        echo '<div style="text-align:center;line-height: 50px;font-size: 16px; margin-top: 5px;margin-left:0%; 
                        height: 50px ;color:white; width: 95%;border-radius: 6px; background-color:red">
                        <i class="fa-solid fa-triangle-exclamation"></i> ' . $message . '</div>';
    }

    if (mysqli_num_rows($result_check) > 0) {
        showErrorDiv("Tên đề tài đã tồn tại!");
    } else {
        $sql_insert = "INSERT INTO tendetai (tendetai, mota) VALUES ('$tendetai', '$mota')";
        $result_insert = mysqli_query($conn, $sql_insert);

        if ($result_insert) {
            echo '<div style="text-align: center; line-height: 50px; font-size: 16px; margin-top: 5px; margin-left: 0%; height: 50px; color: white;
                          width: 95%; border-radius: 6px; background-color: green">
                          <i class="fa-solid fa-check"></i> Thêm đề tài thành công!</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- ... (head section with meta tags and stylesheets) -->
</head>

<body>

<!-- Sidebar and other styles... -->

<div style=" background-color: #fff">
    <div class="w3-container">
        <!-- ... (existing HTML code) -->

        <!-- Thêm Đề Tài Section -->
        <div style="float: left; width: 40%; margin-top: 20px;">
            <div class="thebentrai">
                <h2 style="text-align: center; font-size: 20px;margin-top: 5px; font-weight:500">THÊM ĐỀ TÀI</h2>
                <form method="post">
                    <div class="form-group1">
                        <label style="font-size:14px;">Tên đề tài</label><br>
                        <input required type="text" name="tendetai" class="form-control" autocomplete="off"
                               style="font-size:15px;width: 100%" placeholder="Nhập vào tên đề tài">
                    </div>
                    <p></p>
                    <div class="form-group1">
                        <label style="font-size:14px">Mô tả</label><br>
                        <textarea required name="mota" class="form-control" style="font-size:15px;width: 100%; height: 180px;"
                                  placeholder="Nhập vào mô tả đề tài"></textarea>
                    </div><br>
                    <div class="form-group1" style="display: flex; justify-content: center;">
                        <button class="btn-success1">Thêm</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Danh Sách Đề Tài Section -->
        <div style="float: right; width: 60%; margin-top: 20px">
            <script>
                function Del(tendetai) {
                    return confirm("Bạn có chắc chắn muốn xóa " + tendetai + " ra khỏi danh sách?");
                }
            </script>
            <div class="thebenphai">
                <table>
                    <thead>
                    <tr>
                        <th class="theth" style="width: 50px; text-align: center">STT</th>
                        <th class="theth" style="width: 300px;"><center>Tên đề tài</center></th>
                        <th class="theth" style="width: 800px;"><center>Mô tả</center></th>
                        <th class="theth" style="width: 50px;"> <center>Sửa</center></th>
                        <th class="theth" style="width: 50px;"> <center>Xóa</center></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM `tendetai` ";
                    $qr = mysqli_query($conn, $sql);
                    $i = 0;
                    while ($rows = mysqli_fetch_array($qr)) {
                        $i++;
                        ?>
                        <tr>
                            <td class="thetd" style=" text-align: center"><?php echo $i; ?></td>

                            <td class="thetd" style="padding: 5px 10px;"><?php echo $rows['tendetai']; ?></td>

                            <td class="thetd" style="padding: 5px 20px"><?php echo $rows['mota']; ?></td>
                            
                            <td style="padding: 5px 0px">
                                <a href="editdetai.php?id=<?php echo $rows['id_detai']; ?>"><button
                                            class="btnedit"><i class="fa-solid fa-pen-to-square"></i></button></a>
                            </td>
                            <td style="padding: 5px 0px">
                                <a onclick="return Del('<?php echo $rows['tendetai']; ?>')"
                                   href="xoadetai.php?id=<?php echo $rows['id_detai']; ?>"><button
                                            class="btndel"><i class="fa-solid fa-trash-can"></i></button>
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