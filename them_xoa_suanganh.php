<?php
// Kết nối đến cơ sở dữ liệu
$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Khởi tạo biến thông báo
$notification = "";

// Xử lý khi form được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Thêm ngành
    if (isset($_POST['add'])) {
        $nganh = $_POST['nganh'];
        $kyhieu = $_POST['kyhieu'];

        // Kiểm tra xem ngành đã tồn tại chưa
        $checkQuery = "SELECT * FROM nganh WHERE nganh = '$nganh'";
        $result = $mysqli->query($checkQuery);

        if ($result->num_rows > 0) {
            // Ngành đã tồn tại, hiển thị thông báo
            $notification = "Ngành đã tồn tại.";
        } else {
            // Thực hiện truy vấn thêm ngành
            $query = "INSERT INTO nganh (nganh, kyhieu) VALUES ('$nganh', '$kyhieu')";

            if ($mysqli->query($query)) {
                $notification = "Thêm ngành thành công.";
            } else {
                $notification = "Thêm ngành thất bại: " . $mysqli->error;
            }
        }
    }

    // Xóa ngành
    elseif (isset($_POST['delete'])) {
        $nganh_to_delete = $_POST['nganh_to_delete'];
        // Thực hiện truy vấn xóa ngành
        $query = "DELETE FROM nganh WHERE nganh='$nganh_to_delete'";

        if ($mysqli->query($query)) {
            $notification = "Xóa ngành thành công.";
        } else {
            $notification = "Xóa ngành thất bại: " . $mysqli->error;
        }
    }

    // Sửa ngành
    elseif (isset($_POST['edit'])) {
        $nganh_to_edit = $_POST['nganh_to_edit'];
        $new_kyhieu = $_POST['new_kyhieu'];

        // Thực hiện truy vấn sửa ngành
        $query = "UPDATE nganh SET kyhieu='$new_kyhieu' WHERE nganh='$nganh_to_edit'";

        if ($mysqli->query($query)) {
            $notification = "Sửa ngành thành công.";
        } else {
            $notification = "Sửa ngành thất bại: " . $mysqli->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Ngành</title>
</head>
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
<body>
    <h2>Quản lý Ngành</h2>

    <!-- Form Thêm Ngành -->
    <form method="POST">
        <h3>Thêm Ngành</h3>
        <label>Tên Ngành:</label>
        <input type="text" name="nganh" required>
        <br>
        <label>Ký hiệu Ngành:</label>
        <input type="text" name="kyhieu" required>
        <br>
        <button type="submit" name="add">Thêm</button>
    </form>
    <?php if (!empty($notification)): ?>
        <div style="color: #ff0000;"><?php echo $notification; ?></div>
    <?php endif; ?>
    <!-- Form Xóa Ngành -->
    <form method="POST">
        <h3>Xóa Ngành</h3>
        <label>Tên Ngành:</label>
        <select name="nganh_to_delete" required>
            <?php
            $resultNganh = $mysqli->query("SELECT * FROM nganh");
            while ($rowNganh = $resultNganh->fetch_assoc()) {
                echo "<option value='{$rowNganh['nganh']}'>{$rowNganh['nganh']}</option>";
            }
            ?>
        </select>
        <br>
        <button type="submit" name="delete">Xóa</button>
    </form>

    <!-- Form Sửa Ngành -->
    <form method="POST">
        <h3>Sửa Ngành</h3>
        <label>Tên Ngành:</label>
        <select name="nganh_to_edit" required>
            <?php
            $resultNganh = $mysqli->query("SELECT * FROM nganh");
            while ($rowNganh = $resultNganh->fetch_assoc()) {
                echo "<option value='{$rowNganh['nganh']}'>{$rowNganh['nganh']}</option>";
            }
            ?>
        </select>
        <br>
        <label>Ký hiệu mới:</label>
        <input type="text" name="new_kyhieu" required>
        <br>
        <button type="submit" name="edit">Sửa</button>
    </form>

    <!-- Bảng Danh sách Ngành -->
    <h3>Danh sách Ngành</h3>
    <table border="1">
        <tr>
            <th>Tên Ngành</th>
            <th>Ký hiệu Ngành</th>
        </tr>

        <?php
        // Truy vấn danh sách ngành
        $result = $mysqli->query("SELECT * FROM nganh");

        // Hiển thị dữ liệu
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['nganh']}</td>";
            echo "<td>{$row['kyhieu']}</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <!-- Đóng kết nối -->
    <?php
    $mysqli->close();
    ?>
</body>
</html>
