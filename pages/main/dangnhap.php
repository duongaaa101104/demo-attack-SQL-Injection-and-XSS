<?php
// -----------------------------------------------------------
// 1. TẮT TOÀN BỘ BÁO LỖI (Để giao diện sạch sẽ khi Demo)
// -----------------------------------------------------------
error_reporting(0);
ini_set('display_errors', 0);

// 2. Kiểm tra xem Session đã bật chưa, nếu chưa mới bật
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 3. Kết nối Database
// (Dùng @ để chặn báo lỗi nếu file này đã được index.php include trước đó)
@include('admin/config/config.php'); 

if (isset($_POST['dangnhap'])) {
    $email = $_POST['email'];
    $matkhau = $_POST['password'];

    // ---------------------------------------------------------
    // CÂU LỆNH SQL DỄ BỊ TẤN CÔNG (GIỮ NGUYÊN ĐỂ DEMO)
    // ---------------------------------------------------------
    $sql = "SELECT * FROM tbl_dangky WHERE email='$email' LIMIT 1";
    
    // Thực thi query (Nếu $mysqli chưa có do lỗi include, dòng này sẽ fail nhưng ta đã tắt lỗi)
    // Lưu ý: Nếu web của bạn dùng biến $conn hay $connect thì sửa chữ $mysqli bên dưới nhé
    if(isset($mysqli)){
        $result = mysqli_query($mysqli, $sql);
    } else {
        // Fallback nếu biến kết nối có tên khác (thường gặp trong xampp)
        global $conn; 
        if(isset($conn)) $result = mysqli_query($conn, $sql);
    }

    // =========================================================
    // TRƯỜNG HỢP 1: LỖI CÚ PHÁP SQL (Do nhập dấu ' gây lỗi) -> CHO QUA LUÔN
    // =========================================================
    if (!isset($result) || !$result) {
        $_SESSION['dangky'] = 'HACKER_ADMIN (Bypass Login)';
        $_SESSION['id_khachhang'] = 99999;
        
        echo "<script>
            alert('⚠️ HỆ THỐNG ĐÃ BỊ HACK! (Lỗi cú pháp SQL)\\nĐăng nhập thành công!');
            window.location.href='index.php';
        </script>";
        exit();
    }

    // =========================================================
    // TRƯỜNG HỢP 2: SQL CHẠY ĐÚNG (Kiểm tra xem có phải tấn công không)
    // =========================================================
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Mật khẩu đúng
        if (password_verify($matkhau, $row['matkhau'])) {
            $_SESSION['dangky'] = $row['tenkhachhang'];
            $_SESSION['id_khachhang'] = $row['id_dangky'];
            header("Location: index.php");
            exit();
        } 
        // Sai mật khẩu NHƯNG phát hiện ký tự tấn công -> CHO QUA
        elseif (strpos($email, "'") !== false || strpos($email, "OR") !== false) {
            $_SESSION['dangky'] = $row['tenkhachhang'] . ' (HACKED)';
            $_SESSION['id_khachhang'] = $row['id_dangky'];
            
            echo "<script>
                alert('⚠️ CẢNH BÁO: LOGIN BYPASS THÀNH CÔNG!\\n\\nBạn đã vượt qua lớp xác thực mật khẩu bằng SQL Injection.');
                window.location.href='index.php';
            </script>";
            exit();
        }
        else {
            echo '<p style="color:red; text-align:center;">Mật khẩu không đúng.</p>';
        }
    } else {
        echo '<p style="color:red; text-align:center;">Email không tồn tại.</p>';
    }
}
?>

<form action="" autocomplete="off" method="POST">
    <table border="1" class="table-login" style="text-align:center;border-collapse:collapse; width: 50%; margin: 0 auto;">
        <tr>
            <td colspan="2"><h3>Đăng nhập khách hàng</h3></td>
        </tr>
        <tr>
            <td>Tài khoản</td>
            <td><input type="text" name="email" placeholder="Email..." required style="width: 90%; padding: 5px;"></td>
        </tr>
        <tr>
            <td>Mật khẩu</td>
            <td><input type="password" name="password" placeholder="Mật khẩu..." required style="width: 90%; padding: 5px;"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="dangnhap" value="Đăng nhập" style="padding: 10px 20px; cursor: pointer;"></td>
        </tr>
    </table>
</form>