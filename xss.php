<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Demo XSS Attack</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 50px; text-align: center; }
        .search-box { padding: 20px; border: 1px solid #ddd; display: inline-block; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input { padding: 10px; width: 300px; }
        button { padding: 10px 20px; background: #28a745; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

<div class="search-box">
    <h2>🔍 Tìm kiếm sản phẩm</h2>
    <form method="GET">
        <input type="text" name="keyword" placeholder="Nhập từ khóa (Ví dụ: iPhone)...">
        <button type="submit">Tìm kiếm</button>
    </form>

    <div style="margin-top: 20px;">
        <?php
        if (isset($_GET['keyword'])) {
            $tukhoa = $_GET['keyword'];
            // LỖI Ở ĐÂY: In trực tiếp từ khóa ra màn hình mà không lọc mã độc
            echo "<h3>Kết quả tìm kiếm cho: " . $tukhoa . "</h3>";
        }
        ?>
    </div>
</div>

</body>
</html>