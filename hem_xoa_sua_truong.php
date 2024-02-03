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
    // Thêm trường học
    if (isset($_POST['add'])) {
        $truonghoc = $_POST['truonghoc'];
        $kyhieutruong = $_POST['kyhieutruong'];

        // Kiểm tra xem trường đã tồn tại chưa
        $checkQuery = "SELECT * FROM truong WHERE truonghoc = '$truonghoc'";
        $result = $mysqli->query($checkQuery);

        if ($result->num_rows > 0) {
            // Trường đã tồn tại, hiển thị thông báo
            $notification = "Trường học đã tồn tại.";
        } else {
            // Thực hiện truy vấn thêm trường học
            $query = "INSERT INTO truong (truonghoc, kyhieutruong) VALUES ('$truonghoc', '$kyhieutruong')";

            if ($mysqli->query($query)) {
                $notification = "Thêm trường học thành công.";
            } else {
                $notification = "Thêm trường học thất bại: " . $mysqli->error;
            }
        }
    }


    // Xóa trường học
    elseif (isset($_POST['delete'])) {
        $truonghoc_to_delete = $_POST['truonghoc_to_delete'];
        // Thực hiện truy vấn xóa trường học
        $query = "DELETE FROM truong WHERE truonghoc='$truonghoc_to_delete'";

        if ($mysqli->query($query)) {
            $notification = "Xóa trường học thành công.";
        } else {
            $notification = "Xóa trường học thất bại: " . $mysqli->error;
        }
    }

    // Sửa trường học
    elseif (isset($_POST['edit'])) {
        $truonghoc_to_edit = $_POST['truonghoc_to_edit'];
        $new_kyhieutruong = $_POST['new_kyhieutruong'];

        // Thực hiện truy vấn sửa trường học
        $query = "UPDATE truong SET kyhieutruong='$new_kyhieutruong' WHERE truonghoc='$truonghoc_to_edit'";

        if ($mysqli->query($query)) {
            $notification = "Sửa trường học thành công.";
        } else {
            $notification = "Sửa trường học thất bại: " . $mysqli->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Trường học</title>
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
    <h2>Quản lý Trường học</h2>

    <!-- Form Thêm Trường học -->
    <form method="POST">
        <h3>Thêm Trường học</h3>
        <label>Tên Trường học:</label>
        <input type="text" name="truonghoc" required>
        <br>
        <label>Ký hiệu Trường:</label>
        <input type="text" name="kyhieutruong" required>
        <br>
        <button type="submit" name="add">Thêm</button>
    </form>
    <?php if (!empty($notification)): ?>
        <div style="color: #ff0000;"><?php echo $notification; ?></div>
    <?php endif; ?>
    <!-- Form Xóa Trường học -->
    <form method="POST">
        <h3>Xóa Trường học</h3>
        <label>Tên Trường học:</label>
        <select name="truonghoc_to_delete" required>
            <?php
            $resultTruong = $mysqli->query("SELECT * FROM truong");
            while ($rowTruong = $resultTruong->fetch_assoc()) {
                echo "<option value='{$rowTruong['truonghoc']}'>{$rowTruong['truonghoc']}</option>";
            }
            ?>
        </select>
        <br>
        <button type="submit" name="delete">Xóa</button>
    </form>

    <!-- Form Sửa Trường học -->
    <form method="POST">
        <h3>Sửa Trường học</h3>
        <label>Tên Trường học:</label>
        <select name="truonghoc_to_edit" required>
            <?php
            $resultTruong = $mysqli->query("SELECT * FROM truong");
            while ($rowTruong = $resultTruong->fetch_assoc()) {
                echo "<option value='{$rowTruong['truonghoc']}'>{$rowTruong['truonghoc']}</option>";
            }
            ?>
        </select>
        <br>
        <label>Ký hiệu mới:</label>
        <input type="text" name="new_kyhieutruong" required>
        <br>
        <button type="submit" name="edit">Sửa</button>
    </form>

    <!-- Bảng Danh sách Trường học -->
    <h3>Danh sách Trường học</h3>
    <table border="1">
        <tr>
            <th>Tên Trường học</th>
            <th>Ký hiệu Trường</th>
        </tr>

        <?php
        // Truy vấn danh sách trường học
        $result = $mysqli->query("SELECT * FROM truong");

        // Hiển thị dữ liệu
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['truonghoc']}</td>";
            echo "<td>{$row['kyhieutruong']}</td>";
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
<p><a href="index.php">Quay lại trang chủ!</a></p>