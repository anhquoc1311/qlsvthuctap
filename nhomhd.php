<?php
$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}
$successNotification = "";
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
        $successNotification = "Thêm nhóm người hướng dẫn thành công.";
    } else {
         $successNotification = "<span style='color: red;'>Thêm không thành công ! " . $mysqli->error . "</span>";
    }
}

// Xóa bản ghi
if (isset($_POST['delete'])) {
    $id_to_delete = $_POST['id_to_delete'];

    $delete_query = "DELETE FROM nhomnguoihd WHERE id_nhomnguoihd = $id_to_delete";

    $result = $mysqli->query($delete_query);

    if ($result) {
        $successNotification = "Xoá thành công.";
    } else {
        $successNotification = "<span style='color: red;'>Xoá thất bại! " . $mysqli->error . "</span>";
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
         $successNotification = "Cập nhật thành công.";
    } else {
         $successNotification = "<span style='color: red;'>Cập nhật thất bại! " . $mysqli->error . "</span>";
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
        background-color: #f0f7f9; /* Màu nền xanh dương */
        color: #333; /* Màu chữ trắng */
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
        color: white;
    }

    tr:nth-child(even) {
        background-color: #e1edf4; /* Màu nền xanh dương cho các hàng chẵn */
    }

    tr:nth-child(odd) {
        background-color: #d4e5f7; /* Màu nền xanh dương đậm cho các hàng lẻ */
    }

    a {
        color: #2072b3; /* Màu chữ trắng cho các liên kết */
    }

    a:hover {
        color: #ff6600; /* Màu chữ khi di chuột qua liên kết */
    }

    form {
        margin-top: 20px;
    }

    h2 {
        color: #2072b3; /* Màu chữ trắng cho tiêu đề h2 */
    }

    input[type="text"], input[type="password"], input[type="email"], select {
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
    .form {
            background: linear-gradient(rgba(135, 206, 250, 0), rgba(135, 204, 250, 0.7));
            width: 700px;
            margin: 0 auto;
            text-align: center;
            padding: 20px; /* Thêm khoảng cách xung quanh form */
            border: 1px solid #ccc; /* Thêm đường viền */
            border-radius: 10px; /* Bo góc của form */
        }
    .form input {
        width: 216PX;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: center;
        margin-top: 5px;
    }
    .form label {
        display: inline-block;
        width: 181px;
        text-align: right;
        margin-right: 10px;
        font-weight: bold;
    }
    .form select{
        width: 215px;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: center;

    }
    h2 {
        text-align: center;
        color: blue;
        font-size: 30px;
        /* background: cadetblue; */
        font-weight: bolder;
    }
    h3 {
        color: black;
        font-size: x-large; 
        font-weight: bolder;
    }
    button {
        display: inline-block;
        /* width: calc(45% - 5px); */
        margin-right: 10px;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 130px;
       
    }
    button {
        margin-top: 20px;
    }
    .btndel {
        background-color: red;
        border: 1px solid black;
        cursor: pointer;
        font-size: 15px;
        border-radius: 3PX;
        opacity: 0.7;
        width: 41px;
        height: 40px;
        }
        .btndel:hover ,.btnedit:hover{
          opacity: 1;
        }
        .btnedit{
          background-color: #337ab7;
          border: 1px solid black;
          cursor: pointer;
          font-size: 15px;
          border-radius: 3PX;
          opacity: 0.7;
          width: 41px;
          height: 40px;
        }
        td form {
            display: inline-block;
            margin-right: 10px;
        }
        .home {
            background: #04AA6D;
            /* width: auto; */
            width: 90px;
            margin-top: 20px;
            margin-left: 29px;
            /* text-decoration: none; */
            font-size: 20px;
            border-radius: 8px;
        }
        a {
            color: white;
            text-decoration: none;
        }
        .xoa {
            text-align: center;
            /* padding-top: 5px; */
        }
        input[type="number"] {
            height: 30px;
        }
        a {
            color: black;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
</head>
<body>
<div class="home">
        <a href="index.php"> < Home</a>
    </div>
   
<h2>Thêm Bản Ghi</h2>
<div class="form">
<form method="post" action="nhomhd.php">
    <label>Tên Người Hướng Dẫn:</label>
    <input type="text" name="tennguoihuongdan" required><br>
    <label>Tên Nhóm Thực Tập:</label>
    <select name="tennhomthuctap"  required>
        <?php
        $nhomttOptions = getNhomttOptions();
        foreach ($nhomttOptions as $id => $tennhom) {
            echo "<option value=\"$id\">$tennhom</option>";
        }
        ?>
    </select>
    <br>

    <label>Kì Thực Tập:</label>
    <select name="kithuctap"  required>
        <?php
        $kythuctapOptions = getKythuctapOptions();
        foreach ($kythuctapOptions as $id => $tenkythuctap) {
            echo "<option value=\"$id\">$tenkythuctap</option>";
        }
        ?>
    </select><br>

    <label>Tên Đề Tài:</label>
    <select name="tendetai"  required>
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

    <button type="submit" name="add" >Thêm nhóm hướng dẫn</button>
</form>
    <?php if (!empty($successNotification)): ?>
            <div id="successNotification" style="color: green;"><?php echo $successNotification; ?></div>
            <script>
            setTimeout(function() {
            var successNotification = document.getElementById('successNotification');
            if (successNotification) {
                successNotification.style.display = 'none';
            }
        }, 2000); // 2000 milliseconds = 2 seconds
    </script>
    <?php endif; ?>
</div>

<h2>Xóa nhóm hướng dẫn</h2>
<div class="xoa">
<form method="post" action="nhomhd.php">
    <label>ID cần Xóa:</label>
    <input type="number" name="id_to_delete" required><br>
    <button type="submit" name="delete" >Xóa nhóm hướng dẫn</button>
</form>
</div>

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
<h2>Cập Nhật danh sách</h2>
<div class="form">
    <form method="post" action="nhomhd.php">
        <input type="hidden" name="id_to_update" value="<?php echo $row['id_nhomnguoihd']; ?>">
        <label>Tên Người Hướng Dẫn:</label>
            <input type="text" name="tennguoihuongdan" value="<?php echo $row['tennguoihuongdan']; ?>" required><br>

        <label>Tên Nhóm Thực Tập:</label>
        <select name="tennhomthuctap"  required>
            <?php
            foreach ($nhomttOptions as $id => $tennhom) {
                    $selected = ($id == $row['tennhomthuctap']) ? 'selected' : '';
                        echo "<option value=\"$id\" $selected>$tennhom</option>";
                    }
            ?>
        </select><br>

        <label for="kithuctap">Kỳ thực tập:</label>
        <select name="kithuctap"  required>
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

        <button type="submit" name="update" >Cập Nhật danh sách</button>
        </form>
    </div>
        <?php
        }
    }
?>

<h2>Danh Sách nhóm hướng dẫn</h2>
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

        echo "<td><a href='nhomhd.php?id_to_update=" . $row['id_nhomnguoihd'] . "'>
            <button class='btnedit'><i class='fa-solid fa-pen-to-square'></i></button>
        </a>
        </td>";

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
 <div class="w3-footer"><hr>
    <span class="text-sm text-blue" style="font-size:12px ; color: #0073B7">
            <p>TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG</p>
            <p>Địa chỉ: 73 Nguyễn Huệ, phường 2, thành phố Vỉnh Long, tỉnh Vỉnh Long<br>
            Điện thoại: (+84) 02703.822141 - Fax: (+84) 02703.821003 - Email: spktvl@vlute.edu.vn</p>
        </span>
    </div>
</html>
