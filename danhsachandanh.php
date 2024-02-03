<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đánh Giá</title>
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

<form action="xulydanhgia.php" method="post">
    <label for="hoten">Họ và Tên Người hướng dẫn:</label>
    <input type="text" id="hoten" name="hoten" required><br>

    <label for="mucdo">Mức Độ Hài Lòng:</label>
    <select id="mucdo" name="mucdo" required>
        <option value="1">Hài Lòng</option>
        <option value="2">Rất Tốt</option>
        <option value="3">Rất Rất Tốt</option>
        <option value="4">Siêu Tốt</option>
        <option value="5">Siêu Siêu Tốt</option>
    </select><br>

    <label for="nhanxet">Nhận Xét:</label>
    <textarea id="nhanxet" name="nhanxet" required></textarea><br>

    <label for="danhgiakhac">Đánh Giá Khác:</label>
    <textarea id="danhgiakhac" name="danhgiakhac" required></textarea><br>

    <input type="submit" value="Thêm Đánh Giá">
</form>

</body>
</html>
<p><a href="index.php">Quay lại trang chủ!</a></p>