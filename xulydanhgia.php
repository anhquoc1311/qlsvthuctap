<?php
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'quanlysvtt');

// Check connection
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoten = $_POST["hoten"];
    $mucdo = $_POST["mucdo"];
    $nhanxet = $_POST["nhanxet"];
    $danhgiakhac = $_POST["danhgiakhac"];

    // Chèn dữ liệu vào cơ sở dữ liệu
    $sql = "INSERT INTO danhgiaandanh (hoten_nguoidanhgia, mucdohailong, `nhận xet`, danhgiakhac)
            VALUES ('$hoten', '$mucdo', '$nhanxet', '$danhgiakhac')";

    if ($mysqli->query($sql) === TRUE) {
        echo "Cảm ơn bạn đã góp phần đánh giá!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
}
?>
