<?php
$sql_danhmuc = "SELECT * FROM `tbl_danhmuc` ORDER BY `id_danhmuc` DESC";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
if (!$query_danhmuc) {
    die("Lỗi truy vấn: " . mysqli_error($mysqli));
}

?>
<?php
if(isset($_GET['dangxuat'])&&$_GET['dangxuat']==1){
    unset($_SESSION['dangky']);
}
?>
<?php
$mysqli = new mysqli("localhost", "root", "", "wed_mysqli");

// Kiểm tra lỗi kết nối
if ($mysqli->connect_error) {
    die("Lỗi kết nối: " . $mysqli->connect_error);
}
?>

<div class="menu">
            <ul class="list_menu">
                <li><a href="index.php">Trang Chủ</a></li>
                <li><a href="index.php?quanly=giohang">Giỏ Hàng</a></li>
                <li><a href="index.php?quanly=tintuc">Tin Tức</a></li>
                <li><a href="index.php?quanly=lienhe">Liên Hệ</a></li>
                
                <?php
                if(isset($_SESSION['dangky'])){
                    ?>
                  <li><a href="index.php?dangxuat=1">Đăng Xuất</a></li>
                  <li><a href="index.php?quanly=lichsudonhang">lịch Sử Đơn Hàng</a></li>
                    <?php
                }else{
                    ?>
                    <li><a href="index.php?quanly=dangky">Đăng Ký</a></li>
                    <?php
                }
                ?>
            </ul>
        <div style="display: flex; justify-content: center; margin: 10px 0;">
         <form action="index.php?quanly=timkiem" method="POST" style="display: flex; align-items: center; gap: 5px;">
        <input type="text" placeholder="Tìm kiếm sản phẩm..." name="tukhoa" 
               style="padding: 5px 10px; border: 1px solid #ccc; border-radius: 5px; outline: none; width: 250px;">
        <input type="submit" name="timkiem" value="Tìm kiếm" 
               style="background: rgba(0, 173, 230, 0.94); color: white; padding: 5px 15px; border: none; border-radius: 5px; cursor: pointer;">
        </form>
        </div>
        </div>

