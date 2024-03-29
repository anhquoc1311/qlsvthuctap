<?php
include('config/connect.php');

if ($mysqli->connect_error) {
    die('Kết nối không thành công: ' . $mysqli->connect_error);
}

// Add công việc
if (isset($_POST['submit_add'])) {
    $tencongviec = $_POST['tencongviec'];
    $tendetai = $_POST['tendetai'];
    $tennhomnguoihuongdan = $_POST['tennhomnguoihuongdan'];
    $ngaybatdau = $_POST['ngaybatdau'];
    $ngayketthuc = $_POST['ngayketthuc'];
    $nhanxet = $_POST['nhanxet'];

    $insertQuery = "INSERT INTO congviec (tencongviec, tendetai, tennhomnguoihuongdan, ngaybatdau, ngayketthuc, nhanxet) 
                    VALUES ('$tencongviec', '$tendetai', '$tennhomnguoihuongdan', '$ngaybatdau', '$ngayketthuc', '$nhanxet')";

    if ($mysqli->query($insertQuery) === TRUE) {
        $successNotification = "Thêm công việc thành công.";
    } else {
        $successNotification = "<span style='color: red;'>Thêm công việc thất bại!" . $mysqli->error . "</span>";
    }
}

// Delete công việc
if (isset($_POST['delete'])) {
        $id = $_POST['delete_id'];
        if ($mysqli->query("DELETE FROM congviec WHERE id_cv=$id")) {
             $successNotification = "Xóa công việc thành công.";
        } else {
            $successNotification = "<span style='color: red;'>Xoá công việc thất bại!" . $mysqli->error . "</span>";
        }
    }

// Edit công việc
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    $selectEditQuery = "SELECT c.*, d.tendetai FROM congviec c
                        JOIN tendetai d ON c.tendetai = d.tendetai
                        WHERE c.id_cv = $edit_id";
    $editResult = $mysqli->query($selectEditQuery);
    $editData = $editResult->fetch_assoc();
}

// Update công việc
if (isset($_POST['submit_update'])) {
    $edit_id = $_POST['edit_id'];
    $tencongviec = $_POST['tencongviec'];
    $tendetai = $_POST['tendetai'];
    $tennhomnguoihuongdan = $_POST['tennhomnguoihuongdan'];
    $ngaybatdau = $_POST['ngaybatdau'];
    $ngayketthuc = $_POST['ngayketthuc'];
    $nhanxet = $_POST['nhanxet'];

    $updateQuery = "UPDATE congviec 
                    SET tencongviec = '$tencongviec', tendetai = '$tendetai', tennhomnguoihuongdan = '$tennhomnguoihuongdan',
                        ngaybatdau = '$ngaybatdau', ngayketthuc = '$ngayketthuc', nhanxet = '$nhanxet' 
                    WHERE id_cv = $edit_id";

    if ($mysqli->query($updateQuery) === TRUE) {
        $successNotification = "Cập nhật công việc thành công.";
    } else {
        $successNotification = "<span style='color: red;'>Cập nhật công việc thất bại!" . $mysqli->error . "</span>";
    }
}

// Display danh sách công việc
$selectQuery = "SELECT c.*, d.tendetai FROM congviec c
                JOIN tendetai d ON c.tendetai = d.tendetai";
$result = $mysqli->query($selectQuery);

