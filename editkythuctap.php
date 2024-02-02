<?php
$conn = mysqli_connect('localhost', 'root', '', 'quanlysvtt');
if (mysqli_connect_error()) {
    die('Kết nối đến cơ sở dữ liệu thất bại: ' . mysqli_connect_error());
}

$id = $_GET['id'];
$loi1 = "";

$sql = "SELECT * FROM kythuctap WHERE id_kythuctap='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$tenkythuctapcu = $row["tenkythuctap"];

if (isset($_POST['submit'])) {
    $tenkythuctap = $_POST['tenkythuctap'];
    $mota = $_POST['mota'];

    if ($tenkythuctap != $tenkythuctapcu) {
        $sql_check = "SELECT * FROM kythuctap WHERE tenkythuctap = '$tenkythuctap'";
        $result_check = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            $loi1 = 'Tên kỳ thực tập đã tồn tại!';
        }
    }

    if (empty($loi1)) {
        $sql = "UPDATE kythuctap SET tenkythuctap ='$tenkythuctap', mota='$mota' WHERE id_kythuctap='$id'";
        $result = mysqli_query($conn, $sql);
        header("Location: danhsachkythuctap.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sửa Kỳ Thực Tập</title>
    <!-- Include necessary stylesheets or scripts -->
</head>
<body>
    <!-- Display the form for editing -->
    <form method="post">
        <label>Tên kỳ thực tập</label><br>
        <input type="text" name="tenkythuctap" value="<?php echo $row['tenkythuctap']; ?>" required><br>

        <label>Mô tả</label><br>
        <textarea name="mota" required><?php echo $row['mota']; ?></textarea><br>

        <button type="submit" name="submit">Cập nhật</button>
        <a href="danhsachkythuctap.php"><button type="button">Quay Về</button></a>
        <?php if (!empty($loi1)) { ?>
            <div style="text-align:center;line-height:50px;font-size:16px; margin-top:5px;margin-left:0%;
                height:50px;color:white;width:100%;border-radius:6px;background-color:red">
                <i class="fa-solid fa-triangle-exclamation"></i> <?php echo $loi1; ?>
            </div>
        <?php } ?>
    </form>
</body>
</html>
