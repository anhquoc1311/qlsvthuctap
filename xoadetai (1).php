<?php
    $conn = mysqli_connect('localhost', 'root','', 'quanlysvtt');
    if (mysqli_connect_error()) {
      die('Kết nối đến cơ sở dữ liệu thất bại: ' . mysqli_connect_error());
    }
    $id = $_GET['id'];
    $sql = "DELETE FROM detai WHERE id_detai = $id";
    $qr = mysqli_query($conn, $sql);
    header('location: danhsachdetai.php');
?>