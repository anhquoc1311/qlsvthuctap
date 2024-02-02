<?php
$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

if ($mysqli->connect_error) {
    die('Kết nối không thành công: ' . $mysqli->connect_error);
}

// Add công việc
if (isset($_POST['submit_add'])) {
    $tencongviec = $_POST['tencongviec'];
    $tendetai = $_POST['tendetai'];
    $tennhomnguoihuongdan = $_POST['tennhomnguoihuongdan'];
    $ngaybatdau = $_POST['ngaybatdau'];
    $ngayketthuc = $_POST['ngayketthuc'];
    $nhanxet = $_POST['nhanxet'];

    $insertQuery = "INSERT INTO congviec (tencongviec, tendetai, tennhomnguoihuongdan, ngaybatdau, ngayketthuc, nhanxet) 
                    VALUES ('$tencongviec', '$tendetai', '$tennhomnguoihuongdan', '$ngaybatdau', '$ngayketthuc', '$nhanxet')";

    if ($mysqli->query($insertQuery) === TRUE) {
        echo 'Thêm công việc thành công';
    } else {
        echo 'Lỗi khi thêm công việc: ' . $mysqli->error;
    }
}

// Delete công việc
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $deleteQuery = "DELETE FROM congviec WHERE id_cv = $delete_id";

    if ($mysqli->query($deleteQuery) === TRUE) {
        echo 'Xóa công việc thành công';
    } else {
        echo 'Lỗi khi xóa công việc: ' . $mysqli->error;
    }
}

// Edit công việc
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    $selectEditQuery = "SELECT c.*, d.tendetai FROM congviec c
                        JOIN tendetai d ON c.tendetai = d.tendetai
                        WHERE c.id_cv = $edit_id";
    $editResult = $mysqli->query($selectEditQuery);
    $editData = $editResult->fetch_assoc();
}

// Update công việc
if (isset($_POST['submit_update'])) {
    $edit_id = $_POST['edit_id'];
    $tencongviec = $_POST['tencongviec'];
    $tendetai = $_POST['tendetai'];
    $tennhomnguoihuongdan = $_POST['tennhomnguoihuongdan'];
    $ngaybatdau = $_POST['ngaybatdau'];
    $ngayketthuc = $_POST['ngayketthuc'];
    $nhanxet = $_POST['nhanxet'];

    $updateQuery = "UPDATE congviec 
                    SET tencongviec = '$tencongviec', tendetai = '$tendetai', tennhomnguoihuongdan = '$tennhomnguoihuongdan',
                        ngaybatdau = '$ngaybatdau', ngayketthuc = '$ngayketthuc', nhanxet = '$nhanxet' 
                    WHERE id_cv = $edit_id";

    if ($mysqli->query($updateQuery) === TRUE) {
        echo 'Cập nhật công việc thành công';
    } else {
        echo 'Lỗi khi cập nhật công việc: ' . $mysqli->error;
    }
}

// Display danh sách công việc
$selectQuery = "SELECT c.*, d.tendetai FROM congviec c
                JOIN tendetai d ON c.tendetai = d.tendetai";
$result = $mysqli->query($selectQuery);

// Fetch tên đề tài for dropdown
$detaiQuery = "SELECT * FROM tendetai";
$detaiResult = $mysqli->query($detaiQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý công việc</title>
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

<h2>Danh sách công việc</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Tên công việc</th>
        <th>Tên đề tài</th>
        <th>Tên nhóm người hướng dẫn</th>
        <th>Ngày bắt đầu</th>
        <th>Ngày kết thúc</th>
        <th>Nhận xét</th>
        <th>Thao tác</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo $row['id_cv']; ?></td>
            <td><?php echo $row['tencongviec']; ?></td>
            <td><?php echo $row['tendetai']; ?></td>
            <td><?php echo $row['tennhomnguoihuongdan']; ?></td>
            <td><?php echo $row['ngaybatdau']; ?></td>
            <td><?php echo $row['ngayketthuc']; ?></td>
            <td><?php echo $row['nhanxet']; ?></td>
            <td>
                <a href="themxoasuacv.php?delete_id=<?php echo $row['id_cv']; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</a>
                <a href="themxoasuacv.php?edit_id=<?php echo $row['id_cv']; ?>">Sửa</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php if (isset($editData)) : ?>
    <h2>Sửa công việc</h2>

    <form method="post" action="themxoasuacv.php">
        <input type="hidden" name="edit_id" value="<?php echo $editData['id_cv']; ?>">

        <label for="tencongviec">Tên công việc:</label>
        <input type="text" name="tencongviec" value="<?php echo $editData['tencongviec']; ?>" required><br>

        <label for="tendetai">Tên đề tài:</label>
        <select name="tendetai">
            <?php while ($row = $detaiResult->fetch_assoc()) : ?>
                <option value="<?php echo $row['tendetai']; ?>" <?php echo ($row['tendetai'] == $editData['tendetai']) ? 'selected' : ''; ?>>
                    <?php echo $row['tendetai']; ?>
                </option>
            <?php endwhile; ?>
        </select><br>

        <label for="tennhomnguoihuongdan">Tên nhóm người hướng dẫn:</label>
        <input type="text" name="tennhomnguoihuongdan" value="<?php echo $editData['tennhomnguoihuongdan']; ?>" required><br>

        <label for="ngaybatdau">Ngày bắt đầu:</label>
        <input type="date" name="ngaybatdau" value="<?php echo $editData['ngaybatdau']; ?>" required><br>

        <label for="ngayketthuc">Ngày kết thúc:</label>
        <input type="date" name="ngayketthuc" value="<?php echo $editData['ngayketthuc']; ?>" required><br>

        <label for="nhanxet">Nhận xét:</label>
        <input type="text" name="nhanxet" value="<?php echo $editData['nhanxet']; ?>" required><br>

        <input type="submit" name="submit_update" value="Cập nhật công việc">
    </form>
<?php endif; ?>

<br>

<h2>Thêm công việc mới</h2>

<form method="post" action="themxoasuacv.php">
    <label for="tencongviec">Tên công việc:</label>
    <input type="text" name="tencongviec" required><br>

    <label for="tendetai">Tên đề tài:</label>
    <select name="tendetai">
        <?php $detaiResult = $mysqli->query($detaiQuery); ?>
        <?php while ($row = $detaiResult->fetch_assoc()) : ?>
            <option value="<?php echo $row['tendetai']; ?>"><?php echo $row['tendetai']; ?></option>
        <?php endwhile; ?>
    </select><br>

    <label for="tennhomnguoihuongdan">Tên nhóm người hướng dẫn:</label>
    <input type="text" name="tennhomnguoihuongdan" required><br>

    <label for="ngaybatdau">Ngày bắt đầu:</label>
    <input type="date" name="ngaybatdau" required><br>

    <label for="ngayketthuc">Ngày kết thúc:</label>
    <input type="date" name="ngayketthuc" required><br>

    <label for="nhanxet">Nhận xét:</label>
    <input type="text" name="nhanxet" required><br>

    <input type="submit" name="submit_add" value="Thêm công việc">
</form>

</body>
</html>

<?php
// Đóng kết nối
$mysqli->close();
?>
