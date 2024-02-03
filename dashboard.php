<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard</title>
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
</head>

<body>
    <h1> Dashboard</h1>

    <?php
    $mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }

    function executeQuery($sql)
    {
        global $mysqli;
        $result = $mysqli->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    $tables = ['congviec', 'danhgia', 'kythuctap', 'nganh', 'nguoihuongdan', 'nhomnguoihd', 'nhomtt', 'sinhvien', 'tendetai', 'truong'];

    foreach ($tables as $table) {
        $query = "SELECT * FROM $table";
        $data = executeQuery($query);

        echo "<h2>$table Table</h2>";
        if (!empty($data)) {
            echo '<table>';
            echo '<tr>';
            foreach ($data[0] as $key => $value) {
                echo '<th>' . htmlspecialchars($key) . '</th>';
            }
            echo '</tr>';
            foreach ($data as $row) {
                echo '<tr>';
                foreach ($row as $value) {
                    echo '<td>' . htmlspecialchars($value) . '</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No data available.</p>';
        }
    }

    $mysqli->close();
    ?>
</body>

</html>
<p><a href="index.php">Quay lại trang chủ!</a></p>