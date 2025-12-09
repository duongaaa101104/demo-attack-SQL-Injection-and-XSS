<?php
session_start();
include('../../admincp/config/config.php');

if (isset($_GET['tru'])) {
    $id = $_GET['tru'];
    $product = array(); // Khởi tạo mảng mới

    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            // Giữ nguyên sản phẩm không được nhấn nút trừ
            $product[] = array(
                'tensanpham' => $cart_item['tensanpham'],
                'id' => $cart_item['id'],
                'soluong' => $cart_item['soluong'], 
                'giasp' => $cart_item['giasp'],
                'hinhanh' => $cart_item['hinhanh'],
                'masp' => $cart_item['masp']
            );
        } else {
            // Nếu là sản phẩm được giảm số lượng
            $giamsoluong = $cart_item['soluong'] - 1; // Giảm 1 đơn vị

            if ($giamsoluong > 0) {
                // Nếu số lượng > 0 thì cập nhật lại
                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'],
                    'id' => $cart_item['id'],
                    'soluong' => $giamsoluong, 
                    'giasp' => $cart_item['giasp'],
                    'hinhanh' => $cart_item['hinhanh'],
                    'masp' => $cart_item['masp']
                );
            } 
            // Nếu số lượng giảm về 0 thì không thêm vào giỏ hàng (tức là xóa luôn)
        }
    }

    $_SESSION['cart'] = $product; // Cập nhật giỏ hàng mới
    header('Location: ../../index.php?quanly=giohang');
    exit();
}

if (isset($_GET['cong'])) {
    $id = $_GET['cong'];
    $product = array(); // Khởi tạo mảng mới

    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            // Giữ nguyên sản phẩm không được nhấn nút tăng
            $product[] = array(
                'tensanpham' => $cart_item['tensanpham'],
                'id' => $cart_item['id'],
                'soluong' => $cart_item['soluong'], 
                'giasp' => $cart_item['giasp'],
                'hinhanh' => $cart_item['hinhanh'],
                'masp' => $cart_item['masp']
            );
        } else {
            // Nếu là sản phẩm được tăng số lượng
            $tangsoluong = $cart_item['soluong'] + 1; // Cộng thêm 1
            if ($tangsoluong > 10) {
                $tangsoluong = 10; // Giới hạn tối đa 10
            }

            $product[] = array(
                'tensanpham' => $cart_item['tensanpham'],
                'id' => $cart_item['id'],
                'soluong' => $tangsoluong, 
                'giasp' => $cart_item['giasp'],
                'hinhanh' => $cart_item['hinhanh'],
                'masp' => $cart_item['masp']
            );
        }
    }

    $_SESSION['cart'] = $product; // Gán lại giỏ hàng sau khi xử lý
    header('Location: ../../index.php?quanly=giohang');
    exit();
}

if (isset($_SESSION['cart']) && isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $product = array(); // Mảng mới để chứa sản phẩm còn lại

    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array(
                'tensanpham' => $cart_item['tensanpham'],
                'id' => $cart_item['id'],
                'soluong' => $cart_item['soluong'], // Giữ nguyên số lượng
                'giasp' => $cart_item['giasp'],
                'hinhanh' => $cart_item['hinhanh'],
                'masp' => $cart_item['masp']
            );
        }
    }

    $_SESSION['cart'] = $product; // Cập nhật lại giỏ hàng
    header('Location: ../../index.php?quanly=giohang');
    exit(); // Dừng script sau khi chuyển hướng
}

if(isset($_GET['xoatatca'])&&$_GET['xoatatca']==1){
   unset($_SESSION['cart']);
   header('Location:../../index.php?quanly=giohang');
}
if(isset($_POST['themgiohang'])){
    $id = $_GET['idsanpham'];
    $soluong = 1;

    // Truy vấn lấy sản phẩm theo id
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$id' LIMIT 1";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($result);

    if($row){
        // Tạo sản phẩm mới
        $new_product = array(
            array(
                'tensanpham' => $row['tensanpham'],
                'id' => $id,
                'soluong' => $soluong,
                'giasp' => $row['giasp'],
                'hinhanh' => $row['hinhanh'],
                'masp' => $row['masp']
            )
        );

        // Kiểm tra nếu giỏ hàng đã tồn tại
        if(isset($_SESSION['cart'])){
            $found = false;
            $product = array();

            foreach($_SESSION['cart'] as $cart_item){
                if($cart_item['id'] == $id){
                    // Nếu sản phẩm đã có, tăng số lượng
                    $cart_item['soluong'] += 1;
                    $found = true;
                }
                $product[] = $cart_item;
            }

            // Nếu sản phẩm chưa có trong giỏ hàng
            if(!$found){
                $_SESSION['cart'] = array_merge($product, $new_product);
            } else {
                $_SESSION['cart'] = $product;
            }
        } else {
            $_SESSION['cart'] = $new_product;
        }
    }

    // Chuyển hướng về trang giỏ hàng
    header('Location:../../index.php?quanly=giohang');
}
?>
