<?php
  $sql_lietke_sp = "SELECT * FROM tbl_sanpham, tbl_danhmuc 
                    WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc 
                    ORDER BY id_sanpham DESC";
  $query_lietke_sp =  mysqli_query($mysqli, $sql_lietke_sp);
  if (!$query_lietke_sp) {
    die("Lỗi truy vấn SQL: " . mysqli_error($mysqli));
  }
?>

<!-- Font Awesome để dùng icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  p.title {
    font-size: 22px;
    font-weight: bold;
    color: #444;
    margin-bottom: 15px;
  }

  table.product-table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border: 1px solid #ccc;
    box-shadow: 0 0 5px rgba(0,0,0,0.05);
  }

  table.product-table th,
  table.product-table td {
    border: 1px solid #ccc;
    padding: 8px 12px;
    text-align: center;
    font-size: 14px;
  }

  table.product-table th {
    background-color: #1976d2;
    color: white;
  }

  table.product-table img {
    max-width: 100px;
    border-radius: 5px;
  }

  .short-text {
    max-width: 180px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: left;
  }

  .action-links {
    display: flex;
    justify-content: center;
    gap: 8px;
  }

  .action-links a {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 6px;
    background-color: #f1f1f1;
    border-radius: 4px;
    text-decoration: none;
    font-size: 13px;
    border: 1px solid #ccc;
    color: #333;
    transition: 0.3s;
  }

  .action-links a:hover {
    background-color: #e3f2fd;
    color: #1976d2;
  }

  .status {
    font-weight: bold;
  }

  .status.active {
    color: green;
  }

  .status.inactive {
    color: red;
  }
</style>

<p class="title">📦 Liệt kê sản phẩm</p>

<table class="product-table">
  <tr>
    <th>ID</th>
    <th>Tên sản phẩm</th>
    <th>Hình ảnh</th>
    <th>Giá SP</th>
    <th>Số lượng</th>
    <th>Danh mục</th>
    <th>Mã SP</th>
    <th>Tóm tắt</th>
    <th>Tình trạng</th>
    <th>Quản lý</th>
  </tr>

  <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query_lietke_sp)) {
      $i++;
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['tensanpham'] ?></td>
    <td><img src="modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" alt="Ảnh sản phẩm"></td>
    <td><?php echo number_format($row['giasp'], 0, ',', '.') ?>đ</td>
    <td><?php echo $row['soluong'] ?></td>
    <td><?php echo $row['tendanhmuc'] ?></td>
    <td><?php echo $row['masp'] ?></td>
    <td class="short-text"><?php echo $row['tomtat'] ?></td>
    <td>
      <span class="status <?php echo $row['tinhtrang'] == 1 ? 'active' : 'inactive'; ?>">
        <?php echo $row['tinhtrang'] == 1 ? 'Kích hoạt' : 'Ẩn'; ?>
      </span>
    </td>
    <td>
      <div class="action-links">
        <a href="modules/quanlysp/xuly.php?idsanpham=<?php echo $row['id_sanpham']?>" title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')">
          <i class="fas fa-trash-alt"></i> Xóa
        </a>
        <a href="?action=quanlysp&query=sua&idsanpham=<?php echo $row['id_sanpham']?>" title="Sửa">
          <i class="fas fa-edit"></i> Sửa
        </a>
      </div>
    </td>
  </tr>
  <?php } ?>
</table>
