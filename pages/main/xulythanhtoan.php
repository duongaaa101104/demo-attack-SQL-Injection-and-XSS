<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Load thư viện Carbon và cấu hình
require dirname(__DIR__, 2) . '/vendor/autoload.php'; 
include("../../admincp/config/config.php"); 

use Carbon\Carbon;

// 1. Kiểm tra dữ liệu đầu vào
if (!isset($_SESSION['id_khachhang']) || !isset($_POST['payment'])) {
    die('Lỗi: Thiếu thông tin khách hàng hoặc phương thức thanh toán chưa được chọn.');
}

$id_khachhang = $_SESSION['id_khachhang'];
$cart_payment = mysqli_real_escape_string($mysqli, $_POST['payment']);
$code_order = uniqid('order_', true); // Tạo mã đơn hàng duy nhất
$now = Carbon::now('Asia/Ho_Chi_Minh');
$cart_date = $now->toDateTimeString();
$id_dangky = $id_khachhang;

// 2. Xử lý thông tin vận chuyển (Shipping)
$sql_get_shipping = mysqli_query($mysqli, "SELECT * FROM tbl_shipping WHERE id_dangky = '$id_dangky' LIMIT 1");

if ($sql_get_shipping && mysqli_num_rows($sql_get_shipping) > 0) {
    $row_shipping = mysqli_fetch_array($sql_get_shipping);
    $id_shipping = $row_shipping['id_shipping'];
} else {
    // Tạo thông tin mặc định nếu chưa có (Tránh lỗi khóa ngoại)
    $name = 'Khách vãng lai';
    $phone = '0000000000';
    $address = 'Chưa cập nhật';
    $note = 'Tự động tạo khi thanh toán';

    $insert_shipping = "INSERT INTO tbl_shipping(name, phone, address, note, id_dangky) VALUES('$name', '$phone', '$address', '$note', '$id_dangky')";
    
    if (mysqli_query($mysqli, $insert_shipping)) {
        $id_shipping = mysqli_insert_id($mysqli);
    } else {
        die('Lỗi: Không thể tạo thông tin vận chuyển. ' . mysqli_error($mysqli));
    }
}

// 3. Lưu đơn hàng vào bảng tbl_cart
$insert_cart = "INSERT INTO tbl_cart(id_khachhang, code_cart, cart_status, cart_date, cart_payment, cart_shipping)
    VALUES ('$id_khachhang', '$code_order', 1, '$cart_date', '$cart_payment', '$id_shipping')";

$cart_query = mysqli_query($mysqli, $insert_cart);

if (!$cart_query) {
    die('Lỗi khi lưu đơn hàng: ' . mysqli_error($mysqli));
}

// 4. Lưu chi tiết đơn hàng & Tính tổng tiền
// (VNPay cần biết tổng số tiền để tạo mã QR)
$tongtien = 0; 

if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $id_sanpham = (int)$item['id'];
        $soluong = (int)$item['soluong'];
        
        // Giả sử trong Session giỏ hàng bạn lưu giá sản phẩm là 'giasp'
        // Nếu tên trường khác (ví dụ 'price'), hãy sửa lại dòng dưới
        $gia = isset($item['giasp']) ? (int)$item['giasp'] : 0;
        
        // Cộng dồn tổng tiền
        $tongtien += $gia * $soluong;

        $insert_details = "INSERT INTO tbl_cart_details(id_sanpham, code_cart, soluongmua)
            VALUES ('$id_sanpham', '$code_order', '$soluong')";
            
        mysqli_query($mysqli, $insert_details);
    }
}

// 5. Xóa giỏ hàng sau khi đã lưu xong
unset($_SESSION['cart']);

// 6. ĐIỀU HƯỚNG THANH TOÁN (Logic mới thêm vào)
if ($cart_payment == 'vnpay') {
    // TRƯỜNG HỢP 1: Chọn VNPay -> Chuyển sang trang cấu hình VNPay
    // Truyền mã đơn hàng và tổng tiền qua URL
    header("Location: ../../vnpay_php/index.php?code_cart=$code_order&tongtien=$tongtien");
    exit();

} elseif ($cart_payment == 'momo') {
    // TRƯỜNG HỢP 2: Chọn Momo -> Chuyển sang trang xử lý Momo
    // (Nếu chưa có file này, web sẽ báo lỗi 404. Bạn cần tạo file tương tự VNPay)
    header("Location: ../../momo_php/index.php?code_cart=$code_order&tongtien=$tongtien");
    exit();

} else {
    // TRƯỜNG HỢP 3: Tiền mặt / Chuyển khoản -> Chuyển về trang Cảm ơn
    header("Location: ../../index.php?quanly=camon&method=$cart_payment");
    exit();
}
?>