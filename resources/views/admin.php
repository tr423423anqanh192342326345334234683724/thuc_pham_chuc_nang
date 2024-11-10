<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Lý</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-image: url('/anh/hihi.jpg');
        }
        .section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
        }
        h2 {
            color: #34495e;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            color: #2c3e50;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .action-link {
            display: inline-block;
            padding: 6px 12px;
            margin: 2px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .action-link:hover {
            background-color: #2980b9;
        }
        p {
            color: #2c3e50;
            font-size: 18px;
        }
        .status-select {
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .edit-form {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-success {
            background-color: #2ecc71;
            color: white;
        }
        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }
    </style>
</head>
<body>
    
    <?php
    session_start();
    use Illuminate\Support\Facades\DB;
    $ket_noi = DB::connection()->getPdo();
    // Xử lý cập nhật trạng thái đơn hàng
    if(isset($_POST['cap_nhat_trang_thai'])) {
        $id_don_hang = $_POST['id_don_hang'];
        $trang_thai_moi = $_POST['trang_thai_moi'];
        
        $cap_nhat_sql = "UPDATE don_hang SET trang_thai = ? WHERE id = ?";
        $stmt = $ket_noi->prepare($cap_nhat_sql);
        $stmt->bindParam("si", $trang_thai_moi, $id_don_hang);
        $stmt->execute();
        $stmt = null;
    }

    // Xử lý cập nhật thông tin khách hàng
    if(isset($_POST['cap_nhat_khach_hang'])) {
        $id = $_POST['id'];
        $ten_khach_hang = $_POST['ten_khach_hang'];
        $email = $_POST['email'];
        $so_dien_thoai = $_POST['so_dien_thoai'];
        $dia_chi = $_POST['dia_chi'];
        
        $cap_nhat_sql = "UPDATE khach_hang SET ten_khach_hang = ?, email = ?, so_dien_thoai = ?, dia_chi = ? WHERE id = ?";
        $stmt = $ket_noi->prepare($cap_nhat_sql);
        $stmt->bindParam("ssssi", $ten_khach_hang, $email, $so_dien_thoai, $dia_chi, $id);
        $stmt->execute();
        $stmt = null;
    }

    // Xử lý cập nhật thông tin hàng hóa
    if(isset($_POST['cap_nhat_mat_hang'])) {
        $id = $_POST['id'];
        $ten_mat_hang = $_POST['ten_mat_hang'];
        $loai_mat_hang = $_POST['loai_mat_hang'];
        $gia_mat_hang = $_POST['gia_mat_hang'];
        $so_luong = $_POST['so_luong'];
        
        $cap_nhat_sql = "UPDATE mat_hang SET ten_mat_hang = ?, loai_mat_hang = ?, gia_mat_hang = ?, so_luong = ? WHERE id = ?";
        $stmt = $ket_noi->prepare($cap_nhat_sql);
        $stmt->bindParam("ssdi", $ten_mat_hang, $loai_mat_hang, $gia_mat_hang, $so_luong, $id);
        $stmt->execute();
        $stmt = null;

    }
    if(isset($_POST['xoa_mat_hang'])) {
        $id = $_POST['id'];
        $xoa_sql = "DELETE FROM mat_hang WHERE id = ?";
        $stmt = $ket_noi->prepare($xoa_sql);
        $stmt->bindParam("i", $id);
        $stmt->execute();
        $stmt = null;
    }
    if(isset($_POST['xoa_khach_hang'])) {
        $id = $_POST['id'];
        $xoa_sql = "DELETE FROM khach_hang WHERE id = ?";
        $stmt = $ket_noi->prepare($xoa_sql);
        $stmt->bindParam("i", $id);
        $stmt->execute();
        $stmt = null;
    }

    // Xử lý thêm mặt hàng mới
    if (isset($_POST['them_mat_hang'])) {
        $ten_mat_hang = $_POST['ten_mat_hang'];
        $loai_mat_hang = $_POST['loai_mat_hang'];
        $gia_mat_hang = $_POST['gia_mat_hang'];
        $so_luong = $_POST['so_luong'];
        $hinh_anh = null;

        if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] == 0) {
            $hinh_anh = file_get_contents($_FILES['hinh_anh']['tmp_name']);
        }

        $chen_sql = "INSERT INTO mat_hang (ten_mat_hang, loai_mat_hang, gia_mat_hang, so_luong, hinh_anh) VALUES (?, ?, ?, ?, ?)";
        $stmt = $ket_noi->prepare($chen_sql);
        $stmt->bindParam("ssdis", $ten_mat_hang, $loai_mat_hang, $gia_mat_hang, $so_luong, $hinh_anh);
        $stmt->execute();
        $stmt = null;
    }
    ?>

    <div class="section">
        <h1>Trang Quản Lý</h1>
        <p style="text-align: center;">Xin chào Quản Lý N8</p>
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="#quan-ly-khach-hang" class="btn btn-primary" style="margin: 0 10px;text-decoration: none;">Quản Lý Khách Hàng</a>
            <a href="#quan-ly-hang-hoa" class="btn btn-primary" style="margin: 0 10px;text-decoration: none;">Quản Lý Hàng Hóa</a>
            <a href="#quan-ly-don-hang" class="btn btn-primary" style="margin: 0 10px;text-decoration: none;">Quản Lý Đơn Hàng</a>
            <a href="#thong-ke-binh-luan" class="btn btn-primary" style="margin: 0 10px;text-decoration: none;">Thống Kê Bình Luận</a>
        </div>
        <h2 id="quan-ly-hang-hoa">Quản Lý Hàng Hóa</h2>
        <div id="edit-product-form" class="edit-form">
            <form method="POST">
                <input type="hidden" name="id" id="edit-product-id">
                <div class="mb-3">
                    <label class="form-label">Tên mặt hàng:</label>
                    <input type="text" class="form-control" name="ten_mat_hang" id="edit-product-name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Loại mặt hàng:</label>
                    <input type="text" class="form-control" name="loai_mat_hang" id="edit-product-type">
                </div>
                <div class="mb-3">
                    <label class="form-label">Giá:</label>
                    <input type="number" class="form-control" name="gia_mat_hang" id="edit-product-price">
                </div>
                <div class="mb-3">
                    <label class="form-label">Số lượng:</label>
                    <input type="number" class="form-control" name="so_luong" id="edit-product-quantity">
                </div>
                <button type="submit" name="cap_nhat_mat_hang" class="btn btn-success">Lưu thay đổi</button>
                <button type="button" class="btn btn-secondary" onclick="anFormMatHang()">Hủy</button>
            </form>
        </div>
        <div id="add-product-form" class="edit-form">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Tên mặt hàng:</label>
                    <input type="text" class="form-control" name="ten_mat_hang" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Loại mặt hàng:</label>
                    <input type="text" class="form-control" name="loai_mat_hang" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Giá:</label>
                    <input type="number" class="form-control" name="gia_mat_hang" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Số lượng:</label>
                    <input type="number" class="form-control" name="so_luong" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Hình ảnh:</label>
                    <input type="file" class="form-control" name="hinh_anh" accept="image/*">
                </div>
                <button type="submit" name="them_mat_hang" class="btn btn-success">Thêm Mặt Hàng</button>
                <button type="button" class="btn btn-secondary" onclick="anFormThemMatHang()">Hủy</button>
            </form>
        </div>
        <button onclick="hienFormThemMatHang()" class="action-link">Thêm Mặt Hàng Mới</button>
        <?php
        $quanlyhanghoa = "SELECT * FROM mat_hang ORDER BY id DESC";
        $ket_qua = $ket_noi->query($quanlyhanghoa);
        ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Tên Mặt Hàng</th>
                <th>Loại Mặt Hàng</th>
                <th>Giá</th>
                <th>Số Lượng</th>
                <th>Hình Ảnh</th>
                <th>Thao Tác</th>
            </tr>
            <?php
            if ($ket_qua->rowCount() > 0) {
                while($dong = $ket_qua->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($dong['id']); ?></td>
                        <td><?php echo htmlspecialchars($dong['ten_mat_hang']); ?></td>
                        <td><?php echo htmlspecialchars($dong['loai_mat_hang']); ?></td>
                        <td><?php echo number_format($dong['gia_mat_hang'], 0, ',', '.'); ?> VND</td>
                        <td><?php echo htmlspecialchars($dong['so_luong']); ?></td>
                        <td>
                            <?php
                            if (!empty($dong['hinh_anh'])) {
                                $du_lieu_anh = base64_encode($dong['hinh_anh']);
                                echo '<img src="data:image/jpeg;base64,' . $du_lieu_anh . '" alt="Hình ảnh sản phẩm" style="width: 300px; height: auto;">';
                            } else {
                                echo '<p>Không có hình ảnh</p>';
                            }
                            ?>
                        </td>
                        <td>
                            <button onclick="hienFormMatHang(<?php echo $dong['id']; ?>, '<?php echo addslashes($dong['ten_mat_hang']); ?>', '<?php echo addslashes($dong['loai_mat_hang']); ?>', <?php echo $dong['gia_mat_hang']; ?>, <?php echo $dong['so_luong']; ?>)" class="action-link">Sửa</button>
                            <button onclick="xoa_mat_hang(<?php echo $dong['id']; ?>)" class="action-link">Xóa</button>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <button onclick="hienFormThemMatHang()" class="action-link">Thêm Mặt Hàng Mới</button>
    </div>

    <div class="section">
        <h2 id="quan-ly-khach-hang">Quản Lý Khách Hàng</h2>
        <div id="edit-customer-form" class="edit-form">
            <form method="POST">
                <input type="hidden" name="id" id="edit-customer-id">
                <div class="mb-3">
                    <label class="form-label">Tên khách hàng:</label>
                    <input type="text" class="form-control" name="ten_khach_hang" id="edit-customer-name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" id="edit-customer-email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Số điện thoại:</label>
                    <input type="text" class="form-control" name="so_dien_thoai" id="edit-customer-phone">
                </div>
                <div class="mb-3">
                    <label class="form-label">Địa chỉ:</label>
                    <input type="text" class="form-control" name="dia_chi" id="edit-customer-address">
                </div>
                <button type="submit" name="cap_nhat_khach_hang" class="btn btn-success">Lưu thay đổi</button>
                <button type="button" class="btn btn-secondary" onclick="anFormKhachHang()">Hủy</button>
            </form>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Tên Khách Hàng</th>
                <th>Email</th>
                <th>Số Điện Thoại</th>
                <th>Địa Chỉ</th>
                <th>Thao Tác</th>
            </tr>
            <?php
            $quanlykhachhang = "SELECT * FROM khach_hang ORDER BY id DESC";
            $ket_qua = $ket_noi->query($quanlykhachhang);
            if($ket_qua->rowCount() > 0) {
                while($dong = $ket_qua->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($dong['id']); ?></td>
                        <td><?php echo htmlspecialchars($dong['ten_khach_hang']); ?></td>
                        <td><?php echo htmlspecialchars($dong['email']); ?></td>
                        <td><?php echo htmlspecialchars($dong['so_dien_thoai']); ?></td>
                        <td><?php echo htmlspecialchars($dong['dia_chi']); ?></td>
                        <td>
                            <button onclick="hienFormKhachHang(<?php echo $dong['id']; ?>, '<?php echo addslashes($dong['ten_khach_hang']); ?>', '<?php echo addslashes($dong['email']); ?>', '<?php echo addslashes($dong['so_dien_thoai']); ?>', '<?php echo addslashes($dong['dia_chi']); ?>')" class="action-link">Sửa</button>
                            <button  xoa_khach_hang(<?php echo $dong['id']; ?>) class="action-link">Xóa</button>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>

    <div class="section">
        <h2 id="quan-ly-don-hang">Quản Lý Đơn Hàng</h2>
        <div id="edit-order-form" class="edit-form">
            <form method="POST">
                <input type="hidden" name="id_don_hang" id="edit-order-id">
                <div class="mb-3">
                    <label class="form-label">Trạng thái:</label>
                    <select name="trang_thai_moi" class="form-control" id="edit-order-status">
                        <option value="Chờ Xác Nhận">Chờ xử lý</option>
                        <option value="Đang xử lý">Đang xử lý</option>
                        <option value="Đã Vận Chuyển">Đã Vận Chuyển</option>
                        
                        
                        
                    </select>
                </div>
                <button type="submit" name="cap_nhat_trang_thai" class="btn btn-success">Lưu thay đổi</button>
                <button type="button" class="btn btn-secondary" onclick="anFormDonHang()">Hủy</button>
            </form>
        </div>
        <table>
            <tr>
                <th>ID Đơn Hàng</th>
                <th>ID Khách Hàng</th>
                <th>Tên Khách Hàng</th>
                <th>Ngày Đặt Hàng</th>
                <th>Tổng Tiền</th>
                <th>Trạng Thái</th>
                
            </tr>
            <?php
            $quanlydonhang = "SELECT dh.*, kh.ten_khach_hang 
                             FROM don_hang dh 
                             LEFT JOIN khach_hang kh ON dh.id_khach_hang = kh.id 
                             ORDER BY ngay_dat_hang DESC";
            $ket_qua = $ket_noi->query($quanlydonhang);
            if($ket_qua->rowCount() > 0) {
                while($dong = $ket_qua->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($dong['id']); ?></td>
                        <td><?php echo htmlspecialchars($dong['id_khach_hang']); ?></td>
                        <td><?php echo htmlspecialchars($dong['ten_khach_hang']); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($dong['ngay_dat_hang'])); ?></td>
                        <td><?php echo number_format($dong['tong_tien'], 0, ',', '.'); ?> VND</td>
                        <td>
                            <button onclick="hienFormDonHang(<?php echo $dong['id']; ?>, '<?php echo $dong['trang_thai']; ?>')" class="action-link">
                                <?php echo htmlspecialchars($dong['trang_thai']); ?>
                            </button>
                        </td>
                        
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
    <div class="section">
            <h2 id="thong-ke-binh-luan">Thống Kê Bình Luận</h2>
            <?php
            $thongkebinhluan = "SELECT bl.*, kh.ten_khach_hang 
                               FROM binh_luan bl
                               LEFT JOIN khach_hang kh ON bl.id_khach_hang = kh.id
                               ORDER BY bl.id DESC";
            $ket_qua = $ket_noi->query($thongkebinhluan);
            ?>
            <table>
                <tr>
                    <th>ID Bình Luận</th>
                    <th>ID Khách Hàng</th>
                    <th>Tên Khách Hàng</th>
                    <th>Bình Luận</th>
                </tr>
                <?php
                if($ket_qua->rowCount() > 0) {
                    while($dong = $ket_qua->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($dong['id']); ?></td>
                            <td><?php echo htmlspecialchars($dong['id_khach_hang']); ?></td>
                            <td><?php echo htmlspecialchars($dong['ten_khach_hang']); ?></td>
                            <td><?php echo htmlspecialchars($dong['noi_dung']); ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
    </div>
    <div class="logout" style="text-align: center;">
        <a href="logout.php" class="action-link" style="background-color: red;">Đăng Xuất</a>
    </div>

    <script>
    function hienFormMatHang(id, ten, loai, gia, so_luong) {
        document.getElementById('edit-product-name').value = ten;
        document.getElementById('edit-product-type').value = loai;
        document.getElementById('edit-product-price').value = gia;
        document.getElementById('edit-product-quantity').value = so_luong;
        document.getElementById('edit-product-form').style.display = 'block';
    }
    function them_mat_hang(ten, loai, gia, so_luong, hinh_anh) {
        document.getElementById('edit-product-name').value = ten;
        document.getElementById('edit-product-type').value = loai;
        document.getElementById('edit-product-price').value = gia;
        document.getElementById('edit-product-quantity').value = so_luong;
        document.getElementById('edit-product-image').value = hinh_anh;
        document.getElementById('edit-product-form').style.display = 'block';
    }

    function anFormMatHang() {
        document.getElementById('edit-product-form').style.display = 'none';
    }

    function hienFormKhachHang(id, ten, email, so_dien_thoai, dia_chi) {
        document.getElementById('edit-customer-id').value = id;
        document.getElementById('edit-customer-name').value = ten;
        document.getElementById('edit-customer-email').value = email;
        document.getElementById('edit-customer-phone').value = so_dien_thoai;
        document.getElementById('edit-customer-address').value = dia_chi;
        document.getElementById('edit-customer-form').style.display = 'block';
    }

    function anFormKhachHang() {
        document.getElementById('edit-customer-form').style.display = 'none';
    }

    function hienFormDonHang(id, trang_thai) {
        document.getElementById('edit-order-id').value = id;
        document.getElementById('edit-order-status').value = trang_thai;
        document.getElementById('edit-order-form').style.display = 'block';
    }

    function anFormDonHang() {
        document.getElementById('edit-order-form').style.display = 'none';
    }

    function xoa_khach_hang(id) {
        if(confirm('Bạn có chắc muốn xóa khách hàng này?')) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.innerHTML = '<input type="hidden" name="xoa_khach_hang" value="1"><input type="hidden" name="id" value="' + id + '">';
            document.body.appendChild(form);
            form.submit();
        }
    }

    function xoa_mat_hang(id) {
        if(confirm('Bạn có chắc muốn xóa mặt hàng này?')) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.innerHTML = '<input type="hidden" name="xoa_mat_hang" value="1"><input type="hidden" name="id" value="' + id + '">';
            document.body.appendChild(form);
            form.submit();
        }
    }

    function hienFormThemMatHang() {
        document.getElementById('add-product-form').style.display = 'block';
    }

    function anFormThemMatHang() {
        document.getElementById('add-product-form').style.display = 'none';
    }
    </script>

    <?php $ket_noi = null; ?>
</body>
</html>