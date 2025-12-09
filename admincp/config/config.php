<?php
    $mysqli = new mysqli("localhost","root","","wed_mysqli");

    // --- Thêm dòng này vào để sửa lỗi tiếng Việt ---
    $mysqli->set_charset("utf8"); 
    // ----------------------------------------------

    if($mysqli->connect_errno){
        echo "Kết nối không thành công" . $mysqli->connect_error;
        exit();
    }
?>