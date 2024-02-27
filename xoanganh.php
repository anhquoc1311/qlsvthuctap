<?php
$conn = mysqli_connect('localhost', 'root', '', 'quanlysvtt');
if (mysqli_connect_error()) {
    die('Kết nối đến cơ sở dữ liệu thất bại: ' . mysqli_connect_error());
}

$id = $_GET['id'];

// Use a prepared statement to prevent SQL injection
$sql = "DELETE FROM nganh WHERE tennganh = ?";
$stmt = $conn->prepare($sql);

// Bind the parameter
$stmt->bind_param("s", $id);

// Execute the statement
if ($stmt->execute()) {
    header('location: themnganh.php');
} else {
    echo "Xoá dữ liệu thất bại: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
