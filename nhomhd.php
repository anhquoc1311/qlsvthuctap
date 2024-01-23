<?php
$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');
 include('fpdf.php');
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

if (!function_exists('sanitize')) {
    function sanitize($data)
    {
        return htmlspecialchars(strip_tags($data));
    }
}

// Thêm bản ghi
if (isset($_POST['add'])) {
    $tennguoihuongdan = sanitize($_POST['tennguoihuongdan']);
    $tennhomthuctap = sanitize($_POST['tennhomthuctap']);
    $kithuctap = sanitize($_POST['kithuctap']);
    $tendetai = sanitize($_POST['tendetai']);
    $thoigianbatdau = $_POST['thoigianbatdau'];
    $thoigianketthuc = $_POST['thoigianketthuc'];

    $insert_query = "INSERT INTO nhomnguoihd (tennguoihuongdan, tennhomthuctap, kithuctap, tendetai, thoigianbatdau, thoigianketthuc) 
                     VALUES ('$tennguoihuongdan', '$tennhomthuctap', '$kithuctap', '$tendetai', '$thoigianbatdau', '$thoigianketthuc')";
    
    $result = $mysqli->query($insert_query);
    
    if ($result) {
        echo "Bản ghi được thêm thành công!";
    } else {
        echo "Lỗi: " . $mysqli->error;
    }
}

// Xóa bản ghi
if (isset($_POST['delete'])) {
    $id_to_delete = $_POST['id_to_delete'];
    
    $delete_query = "DELETE FROM nhomnguoihd WHERE id_nhomnguoihd = $id_to_delete";
    
    $result = $mysqli->query($delete_query);
    
    if ($result) {
        echo "Bản ghi đã được xóa thành công!";
    } else {
        echo "Lỗi: " . $mysqli->error;
    }
}

// Cập nhật bản ghi
if (isset($_POST['update'])) {
    $id_to_update = $_POST['id_to_update'];
    $tennguoihuongdan = sanitize($_POST['tennguoihuongdan']);
    $tennhomthuctap = sanitize($_POST['tennhomthuctap']);
    $kithuctap = sanitize($_POST['kithuctap']);
    $tendetai = sanitize($_POST['tendetai']);
    $thoigianbatdau = $_POST['thoigianbatdau'];
    $thoigianketthuc = $_POST['thoigianketthuc'];

    $update_query = "UPDATE nhomnguoihd 
                     SET tennguoihuongdan='$tennguoihuongdan', tennhomthuctap='$tennhomthuctap', kithuctap='$kithuctap', tendetai='$tendetai', 
                         thoigianbatdau='$thoigianbatdau', thoigianketthuc='$thoigianketthuc' 
                     WHERE id_nhomnguoihd = $id_to_update";
    
    $result = $mysqli->query($update_query);
    
    if ($result) {
        echo "Bản ghi đã được cập nhật thành công!";
    } else {
        echo "Lỗi: " . $mysqli->error;
    }
}

