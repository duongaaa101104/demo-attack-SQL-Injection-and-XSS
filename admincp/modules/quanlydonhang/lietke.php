<p>Liệt kê đơn hàng</p>
<?php
  $sql_lietke_dh = "SELECT * FROM tbl_cart 
                    INNER JOIN tbl_dangky ON tbl_cart.id_khachhang = tbl_dangky.id_dangky 
                    ORDER BY tbl_cart.id_cart DESC";
  $query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
  
  if (!$query_lietke_dh) {
      die("Lỗi truy vấn: " . mysqli_error($mysqli));
  }
?>
<p>Danh sách đơn hàng</p>
<table border="1" style="width:100%" style="border-collapse: collapse;">
  <tr>
    <th>ID</th>
    <th>Mã đơn hàng</th>
    <th>Tên khách hàng</th>
    <th>Địa chỉ</th>
    <th>Email</th>
    <th>Số điện thoại</th>
    <th>Tình trạng</th>
    <th>Ngày đặt</th>
    <th>Quản lý</th>
    <th>In</th>
  </tr>
  <?php
  $i = 0;
  while ($row = mysqli_fetch_array($query_lietke_dh)) {
      $i++;
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo htmlspecialchars($row['code_cart']) ?></td>
    <td><?php echo htmlspecialchars($row['tenkhachhang']) ?></td>
    <td><?php echo htmlspecialchars($row['diachi']) ?></td>
    <td><?php echo htmlspecialchars($row['email']) ?></td>
    <td><?php echo htmlspecialchars($row['dienthoai']) ?></td>
    <td>
        <?php if($row['cart_status']==1){
            echo '<a href="modules/quanlydonhang/xuly.php?code='.$row['code_cart'].'">Đơn hàng mới</a>';

        }else{
            echo 'Đã xem';
        }
        ?>
    </td>
    <td><?php echo htmlspecialchars($row['cart_date']) ?></td>
    <td>
      <a href="index.php?action=donhang&query=xemdonhang&code=<?php echo $row['code_cart'] ?>">Xem đơn hàng</a>
    </td>
    <td>
      <a href="modules/quanlydonhang/indonhang.php?code=<?php echo $row['code_cart'] ?>">In đơn hàng</a>
    </td>
  </tr>
  <?php
  }
  ?>
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

  a {
    color: #3498db;
    text-decoration: none;
    font-weight: 500;
  }

  a:hover {
    text-decoration: underline;
  }

  p {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #2c3e50;
  }
</style>
