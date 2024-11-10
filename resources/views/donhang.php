<?php
session_start();
use Illuminate\Support\Facades\DB;
$ket_noi = DB::connection()->getPdo();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng của bạn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('/anh/hihi.jpg');
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .no-orders {
            text-align: center;
            color: #e74c3c;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Đơn hàng của bạn</h1>   
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên mặt hàng</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
                <th>Ngày đặt hàng</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT dh.id, dh.so_luong, mh.ten_mat_hang, dh.tong_tien, dh.ngay_dat_hang, dh.trang_thai
                FROM don_hang dh
                JOIN mat_hang mh ON dh.id_mat_hang = mh.id";
        $result = $ket_noi->query($sql);

        if ($result->rowCount() > 0) {
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ten_mat_hang']) . "</td>";
                echo "<td>" . htmlspecialchars($row['so_luong']) . "</td>";
                echo "<td>" . number_format($row['tong_tien'], 0, ',', '.') . " VNĐ</td>";
                echo "<td>" . htmlspecialchars($row['ngay_dat_hang']) . "</td>";
                echo "<td>" . htmlspecialchars($row['trang_thai']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='no-orders'>Không có đơn hàng nào.</td></tr>";
        }
        $ket_noi = null;
        ?>
        </tbody>
    </table>
    <div style="text-align: center;">
        <a href="sanpham.php" class="btn btn-primary">Tiếp tục mua sắm</a>
        <a href="trangchu.php" class="btn btn-primary">Trang chủ</a>
    </div>
</body>
</html>