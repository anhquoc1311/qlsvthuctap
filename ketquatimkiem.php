<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <title></title>
</head>
<style>
    body {
                background-color: #f0f7f9; /* Màu nền xanh dương */
                color: #333; /* Màu chữ trắng */
                font-family: Arial, sans-serif; /* Kiểu font chữ */
                margin: 0;
                padding: 0;
                margin-top: 28px;
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
                .home {
                    background: #04AA6D;
                    /* width: auto; */
                    width: 100px;
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
        <a href="timkiem.php"> < Quay về</a>
    </div>
</body>
</html>
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
<div class="w3-footer"><hr>
        <span class="text-sm text-blue" style="font-size:12px ; color: #0073B7">
            <p>TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG</p>
            <p>Địa chỉ: 73 Nguyễn Huệ, phường 2, thành phố Vỉnh Long, tỉnh Vỉnh Long<br>
            Điện thoại: (+84) 02703.822141 - Fax: (+84) 02703.821003 - Email: spktvl@vlute.edu.vn</p>
        </span>
</div>