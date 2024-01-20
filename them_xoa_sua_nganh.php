<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'qlsvtp';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Xử lý thêm dữ liệu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $nganh = $_POST['nganh'];
    $kyhieu = $_POST['kyhieu'];

    $sql_insert = "INSERT INTO nganh (nganh, kyhieu) VALUES ('$nganh', '$kyhieu')";
    $conn->query($sql_insert);
}

// Xử lý xóa dữ liệu
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_delete = "DELETE FROM nganh WHERE id = $id";
    $conn->query($sql_delete);
}

// Xử lý sửa dữ liệu
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_select = "SELECT * FROM nganh WHERE id = $id";
    $result = $conn->query($sql_select);
    $row = $result->fetch_assoc();
}

// Xử lý cập nhật dữ liệu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $nganh = $_POST['nganh'];
    $kyhieu = $_POST['kyhieu'];

    $sql_update = "UPDATE nganh SET nganh='$nganh', kyhieu='$kyhieu' WHERE id=$id";
    $conn->query($sql_update);
}

// Lấy danh sách ngành
$sql_select_all = "SELECT * FROM nganh";
$result_all = $conn->query($sql_select_all);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Ngành</title>
    <style>
        body {
            background-color: #3498db;
            color: #ffffff; /* Màu chữ trắng */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #ffffff; /* Màu chữ trắng */
        }

        form {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ffffff; /* Màu viền chữ trắng */
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #3498db; /* Màu nền #3498db cho header */
        }

        tr:nth-child(even) {
            background-color: #2979b5; /* Màu nền #2979b5 cho hàng chẵn */
        }

        tr:nth-child(odd) {
            background-color: #18699f; /* Màu nền #18699f cho hàng lẻ */
        }

        a {
            color: #ffffff; /* Màu chữ trắng cho liên kết */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>Quản lý ngành</h2>
<form method="post" action="">
    <label for="nganh">Ngành:</label>
    <input type="text" name="nganh" required>
    
    <label for="kyhieu">Ký hiệu:</label>
    <input type="text" name="kyhieu" required>
    
    <button type="submit" name="submit">Thêm</button>
</form>

<h2>Danh sách Ngành</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Ngành</th>
        <th>Ký hiệu</th>
        <th>Thao tác</th>
    </tr>
    <?php
    while ($row_all = $result_all->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row_all['id']}</td>";
        echo "<td>{$row_all['nganh']}</td>";
        echo "<td>{$row_all['kyhieu']}</td>";
        echo "<td>
                  <a href='them_xoa_sua_nganh.php?action=edit&id={$row_all['id']}'>Sửa</a> | 
                  <a href='them_xoa_sua_nganh.php?action=delete&id={$row_all['id']}'>Xóa</a>
              </td>";
        echo "</tr>";
    }
    ?>
</table>

<?php
// Hiển thị thông tin sửa
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    ?>
    <h2>Sửa Ngành</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="nganh">Ngành:</label>
        <input type="text" name="nganh" value="<?php echo $row['nganh']; ?>" required>
        
        <label for="kyhieu">Ký hiệu:</label>
        <input type="text" name="kyhieu" value="<?php echo $row['kyhieu']; ?>" required>
        
        <button type="submit" name="update">Cập nhật</button>
    </form>
    <?php
}
?>

</body>
</html>

<?php
$conn->close();
?>
