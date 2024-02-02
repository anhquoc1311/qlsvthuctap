<?php
$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$notification = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $tennhom = $_POST['tennhom'];
        $detai = $_POST['detai'];
        $hotensinhvien = $_POST['hotensinhvien'];
        $ngaybd = $_POST['ngaybd'];
        $ngaykt = $_POST['ngaykt'];

        $checkQuery = "SELECT * FROM nhomtt WHERE tennhom = '$tennhom'";
        $checkResult = $mysqli->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            $notification = "Tên nhóm đã tồn tại.";
        } else {
            $query = "INSERT INTO nhomtt (tennhom, detai, hotensinhvien, ngaybd, ngaykt) 
                      VALUES ('$tennhom', '$detai', '$hotensinhvien', '$ngaybd', '$ngaykt')";

            if ($mysqli->query($query)) {
                $notification = "Thêm nhóm thành công.";
            } else {
                $notification = "Thêm nhóm thất bại: " . $mysqli->error;
            }
        }
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['delete_id'];
        if ($mysqli->query("DELETE FROM nhomtt WHERE id=$id")) {
            $notification = "Xóa nhóm thành công.";
        } else {
            $notification = "Xóa nhóm thất bại: " . $mysqli->error;
        }
    } elseif (isset($_POST['edit'])) {
        $id = $_POST['edit_id'];
        $new_tennhom = $_POST['new_tennhom'];
        $new_detai = $_POST['new_detai'];
        $new_hotensinhvien = $_POST['new_hotensinhvien'];
        $new_ngaybd = $_POST['new_ngaybd'];
        $new_ngaykt = $_POST['new_ngaykt'];

        $updateData = [];
        if (!empty($new_tennhom)) $updateData[] = "tennhom='$new_tennhom'";
        if (!empty($new_detai)) $updateData[] = "detai='$new_detai'";
        if (!empty($new_hotensinhvien)) $updateData[] = "hotensinhvien='$new_hotensinhvien'";
        if (!empty($new_ngaybd)) $updateData[] = "ngaybd='$new_ngaybd'";
        if (!empty($new_ngaykt)) $updateData[] = "ngaykt='$new_ngaykt'";

        if (!empty($updateData)) {
            $query = "UPDATE nhomtt SET " . implode(", ", $updateData) . " WHERE id=$id";

            if ($mysqli->query($query)) {
                $notification = "Sửa nhóm thành công.";
            } else {
                $notification = "Sửa nhóm thất bại: " . $mysqli->error;
            }
        } else {
            $notification = "Không có dữ liệu mới để cập nhật.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <title>Quản lý Nhóm Thực Tập</title>
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
    <h2>Quản lý Nhóm Thực Tập</h2>

    <!-- Form Thêm Nhóm -->
    <form method="POST">
        <h3>Thêm Nhóm</h3>
        <label>Tên Nhóm:</label>
        <input type="text" name="tennhom" required>
        <br>
        <label>Đề Tài:</label>
        <input type="text" name="detai" required>
        <br>
        <label>Họ Tên Sinh Viên:</label>
        <input type="text" name="hotensinhvien" required>

        <br>
        <label>Ngày Bắt Đầu:</label>
        <input type="date" name="ngaybd" required>
        <br>
        <label>Ngày Kết Thúc:</label>
        <input type="date" name="ngaykt" required>
        <br>
        <button type="submit" name="add">Thêm</button>
    </form>

    <?php if (!empty($notification)): ?>
        <div style="color: #ff0000;"><?php echo $notification; ?></div>
    <?php endif; ?>

    <!-- Bảng Danh sách Nhóm -->
    <h3>Danh sách Nhóm</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tên Nhóm</th>
            <th>Đề Tài</th>
            <th>Họ Tên Sinh Viên</th>
            <th>Ngày Bắt Đầu</th>
            <th>Ngày Kết Thúc</th>
            <th>Thao tác</th>
        </tr>

        <?php
        $result = $mysqli->query("SELECT * FROM nhomtt");

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['tennhom']}</td>";
            echo "<td>{$row['detai']}</td>";
            echo "<td>{$row['hotensinhvien']}</td>";
            echo "<td>{$row['ngaybd']}</td>";
            echo "<td>{$row['ngaykt']}</td>";
            echo "<td class='actions'>
                    <form method='POST'>
                        <input type='hidden' name='delete_id' value='{$row['id']}'>
                        <button type='submit' name='delete'>Xóa</button>
                    </form>
                    <form method='POST'>
                        <input type='hidden' name='edit_id' value='{$row['id']}'>
                        <input type='text' name='new_tennhom' placeholder='Tên Nhóm mới'>
                        <input type='text' name='new_detai' placeholder='Đề Tài mới'>
                        <input type='text' name='new_hotensinhvien' placeholder='Họ Tên Sinh Viên mới'>
                        <input type='date' name='new_ngaybd' placeholder='Ngày Bắt Đầu mới'>
                        <input type='date' name='new_ngaykt' placeholder='Ngày Kết Thúc mới'>
                        <button type='submit' name='edit'>Sửa</button>
                    </form>
                </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php
$resultSinhVien = $mysqli->query("SELECT hotensinhvien FROM sinhvien");
$sinhVienArray = array();

while ($rowSinhVien = $resultSinhVien->fetch_assoc()) {
    $sinhVienArray[] = $rowSinhVien['hotensinhvien'];
}
?>

<script>
    // Đưa danh sách sinh viên vào Select2 và cho phép chọn nhiều giá trị
    var sinhVienData = <?php echo json_encode($sinhVienArray); ?>;
    $('#selectSinhVien').select2({
        data: sinhVienData,
        multiple: true
    });
</script>


    <?php
    $mysqli->close();
    ?>
</body>
</html>
