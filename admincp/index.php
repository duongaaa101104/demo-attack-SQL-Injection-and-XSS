<?php
session_start();
if(!isset($_SESSION['dangnhap'])){
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admincp</title>
    <link rel="stylesheet" type="text/css" href="css/styleadmincp.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
</head>
<body>
    <h3 class="title_admin">Welcome to AdminCP</h3>
    <div class="wrapper">
   <?php
           include("config/config.php");
           include("modules/header.php");
           include("modules/menu.php");
           include("modules/main.php");
           include("modules/footer.php");
    ?>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
    // Đợi DOM sẵn sàng rồi thêm class
    document.addEventListener("DOMContentLoaded", function() {
        document.body.classList.add('loaded');
    });
</script>
    <script>
			CKEDITOR.replace( 'tomtat' );
            CKEDITOR.replace( 'noidung' );
            CKEDITOR.replace( 'thongtinlienhe' );
	</script>
    <script>
        new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'chart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
            { year: '2008', value: 20 },
            { year: '2009', value: 10 },
            { year: '2010', value: 5 },
            { year: '2011', value: 5 },
            { year: '2012', value: 20 }
        ],
        // The name of the data record attribute that contains x-values.
        xkey: 'year',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['value'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['Value']
        });
    </script>
</body>
</html>
<style>
    /* styleadmincp.css */

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f4f6f9;
    margin: 0;
    padding: 0;
}

.title_admin {
    text-align: center;
    font-size: 28px;
    font-weight: bold;
    color: #34495e;
    padding: 20px;
    background: linear-gradient(135deg, #6dd5ed, #2193b0);
    color: white;
    margin: 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.wrapper {
    width: 95%;
    max-width: 1200px;
    margin: 20px auto;
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.wrapper:hover {
    transform: scale(1.01);
}

.chart-container {
    padding: 20px;
    margin-top: 20px;
    background: #fafafa;
    border-radius: 10px;
    box-shadow: inset 0 0 5px rgba(0,0,0,0.05);
    transition: background 0.3s ease;
}

.chart-container:hover {
    background: #f1f1f1;
}

/* Menu và Header (nếu có) */
header, nav, footer {
    padding: 15px;
    background-color: #2c3e50;
    color: white;
    border-radius: 8px;
    margin-bottom: 20px;
}

nav a {
    color: white;
    text-decoration: none;
    padding: 8px 16px;
    display: inline-block;
    transition: background-color 0.2s;
}

nav a:hover {
    background-color: #34495e;
    border-radius: 4px;
}

/* CKEditor styles */
textarea {
    width: 100%;
    min-height: 150px;
    margin-bottom: 20px;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
}
body {
    opacity: 0;
    transition: opacity 0.3s ease-in;
}

body.loaded {
    opacity: 1;
}
</style>