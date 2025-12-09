<h3  style="text:align:center;text-transform:uppercase;">Tin túc mới nhất</h3>
<?php 
    $sql_bv = "SELECT * FROM tbl_baiviet WHERE tinhtrang=1 ORDER BY id DESC";
    $query_bv = mysqli_query($mysqli, $sql_bv);

?>
<ul class="product_list">
    <?php
    while($row_bv = mysqli_fetch_array($query_bv)) {
    ?>
        <li>
            <a href="index.php?quanly=baiviet&id=<?php echo  $row_bv['id']?>">
                <img src="admincp/modules/quanlybaiviet/uploads/<?php echo $row_bv['hinhanh']?>">
                <p class="title_product">Tên bài viết: <?php echo  $row_bv['tenbaiviet']?></p>
             
            </a>
            <p style="color:red"class="title_product"> <?php echo  $row_bv['tomtat']?></p>
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