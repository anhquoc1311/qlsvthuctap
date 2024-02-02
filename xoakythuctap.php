<?php
$conn = mysqli_connect('localhost', 'root', '', 'quanlysvtt');
if (mysqli_connect_error()) {
    die('Kết nối đến cơ sở dữ liệu thất bại: ' . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id_kythuctap = $_GET['id'];

    // Perform the delete query
    $sql_delete = "DELETE FROM kythuctap WHERE id_kythuctap = $id_kythuctap";
    $result_delete = mysqli_query($conn, $sql_delete);

    if ($result_delete) {
        echo 'Xóa kỳ thực tập thành công!';
    } else {
        echo 'Có lỗi xảy ra khi xóa kỳ thực tập.';
    }
} else {
    echo 'Không có ID được chọn.';
    exit;
}
?>
