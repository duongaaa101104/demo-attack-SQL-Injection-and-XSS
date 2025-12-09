<p>Thông tin vận chuyển</p>
<div class="progress-bar-container">
  <!-- Responsive Arrow Progress Bar -->
  <div class="arrow-steps clearfix">
    <div class="step done"> <span> <a href="index.php?quanly=giohang" >Giỏ hàng</a></span> </div>
    <div class="step current"> <span><a href="index.php?quanly=vanchuyen" >Vận chuyển</a></span> </div>
    <div class="step "> <span><a href="index.php?quanly=thongtinthanhtoan" >Thanh toán</a><span> </div>
    <!-- <div class="step "> <span><a href="index.php?quanly=donhangdadat" >Lịch sử đơn hàng</a><span> </div> -->
  </div>
  <h4>Thông tin vận chuyển</h4>
  <?php
    if(isset($_POST['themvanchuyen'])){
      $name=$_POST['name'];
      $phone=$_POST['phone'];
      $address=$_POST['address'];
      $note=$_POST['note'];
      $id_dangky=$_SESSION['id_khachhang'];
      $sql_them_vanchuyen = mysqli_query($mysqli,"INSERT INTO tbl_shipping(name,phone,address,note,id_dangky) VALUES('$name','$phone','$address','$note','$id_dangky')");
      if($sql_them_vanchuyen){
        echo '<script>alert("Thêm vận chuyển thành công ")</script>';
      }
    }elseif(isset($_POST['capnhatvanchuyen'])){
      $name=$_POST['name'];
      $phone=$_POST['phone'];
      $address=$_POST['address'];
      $note=$_POST['note'];
      $id_dangky=$_SESSION['id_khachhang'];
      $sql_update_vanchuyen = mysqli_query($mysqli,"UPDATE  tbl_shipping SET name='$name',phone='$phone',address='$address',note='$note',id_dangky='$id_dangky'
      WHERE id_dangky='$id_dangky'");
      if($sql_update_vanchuyen){
        echo '<script>alert("Cập nhật vận chuyển thành công ")</script>';
      }
    }
  ?>
  <div class="row">
    <?php
     $id_dangky =$_SESSION['id_khachhang'];
     $sql_get_vanchuyen = mysqli_query($mysqli,"SELECT *FROM tbl_shipping WHERE id_dangky='$id_dangky' LIMIT 1");
     $count= mysqli_num_rows($sql_get_vanchuyen);
     if($count>0){
        $row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
        $name=$row_get_vanchuyen['name'];
        $phone=$row_get_vanchuyen['phone'];
        $address=$row_get_vanchuyen['address'];
        $note=$row_get_vanchuyen['note'];
     }else{
        $name='';
        $phone='';
        $address='';
        $note='';
     }
    ?>
    <form action="" autocomplete="off" method="POST">
    <div class="form-group">
      <label for="email">Họ và tên</label>
      <input type="text" name="name" value="<?php echo $name ?>" class="form-control" >
    </div>
    
    <div class="form-group">
      <label for="email">Phone</label>
      <input type="text" name="phone" value="<?php echo $phone ?>" class="form-control" >
    </div>
    <div class="form-group">
      <label for="email">Địa chỉ</label>
      <input type="text" name="address" value="<?php echo $address ?>" class="form-control" >
    </div>
    <div class="form-group">
      <label for="email">Ghi chú</label>
      <input type="text" name="note" value="<?php echo $note ?>" class="form-control" >
    </div>
    <?php
    if($name==''&& $phone==''){
    ?>
    <button type="submit" name="themvanchuyen" class="btn btn-default">Thêm vận chuyển</button>
    <?php
    }elseif($name!=''&& $phone!=''){
    ?>
    <button type="submit" name="capnhatvanchuyen" class="btn btn-default">Cập nhật vận chuyển</button>
    <?php
    }
    ?>
  </form>
  </div>
  <!-- Giỏ hàng -->
  <table style="width:100% ;text-align:center;border-collapse:collapse;" border="1">
  <tr>
    <th>ID</th>
    <th>Mã sản phẩm</th>
    <th>Tên sản phẩm</th>
    <th>Hình ảnh</th>
    <th>Số lượng</th>
    <th>Giá sản phẩm</th>
    <th>Thành tiền</th>
    <th>Quản lý</th>
  </tr>

  <?php
  if(isset($_SESSION['cart']) && is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0){
      $i = 1; // Khởi tạo biến đếm
      $tongtien =0;
      foreach($_SESSION['cart'] as $cart_item){
        $thanhtien= $cart_item['soluong']*$cart_item['giasp'];
       $tongtien+=$thanhtien;
  ?>
  <tr>
    <td><?php echo $i++; ?></td>
    <td><?php echo htmlspecialchars($cart_item['masp']); ?></td>
    <td><?php echo htmlspecialchars($cart_item['tensanpham']); ?></td>
    <td><img src="admincp/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh'];?>" width="150px"></td>
    <td>
        <a href="pages/main/themgiohang.php?cong=<?php echo $cart_item['id']?>"><i class="fa-solid fa-plus"></i></a>
        <?php echo $cart_item['soluong']; ?>
        <a href="pages/main/themgiohang.php?tru=<?php echo $cart_item['id']?>"><i class="fa-solid fa-minus"></i></a>
    </td>
    <td><?php echo number_format($cart_item['giasp'], 0, ',', '.').'vnđ'; ?></td>
    <td><?php echo number_format($thanhtien, 0, ',', '.').'vnđ'; ?></td>
    <td><a href="pages/main/themgiohang.php?xoa=<?php echo $cart_item['id']?>">Xóa</a></td>
  </tr>
  <?php
      }
    ?>
        <tr>
        <td colspan="8">
        <p syle="float:left;">Tổng tiền:<?php echo number_format($tongtien, 0, ',', '.').'vnđ';?></p><br>
        <p syle="float:right;"><a href="pages/main/themgiohang.php?xoatatca=1">Xóa tất cả</a></p>
        <div style="clear:both;">
          <?php
          if(isset($_SESSION['dangky'])){
            ?><p> <a href="index.php?quanly=thongtinthanhtoan">Hình thức Thanh toán</a></p>
          <?php
          }else{
            ?>
              <p><a href="index.php?quanly=dangky">Đăng ký đặt hàng</a></p>
            <?php
          }
          ?>
        </div>
        </td>
  </tr>
   <?php
  } else {
  ?>
  <tr>
    <td colspan="8"><p>Hiện tại giỏ hàng trống</p></td>
  </tr>
  <?php
  }
  ?>
 </table>
</div>
<style>
/* Progress Bar Container */
.progress-bar-container {
  margin: 20px 0;
  padding: 10px 0;
  background: #f9f9f9;
  border-radius: 12px;
  text-align: left;
}

/* Arrow Steps */
.arrow-steps {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  padding: 0;
  list-style: none;
}

.arrow-steps .step {
  position: relative;
  text-align: left;
  padding: 10px 15px;
  color: #555;
  background: #e0e0e0;
  border-radius: 8px;
  transition: background 0.3s ease;
}

.arrow-steps .step a {
  text-decoration: none;
  color: inherit;
  font-weight: 600;
}

.arrow-steps .step.done {
  background: #4caf50;
  color: white;
}

.arrow-steps .step.current {
  background: #2196f3;
  color: white;
}

.arrow-steps .step:not(:last-child)::after {

  position: absolute;
  right: -12px;
  top: 50%;
  transform: translateY(-50%);
  color: inherit;
}

/* Form Section */
.row {
  display: flex;
  flex-direction: column;
  gap: 15px;
  max-width: 600px;
  margin: 20px 0;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-group label {
  font-weight: bold;
  margin-bottom: 5px;
  color: #333;
}

.form-group input[type="text"] {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 14px;
  transition: border 0.3s ease;
}

.form-group input[type="text"]:focus {
  border-color: #2196f3;
  outline: none;
}

/* Button Styles */
.btn {
  padding: 10px 20px;
  border: none;
  border-radius: 8px;
  background: #2196f3;
  color: white;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s ease;
}

.btn:hover {
  background: #1976d2;
}

/* Responsive Design */
@media (max-width: 768px) {
  .arrow-steps {
    flex-direction: column;
    gap: 10px;
  }

  .btn {
    width: 100%;
  }
}

</style>