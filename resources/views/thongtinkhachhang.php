<?php
session_start(); // Sử dụng session để lấy id tài khoản đã đăng ký
use Illuminate\Support\Facades\DB;

$ket_noi = DB::connection()->getPdo();


if (!$ket_noi) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nhận dữ liệu từ form
    $email = trim($_POST['email']);
    $so_dien_thoai = trim($_POST['so_dien_thoai']);
    $dia_chi = trim($_POST['dia_chi']);
    $ten_khach_hang = trim($_POST['ten_khach_hang']);

    // Kiểm tra thông tin
    if (empty($email) || empty($so_dien_thoai) || empty($dia_chi) || empty($ten_khach_hang)) {
        $error = 'Vui lòng điền đầy đủ thông tin.';
    } elseif (!is_numeric($so_dien_thoai) || strlen($so_dien_thoai) != 10) {
        $error = 'Số điện thoại phải đủ 10 số.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email không hợp lệ.';
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $ten_khach_hang)) {
        $error = 'Họ và Tên chỉ được chứa ký tự chữ cái.';
    } else {
        // Lấy id_tai_khoan từ bảng tai_khoan_khach_hang dựa trên session
        $tai_khoan = $_SESSION['tai_khoan'];
        $sql = "SELECT id FROM tai_khoan_khach_hang WHERE tai_khoan = ?";
        $stmt = $ket_noi->prepare($sql);
        $stmt->bindParam(1, $tai_khoan);
        $stmt->execute();
        $stmt->bindColumn(1, $id_tai_khoan);
        $stmt->fetch();
        $stmt->closeCursor();

        // Thêm thông tin khách hàng vào bảng khach_hang
        $sql = "INSERT INTO khach_hang (id_tai_khoan, ten_khach_hang, email, so_dien_thoai, dia_chi)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $ket_noi->prepare($sql);
        $stmt->bindParam(1, $id_tai_khoan);
        $stmt->bindParam(2, $ten_khach_hang);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $so_dien_thoai);
        $stmt->bindParam(5, $dia_chi);

        if ($stmt->execute()) {
            // Đăng nhập cho khách hàng
            $_SESSION['id_tai_khoan'] = $id_tai_khoan;
            $_SESSION['ten_khach_hang'] = $ten_khach_hang;
            $_SESSION['email'] = $email;
            $_SESSION['so_dien_thoai'] = $so_dien_thoai;
            $_SESSION['dia_chi'] = $dia_chi;

            echo "<p>Đăng ký thông tin thành công! Chào mừng, " . htmlspecialchars($ten_khach_hang) . "!</p>";
            // Chuyển hướng đến trang đăng nhập
            header('Location: dangnhap.php'); // Chuyển hướng đến trang đăng nhập
            exit();
        } else {
            $error = "Lỗi khi lưu thông tin khách hàng.";
        }

        $stmt->closeCursor();
    }
}

if ($error) {
    echo '<p class="error">' . htmlspecialchars($error) . '</p>';
}

$ket_noi = null;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin khách hàng</title>
    <style>
        body {
            background-image: url('hihi.jpg'); /* Màu nền trắng */
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

        input[type="email"],
        input[type="text"] {
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

<h1>Thông tin khách hàng</h1>

<form method="POST" action="">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="text" name="so_dien_thoai" placeholder="Số điện thoại" required><br>
    <input type="text" name="dia_chi" placeholder="Địa chỉ" required><br>
    <input type="text" name="ten_khach_hang" placeholder="Họ và Tên" required><br>
    <input type="submit" value="Hoàn tất đăng ký">
</form>

</body>
</html>
