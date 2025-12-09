<?php 
    $sql_pro = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.id_danhmuc='$_GET[id]' AND tbl_sanpham.tinhtrang=1 ORDER BY id_sanpham DESC";
    $query_pro = mysqli_query($mysqli, $sql_pro);

    $sql_cate = "SELECT * FROM tbl_danhmuc WHERE tbl_danhmuc.id_danhmuc='$_GET[id]' LIMIT 1";
    $query_cate = mysqli_query($mysqli, $sql_cate);
    $row_title = mysqli_fetch_array($query_cate);
?>

<h3>Danh mục sản phẩm: <?php echo $row_title['tendanhmuc']; ?></h3>
<ul class="product_list">
    <?php
    // Lặp qua danh sách sản phẩm
    while($row = mysqli_fetch_array($query_pro)) {
    ?>
        <li>
            <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham']?>">
                <img src="admincp/modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>" alt="<?php echo $row['tensanpham']; ?>">
                <p class="title_product">Tên sản phẩm: <?php echo $row['tensanpham']; ?></p>
                <p class="price_product">Giá: <?php echo number_format($row['giasp'], 0, ',', '.'); ?> VNĐ</p>
            </a>
        </li>
    <?php
    }
    ?>
</ul>
<style type="text/css">
                    ul.product_list {
                        padding: 0;
                        margin: 0;
                        list-style: none;
                        width: 100%;
                        display: flex;
                        flex-wrap: wrap;
                        gap: 10px;
                    }

                    ul.product_list li {
                        width: calc(20% - 10px); /* Chia 5 sản phẩm mỗi hàng */
                        border: 2px solid #ccc; /* Viền xám */
                        border-radius: 8px; /* Bo góc */
                        padding: 10px;
                        background: #fff;
                        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ */
                        text-align: center;
                    }
                   ul.list_trang{
                    padding: 0;
                    margin:0;
                    list-style: none;
                   }
                   ul.list_trang li{
                    float:left;
                    padding: 5px 13px;
                    margin:5px;
                    background:burlywood;
                    display:block;
                   }
                   ul.list_trang li a{
                    color:#000;
                    text-align:center;
                    text-decoration:none;
                   }
                </style>