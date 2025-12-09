<?php
if (isset($_POST['dangky'])) {
    $tenkhachhang = trim($_POST['hovaten']);
    $email = trim($_POST['email']);
    $dienthoai = trim($_POST['dienthoai']);
    $matkhau_raw = trim($_POST['matkhau']);
    $diachi = trim($_POST['diachi']);

    if ($tenkhachhang == "" || $email == "" || $dienthoai == "" || $matkhau_raw == "" || $diachi == "") {
        echo '<p style="color:red">Vui lòng điền đầy đủ thông tin!</p>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<p style="color:red">Email không hợp lệ!</p>';
    } elseif (!preg_match('/^[0-9]{9,11}$/', $dienthoai)) {
        echo '<p style="color:red">Số điện thoại không hợp lệ!</p>';
    } elseif (strlen($matkhau_raw) < 6) {
        echo '<p style="color:red">Mật khẩu phải có ít nhất 6 ký tự!</p>';
    } else {
        // Kiểm tra email
        $kiemtra_email = mysqli_query($mysqli, "SELECT * FROM tbl_dangky WHERE email='$email' LIMIT 1");
        if (mysqli_num_rows($kiemtra_email) > 0) {
            echo '<p style="color:red">Email đã tồn tại. Vui lòng dùng email khác!</p>';
        } else {
            $matkhau = password_hash($matkhau_raw, PASSWORD_DEFAULT);
            $sql_dangky = mysqli_query($mysqli, "INSERT INTO tbl_dangky(tenkhachhang,email,diachi,matkhau,dienthoai) 
                VALUES('$tenkhachhang','$email','$diachi','$matkhau','$dienthoai')");

            if ($sql_dangky) {
                // Đăng ký thành công → chuyển qua trang đăng nhập
                echo '<script>alert("Đăng ký thành công! Mời bạn đăng nhập.");</script>';
                echo '<script>window.location.href = "index.php?quanly=dangnhap";</script>';
                exit();
            } else {
                echo '<p style="color:red">Có lỗi xảy ra. Vui lòng thử lại sau!</p>';
            }
        }
    }
}
?>



<!-- FORM ĐĂNG KÝ -->
<p>Đăng ký thành viên</p>
<style type="text/css">
   table.dangky tr td {
       padding: 5px;
   }
</style>

<form action="" method="POST">
    <table class="dangky" border="1" width="50%" style="border-collapse:collapse;">
        <tr>
            <td>Họ và tên</td>
            <td><input type="text" name="hovaten" size="50" maxlength="100" required></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" name="email" size="50" maxlength="100" required></td>
        </tr>
        <tr>
            <td>Điện thoại</td>
            <td><input type="tel" name="dienthoai" size="50" maxlength="11" required></td>
        </tr>
        <tr>
            <td>Địa chỉ</td>
            <td><input type="text" name="diachi" size="50" maxlength="200" required></td>
        </tr>
        <tr>
            <td>Mật khẩu</td>
            <td><input type="password" name="matkhau" size="50" maxlength="50" required></td>
        </tr>
        <tr>
            <td><input type="submit" name="dangky" value="Đăng Ký"></td>
            <td><a href="index.php?quanly=dangnhap">Đăng nhập</a></td>
        </tr>
    </table>
</form>
