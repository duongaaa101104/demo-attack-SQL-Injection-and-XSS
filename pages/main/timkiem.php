<?php
    // Kết nối database
    @include('admincp/config/config.php');
    
    // Xử lý biến kết nối (Hỗ trợ cả $mysqli và $conn)
    $conn_db = isset($mysqli) ? $mysqli : (isset($conn) ? $conn : null);

    if(isset($_POST['tukhoa'])){
        $tukhoa = $_POST['tukhoa'];
    } else {
        $tukhoa = '';
    }
?>

<h3>Từ khóa tìm kiếm : <?php echo $tukhoa; ?></h3>

<?php
    // ------------------------------------------------------------------
    // ⚠️ QUAN TRỌNG: CHỈ SELECT 4 CỘT ĐỂ DỄ TẤN CÔNG UNION ⚠️
    // ------------------------------------------------------------------
    // Thay vì SELECT * (không biết bao nhiêu cột), ta chỉ lấy đúng 4 cái:
    // 1. id_sanpham
    // 2. tensanpham
    // 3. giasp
    // 4. hinhanh
    $sql_pro = "SELECT id_sanpham, tensanpham, giasp, hinhanh FROM tbl_sanpham WHERE tensanpham LIKE '%".$tukhoa."%'";
    
    if($conn_db){
        $query_pro = mysqli_query($conn_db, $sql_pro);
        
        // --- ĐOẠN NÀY ĐỂ DEBUG (BÁO LỖI NẾU TẤN CÔNG SAI) ---
        if (!$query_pro) {
            echo "<div style='color:red; border:1px solid red; padding:10px; margin:10px;'>";
            echo "<b>LỖI SQL (DEBUG):</b> " . mysqli_error($conn_db);
            echo "<br><i>(Hãy đọc lỗi này để biết bạn sai tên bảng hay sai số cột)</i>";
            echo "</div>";
        }
    }
?>

<ul class="product_list">
    <?php
    if(isset($query_pro) && $query_pro){
        while($row = mysqli_fetch_array($query_pro)){
    ?>
    <li>
        <a href="#">
            <img src="admincp/modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>" 
                 onerror="this.src='https://cdn-icons-png.flaticon.com/512/2748/2748558.png'">
            
            <p class="title_product" style="color:blue; font-weight:bold;">
                <?php echo $row['tensanpham']; ?>
            </p>
            
            <p class="price_product" style="color:red; font-weight:bold;">
                Giá/Pass: <?php echo $row['giasp']; ?>
            </p>
        </a>
    </li>
    <?php
        }
    }
    ?>
</ul>

<style type="text/css">
    ul.product_list { padding: 0; margin: 0; list-style: none; width: 100%; display: flex; flex-wrap: wrap; gap: 10px; }
    ul.product_list li { width: calc(20% - 10px); border: 2px solid #ccc; border-radius: 8px; padding: 10px; background: #fff; text-align: center; overflow: hidden; }
    ul.product_list li img { width: 100%; height: 150px; object-fit: contain; }
</style>