<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đánh Giá</title>
</head>
<body>

<form action="xulydanhgia.php" method="post">
    <label for="hoten">Họ và Tên:</label>
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
