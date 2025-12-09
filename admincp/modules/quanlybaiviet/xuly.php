<?php
include('../../config/config.php');
$tenbaiviet = $_POST['tenbaiviet'];
$hinhanh=$_FILES['hinhanh']['name'];
$hinhanh_tmp=$_FILES['hinhanh']['tmp_name'];
$hinhanh=time().'_'.$hinhanh;
$tomtat = $_POST['tomtat'];
$noidung= $_POST['noidung'];
$tinhtrang= $_POST['tinhtrang'];
$danhmuc= $_POST['danhmuc'];

// move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh);
if(isset($_POST['thembaiviet'])){
    $sql_them = "INSERT INTO tbl_baiviet(tenbaiviet,hinhanh,tomtat,noidung,tinhtrang,id_danhmuc) VALUE('".$tenbaiviet."'
    ,'".$hinhanh."','".$tomtat."','".$noidung."','".$tinhtrang."','".$danhmuc."')";
    mysqli_query($mysqli,$sql_them);
    move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh);
    header('Location:../../index.php?action=quanlybaiviet&query=them');
}
elseif(isset($_POST['suabaiviet'])){
    $id_baiviet = $_GET['idbaiviet'];

    $tenbaiviet = $_POST['tenbaiviet'];
    $tomtat = $_POST['tomtat'];
    $noidung = $_POST['noidung'];
    $tinhtrang = $_POST['tinhtrang'];
    $danhmuc = $_POST['danhmuc'];

    // Lấy dữ liệu ảnh cũ trước khi cập nhật
    $sql = "SELECT * FROM tbl_baiviet WHERE id='$id_baiviet' LIMIT 1";
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

        // Cập nhật bài viết với ảnh mới
        $sql_update = "UPDATE tbl_baiviet SET 
            tenbaiviet='$tenbaiviet', 
            hinhanh='$hinhanh', 
            tomtat='$tomtat', 
            noidung='$noidung', 
            tinhtrang='$tinhtrang', 
            id_danhmuc='$danhmuc' 
            WHERE id='$id_baiviet'";
    } else {
        // Nếu không có ảnh mới, giữ nguyên ảnh cũ
        $sql_update = "UPDATE tbl_baiviet SET 
            tenbaiviet='$tenbaiviet', 
            tomtat='$tomtat', 
            noidung='$noidung', 
            tinhtrang='$tinhtrang', 
            id_danhmuc='$danhmuc' 
            WHERE id='$id_baiviet'";
    }

    // Thực hiện truy vấn cập nhật
    if (mysqli_query($mysqli, $sql_update)) {
        header('Location: ../../index.php?action=quanlybaiviet&query=them&idbaiviet='.$id_baiviet);
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($mysqli);
    }
}

else{
    $id=$_GET['idbaiviet'];
    $sql ="SELECT *FROM tbl_baiviet WHERE id='$id' LIMIT 1";
    $query=mysqli_query($mysqli,$sql);
    while($row=mysqli_fetch_array($query)){
        unlink('uploads/'.$row['hinhanh']);
    }
    $sql_xoa = "DELETE FROM tbl_baiviet WHERE id='".$id."'";
    mysqli_query($mysqli,$sql_xoa);
    header('Location:../../index.php?action=quanlybaiviet&query=them');
}
?>