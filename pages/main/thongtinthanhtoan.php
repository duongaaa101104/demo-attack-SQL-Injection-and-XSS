<p>Hình thức thanh toán</p>
<div class="progress-bar-container">
  <!-- Responsive Arrow Progress Bar -->
  <div class="arrow-steps clearfix">
    <div class="step done"> <span> <a href="index.php?quanly=giohang" >Giỏ hàng</a></span> </div>
    <div class="step done"> <span><a href="index.php?quanly=vanchuyen" >Vận chuyển</a></span> </div>
    <div class="step current"> <span><a href="index.php?quanly=thongtinthanhtoan" >Thanh toán</a></span> </div>
    <!-- <div class="step "> <span><a href="index.php?quanly=donhangdadat" >Lịch sử đơn hàng</a></span> </div> -->
  </div>
  <form action="pages/main/xulythanhtoan.php" method="POST">
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
    <div class="col-md-8">
      <h4>Thông tin vận chuyển và giỏ hàng</h4>
      <ul>
         <li>Họ và tên vận chuyển: <b><?php echo $name?></b></li>
         <li>Số điện thoại: <b><?php echo $phone?></b></li>
         <li>Địa chỉ: <b><?php echo $address?></b></li>
         <li>Ghi chú: <b><?php echo $note?></b></li>
      </ul>
      <h5>Giỏ hàng của bạn</h5>
      <table style="width:100% ;text-align:center;border-collapse:collapse;" border="1">
        <tr>
          <th>ID</th>
          <th>Mã sản phẩm</th>
          <th>Tên sản phẩm</th>
          <th>Hình ảnh</th>
          <th>Số lượng</th>
          <th>Giá sản phẩm</th>
          <th>Thành tiền</th>
        
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
          
        </tr>
        <?php
            }
          ?>
              <tr>
              <td colspan="8">
              <p style="float:left;">Tổng tiền:<?php echo number_format($tongtien, 0, ',', '.').'vnđ';?></p><br>
              <div style="clear:both;"></div>
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
    <div class="col-md-4">
      <p>Phương thức thanh toán</p>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="payment" id="exampleRadios1" value="tien mat" checked>
        <label class="form-check-label" for="exampleRadios1">
          Tiền mặt
        </label>
     </div>
     <div class="form-check">
        <input class="form-check-input" type="radio" name="payment" id="exampleRadios2" value="chuyen khoan" checked>
        <label class="form-check-label" for="exampleRadios2">
          Chuyển khoản
        </label>
     </div>
     <div class="form-check">
        <input class="form-check-input" type="radio" name="payment" id="exampleRadios3" value="momo" checked>
        <label class="form-check-label" for="exampleRadios3">
          Momo
        </label>
     </div>
     <div class="form-check">
        <input class="form-check-input" type="radio" name="payment" id="exampleRadios4" value="vnpay" checked>
        <label class="form-check-label" for="exampleRadios4">
          Vnpay
        </label>
     </div>
     <div class="form-check">
        <input class="form-check-input" type="radio" name="payment" id="exampleRadios5" value="paypal" checked>
        <label class="form-check-label" for="exampleRadios5">
          Paypal
        </label>
     </div>
    <input type="submit" value="Thanh toán ngay" name="thanhtoanngay" class="btn btn-danger" style="display: block; margin-top: 20px; width: 95%;">

    </div>
  </div>
</div>
</form>
<style>
/* Progress Bar Container */
.progress-bar-container {
  margin: 20px 0;
  padding: 10px 0;
  text-align: left;
  position: relative;
}

/* Loading Bar */
.loading-bar {
  position: absolute;
  top: 0;
  left: 0;
  height: 4px;
  width: 0;
  animation: loading-animation 3s linear forwards;
}

@keyframes loading-animation {
  from {
    width: 0;
  }
  to {
    width: 100%;
  }
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
  transition: transform 0.2s ease;
}

/* Form Section */
.row {
  display: flex;
  justify-content: space-between;
  gap: 20px;
  max-width: 100%;
  margin: 20px 0;
}

.col-md-8 {
  flex: 2;
}

.col-md-4 {
  flex: 1;
  text-align: left;
}

.form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 15px;
}

.form-group label {
  margin-bottom: 8px;
}

.form-group input[type="text"],
.form-group input[type="radio"] {
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 14px;
}

.form-group input[name="phone"],
.form-group input[name="address"],
.form-group input[name="note"] {
  margin-top: 10px;
}

.payment-method {
  display: flex;
  flex-direction: column;
  gap: 16px;
  margin-top: 20px;
}

.payment-method label {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 8px;
  cursor: pointer;
}

/* Button Styles */
.btn {
  padding: 12px 24px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  background:red;
  color: white;
}

.btn.btn-primary {
  background: red;
  color: white;
}

/* Table Styles */
.table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  border: 1px solid #ddd;
}

.table th, .table td {
  padding: 16px;
  text-align: center;
  border: 1px solid #ddd;
}

/* Align Amount Closer to Total */
.table .amount-cell {
  text-align: right;
  padding-right: 20px;
}

/* Payment Section */
.payment-container {
  margin-top: 40px;
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

  .row {
    flex-direction: column;
  }

  .col-md-4 {
    text-align: left;
  }

  .table th, .table td {
    padding: 8px;
  }

  .payment-method label {
    padding: 8px;
  }
}
</style>