<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'qlsvtp';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý thêm mới
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "add") {
    $ten = $_POST["ten"];
    $sdt = $_POST["sdt"];
    $gmail = $_POST["gmail"];
    $chucdanh = $_POST["chucdanh"];
    $phong = $_POST["phong"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $zalo = $_POST["zalo"];
    $facebook = $_POST["facebook"];
    $github = $_POST["github"];
    $avata = $_POST["avata"];

    $sql = "INSERT INTO nguoihuongdan (ten, sdt, gmail, chucdanh, phong, username, password, zalo, facebook, github, avata)
            VALUES ('$ten', '$sdt', '$gmail', '$chucdanh', '$phong', '$username', '$password', '$zalo', '$facebook', '$github', '$avata')";

    if ($conn->query($sql) === TRUE) {
        header('Location: nguoihuongdan.php');
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

// Xử lý xóa
if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM nguoihuongdan WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: nguoihuongdan.php');
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

// Xử lý sửa
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "edit") {
    $id = $_POST["id"];
    $ten = $_POST["ten"];
    $sdt = $_POST["sdt"];
    $gmail = $_POST["gmail"];
    $chucdanh = $_POST["chucdanh"];
    $phong = $_POST["phong"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $zalo = $_POST["zalo"];
    $facebook = $_POST["facebook"];
    $github = $_POST["github"];
    $avata = $_POST["avata"];

    $sql = "UPDATE nguoihuongdan SET
            ten='$ten', sdt='$sdt', gmail='$gmail', chucdanh='$chucdanh', phong='$phong',
            username='$username', password='$password', zalo='$zalo', facebook='$facebook', github='$github', avata='$avata'
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: nguoihuongdan.php');
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

// Hàm để hiển thị dữ liệu từ cơ sở dữ liệu
function displayData()
{
    global $conn;
    $result = $conn->query("SELECT * FROM nguoihuongdan");
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người hướng dẫn</title>
</head>
<style>
        body {
            background-color: #3498db;
            color: #fff;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        .message {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #fff;
            color: #333;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }

        .student-list {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }

        .student-list h3 {
            color: #fff;
        }

        .student-list table {
            width: 100%;
            border-collapse: collapse;
        }

        .student-list table th,
        .student-list table td {
            padding: 8px;
            border: 1px solid #fff;
        }
    </style>
<body>

<h2>Thêm Người Hướng Dẫn</h2>
<form action="nguoihuongdan.php" method="post">
    <!-- Form để thêm mới -->
    <label for="ten">Tên:</label>
    <input type="text" name="ten" required><br>

    <label for="sdt">Số điện thoại:</label>
    <input type="text" name="sdt" required><br>

    <label for="gmail">Email:</label>
    <input type="text" name="gmail" required><br>

    <label for="chucdanh">Chức danh:</label>
    <input type="text" name="chucdanh" required><br>

    <label for="phong">Phòng:</label>
    <input type="text" name="phong" required><br>

    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <label for="zalo">Zalo:</label>
    <input type="text" name="zalo" required><br>

    <label for="facebook">Facebook:</label>
    <input type="text" name="facebook" required><br>

    <label for="github">Github:</label>
    <input type="text" name="github" required><br>

    <label for="avata">Link Avata:</label>
    <input type="text" name="avata" required><br>

    <input type="hidden" name="action" value="add">
    <input type="submit" value="Thêm">
</form>

<h2>Danh sách Người Hướng Dẫn</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Số điện thoại</th>
        <th>Email</th>
        <th>Chức danh</th>
        <th>Phòng</th>
        <th>Username</th>
        <th>Zalo</th>
        <th>Facebook</th>
        <th>Github</th>
        <th>Avata</th>
        <th>Thao tác</th>
    </tr>
    <?php
    $data = displayData();
    foreach ($data as $row) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['ten'] . "</td>";
        echo "<td>" . $row['sdt'] . "</td>";
        echo "<td>" . $row['gmail'] . "</td>";
        echo "<td>" . $row['chucdanh'] . "</td>";
        echo "<td>" . $row['phong'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['zalo'] . "</td>";
        echo "<td>" . $row['facebook'] . "</td>";
        echo "<td>" . $row['github'] . "</td>";
        echo "<td>" . $row['avata'] . "</td>";
        echo "<td><a href='nguoihuongdan.php?action=edit&id=" . $row['id'] . "'>Sửa</a> | ";
        echo "<a href='nguoihuongdan.php?action=delete&id=" . $row['id'] . "'>Xóa</a></td>";
        echo "</tr>";
    }
    ?>
</table>

<?php
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM nguoihuongdan WHERE id=$id");
    $row = $result->fetch_assoc();
    ?>
    <h2>Sửa Người Hướng Dẫn</h2>
    <form action="nguoihuongdan.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label for="ten">Tên:</label>
        <input type="text" name="ten" value="<?php echo $row['ten']; ?>" required><br>

        <label for="sdt">Số điện thoại:</label>
        <input type="text" name="sdt" value="<?php echo $row['sdt']; ?>" required><br>

        <label for="gmail">Email:</label>
        <input type="text" name="gmail" value="<?php echo $row['gmail']; ?>" required><br>

        <label for="chucdanh">Chức danh:</label>
        <input type="text" name="chucdanh" value="<?php echo $row['chucdanh']; ?>" required><br>

        <label for="phong">Phòng:</label>
        <input type="text" name="phong" value="<?php echo $row['phong']; ?>" required><br>

        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $row['username']; ?>" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="zalo">Zalo:</label>
        <input type="text" name="zalo" value="<?php echo $row['zalo']; ?>" required><br>

        <label for="facebook">Facebook:</label>
        <input type="text" name="facebook" value="<?php echo $row['facebook']; ?>" required><br>

        <label for="github">Github:</label>
        <input type="text" name="github" value="<?php echo $row['github']; ?>" required><br>

        <label for="avata">Link Avata:</label>
        <input type="text" name="avata" value="<?php echo $row['avata']; ?>" required><br>

        <input type="hidden" name="action" value="edit">
        <input type="submit" value="Cập nhật">
    </form>
    <?php
}
?>

</body>
</html>

<?php
$conn->close();
?>
