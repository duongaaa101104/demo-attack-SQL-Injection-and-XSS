<p class="section-title">Thêm danh mục bài viết</p>
<div class="form-wrapper">
  <form method="POST" action="modules/quanlydanhmucbaiviet/xuly.php">
    <table class="form-table">
      <tr>
        <td class="label">Tên danh mục bài viết</td>
        <td><input type="text" name="tendanhmucbaiviet" class="input-field" placeholder="Nhập tên danh mục..."></td>
      </tr>
      <tr>
        <td class="label">Thứ tự</td>
        <td><input type="text" name="thutu" class="input-field" placeholder="Nhập thứ tự..."></td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" name="themdanhmucbaiviet" value="Thêm danh mục bài viết" class="submit-btn">
        </td>
      </tr>
    </table>
  </form>
</div>

<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 20px;
  }

  .section-title {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-left: 0; /* Căn trái */
    margin-bottom: 15px;
  }

  .form-wrapper {
    width: 50%;
    /* margin-left: 0; // để căn trái tuyệt đối */
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  }

  .form-table {
    width: 100%;
    border-collapse: collapse;
  }

  .form-table td {
    padding: 10px;
    vertical-align: top;
  }

  .label {
    width: 40%;
    font-weight: bold;
    color: #333;
  }

  .input-field {
    width: 100%;
    padding: 10px;
    font-size: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: all 0.3s ease;
  }

  .input-field:focus {
    border-color: #4CAF50;
    background-color: #fff;
    outline: none;
  }

  .submit-btn {
    width: 100%;
    padding: 12px;
    background-color: #0056b3;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 10px;
  }

  .submit-btn:hover {
    background-color: #45a049;
  }
</style>
