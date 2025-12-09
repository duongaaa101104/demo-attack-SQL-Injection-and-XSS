<?php
  $sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY thutu DESC";
  $query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);
?>
<p style="font-size: 24px; font-weight: bold; margin-bottom: 15px;">📋 Liệt kê danh mục sản phẩm</p>

<style>
  table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border: 1px solid #ccc;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.05);
    font-family: 'Segoe UI', sans-serif;
  }

  th {
    background-color: #4CAF50;
    color: white;
    padding: 12px 10px;
    text-align: left;
  }

  td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
  }

  tr:hover {
    background-color: #f5f5f5;
  }

  a {
    color: #2196F3;
    text-decoration: none;
    font-weight: bold;
  }

  a:hover {
    text-decoration: underline;
    color: #0b7dda;
  }

  p {
    font-family: 'Segoe UI', sans-serif;
  }
</style>

<table>
  <tr>
    <th>Thứ tự</th>
    <th>Tên danh mục</th>
    <th>Quản lý</th>
  </tr>
  <?php
    $i = 0;
    while($row = mysqli_fetch_array($query_lietke_danhmucsp)){
      $i++;
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['tendanhmuc'] ?></td>
    <td>
      <a href="modules/quanlydanhmucsp/xuly.php?iddanhmuc=<?php echo $row['id_danhmuc']?>">🗑 Xóa</a> |
      <a href="?action=quanlydanhmucsanpham&query=sua&iddanhmuc=<?php echo $row['id_danhmuc']?>">✏️ Sửa</a>
    </td>
  </tr>
  <?php
    }
  ?>
</table>
