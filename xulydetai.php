<?php
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

// Check connection
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tendetai = $_POST["tendetai"];
    $mota = $_POST["mota"];

    if ($_GET["action"] == "them") {
        // Kiểm tra xem đề tài đã tồn tại hay chưa
        $checkSql = "SELECT * FROM tendetai WHERE tendetai='$tendetai'";
        $checkResult = $mysqli->query($checkSql);

        if ($checkResult->num_rows > 0) {
            echo "Đề tài đã tồn tại. Vui lòng chọn tên đề tài khác.";
        } else {
            // Thêm đề tài mới
            $sql = "INSERT INTO tendetai (tendetai, mota) VALUES ('$tendetai', '$mota')";
            
            if ($mysqli->query($sql) === TRUE) {
                header("Location: quandetai.php?success=them"); // Redirect with success parameter
                exit();
            } else {
                echo "Lỗi: " . $sql . "<br>" . $mysqli->error;
            }
        }
    } elseif ($_GET["action"] == "sua" && isset($_GET["id"])) {
        // Sửa thông tin đề tài
        $idSua = $_GET["id"];
        $sql = "UPDATE tendetai SET tendetai='$tendetai', mota='$mota' WHERE tendetai='$idSua'";
        
        if ($mysqli->query($sql) === TRUE) {
            header("Location: quandetai.php?success=sua"); // Redirect with success parameter
            exit();
        } else {
            echo "Lỗi: " . $sql . "<br>" . $mysqli->error;
        }
    }
} elseif ($_GET["action"] == "xoa" && isset($_GET["id"])) {
    // Xóa đề tài
    $tendetai = $_GET["id"];
    $sql = "DELETE FROM tendetai WHERE tendetai='$tendetai'";

    if ($mysqli->query($sql) === TRUE) {
        header("Location: quandetai.php?success=xoa"); // Redirect with success parameter
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $mysqli->error;
    }
}

$mysqli->close();
?>
