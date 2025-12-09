<?php
$sql_sua_sp = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$_GET[idsanpham]' LIMIT 1";
$query_sua_sp = mysqli_query($mysqli, $sql_sua_sp);
?>

<!-- CSS giống thêm sản phẩm -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
  .form-container {
    background-color: #fafafa;
    padding: 20px;
    border: 1px solid #ddd;
    max-width: 800px;
    border-radius: 8px;
  }

  .form-container h2 {
    font-size: 20px;
    margin-bottom: 15px;
    color: #1976d2;
  }

  .form-group {
    margin-bottom: 15px;
  }

  .form-group label {
    font-weight: 500;
    display: block;
    margin-bottom: 5px;
  }

  .form-group input[type="text"],
  .form-group input[type="number"],
  .form-group input[type="file"],
  .form-group textarea,
  .form-group select {
    width: 100%;
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
  }

  .form-group textarea {
    resize: vertical;
    min-height: 80px;
  }

  .submit-btn {
    background-color: #1976d2;
    color: white;
    padding: 10px 18px;
    font-size: 15px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
  }

  .submit-btn:hover {
    background-color: #1565c0;
  }

  .img-preview {
    margin-top: 8px;
    max-height: 120px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
</style>

<div class="form-container">
  <h2>✏️ Sửa sản phẩm</h2>

  <?php while ($row = mysqli_fetch_array($query_sua_sp)) { ?>
    <form method="POST" action="modules/quanlysp/xuly.php?idsanpham=<?php echo $_GET['idsanpham'] ?>" enctype="multipart/form-data">

      <div class="form-group">
        <label for="tensanpham">Tên sản phẩm</label>
        <input type="text" name="tensanpham" value="<?php echo $row['tensanpham'] ?>" required>
      </div>

      <div class="form-group">
        <label for="masp">Mã sản phẩm</label>
        <input type="text" name="masp" value="<?php echo $row['masp'] ?>" required>
      </div>

      <div class="form-group">
        <label for="giasp">Giá sản phẩm</label>
        <input type="text" name="giasp" value="<?php echo $row['giasp'] ?>" required>
      </div>

      <div class="form-group">
        <label for="soluong">Số lượng</label>
        <input type="text" name="soluong" value="<?php echo $row['soluong'] ?>" required>
      </div>

      <div class="form-group">
        <label for="hinhanh">Hình ảnh mới (nếu có)</label>
        <input type="file" name="hinhanh" accept="image/*">
        <img src="modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" class="img-preview">
      </div>

      <div class="form-group">
        <label for="tomtat">Tóm tắt sản phẩm</label>
        <textarea name="tomtat"><?php echo $row['tomtat'] ?></textarea>
      </div>

      <div class="form-group">
        <label for="noidung">Nội dung sản phẩm</label>
        <textarea name="noidung"><?php echo $row['noidung'] ?></textarea>
      </div>

      <div class="form-group">
        <label for="danhmuc">Danh mục sản phẩm</label>
        <select name="danhmuc">
          <?php
          $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
          $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
          while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
            $selected = ($row_danhmuc['id_danhmuc'] == $row['id_danhmuc']) ? 'selected' : '';
            echo "<option value='{$row_danhmuc['id_danhmuc']}' $selected>{$row_danhmuc['tendanhmuc']}</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="tinhtrang">Tình trạng</label>
        <select name="tinhtrang">
          <option value="1" <?php echo ($row['tinhtrang'] == 1) ? 'selected' : '' ?>>Kích hoạt</option>
          <option value="0" <?php echo ($row['tinhtrang'] == 0) ? 'selected' : '' ?>>Ẩn</option>
        </select>
      </div>

      <button type="submit" name="suasanpham" class="submit-btn">
        <i class="fas fa-save"></i> Cập nhật sản phẩm
      </button>
    </form>
  <?php } ?>
</div>
