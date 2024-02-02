<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Đánh Giá</title>
    <style>
    body {
        background-color: #3498db; /* Màu nền xanh dương */
        color: #ffffff; /* Màu chữ trắng */
        font-family: Arial, sans-serif; /* Kiểu font chữ */
        margin: 0;
        padding: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table, th, td {
        border: 1px solid #ffffff; /* Màu đường biên trắng */
    }

    th, td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #2072b3; /* Màu nền xanh dương đậm cho phần header */
    }

    tr:nth-child(even) {
        background-color: #3498db; /* Màu nền xanh dương cho các hàng chẵn */
    }

    tr:nth-child(odd) {
        background-color: #2072b3; /* Màu nền xanh dương đậm cho các hàng lẻ */
    }

    a {
        color: #ffffff; /* Màu chữ trắng cho các liên kết */
    }

    a:hover {
        color: #ffcc00; /* Màu chữ khi di chuột qua liên kết */
    }

    form {
        margin-top: 20px;
    }

    h2 {
        color: #ffffff; /* Màu chữ trắng cho tiêu đề h2 */
    }

    input[type="text"], select {
        width: 10%;
        padding: 8px;
        margin: 5px 0;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #2072b3; /* Màu nền xanh dương đậm cho nút submit */
        color: #ffffff; /* Màu chữ trắng cho nút submit */
        padding: 10px;
        border: none;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #3498db; /* Màu nền xanh dương khi di chuột qua nút submit */
    }
</style>
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
