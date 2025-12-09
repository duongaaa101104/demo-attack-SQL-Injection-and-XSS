<?php
session_start();
include("../../admincp/config/config.php");
include('../../carbon/autoload.php');
use Carbon\Carbon;

// Kiểm tra session và giỏ hàng
if (!isset($_SESSION['id_khachhang']) || empty($_SESSION['cart'])) {
    die('Không có thông tin khách hàng hoặc giỏ hàng trống.');
}

$id_khachhang = $_SESSION['id_khachhang'];
$code_order = 'ORD' . strtoupper(bin2hex(random_bytes(5)));  // Mã đơn hàng ngẫu nhiên
$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();

// Nếu có hình thức thanh toán từ form thì lấy
$cart_payment = isset($_POST['payment']) ? mysqli_real_escape_string($mysqli, $_POST['payment']) : 'tienmat';

// Thêm đơn hàng vào bảng tbl_cart
$insert_cart = "
    INSERT INTO tbl_cart(id_khachhang, code_cart, cart_status, cart_date, cart_payment, cart_shipping)
    VALUES ('$id_khachhang', '$code_order', 1, '$cart_date', '$cart_payment', '$id_shipping')
";
echo $insert_cart;

$cart_query = mysqli_query($mysqli, $insert_cart);

if ($cart_query) {
    foreach ($_SESSION['cart'] as $item) {
        $id_sanpham = (int)$item['id'];
        $soluong = (int)$item['soluong'];

        $insert_order_details = "
            INSERT INTO tbl_cart_details(id_sanpham, code_cart, soluongmua)
            VALUES ('$id_sanpham', '$code_order', '$soluong')
        ";
        mysqli_query($mysqli, $insert_order_details);
    }

    // Xoá giỏ hàng sau khi đặt hàng xong
    unset($_SESSION['cart']);

    // Chuyển hướng kèm phương thức thanh toán để trang camon có thể hiển thị QR
    header("Location: ../../index.php?quanly=camon&method=$cart_payment");
    exit();
} else {
    die('Lỗi khi tạo đơn hàng: ' . mysqli_error($mysqli));
}
?>
