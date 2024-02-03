<?php
$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $tenkythuctap = $_POST['tenkythuctap'];
        $tendetai = $_POST['tendetai'];
        $ngaybatdau = $_POST['ngaybatdau'];
        $ngayketthuc = $_POST['ngayketthuc'];

        $checkQuery = "SELECT * FROM kythuctap WHERE tenkythuctap = '$tenkythuctap'";
        $checkResult = $mysqli->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            $notification = "Tên kỳ thực tập đã tồn tại.";
        } else {
            $query = "INSERT INTO kythuctap (tenkythuctap, tendetai, ngaybatdau, ngayketthuc) 
                      VALUES ('$tenkythuctap', '$tendetai', '$ngaybatdau', '$ngayketthuc')";

            if ($mysqli->query($query)) {
                $notification = "Thêm kỳ thực tập thành công.";
            } else {
                $notification = "Thêm kỳ thực tập thất bại: " . $mysqli->error;
            }
        }
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['delete_id'];
        if ($mysqli->query("DELETE FROM kythuctap WHERE id_kythuctap=$id")) {
            $notification = "Xóa kỳ thực tập thành công.";
        } else {
            $notification = "Xóa kỳ thực tập thất bại: " . $mysqli->error;
        }
    } elseif (isset($_POST['edit'])) {
        $id = $_POST['edit_id'];
        $new_tenkythuctap = $_POST['new_tenkythuctap'];
        $new_tendetai = $_POST['new_tendetai'];
        $new_ngaybatdau = $_POST['new_ngaybatdau'];
        $new_ngayketthuc = $_POST['new_ngayketthuc'];

        $updateData = [];
        if (!empty($new_tenkythuctap)) $updateData[] = "tenkythuctap='$new_tenkythuctap'";
        if (!empty($new_tendetai)) $updateData[] = "tendetai='$new_tendetai'";
        if (!empty($new_ngaybatdau)) $updateData[] = "ngaybatdau='$new_ngaybatdau'";
        if (!empty($new_ngayketthuc)) $updateData[] = "ngayketthuc='$new_ngayketthuc'";

        

        if (!empty($updateData)) {
            $query = "UPDATE kythuctap SET " . implode(", ", $updateData) . " WHERE id_kythuctap=$id";

            if ($mysqli->query($query)) {
                $notification = "Sửa kỳ thực tập thành công.";
            } else {
                $notification = "Sửa kỳ thực tập thất bại: " . $mysqli->error;
            }
        } else {
            $notification = "Không có dữ liệu mới để cập nhật.";
        }
    }   
}



// Add kỳ thực tập
if (isset($_POST['submit_add_kythuctap'])) {
    $tenkythuctap = $_POST['tenkythuctap'];
    $tendetai = $_POST['tendetai'];
    $ngaybatdau = $_POST['ngaybatdau'];
    $ngayketthuc = $_POST['ngayketthuc'];

    $insertKythuctapQuery = "INSERT INTO kythuctap (tenkythuctap, tendetai, ngaybatdau, ngayketthuc) 
                            VALUES ('$tenkythuctap', '$tendetai', '$ngaybatdau', '$ngayketthuc')";

    if ($mysqli->query($insertKythuctapQuery) === TRUE) {
        $notification = "Thêm kỳ thực tập thành công.";
    } else {
        $notification = "Thêm kỳ thực tập thất bại: " . $mysqli->error;
    }
}

// Xóa kỳ thực tập

if (isset($_POST['delete_kythuctap'])) {
    $delete_id_kythuctap = $_POST['delete_id_kythuctap'];

    $deleteKythuctapQuery = "DELETE FROM kythuctap WHERE id_kythuctap=$delete_id_kythuctap";

    if ($mysqli->query($deleteKythuctapQuery)) {
        $notification = "Xóa kỳ thực tập thành công.";
    } else {
        $notification = "Xóa kỳ thực tập thất bại: " . $mysqli->error;
    }
    
}
// Sửa kỳ thực tập
if (isset($_POST['edit_kythuctap'])) {
    $edit_id_kythuctap = $_POST['edit_id_kythuctap'];
    $new_tenkythuctap = $_POST['new_tenkythuctap'];
    $new_tendetai = $_POST['new_tendetai'];
    $new_ngaybatdau = $_POST['new_ngaybatdau'];
    $new_ngayketthuc = $_POST['new_ngayketthuc'];

    $updateData = [];
    if (!empty($new_tenkythuctap)) $updateData[] = "tenkythuctap='$new_tenkythuctap'";
    if (!empty($new_tendetai)) $updateData[] = "tendetai='$new_tendetai'";
    if (!empty($new_ngaybatdau)) $updateData[] = "ngaybatdau='$new_ngaybatdau'";
    if (!empty($new_ngayketthuc)) $updateData[] = "ngayketthuc='$new_ngayketthuc'";

    if (!empty($updateData)) {
        $query = "UPDATE kythuctap SET " . implode(", ", $updateData) . " WHERE id_kythuctap=$edit_id_kythuctap";

        if ($mysqli->query($query)) {
            $notification = "Sửa kỳ thực tập thành công.";
        } else {
            $notification = "Sửa kỳ thực tập thất bại: " . $mysqli->error;
        }
    } else {
        $notification = "Không có dữ liệu mới để cập nhật.";
    }
}


