<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Đánh Giá</title>
</head>
<body>

<?php
$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

// Check connection
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Truy vấn cơ sở dữ liệu để lấy danh sách đánh giá
$sql = "SELECT * FROM danhgiaandanh";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Hiển thị dữ liệu
    echo "<h2>Danh Sách Đánh Giá</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Họ và Tên</th><th>Mức Độ Hài Lòng</th><th>Nhận Xét</th><th>Đánh Giá Khác</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["id_danhgia"]."</td>";
        echo "<td>".$row["hoten_nguoidanhgia"]."</td>";
        echo "<td>".$row["mucdohailong"]."</td>";
        echo "<td>".$row["nhận xet"]."</td>";
        echo "<td>".$row["danhgiakhac"]."</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Không có đánh giá nào.";
}

$mysqli->close();
?>

</body>
</html>
