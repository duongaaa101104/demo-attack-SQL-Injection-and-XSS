<p>xem đơn hàng</p>
<?php
     $code=$_GET['code'];
    $sql_lietke_dh="SELECT * FROM tbl_cart_details,tbl_sanpham WHERE tbl_cart_details.id_sanpham=tbl_sanpham.id_sanpham 
    AND tbl_cart_details.code_cart='".$code."' ORDER BY tbl_cart_details.id_cart_details DESC";
    $query_lietke_dh=mysqli_query($mysqli,$sql_lietke_dh);

?>
<table border="1" style="width:100%" style="border-collapse: collapse;">
  <tr>
    <th>ID</th>
    <th>Mã đơn hàng</th>
    <th>Tên sản phẩm</th>
    <th>Số lượng</th>
    <th>Đơn giá</th>
    <th>Thành tiền</th>
    
  </tr>
  <?php
  $i = 0;
  $tongtien=0;
  while ($row = mysqli_fetch_array($query_lietke_dh)) {
      $i++;
      $thanhtien=$row['giasp'] * $row['soluongmua'];
      $tongtien+=$thanhtien;
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo ($row['code_cart'])?></td>
    <td><?php echo ($row['tensanpham']) ?></td>
    <td><?php echo ($row['soluongmua']) ?></td>
    <td><?php echo number_format($row['giasp'], 0, ',', '.') . ' vnđ' ?></td>
    <td><?php echo number_format($thanhtien, 0, ',', '.') . ' vnđ' ?></td>
  </tr>
  <?php
  }
  ?>
  <tr>
    <td colspan="6">
        <p>
            Tổng tiền:<?php echo number_format($tongtien, 0, ',', '.') . ' vnđ' ?>
        </p>
    </td>
  </tr>
</table>
<style>
  table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    margin-top: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  }

  th, td {
    border: 1px solid #ccc;
    padding: 12px 10px;
    text-align: left;
    font-size: 14px;
  }

  th {
    background-color: #3498db;
    color: white;
    font-weight: 600;
  }

  tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  tr:hover {
    background-color: #f1f1f1;
  }

  p {
    font-weight: bold;
    color: #e74c3c;
    font-size: 16px;
    margin: 10px 0;
  }
</style>