// Fetch tên đề tài for dropdown
$detaiQuery = "SELECT * FROM tendetai";
$detaiResult = $mysqli->query($detaiQuery);

// Fetch danh sách kỳ thực tập
$kythuctapQuery = "SELECT * FROM kythuctap";
$kythuctapResult = $mysqli->query($kythuctapQuery);

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

    <title>Quản Lý Kỳ Thực Tập</title>
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
    .notification {
        color: #ff0000; /* Red color for notification */
        font-weight: bold;
        margin-top: 10px; /* Adjust the margin as needed */
    }
</style>
</head>
<body>
    <h2>Quản Lý Kỳ Thực Tập</h2>

    <!-- Form Thêm Kỳ Thực Tập -->
    <form method="POST">
        <h3>Thêm Kỳ Thực Tập</h3>
        <label>Tên kỳ thực tập:</label>
        <input type="text" name="tenkythuctap" required>
        <br>
        <label>Đề tài:</label>
        <select name="tendetai">
            <?php while ($row = $detaiResult->fetch_assoc()) : ?>
                <option value="<?php echo $row['tendetai']; ?>"><?php echo $row['tendetai']; ?></option>
            <?php endwhile; ?>
        </select>
        <br>
        <label>Ngày bắt đầu:</label>
        <input type="date" name="ngaybatdau" required>
        <br>
        <label>Ngày kết thúc:</label>
        <input type="date" name="ngayketthuc" required>
        <br>
        <button type="submit" name="submit_add_kythuctap">Thêm</button>
    </form>

<!-- Bảng Danh sách Kỳ Thực Tập -->
<h3>Danh Sách Kỳ Thực Tập</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Tên kỳ thực tập</th>
        <th>Đề tài</th>
        <th>Ngày bắt đầu</th>
        <th>Ngày kết thúc</th>
        <th>Chỉnh sửa</th>
    </tr>

    <?php
    while ($row = $kythuctapResult->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id_kythuctap']}</td>";
        echo "<td>{$row['tenkythuctap']}</td>";
        echo "<td>{$row['tendetai']}</td>";
        echo "<td>{$row['ngaybatdau']}</td>";
        echo "<td>{$row['ngayketthuc']}</td>";
        echo "<td class='actions'>
                <form method='POST'>
                    <input type='hidden' name='delete_id_kythuctap' value='{$row['id_kythuctap']}'>
                    <button type='submit' name='delete_kythuctap'>Xóa</button>
                </form>
                <form method='POST'>
                    <input type='hidden' name='edit_id_kythuctap' value='{$row['id_kythuctap']}'>
                    <input type='text' name='new_tenkythuctap' placeholder='Tên Kỳ Thực Tập mới'>";

        // Fetch đề tài để hiển thị trong dropdown
        $detaiQueryForDropdown = "SELECT * FROM tendetai";
        $detaiResultForDropdown = $mysqli->query($detaiQueryForDropdown);

        echo "<select name='new_tendetai'>";
        while ($detaiRowForDropdown = $detaiResultForDropdown->fetch_assoc()) {
            $selected = ($detaiRowForDropdown['tendetai'] == $row['tendetai']) ? 'selected' : '';
            echo "<option value='{$detaiRowForDropdown['tendetai']}' $selected>{$detaiRowForDropdown['tendetai']}</option>";
        }
        echo "</select>";

        echo "<input type='date' name='new_ngaybatdau' placeholder='Ngày bắt đầu mới'>
              <input type='date' name='new_ngayketthuc' placeholder='Ngày kết thúc mới'>
              <button type='submit' name='edit_kythuctap'>Sửa</button>
          </form>
        </td>";
        echo "</tr>";
    }
    ?>
</table>
<p><?php echo $notification; ?></p>
<p><a href="index.php">Quay lại trang chủ!</a></p>

</body>
</html>
