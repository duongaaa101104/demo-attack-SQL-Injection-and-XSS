<?php
include('../../config/config.php');
$tensanpham = $_POST['tensanpham'];
$masp = $_POST['masp'];
$giasp = $_POST['giasp'];
$soluong = $_POST['soluong'];
$hinhanh=$_FILES['hinhanh']['name'];
$hinhanh_tmp=$_FILES['hinhanh']['tmp_name'];
$hinhanh=time().'_'.$hinhanh;
$tomtat = $_POST['tomtat'];
$noidung= $_POST['noidung'];
$tinhtrang= $_POST['tinhtrang'];
$danhmuc= $_POST['danhmuc'];

// move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh);
if(isset($_POST['themsanpham'])){
    $sql_them = "INSERT INTO tbl_sanpham(tensanpham,masp,giasp,soluong,hinhanh,tomtat,noidung,tinhtrang,id_danhmuc) VALUE('".$tensanpham."','".$masp."',
    '".$giasp."','".$soluong."','".$hinhanh."','".$tomtat."','".$noidung."','".$tinhtrang."','".$danhmuc."')";
    mysqli_query($mysqli,$sql_them);
    move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh);
    header('Location:../../index.php?action=quanlysp&query=them');
}elseif(isset($_POST['suasanpham'])){
$id_sanpham = $_GET['idsanpham'];

    // Lấy dữ liệu ảnh cũ trước khi cập nhật
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$id_sanpham' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);
    $hinhanh_cu = $row['hinhanh'];

    // Kiểm tra nếu có ảnh mới được upload
    if(!empty($_FILES['hinhanh']['name'])){
        // Upload ảnh mới
        $hinhanh = time().'_'.$_FILES['hinhanh']['name'];
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        move_uploaded_file($hinhanh_tmp, 'uploads/'.$hinhanh);

        // Xóa ảnh cũ nếu tồn tại
        if (!empty($hinhanh_cu) && file_exists('uploads/'.$hinhanh_cu)) {
            unlink('uploads/'.$hinhanh_cu);
        }

        // Cập nhật sản phẩm với ảnh mới
        $sql_update = "UPDATE tbl_sanpham SET 
            tensanpham='$tensanpham', 
            masp='$masp', 
            giasp='$giasp', 
            soluong='$soluong', 
            hinhanh='$hinhanh', 
            tomtat='$tomtat', 
            noidung='$noidung', 
            tinhtrang='$tinhtrang', 
            id_danhmuc='$danhmuc' 
            WHERE id_sanpham='$id_sanpham'";
    } else {
        // Nếu không có ảnh mới, giữ nguyên ảnh cũ
        $sql_update = "UPDATE tbl_sanpham SET 
            tensanpham='$tensanpham', 
            masp='$masp', 
            giasp='$giasp', 
            soluong='$soluong', 
            tomtat='$tomtat', 
            noidung='$noidung', 
            tinhtrang='$tinhtrang', 
            id_danhmuc='$danhmuc' 
            WHERE id_sanpham='$id_sanpham'";
    }

    // Thực hiện truy vấn cập nhật
    if (mysqli_query($mysqli, $sql_update)) {
        header('Location: ../../index.php?action=quanlysp&query=them');
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($mysqli);
    }
}
else{
    $id=$_GET['idsanpham'];
    $sql ="SELECT *FROM tbl_sanpham WHERE id_sanpham='$id' LIMIT 1";
    $query=mysqli_query($mysqli,$sql);
    while($row=mysqli_fetch_array($query)){
        unlink('uploads/'.$row['hinhanh']);
    }
    $sql_xoa = "DELETE FROM tbl_sanpham WHERE id_sanpham='".$id."'";
    mysqli_query($mysqli,$sql_xoa);
    header('Location:../../index.php?action=quanlysp&query=them');
}
?>