<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin khách hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('hihi.jpg');
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: rgba(255,255,255,0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .info-item {
            margin: 15px 0;
            padding: 10px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .edit-form {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thông tin khách hàng</h1>
        <?php
        session_start();
        use Illuminate\Support\Facades\DB;
        $ket_noi = DB::connection()->getPdo();
        
        try {
                
            // Xử lý cập nhật thông tin
            if(isset($_POST['update'])) {
                $sql = "UPDATE khach_hang SET 
                        ten_khach_hang = :ten,
                        email = :email,
                        so_dien_thoai = :sdt,
                        dia_chi = :diachi 
                        WHERE id_tai_khoan = :id";
                
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':ten' => $_POST['ten_khach_hang'],
                    ':email' => $_POST['email'],
                    ':sdt' => $_POST['so_dien_thoai'],
                    ':diachi' => $_POST['dia_chi'],
                    ':id' => $_SESSION['user_id']
                ]);
                
                echo "<div class='alert alert-success'>Cập nhật thông tin thành công!</div>";
            }
            
            // Lấy thông tin khách hàng
            $sql = "SELECT * FROM khach_hang WHERE id_tai_khoan = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $_SESSION['user_id']);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($user) {
                // Hiển thị thông tin
                echo "<div id='info-display'>";
                echo "<div class='info-item'><strong>Tên khách hàng:</strong> " . htmlspecialchars($user['ten_khach_hang']) . "</div>";
                echo "<div class='info-item'><strong>Email:</strong> " . htmlspecialchars($user['email']) . "</div>";
                echo "<div class='info-item'><strong>Số điện thoại:</strong> " . htmlspecialchars($user['so_dien_thoai']) . "</div>";
                echo "<div class='info-item'><strong>Địa chỉ:</strong> " . htmlspecialchars($user['dia_chi']) . "</div>";
                echo "</div>";

                // Form chỉnh sửa
                echo "<div id='edit-form' class='edit-form'>";
                echo "<form method='POST'>";
                echo "<div class='mb-3'>";
                echo "<label class='form-label'>Tên khách hàng:</label>";
                echo "<input type='text' class='form-control' name='ten_khach_hang' value='" . htmlspecialchars($user['ten_khach_hang']) . "'>";
                echo "</div>";
                
                echo "<div class='mb-3'>";
                echo "<label class='form-label'>Email:</label>";
                echo "<input type='email' class='form-control' name='email' value='" . htmlspecialchars($user['email']) . "'>";
                echo "</div>";
                
                echo "<div class='mb-3'>";
                echo "<label class='form-label'>Số điện thoại:</label>";
                echo "<input type='text' class='form-control' name='so_dien_thoai' value='" . htmlspecialchars($user['so_dien_thoai']) . "'>";
                echo "</div>";
                
                echo "<div class='mb-3'>";
                echo "<label class='form-label'>Địa chỉ:</label>";
                echo "<input type='text' class='form-control' name='dia_chi' value='" . htmlspecialchars($user['dia_chi']) . "'>";
                echo "</div>";
                
                echo "<button type='submit' name='update' class='btn btn-success'>Lưu thay đổi</button>";
                echo "<button type='button' class='btn btn-secondary ms-2' onclick='toggleEdit()'>Hủy</button>";
                echo "</form>";
                echo "</div>";
            } else {
                echo "<div class='alert alert-warning'>Không tìm thấy thông tin khách hàng</div>";
            }
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Lỗi kết nối: " . $e->getMessage() . "</div>";
        }
        ?>
        <div class="text-center mt-4">
            <button onclick="toggleEdit()" id="editBtn" class="btn btn-warning">Chỉnh sửa thông tin</button>
            <a href="trangchu.php" class="btn btn-primary">Về trang chủ</a>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleEdit() {
            const infoDisplay = document.getElementById('info-display');
            const editForm = document.getElementById('edit-form');
            const editBtn = document.getElementById('editBtn');
            
            if(editForm.style.display === 'none' || editForm.style.display === '') {
                editForm.style.display = 'block';
                infoDisplay.style.display = 'none';
                editBtn.style.display = 'none';
            } else {
                editForm.style.display = 'none';
                infoDisplay.style.display = 'block';
                editBtn.style.display = 'inline-block';
            }
        }
    </script>
</body>
</html>