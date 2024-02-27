<?php
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

// Check connection
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoten = $_POST["hoten"];
    $mucdo = $_POST["mucdo"];
    $nhanxet = $_POST["nhanxet"];
    $danhgiakhac = $_POST["danhgiakhac"];

    // Chèn dữ liệu vào cơ sở dữ liệu
    $sql = "INSERT INTO danhgiaandanh (hoten_nguoidanhgia, mucdohailong, `nhanxet`, danhgiakhac)
            VALUES ('$hoten', '$mucdo', '$nhanxet', '$danhgiakhac')";

    if ($mysqli->query($sql) === TRUE) {
        echo "<div class='camon'>";
        echo "<p>Cảm ơn bạn đã góp phần đánh giá!</p>";
        echo "</div>";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'danhsachandanh.php'; // Thay đổi đường dẫn tương ứng
                }, 5000);
             </script>";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cảm ơn</title>
</head>
<body>
    <style>
      body {
        background-color: #f0f7f9; /* Màu nền xanh dương */
        color: #333; /* Màu chữ trắng */
        font-family: Arial, sans-serif; /* Kiểu font chữ */
        margin: 0;
        padding: 0;
    }
    .camon {
        text-align: center;
        margin-top: 150px;
        font-size: 40px;
        color: #3308CF;
    }
    </style>    

</body>
    <div class="w3-footer"><hr>
        <span class="text-sm text-blue" style="font-size:12px ; color: #0073B7">
            <p>TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG</p>
            <p>Địa chỉ: 73 Nguyễn Huệ, phường 2, thành phố Vỉnh Long, tỉnh Vỉnh Long<br>
            Điện thoại: (+84) 02703.822141 - Fax: (+84) 02703.821003 - Email: spktvl@vlute.edu.vn</p>
        </span>
    </div>
</html>