<?php
  $sql_sua_danhmucbv = "SELECT * FROM tbl_danhmucbaiviet WHERE id_baiviet='$_GET[idbaiviet]' LIMIT 1";
  $query_sua_danhmucbv =  mysqli_query($mysqli,$sql_sua_danhmucbv);
?>
<p class="form-title">Sửa danh mục bài viết</p>
<table class="form-table">
 <form method="POST" action="modules/quanlydanhmucbaiviet/xuly.php?idbaiviet=<?php echo $_GET['idbaiviet']?>">
    <?php
    while($dong = mysqli_fetch_array($query_sua_danhmucbv)){
    ?>
  <tr>
    <td class="label">Tên danh mục bài viết</td>
    <td><input type="text" value="<?php echo $dong['tendanhmuc_baiviet']?>" name="tendanhmucbaiviet" class="input-field" placeholder="Nhập tên danh mục..."></td>
  </tr>
  <tr>
    <td class="label">Thứ tự</td>
    <td><input type="number" value="<?php echo $dong['thutu']?>" name="thutu" class="input-field" placeholder="Nhập thứ tự..."></td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="suadanhmucbaiviet" value="Sửa danh mục bài viết" class="submit-btn"></td>
  </tr>
  <?php
    }
  ?>
  </form>
</table>

<style>
  /* Tổng thể bố cục */
  body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 20px;
  }

  /* Tiêu đề form */
  .form-title {
    font-size: 28px;
    font-weight: 600;
    color: #333;
    text-align: center;
    margin-bottom: 30px;
  }

  /* Bảng form */
  .form-table {
    width: 60%;
    margin: 0 auto;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 20px;
  }

  .form-table td {
    padding: 12px;
  }

  /* Label */
  .label {
    font-weight: 600;
    color: #333;
    font-size: 16px;
  }

  /* Input trường nhập liệu */
  .input-field {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 2px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
    margin-top: 8px;
    transition: border-color 0.3s ease;
  }

  .input-field:focus {
    border-color: #4CAF50;
    outline: none;
    background-color: #fff;
  }

  .input-field::placeholder {
    color: #888;
  }

  /* Nút Submit */
  .submit-btn {
    background-color: #4CAF50;
    color: white;
    padding: 15px 20px;
    border: none;
    border-radius: 5px;
    width: 100%;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 20px;
  }

  .submit-btn:hover {
    background-color: #45a049;
  }

  /* Cải thiện hiệu ứng hover cho các phần tử */
  .form-table tr:hover {
    background-color: #f1f1f1;
  }

</style>
