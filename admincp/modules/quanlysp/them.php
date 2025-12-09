<p>Thêm sản phẩm</p>
<table border="1" width="100%" style="border-collapse: collapse;">
 <form method="POST" action="modules/quanlysp/xuly.php" enctype="multipart/form-data">
  <tr>
    <td>Tên sản phẩm</td>
    <td><input type="text" name="tensanpham" ></td>
  </tr>
  <tr>
    <td>Mã sản phẩm</td>
    <td><input type="text" name="masp" ></td>
  </tr>
  <tr>
    <td>Giá sản phẩm</td>
    <td><input type="text" name="giasp" ></td>
  </tr>
  <tr>
    <td>Số Lượng</td>
    <td><input type="text" name="soluong" ></td>
  </tr>
  <tr>
    <td>Hình ảnh</td>
    <td><input type="file" name="hinhanh" ></td>
  </tr>
  <tr>
    <td>Tóm tắt</td>
    <td><textarea rows="10"  name="tomtat" style="resize:none" ></textarea></td>
  </tr>
  <tr>
    <td>Nội dung</td>
    <td><textarea rows="10"  name="noidung" style="resize:none"></textarea></td>
  </tr>
  <tr>
    <td>Danh mục sản phẩm </td>
    <td>
      <select name="danhmuc">
        <?php
        $sql_danhmuc = "SELECT *FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
        $query_danhmuc=mysqli_query($mysqli,$sql_danhmuc);
        while($row_danhmuc=mysqli_fetch_array($query_danhmuc)){
        ?>
        <option value="<?php echo $row_danhmuc['id_danhmuc']?>"><?php echo $row_danhmuc['tendanhmuc']?></option>
        <?php
        }
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td>Tình trạng</td>
    <td>
      <select name="tinhtrang">
        <option value="1">Kích hoạt</option>
        <option value="0">Ẩn</option>
      </select>
    </td>
  </tr>
  <tr>
 
    <td colspan="2"><input type="submit" name="themsanpham" value="Thêm  sản phẩm"></td>
  </tr>
  </form>
</table>
<style>
  p {
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #2c3e50;
    font-family: Arial, sans-serif;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    font-family: Arial, sans-serif;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  table td {
    padding: 12px;
    border: 1px solid #ccc;
    vertical-align: top;
  }

  table tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  input[type="text"],
  textarea,
  select {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
    margin-top: 5px;
  }

  textarea {
    resize: none;
  }

  input[type="file"] {
    margin-top: 5px;
  }

  input[type="submit"] {
    background-color: #3498db;
    color: white;
    padding: 12px;
    font-size: 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    width: 100%;
  }

  input[type="submit"]:hover {
    background-color: #2980b9;
  }
</style>
