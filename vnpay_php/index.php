<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cổng thanh toán VNPAY (Demo)</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding-top: 50px; }
        .loader {
            border: 16px solid #f3f3f3;
            border-top: 16px solid #3498db;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            animation: spin 2s linear infinite;
            margin: 0 auto;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        .info { margin-top: 20px; font-size: 18px; background: #e9ecef; display: inline-block; padding: 20px; border-radius: 10px; }
    </style>
</head>
<body>

    <img src="https://vnpay.vn/assets/images/logo-icon/logo-primary.svg" alt="VNPAY Logo" style="height: 50px;">
    
    <h2>ĐANG XỬ LÝ THANH TOÁN...</h2>
    
    <div class="loader"></div>

    <div class="info">
        <?php
        // Lấy thông tin từ URL gửi sang
        $code_cart = isset($_GET['code_cart']) ? $_GET['code_cart'] : 'Không xác định';
        $tongtien = isset($_GET['tongtien']) ? $_GET['tongtien'] : 0;
        ?>
        <p><b>Mã đơn hàng:</b> <?php echo $code_cart; ?></p>
        <p><b>Số tiền:</b> <?php echo number_format($tongtien); ?> VND</p>
        <p style="color: red;">Vui lòng không tắt trình duyệt...</p>
    </div>

    <script>
        // Tự động chuyển về trang Cảm ơn sau 3 giây (Giả lập thanh toán thành công)
        setTimeout(function(){
            // Quay trở lại thư mục gốc và vào trang cảm ơn
            window.location.href = '../index.php?quanly=camon&method=vnpay';
        }, 3000);
    </script>

</body>
</html>