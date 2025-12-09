<?php
  $sql_lietke_danhmucbv = "SELECT *FROM tbl_danhmucbaiviet ORDER BY thutu DESC";
  $query_lietke_danhmucbv =  mysqli_query($mysqli,$sql_lietke_danhmucbv);
?>
<p>Liệt kê danh mục bài viết</p>
<table class="table-style">
  <tr>
    <th>ID</th>
    <th>Tên danh mục</th>
    <th>Quản lý</th>
  </tr>
  <?php
  $i = 0;
  while($row = mysqli_fetch_array($query_lietke_danhmucbv)){
    $i++;
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['tendanhmuc_baiviet'] ?></td>
    <td>
      <a class="btn-delete" href="modules/quanlydanhmucbaiviet/xuly.php?idbaiviet=<?php echo $row['id_baiviet']?>">Xóa</a> | 
      <a class="btn-edit" href="?action=quanlydanhmucbaiviet&query=sua&idbaiviet=<?php echo $row['id_baiviet']?>">Sửa</a>
    </td>
  </tr>
  <?php
  }
  ?>
</table>

<style>
  /* Cải thiện giao diện bảng */
  table.table-style {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  table.table-style th, table.table-style td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  table.table-style th {
    background-color: #4CAF50;
    color: white;
  }

  table.table-style tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  table.table-style tr:hover {
    background-color: #ddd;
  }

  /* Các nút Xóa và Sửa */
  .btn-delete, .btn-edit {
    padding: 5px 10px;
    text-decoration: none;
    color: white;
    border-radius: 3px;
    margin: 0 5px;
  }

  .btn-delete {
    background-color: #e74c3c;
  }

  .btn-edit {
    background-color: #3498db;
  }

  .btn-delete:hover {
    background-color: #c0392b;
  }

  .btn-edit:hover {
    background-color: #2980b9;
  }

  /* Cải thiện văn bản */
  p {
    font-size: 18px;
    font-weight: bold;
    color: #333;
  }
</style>