// Fetch tên đề tài for dropdown
$detaiQuery = "SELECT * FROM tendetai";
$detaiResult = $mysqli->query($detaiQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <title>Quản lý công việc</title>
</head>
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
            width: auto;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;

        }
    .form label {
        display: inline-block;
        width: 150px; 
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
        font-weight: bold;
        font-size: 30px;
    }
    h3 {
        color: black;
        font-size: x-large; 
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
        /* text-align: center; */
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
        input[type="text"] {
            width: 212px;
            margin-bottom: 6px;
        }
        input[type="date"] {
            width: 213px;
            margin-bottom: 6px;
        }
        .home {
            background: #04AA6D;
            /* width: auto; */
            width: 77px;
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
    </style>
<body>

<div class="home">
        <a href="index.php"> < Home</a>
    </div>
<h2>Thêm công việc mới</h2>
<div class="form">
<form method="post" action="themxoasuacv.php">
    <label for="tencongviec">Tên công việc:</label>
    <input type="text" name="tencongviec" required><br>

    <label for="tendetai">Tên đề tài:</label>
    <select name="tendetai">
        <?php $detaiResult = $mysqli->query($detaiQuery); ?>
        <?php while ($row = $detaiResult->fetch_assoc()) : ?>
            <option value="<?php echo $row['tendetai']; ?>"><?php echo $row['tendetai']; ?></option>
        <?php endwhile; ?>
    </select><br>

    <label for="tennhomnguoihuongdan">Tên nhóm người hướng dẫn:</label>
    <select name="tennhomnguoihuongdan" required>
    <?php
    // Query to fetch distinct values for 'tennhomnguoihuongdan' from your database
    $nhomQuery = "SELECT DISTINCT tennguoihuongdan FROM nhomnguoihd";
    $nhomResult = $mysqli->query($nhomQuery);

    // Check if the query was successful
    if ($nhomResult) {
        while ($row = $nhomResult->fetch_assoc()) {
            $selected = ($row['tennguoihuongdan'] == $editData['tennguoihuongdan']) ? 'selected' : '';
            echo "<option value='{$row['tennguoihuongdan']}' $selected>{$row['tennguoihuongdan']}</option>";
        }
    }
    ?>
    </select><br>

    <label for="ngaybatdau">Ngày bắt đầu:</label>
    <input type="date" name="ngaybatdau" required><br>

    <label for="ngayketthuc">Ngày kết thúc:</label>
    <input type="date" name="ngayketthuc" required><br>

    <label for="nhanxet">Nhận xét:</label>
    <input type="text" name="nhanxet" required><br>

    <button type="submit" name="submit_add" >Thêm </button>
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


<h2>Danh sách công việc</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Tên công việc</th>
        <th>Tên đề tài</th>
        <th>Tên nhóm người hướng dẫn</th>
        <th>Ngày bắt đầu</th>
        <th>Ngày kết thúc</th>
        <th>Nhận xét</th>
        <th>Thao tác</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo $row['id_cv']; ?></td>
            <td><?php echo $row['tencongviec']; ?></td>
            <td><?php echo $row['tendetai']; ?></td>
            <td><?php echo $row['tennhomnguoihuongdan']; ?></td>
            <td><?php echo $row['ngaybatdau']; ?></td>
            <td><?php echo $row['ngayketthuc']; ?></td>
            <td><?php echo $row['nhanxet']; ?></td>
            <td>
                <!-- <a href="themxoasuacv.php?delete_id=<?php echo $row['id_cv']; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?')"><i class='fa-solid fa-trash-can'></i></a> -->
                <form method='POST' onsubmit='return confirm("Bạn có chắc chắn muốn xoá công việc này không?");'>
                <input type='hidden' name='delete_id' value='<?php echo $row['id_cv']; ?>'>
                <button class='btndel' name='delete'><i class='fa-solid fa-trash-can'></i></button>

            </form>

                <a href='suacongviec.php?edit_id=<?php echo $row['id_cv']; ?>' class='edit'>
                    <button class='btnedit'><i class='fa-solid fa-pen-to-square'></i></button>
                </a>

            </td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
<div class="w3-footer"><hr>
        <span class="text-sm text-blue" style="font-size:12px ; color: #0073B7">
            <p>TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG</p>
            <p>Địa chỉ: 73 Nguyễn Huệ, phường 2, thành phố Vỉnh Long, tỉnh Vỉnh Long<br>
            Điện thoại: (+84) 02703.822141 - Fax: (+84) 02703.821003 - Email: spktvl@vlute.edu.vn</p>
        </span>
    </div>
<?php
// Đóng kết nối
$mysqli->close();
?>
