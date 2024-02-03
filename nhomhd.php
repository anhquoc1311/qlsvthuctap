<?php
$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

if (!function_exists('sanitize')) {
    function sanitize($data)
    {
        return htmlspecialchars(strip_tags($data));
    }
}

// Function to get options from kythuctap table
function getKythuctapOptions()
{
    global $mysqli;
    $options = array();

    $query = "SELECT * FROM kythuctap";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options[$row['tenkythuctap']] = $row['tenkythuctap']; // Sửa ở đây để trả về tên thực tập
        }
    }

    return $options;
}

// Function to get options from nhomtt table
function getNhomttOptions()
{
    global $mysqli;
    $options = array();

    $query = "SELECT * FROM nhomtt";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options[$row['tennhom']] = $row['tennhom']; // Sửa ở đây để trả về tên nhóm
        }
    }

    return $options;
}

// Function to get options from tendetai table
function getTendetaiOptions()
{
    global $mysqli;
    $options = array();

    $query = "SELECT * FROM tendetai";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options[$row['tendetai']] = $row['tendetai'];
        }
    }

    return $options;
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Nhóm HD</title>
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
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Select2 CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

    <!-- Initialize Select2 for the "kithuctap", "tennhomthuctap", and "tendetai" dropdowns -->
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
</head>
<body>

<h2>Thêm Bản Ghi</h2>
<form method="post" action="nhomhd.php">
    <label>Tên Người Hướng Dẫn:</label>
    <input type="text" name="tennguoihuongdan" required><br>

    <label>Tên Nhóm Thực Tập:</label>
    <select name="tennhomthuctap" class="select2" required>
        <?php
        $nhomttOptions = getNhomttOptions();
        foreach ($nhomttOptions as $id => $tennhom) {
            echo "<option value=\"$id\">$tennhom</option>";
        }
        ?>
    </select><br>

    <label>Kì Thực Tập:</label>
    <select name="kithuctap" class="select2" required>
        <?php
        $kythuctapOptions = getKythuctapOptions();
        foreach ($kythuctapOptions as $id => $tenkythuctap) {
            echo "<option value=\"$id\">$tenkythuctap</option>";
        }
        ?>
    </select><br>

    <label>Tên Đề Tài:</label>
    <select name="tendetai" class="select2" required>
        <?php
        $tendetaiOptions = getTendetaiOptions();
        foreach ($tendetaiOptions as $tendetai) {
            echo "<option value=\"$tendetai\">$tendetai</option>";
        }
        ?>
    </select><br>

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
            <select name="tennhomthuctap" class="select2" required>
                <?php
                foreach ($nhomttOptions as $id => $tennhom) {
                    $selected = ($id == $row['tennhomthuctap']) ? 'selected' : '';
                    echo "<option value=\"$id\" $selected>$tennhom</option>";
                }
                ?>
            <label for="tennhomthuctap">Nhóm thực tập:</label>
<select name="tennhomthuctap" class="select2" required>
    <?php
    $nhomttOptions = getNhomttOptions();
    foreach ($nhomttOptions as $tennhom) {
        echo "<option value=\"$tennhom\">$tennhom</option>";
    }
    ?>
</select><br>

<label for="kithuctap">Kỳ thực tập:</label>
<select name="kithuctap" class="select2" required>
    <?php
    $kythuctapOptions = getKythuctapOptions();
    foreach ($kythuctapOptions as $tenkythuctap) {
        echo "<option value=\"$tenkythuctap\">$tenkythuctap</option>";
    }
    ?>
</select><br>

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

        // Additional row for detailed information
        echo "<tr style='display:none;'>";
        echo "<td colspan='7'>";
        echo "<strong>Thông Tin Chi Tiết:</strong><br>";
        echo "<strong>Tên Người Hướng Dẫn:</strong> " . $row['tennguoihuongdan'] . "<br>";
        echo "<strong>Tên Nhóm Thực Tập:</strong> " . $row['tennhomthuctap'] . "<br>";
        echo "<strong>Kì Thực Tập:</strong> " . $row['kithuctap'] . "<br>";
        echo "<strong>Tên Đề Tài:</strong> " . $row['tendetai'] . "<br>";
        echo "<strong>Thời Gian Bắt Đầu:</strong> " . $row['thoigianbatdau'] . "<br>";
        echo "<strong>Thời Gian Kết Thúc:</strong> " . $row['thoigianketthuc'] . "<br>";
        echo "</td>";
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
<p><a href="index.php">Quay lại trang chủ!</a></p>