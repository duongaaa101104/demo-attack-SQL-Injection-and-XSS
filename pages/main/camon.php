<?php
$method = $_GET['method'] ?? '';
?>

<div class="camon-wrapper">
    <h2>Cảm ơn bạn đã đặt hàng!</h2>

    <?php if ($method == 'chuyenkhoan'): ?>
        <h3>Vui lòng chuyển khoản theo thông tin bên dưới:</h3>
        <p>Số tài khoản: 1234567890 (Nguyễn Văn A)</p>
        <img src="../../imgages/qr-chuyenkhoan.png" width="200">

    <?php else: ?>
        <p>Chúng tôi sẽ liên hệ để xác nhận đơn hàng của bạn.</p>
    <?php endif; ?>
</div>
