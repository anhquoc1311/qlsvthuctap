<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Đề Tài</title>
</head>
<body>

<?php
$editMode = false;

// Initialize $mysqli
$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

// Check connection
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

if(isset($_GET["action"]) && $_GET["action"] == "sua" && isset($_GET["id"])) {
    $editMode = true;

    $idSua = $_GET["id"];

    // Lấy dữ liệu của đề tài cần sửa
    $sqlEdit = "SELECT * FROM tendetai WHERE tendetai='$idSua'";
    $resultEdit = $mysqli->query($sqlEdit);

    if ($resultEdit->num_rows > 0) {
        $rowEdit = $resultEdit->fetch_assoc();
        $tendetaiEdit = $rowEdit["tendetai"];
        $motaEdit = $rowEdit["mota"];
    }
}

// Check for success parameter
if (isset($_GET["success"])) {
    $successMessage = "";

    switch ($_GET["success"]) {
        case "them":
            $successMessage = "Thêm thành công!";
            break;
        case "sua":
            $successMessage = "Cập nhật thành công!";
            break;
        case "xoa":
            $successMessage = "Xóa thành công!";
            break;
        default:
            $successMessage = "";
    }

    if (!empty($successMessage)) {
        echo "<p style='color: green;'>{$successMessage}</p>";
    }
}
?>
<?php if(!$editMode) { ?>
    <h2>Thêm Đề Tài</h2>
    <form action="xulydetai.php?action=them" method="post">
        <label for="tendetai">Tên Đề Tài:</label>
        <input type="text" id="tendetai" name="tendetai" required><br>

        <label for="mota">Mô Tả:</label>
        <input type="text" id="mota" name="mota" required><br>

        <input type="submit" value="Thêm Đề Tài">
    </form>
<?php } else { ?>
    <h2>Sửa Đề Tài</h2>
    <form action="xulydetai.php?action=sua&id=<?php echo $idSua; ?>" method="post">
        <label for="tendetai">Tên Đề Tài:</label>
        <input type="text" id="tendetai" name="tendetai" value="<?php echo $tendetaiEdit; ?>" required><br>

        <label for="mota">Mô Tả:</label>
        <input type="text" id="mota" name="mota" value="<?php echo $motaEdit; ?>" required><br>

        <input type="submit" value="Cập Nhật">
    </form>
<?php } ?>

<h2>Danh Sách Đề Tài</h2>

<?php
// Hiển thị danh sách đề tài
$sqlList = "SELECT * FROM tendetai";
$resultList = $mysqli->query($sqlList);

if ($resultList->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Tên Đề Tài</th><th>Mô Tả</th><th>Thao Tác</th></tr>";

    while($rowList = $resultList->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$rowList["tendetai"]."</td>";
        echo "<td>".$rowList["mota"]."</td>";
        echo "<td>
                <a href='quandetai.php?action=sua&id=".$rowList["tendetai"]."'>Sửa</a> |
                <a href='xulydetai.php?action=xoa&id=".$rowList["tendetai"]."'>Xóa</a>
              </td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Không có đề tài nào.";
}

$mysqli->close();
?>

</body>
</html>
