<?php
  $sql_sua_bv = "SELECT * FROM tbl_baiviet WHERE id='$_GET[idbaiviet]' LIMIT 1";
  $query_sua_bv =  mysqli_query($mysqli,$sql_sua_bv);
?>
<p>Sửa bài viết</p>
<?php
while($row = mysqli_fetch_array($query_sua_bv)){
?>
<table border="1" width="100%" style="border-collapse: collapse;">
 <form method="POST" action="modules/quanlybaiviet/xuly.php?idbaiviet=<?php echo $row['id']?>" enctype="multipart/form-data">
  <tr>
    <td>Tên bài viết</td>
    <td><input type="text" value="<?php echo $row['tenbaiviet']?>" name="tenbaiviet" ></td>
  </tr>
  <tr>
    <td>Hình ảnh</td>
    <td><input type="file"  name="hinhanh" >
    <img src="modules/quanlybaiviet/uploads/<?php echo $row['hinhanh'] ?>" width="150px">
  </td>
  </tr>
  <tr>
    <td>Tóm tắt</td>
    <td><textarea rows="10"  name="tomtat" style="resize:none" ><?php echo $row['tomtat']?></textarea></td>
  </tr>
  <tr>
    <td>Nội dung</td>
    <td><textarea rows="10"  name="noidung" style="resize:none"><?php echo $row['noidung']?></textarea></td>
  </tr>
  <tr>
    <td>Danh mục bài viết</td>
    <td>
      <select name="danhmuc">
        <?php
        $sql_danhmuc = "SELECT *FROM tbl_danhmucbaiviet ORDER BY id_baiviet DESC";
        $query_danhmuc=mysqli_query($mysqli,$sql_danhmuc);
        while($row_danhmuc=mysqli_fetch_array($query_danhmuc)){
          if($row_danhmuc['id_baiviet']==$row['id_danhmuc']){
        ?>
        <option selected value="<?php echo $row_danhmuc['id_baiviet']?>"><?php echo $row_danhmuc['tendanhmuc_baiviet']?></option>
        <?php
          }else{
            ?>
            <option value="<?php echo $row_danhmuc['id_baiviet']?>"><?php echo $row_danhmuc['tendanhmuc_baiviet']?></option>
            <?php
          }
        }
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td>Tình trạng</td>
    <td>
      <select name="tinhtrang">
        <?php
        if($row['tinhtrang']==1){
        ?>
        <option value="1" selected>Kích hoạt</option>
        <option value="0" >Ẩn</option>
        <?php
        }else{
        ?>
        <option value="1">Kích hoạt</option>
        <option value="0" selected>Ẩn</option>
        <?php
        }
        ?>
      </select>
    </td>
  </tr>
  <tr>
 
    <td colspan="2"><input type="submit" name="suabaiviet" value="Sửa bài viết"></td>
  </tr>
  </form>
  <?php
  }
  ?>
</table>
<style>
  table {
    width: 100%;
    border-collapse: collapse;
    background: #f9f9f9;
    font-family: Arial, sans-serif;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }

  table td {
    padding: 12px;
    border: 1px solid #ddd;
    vertical-align: top;
  }

  table tr:nth-child(even) {
    background-color: #fff;
  }

  table tr:nth-child(odd) {
    background-color: #f1f1f1;
  }

  input[type="text"],
  textarea,
  select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
  }

  input[type="file"] {
    margin-top: 5px;
  }

  input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
  }

  input[type="submit"]:hover {
    background-color: #45a049;
  }

  p {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
  }

  img {
    margin-top: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
  }
</style>
