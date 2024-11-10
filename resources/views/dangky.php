<?php
session_start(); // Khởi tạo session
use Illuminate\Support\Facades\DB;
$ket_noi = DB::connection()->getPdo();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $tai_khoan = trim($_POST['tai_khoan']);
    $mat_khau = trim($_POST['mat_khau']);
    $confirm_mat_khau = trim($_POST['confirm_mat_khau']);

    // Kiểm tra xem tên tài khoản đã tồn tại chưa
    $check_sql = "SELECT * FROM tai_khoan_khach_hang WHERE tai_khoan = ?";
    $check_stmt = $ket_noi->prepare($check_sql);
    $check_stmt->execute([$tai_khoan]);
    $result = $check_stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($tai_khoan) || empty($mat_khau) || empty($confirm_mat_khau)) {
        $error = 'Vui lòng điền đầy đủ thông tin.';
    } elseif ($mat_khau !== $confirm_mat_khau) {
        $error = 'Mật khẩu xác nhận không khớp.';
    } elseif ($result) {
        $error = 'Tên tài khoản đã tồn tại.';
    } else {
        // Mã hóa mật khẩu trước khi lưu
        $hashed_password = password_hash($mat_khau, PASSWORD_DEFAULT);

        // Thêm tài khoản vào bảng tai_khoan_khach_hang
        $sql = "INSERT INTO tai_khoan_khach_hang (tai_khoan, mat_khau) VALUES (?, ?)";
        $stmt = $ket_noi->prepare($sql);

        if ($stmt->execute([$tai_khoan, $hashed_password])) {
            // Lưu tên tài khoản vào session
            $_SESSION['tai_khoan'] = $tai_khoan;

            // Chuyển hướng sang màn hình điền thông tin khách hàng
            header('Location: /thongtinkhachhang');
            exit();
        }

        $stmt = null;
    }

    $check_stmt = null;
}

$ket_noi = null;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký hoặc Đăng nhập</title>
    <style>
        body {
            background-image: url('/anh/hihi.jpg'); /* Màu nền trắng */
            color: black; /* Màu chữ đen */
            font-family: Arial, sans-serif; /* Font chữ */
            padding: 20px; /* Khoảng cách cho body */
            text-align: center; /* Căn giữa văn bản */
        }

        h1 {
            margin-bottom: 20px; /* Khoảng cách dưới tiêu đề */
        }

        form {
            max-width: 400px; /* Chiều rộng tối đa cho form */
            margin: auto; /* Căn giữa form */
            padding: 20px; /* Khoảng cách bên trong form */
            border: 1px solid #ccc; /* Viền cho form */
            border-radius: 10px; /* Bo tròn góc cho form */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Hiệu ứng đổ bóng */
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 22px); /* Chiều rộng 100% - padding */
            padding: 10px; /* Khoảng cách bên trong input */
            margin: 10px 0; /* Khoảng cách giữa các input */
            border: 1px solid #ccc; /* Viền cho input */
            border-radius: 5px; /* Bo tròn góc cho input */
            box-sizing: border-box; /* Bao gồm padding và border vào kích thước */
        }

        input[type="submit"] {
            background-color: #007bff; /* Màu nền nút xanh */
            color: white; /* Màu chữ trong nút */
            border: none; /* Không có viền */
            border-radius: 5px; /* Bo tròn góc nút */
            padding: 10px 20px; /* Padding cho nút */
            cursor: pointer; /* Con trỏ chuột chuyển thành hình tay khi hover */
            transition: background-color 0.3s; /* Hiệu ứng chuyển màu */
            width: 100%; /* Chiều rộng 100% */
        }

        input[type="submit"]:hover {
            background-color: #0056b3; /* Màu nền nút khi hover */
        }

        .error {
            color: red; /* Màu chữ đỏ cho thông báo lỗi */
            margin-bottom: 15px; /* Khoảng cách dưới thông báo lỗi */
        }
    </style>
</head>
<body>

<h1>Đăng ký hoặc Đăng nhập</h1>

<?php if ($error): ?>
    <p class="error"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="POST" action="{{ route('dangky') }}">
    @csrf
    <input type="text" name="tai_khoan" placeholder="Tên tài khoản" required><br>
    <input type="password" name="mat_khau" placeholder="Mật khẩu" required><br>
    <input type="password" name="confirm_mat_khau" placeholder="Nhập lại mật khẩu" required><br>
    <input type="submit" value="Đăng ký">
</form>

<a href="dangnhap.php" class="toggle-link">Đã có tài khoản? Đăng nhập</a>

</body>
</html>
