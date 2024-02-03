<?php
$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

// Xử lý thêm dữ liệu
if (isset($_POST['submit'])) {
    $tennhomthuctap = $_POST['tennhomthuctap'];
    $kithuctap = $_POST['kithuctap'];
    $tendetai = $_POST['tendetai'];

    $query = "INSERT INTO nhomthuctap (tennhomthuctap, kithuctap, tendetai) VALUES ('$tennhomthuctap', '$kithuctap', '$tendetai')";
    $result = $mysqli->query($query);

    if ($result) {
        echo "Thêm thành công!";
    } else {
        echo "Thêm thất bại: " . $mysqli->error;
    }
}

// Xử lý sửa dữ liệu
if (isset($_POST['update'])) {
    $tennhomthuctap_update = $_POST['tennhomthuctap_update'];
    $kithuctap_update = $_POST['kithuctap_update'];
    $tendetai_update = $_POST['tendetai_update'];

    $update_query = "UPDATE nhomthuctap SET kithuctap='$kithuctap_update', tendetai='$tendetai_update' WHERE tennhomthuctap='$tennhomthuctap_update'";
    $update_result = $mysqli->query($update_query);

    if ($update_result) {
        echo "Sửa thành công!";
    } else {
        echo "Sửa thất bại: " . $mysqli->error;
    }
}

// Xử lý xóa dữ liệu
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $delete_query = "DELETE FROM nhomthuctap WHERE tennhomthuctap = '$delete_id'";
    $delete_result = $mysqli->query($delete_query);

    if ($delete_result) {
        echo "Xóa thành công!";
    } else {
        echo "Xóa thất bại: " . $mysqli->error;
    }
}

// Hiển thị danh sách dữ liệu
$select_query = "SELECT * FROM nhomthuctap";
if (isset($_GET['search'])) {
    $search_kithuctap = $_GET['search'];
    $select_query .= " WHERE kithuctap = '$search_kithuctap'";
}
$select_result = $mysqli->query($select_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhóm thực tập</title>
    <style>
        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        #updateForm {
            margin-top: 20px;
        }

        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h2>Danh sách nhóm thực tập</h2>

    <!-- Form tìm kiếm -->
    <form method="get" action="">
        <label for="search">Tìm kiếm theo kì thực tập:</label>
        <input type="text" name="search">
        <button type="submit">Tìm kiếm</button>
    </form>

    <!-- Form thêm dữ liệu -->
    <form method="post" action="">
        <label for="tennhomthuctap">Tên nhóm thực tập:</label>
        <input type="text" name="tennhomthuctap" required>

        <label for="kithuctap">Kì thực tập:</label>
        <input type="text" name="kithuctap" required>

        <label for="tendetai">Tên đề tài:</label>
        <input type="text" name="tendetai" required>

        <button type="submit" name="submit">Thêm</button>
    </form>

    <!-- Danh sách dữ liệu -->
    <ul>
        <?php while ($row = $select_result->fetch_assoc()) : ?>
            <li>
                <?php echo $row['tennhomthuctap']; ?> - <?php echo $row['kithuctap']; ?> - <?php echo $row['tendetai']; ?>
                <a href="?delete=<?php echo $row['tennhomthuctap']; ?>">Xóa</a>
                <button onclick="showUpdateForm('<?php echo $row['tennhomthuctap']; ?>', '<?php echo $row['kithuctap']; ?>', '<?php echo $row['tendetai']; ?>')">Sửa</button>
            </li>
        <?php endwhile; ?>
    </ul>

    <!-- Form sửa dữ liệu -->
    <div id="updateForm" style="display:none;">
        <h3>Sửa thông tin nhóm thực tập</h3>
        <form method="post" action="">
            <label for="tennhomthuctap_update">Tên nhóm thực tập:</label>
            <input type="text" name="tennhomthuctap_update" id="tennhomthuctap_update" readonly>

            <label for="kithuctap_update">Kì thực tập:</label>
            <input type="text" name="kithuctap_update" required>

            <label for="tendetai_update">Tên đề tài:</label>
            <input type="text" name="tendetai_update" required>

            <button type="submit" name="update">Sửa</button>
        </form>
    </div>

    <script>
        function showUpdateForm(tennhomthuctap, kithuctap, tendetai) {
            document.getElementById('tennhomthuctap_update').value = tennhomthuctap;
            document.getElementById('kithuctap_update').value = kithuctap;
            document.getElementById('tendetai_update').value = tendetai;
            document.getElementById('updateForm').style.display = 'block';
        }
    </script>
</body>
</html>
<p><a href="index.php">Quay lại trang chủ!</a></p>