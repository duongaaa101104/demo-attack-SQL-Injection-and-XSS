<p>Quản lý thông tin website</p>

<?php
  $sql_lh = "SELECT * FROM tbl_lienhe WHERE id = 1";
  $query_lh = mysqli_query($mysqli, $sql_lh);
  $dong = mysqli_fetch_array($query_lh);
?>

<form method="POST" action="modules/thongtinwed/xuly.php?id=<?php echo $dong['id']; ?>" enctype="multipart/form-data">
  <table border="1" width="100%" style="border-collapse: collapse;">
    <tr>
      <td width="150px">Thông tin liên hệ</td>
      <td>
        <textarea rows="10" id="thongtinlienhe" name="thongtinlienhe" style="resize: none; width: 100%;"><?php echo htmlspecialchars($dong['thongtinlienhe']) ?></textarea>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: center;">
        <input type="submit" name="submitlienhe" value="Cập nhật">
      </td>
    </tr>
  </table>
</form>
