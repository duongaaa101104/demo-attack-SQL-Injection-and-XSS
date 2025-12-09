<?php
  $sql_sua_danhmucsp = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='$_GET[iddanhmuc]' LIMIT 1";
  $query_sua_danhmucsp = mysqli_query($mysqli, $sql_sua_danhmucsp);
?>
<p style="font-size: 24px; font-weight: bold; margin-bottom: 15px;">✏️ Sửa danh mục sản phẩm</p>

<style>
  .form-container {
    width: 50%;
    background: #fff;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    font-family: 'Segoe UI', sans-serif;
    box-shadow: 0px 0px 12px rgba(0,0,0,0.05);
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  td {
    padding: 12px 10px;
    font-weight: 500;
  }

  input[type="text"] {
    width: 100%;
    padding: 10px;
    font-size: 15px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
  }

  input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    font-size: 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    width: 100%;
  }

  input[type="submit"]:hover {
    background-color: #45a049;
  }
</style>

<div class="form-container">
  <form method="POST" action="modules/quanlydanhmucsp/xuly.php?iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>">
    <table>
      <?php while($dong = mysqli_fetch_array($query_sua_danhmucsp)) { ?>
        <tr>
          <td>Tên danh mục</td>
          <td><input type="text" value="<?php echo $dong['tendanhmuc'] ?>" name="tendanhmuc"></td>
        </tr>
        <tr>
          <td>Thứ tự</td>
          <td><input type="text" value="<?php echo $dong['thutu'] ?>" name="thutu"></td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" name="suadanhmuc" value="💾 Sửa danh mục sản phẩm">
          </td>
        </tr>
      <?php } ?>
    </table>
  </form>
</div>
