<?php
// Kết nối đến cơ sở dữ liệu
include('config/connect.php');

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <title>Đánh Giá</title>
<style>
     body {
    background-color: #f0f7f9;
    color: #333;
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
}

form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #2072b3;
    font-size: 30px;
    font-weight: bold;
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
    color: #2072b3;
}

input[type="text"],
input[type="password"],
input[type="email"],
select {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 5px;
    text-align: center;
}

button[type="submit"] {
    background-color: #2072b3;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #3498db;
}

textarea {
    width: 100%;
    height: 150px;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    resize: none; /* Không cho phép resize textarea */
}

    </style>
</head>
<body>
<div class="home">
    <a href="index.php"> < Home</a>
</div>
<h2>ĐÁNH GIÁ ẨN DANH</h2>
<div class="form">
<form action="xulydanhgia.php" method="post">
    <label for="hoten">Họ và Tên Người hướng dẫn:</label>
    <select id="hoten" name="hoten" required>
        <?php
        // Query to fetch distinct values for 'tennhomnguoihuongdan' from your database
        $nhomQuery = "SELECT DISTINCT ten FROM nguoihuongdan";
        $nhomResult = $mysqli->query($nhomQuery);

        // Check if the query was successful
        if ($nhomResult) {
            while ($row = $nhomResult->fetch_assoc()) {
                $selected = ($row['ten'] == $editData['ten']) ? 'selected' : '';
                echo "<option value='{$row['ten']}' $selected>{$row['ten']}</option>";
            }
        }
        ?>
</select><br>
    
    <label for="mucdo">Mức Độ Hài Lòng :</label>
    <div class="rating">
    <div class="rating">
    <?php
    // Dùng Unicode để hiển thị ngôi sao
    $star_icon = "★"; // Mã Unicode của ngôi sao

    for ($i = 1; $i <= 5; $i++) {
        echo "<label class='rating-item'>";
        echo "<input type='radio' name='mucdo' value='$i' required>";
        echo "$i $star_icon"; // Hiển thị số lượng ngôi sao tương ứng
        echo "</label>";
    }
    ?>
</div><br>






    <label for="nhanxet">Nhận Xét:</label>
    <select id="nhanxet" name="nhanxet" required>
        <option value="Rất hài lòng">Rất hài lòng</option>
        <option value="Hài lòng">Hài lòng</option>
        <option value="Không hài lòng">Không hài lòng</option>
    </select><br>

    <label for="danhgiakhac">Đánh Giá Khác:</label>
    <textarea id="danhgiakhac" name="danhgiakhac" required></textarea><br>

    <button type="submit"> Thêm đánh giá</button>
</form>

</div>
</body>
<div class="w3-footer"><hr>
        <span class="text-sm text-blue" style="font-size:12px ; color: #0073B7">
            <p>TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG</p>
            <p>Địa chỉ: 73 Nguyễn Huệ, phường 2, thành phố Vỉnh Long, tỉnh Vỉnh Long<br>
            Điện thoại: (+84) 02703.822141 - Fax: (+84) 02703.821003 - Email: spktvl@vlute.edu.vn</p>
        </span>
    </div>
</html>