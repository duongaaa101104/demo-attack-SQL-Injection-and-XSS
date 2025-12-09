<?php
    if(isset($_GET['trang'])){
        $page=$_GET['trang'];
    }else{
        $page='';
    }
    if($page==''||$page==1){
        $begin=0;

    }else{
        $begin=($page*8)-8;
    }
    $sql_pro = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc ORDER BY tbl_sanpham.id_sanpham DESC LIMIT $begin,8";
    $query_pro = mysqli_query($mysqli, $sql_pro);
?>
<h3>Sản phẩm mới nhất</h3>
                <ul class="product_list">
                    <?php
                    while($row =mysqli_fetch_array( $query_pro)){
                    ?>
                   <li>
                    <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham']?>">
                       <img src="admincp/modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>" alt="<?php echo $row['tensanpham']; ?>">
                       <p class="title_product">Tên sản phẩm: <?php echo $row['tensanpham']; ?></p>
                       <p class="price_product">Giá: <?php echo number_format($row['giasp'], 0, ',', '.'); ?> VNĐ</p>
                       <p style="text-align:center;color:#d1d1d1;"><?php echo $row['tensanpham']; ?></p>
                    </a>
                   </li>
                   <?php
                    }
                   ?>
                </ul>
                <div style="clear:both;"></div>
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
                <p>Trang:</p>
                <?php
                $sql_trang=mysqli_query($mysqli,"SELECT *FROM tbl_sanpham ");
                $row_count=mysqli_num_rows($sql_trang);
                $trang=ceil($row_count/8);
                ?>
                <ul class="list_trang">
                    <?php
                    for($i=1;$i<=$trang;$i++){
                    ?>
                    <li <?php if($i==$page){ echo 'style="background:brown"';}else{echo '';}?> ><a href="index.php?trang=<?php echo $i?>"><?php echo $i ?></a></li>
                   <?php
                   }
                   ?>
                </ul>