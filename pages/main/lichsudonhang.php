<h3>Lịch sử đơn hàng</h3>
<?php
  $id_khachhang=$_SESSION['id_khachhang'];
  $sql_lietke_dh = "SELECT * FROM tbl_cart,tbl_dangky
                    WHERE  tbl_cart.id_khachhang =tbl_dangky.id_dangky AND tbl_cart.id_khachhang='$id_khachhang'
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
    <th>Ngày đặt</th>
    <th>Quản lý</th>
    <th>Hình thức thanh toán</th>
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
    <td><?php echo htmlspecialchars($row['cart_date']) ?></td>
    <td>
      <a href="index.php?quanly=xemdonhang&code=<?php echo $row['code_cart'] ?>">Xem đơn hàng</a>
    </td>
    
    <td>
        <?php echo htmlspecialchars($row['cart_payment']) ?>
    </td>
  </tr>
  <?php
  }
  ?>
</table>

