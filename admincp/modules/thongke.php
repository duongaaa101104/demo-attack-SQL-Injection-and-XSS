<?php
use Carbon\Carbon;
include('../config/config.php');
require('../../carbon/autoload.php');

// Lấy dữ liệu
$sundays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

$sql = "SELECT * FROM tbl_thongke WHERE ngaydat BETWEEN '$sundays' AND '$now' ORDER BY ngaydat ASC";
$sql_query = mysqli_query($mysqli, $sql);

$chart_data = []; // Khởi tạo mảng trống tránh lỗi

while ($val = mysqli_fetch_assoc($sql_query)) {
    $chart_data[] = [
        'date' => $val['ngaydat'],
        'order' => (int) $val['donhang'],
        'sales' => (float) $val['doanhthu'],
        'quantity' => (int) $val['soluongban']
    ];
}

// Trả về JSON
header('Content-Type: application/json');
echo json_encode($chart_data);
exit;
?>
