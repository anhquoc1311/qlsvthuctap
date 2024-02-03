<?php
$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

echo "<h2>Kết Quả Tìm Kiếm</h2>";

// Check if the search form is submitted
if (isset($_POST['search'])) {
    // Get the search term from the form
    $tendetai = $_POST['tendetai'];

    // Build the SQL query
    $search_query = "SELECT * FROM nhomnguoihd";
    
    // Check if a search term is provided
    if (!empty($tendetai)) {
        $search_query .= " WHERE tendetai LIKE '%$tendetai%'";
    }

    // Execute the query
    $search_result = $mysqli->query($search_query);

    // Check if the query was successful
    if ($search_result) {
        // Check if there are any results
        if ($search_result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Tên Nhóm Thực Tập</th><th>Kì Thực Tập</th><th>Tên Đề Tài</th><th>Thời Gian Bắt Đầu</th><th>Thời Gian Kết Thúc</th></tr>";

            // Fetch and display the results
            while ($row = $search_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_nhomnguoihd'] . "</td>";
                echo "<td>" . $row['tennhomthuctap'] . "</td>";
                echo "<td>" . $row['kithuctap'] . "</td>";
                echo "<td>" . $row['tendetai'] . "</td>";
                echo "<td>" . $row['thoigianbatdau'] . "</td>"; // Assuming 'thoigianbatdau' is the column name for start time
                echo "<td>" . $row['thoigianketthuc'] . "</td>"; // Assuming 'thoigianketthuc' is the column name for end time
                echo "</tr>";
            }

            echo "</table>";
        } else {
            // Display a message if no results are found
            echo "Không có kết quả tìm kiếm.";
        }
    } else {
        // Display an error message if the query fails
        echo "Error executing the query: " . $mysqli->error;
    }
}

// Close the database connection
$mysqli->close();
?>
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
<p><a href="index.php">Quay lại trang chủ!</a></p>