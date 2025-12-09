<p class="section-title">📝 Thêm bài viết</p>
<div class="form-container">
  <form method="POST" action="modules/quanlybaiviet/xuly.php" enctype="multipart/form-data" class="styled-form">
    <div class="form-group">
      <label>Tên bài viết</label>
      <input type="text" name="tenbaiviet" required>
    </div>

    <div class="form-group">
      <label>Hình ảnh</label>
      <input type="file" name="hinhanh" accept="image/*">
    </div>

    <div class="form-group">
      <label>Tóm tắt</label>
      <textarea name="tomtat" rows="4" required></textarea>
    </div>

    <div class="form-group">
      <label>Nội dung</label>
      <textarea name="noidung" rows="6" required></textarea>
    </div>

    <div class="form-group">
      <label>Danh mục bài viết</label>
      <select name="danhmuc" required>
        <?php
        $sql_danhmuc = "SELECT * FROM tbl_danhmucbaiviet ORDER BY id_baiviet DESC";
        $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
        while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
        ?>
        <option value="<?= $row_danhmuc['id_baiviet'] ?>"><?= $row_danhmuc['tendanhmuc_baiviet'] ?></option>
        <?php } ?>
      </select>
    </div>

    <div class="form-group">
      <label>Tình trạng</label>
      <select name="tinhtrang">
        <option value="1">Kích hoạt</option>
        <option value="0">Ẩn</option>
      </select>
    </div>

    <div class="form-actions">
      <button type="submit" name="thembaiviet">➕ Thêm bài viết</button>
    </div>
  </form>
</div>
<style>
  .section-title {
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #2c3e50;
    font-family: Arial, sans-serif;
  }

  .form-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    max-width: 100%;
    font-family: Arial, sans-serif;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
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
  input[type="file"],
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

  input[type="submit"],
  .form-actions button {
    background-color: #3498db;
    color: white;
    padding: 12px;
    font-size: 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    width: 100%;
    font-weight: 600;
  }

  input[type="submit"]:hover,
  .form-actions button:hover {
    background-color: #2980b9;
  }
</style>