if (isset($_POST['export_pdf'])) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);

    $select_query = "SELECT * FROM nhomnguoihd WHERE id_nhomnguoihd >= 0 AND id_nhomnguoihd <= 999";
    $result = $mysqli->query($select_query);

    if ($result->num_rows > 0) {
        $pdf->Cell(10, 7, 'ID', 1);
        $pdf->Cell(40, 7, 'Tên Người Hướng Dẫn', 1);
        $pdf->Cell(40, 7, 'Tên Nhóm Thực Tập', 1);
        $pdf->Cell(20, 7, 'Kì Thực Tập', 1);
        $pdf->Cell(40, 7, 'Tên Đề Tài', 1);
        $pdf->Cell(30, 7, 'Thời Gian Bắt Đầu', 1);
        $pdf->Cell(30, 7, 'Thời Gian Kết Thúc', 1);
        $pdf->Ln();

        while ($row = $result->fetch_assoc()) {
            $pdf->Cell(10, 7, $row['id_nhomnguoihd'], 1);
            $pdf->Cell(40, 7, $row['tennguoihuongdan'], 1);
            $pdf->Cell(40, 7, $row['tennhomthuctap'], 1);
            $pdf->Cell(20, 7, $row['kithuctap'], 1);
            $pdf->Cell(40, 7, $row['tendetai'], 1);
            $pdf->Cell(30, 7, $row['thoigianbatdau'], 1);
            $pdf->Cell(30, 7, $row['thoigianketthuc'], 1);
            $pdf->Ln();
        }

        $pdf->Output('export.pdf', 'D'); // Download the PDF file
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Nhóm HD</title>
</head>
<body>
<form method="post" action="nhomhd.php">
    <input type="submit" name="export_pdf" value="Xuất PDF">
</form>
<h2>Thêm Bản Ghi</h2>
<form method="post" action="nhomhd.php">
    <label>Tên Người Hướng Dẫn:</label>
    <input type="text" name="tennguoihuongdan" required><br>

    <label>Tên Nhóm Thực Tập:</label>
    <input type="text" name="tennhomthuctap" required><br>

    <label>Kì Thực Tập:</label>
    <input type="text" name="kithuctap" required><br>

    <label>Tên Đề Tài:</label>
    <input type="text" name="tendetai" required><br>

    <label>Thời Gian Bắt Đầu:</label>
    <input type="datetime-local" name="thoigianbatdau" required><br>

    <label>Thời Gian Kết Thúc:</label>
    <input type="datetime-local" name="thoigianketthuc" required><br>

    <input type="submit" name="add" value="Thêm Bản Ghi">
</form>

<h2>Xóa Bản Ghi</h2>
<form method="post" action="nhomhd.php">
    <label>ID cần Xóa:</label>
    <input type="number" name="id_to_delete" required><br>
    <input type="submit" name="delete" value="Xóa Bản Ghi">
</form>

<?php
// Nếu có ID được chọn để sửa
if (isset($_GET['id_to_update'])) {
    $id_to_update = $_GET['id_to_update'];

    // Lấy thông tin của bản ghi cần sửa
    $select_update_query = "SELECT * FROM nhomnguoihd WHERE id_nhomnguoihd = $id_to_update";
    $update_result = $mysqli->query($select_update_query);

    if ($update_result->num_rows > 0) {
        $row = $update_result->fetch_assoc();
?>
        <h2>Cập Nhật Bản Ghi</h2>
        <form method="post" action="nhomhd.php">
            <input type="hidden" name="id_to_update" value="<?php echo $row['id_nhomnguoihd']; ?>">
            <label>Tên Người Hướng Dẫn:</label>
            <input type="text" name="tennguoihuongdan" value="<?php echo $row['tennguoihuongdan']; ?>" required><br>

            <label>Tên Nhóm Thực Tập:</label>
            <input type="text" name="tennhomthuctap" value="<?php echo $row['tennhomthuctap']; ?>" required><br>

            <label>Kì Thực Tập:</label>
            <input type="text" name="kithuctap" value="<?php echo $row['kithuctap']; ?>" required><br>

            <label>Tên Đề Tài:</label>
            <input type="text" name="tendetai" value="<?php echo $row['tendetai']; ?>" required><br>

            <label>Thời Gian Bắt Đầu:</label>
            <input type="datetime-local" name="thoigianbatdau" value="<?php echo $row['thoigianbatdau']; ?>" required><br>

            <label>Thời Gian Kết Thúc:</label>
            <input type="datetime-local" name="thoigianketthuc" value="<?php echo $row['thoigianketthuc']; ?>" required><br>

            <input type="submit" name="update" value="Cập Nhật Bản Ghi">
        </form>
<?php
    }
}
?>

<h2>Danh Sách Bản Ghi</h2>
<?php
$select_query = "SELECT * FROM nhomnguoihd WHERE id_nhomnguoihd >= 0 AND id_nhomnguoihd <= 999";
$result = $mysqli->query($select_query);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Tên Người Hướng Dẫn</th><th>Tên Nhóm Thực Tập</th><th>Kì Thực Tập</th><th>Tên Đề Tài</th><th>Thời Gian Bắt Đầu</th><th>Thời Gian Kết Thúc</th><th>Sửa</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id_nhomnguoihd'] . "</td>";
        echo "<td>" . $row['tennguoihuongdan'] . "</td>";
        echo "<td>" . $row['tennhomthuctap'] . "</td>";
        echo "<td>" . $row['kithuctap'] . "</td>";
        echo "<td>" . $row['tendetai'] . "</td>";
        echo "<td>" . $row['thoigianbatdau'] . "</td>";
        echo "<td>" . $row['thoigianketthuc'] . "</td>";
        echo "<td><a href='nhomhd.php?id_to_update=" . $row['id_nhomnguoihd'] . "'>Sửa</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Không có bản ghi nào được tìm thấy";
}

$mysqli->close();
?>
</body>
</html>
