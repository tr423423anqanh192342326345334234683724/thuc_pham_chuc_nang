<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-image: url('/anh/hihi.jpg');
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-message {
            text-align: center;
            margin-top: 20px;
        }
        .login-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    echo "<div class='login-message'>";
    echo "<h1>Vui Lòng Đăng Nhập Trước</h1>";
    echo "<a href='/dangnhap' class='login-button'>Đăng Nhập</a>";
    echo "</div>";
    exit();
}
?>
    
</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <title>Chi tiết sản phẩm</title>
    <style>
        body {
            background-image: url('/anh/ahihi.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }
        .product-detail {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        img {
            max-width: 100%;
            border-radius: 5px;
            display: block;
            margin: 0 auto;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            text-align: center;
        }
        .related-products {
            margin-top: 40px;
        }
        .related-products h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .related-products .product-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            width: calc(33.33% - 20px);
            box-sizing: border-box;
            background-color: #fff;
            transition: box-shadow 0.3s;
            display: inline-block;
            margin: 10px;
        }
        .related-products .product-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Sản phẩm Thực phẩm chức năng</h1>
    <nav class="navbar navbar-expand-lg navbar-light" style="background: linear-gradient(to right, #87CEEB, #FFFFFF); border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); height: 100px;">
            <div class="container-fluid">
                <a class="navbar-brand" href="trangchu.php" style="padding-top: 100px; transition: transform 0.2s; transform: scale(1.1);   ">
                    <img src="logo.png" alt="Logo" style="width: 200px; height: auto;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>   
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item dropdown">
                            <a style="text-decoration: none; color: black; font-weight: bold;" class="nav-link dropdown-toggle" href="sanphan.php" id="navbarDropdown" role="button">
                                Sản phẩm
                            </a>
                            <ul class="dropdown-menu" id="productDropdown" aria-labelledby="navbarDropdown">
                                <?php   
                                use Illuminate\Support\Facades\DB;

                                $ket_noi = DB::connection()->getPdo();
                                if (!$ket_noi) {
                                    die("Kết nối thất bại: " . mysqli_connect_error());
                                }

                                $sql = "SELECT DISTINCT loai_mat_hang FROM mat_hang";
                                $stmt = $ket_noi->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                if (count($result) > 0) {
                                    foreach ($result as $row) {
                                        switch ($row['loai_mat_hang']) {
                                            case "Vitamins":
                                                echo "<li><a class='dropdown-item' href='vitamin.php'>{$row['loai_mat_hang']}</a></li>";
                                                break;
                                            case "Kháng Chất":
                                                echo "<li><a class='dropdown-item' href='khoangchat.php'>{$row['loai_mat_hang']}</a></li>";
                                                break;
                                            case "Thực phẩm bổ sung":
                                                echo "<li><a class='dropdown-item' href='thucphamboxung.php'>{$row['loai_mat_hang']}</a></li>";
                                                break;
                                            case "Mẹ và bé":
                                                echo "<li><a class='dropdown-item' href='mevabe.php'>{$row['loai_mat_hang']}</a></li>";
                                                break;
                                            default:
                                                echo "<li><a class='dropdown-item' href='#'>{$row['loai_mat_hang']}</a></li>";
                                                break;
                                        }
                                    }
                                }
                                $ket_noi = null;
                                ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a style="text-decoration: none; color: black; font-weight: bold;" class="nav-link" href="gioithieu.php">Giới thiệu</a>
                        </li>
                        <li class="nav-item">
                            <a style="text-decoration: none; color: black; font-weight: bold;" class="nav-link" href="lienhe.php">Liên hệ</a>
                        </li>
                    </ul>
                </div>
                <form action="timkiem.php" method="post" class="d-flex" style="flex-grow: 1;">
                    <input style="width: 600px;" class="form-control me-2" type="text" name="search" placeholder="Tìm kiếm sản phẩm" required>
                    <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                </form>
                
            </div>
        </nav>
        <script>
        function showDropdown() {
            document.getElementById("productDropdown").style.display = 'block';
        }

        function hideDropdown() {
            document.getElementById("productDropdown").style.display = 'none';
        }


        const dropdownToggle = document.getElementById("navbarDropdown");
        const dropdownMenu = document.getElementById("productDropdown");

        if (dropdownToggle && dropdownMenu) {
            dropdownToggle.addEventListener("mouseenter", showDropdown);
            dropdownToggle.addEventListener("mouseleave", hideDropdown);
            dropdownMenu.addEventListener("mouseenter", showDropdown);
            dropdownMenu.addEventListener("mouseleave", hideDropdown);
        }
        
    </script>
        <br>
        <br>
        <br>
    <div class="product-detail">
        <?php
        $ket_noi = DB::connection()->getPdo();
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM mat_hang WHERE id = ?";
            $result = DB::select($sql, [$id]);

            if ($result && count($result) > 0) {
                    $row = $result[0];
                echo "<h1>" . htmlspecialchars($row->ten_mat_hang) . "</h1>";
                echo "<p><strong>Loại:</strong> " . htmlspecialchars($row->loai_mat_hang) . "</p>";
                
                // Kiểm tra xem cột 'cong_dung_mat_hang' có tồn tại không
                if (isset($row->cong_dung_mat_hang)) {
                    echo "<p><strong>Công dụng:</strong> " . htmlspecialchars($row->cong_dung_mat_hang) . "</p>";
                }
                
                    echo "<p><strong>Giá:</strong> " . number_format($row->gia_mat_hang, 0, ',', '.') . " VNĐ</p>";
                
                
                if (!empty($row['hinh_anh'])) {
                    $imageData = base64_encode($row['hinh_anh']);
                    echo '<img src="data:image/jpeg;base64,' . $imageData . '" alt="Hình ảnh sản phẩm">';
                } else {
                    echo '<p>Không có hình ảnh</p>';
                }
                
    
            } else {
                echo "<p>Không tìm thấy sản phẩm.</p>";
            }
            
        } else {
            echo "<p>Không có thông tin sản phẩm.</p>";
        }
       ?>
       <br>
       <br>
       <form method="POST" action="giohang.php">
           <input type="hidden" name="product_id" value="<?php echo $id; ?>">
           <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
           <input type="number" name="quantity" value="1" min="1" max="20" style="width: 50px; margin-right: 10px;">
           <button type="submit" name="add_to_cart" style="background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: bold;">Thêm vào giỏ hàng</button>
       </form>
    </div>
    
    <div class="related-products">
       <h2>Sản phẩm liên quan</h2>
       <div class="product-list">
       <?php 
        if(isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $sql = "SELECT * FROM mat_hang WHERE loai_mat_hang = (SELECT loai_mat_hang FROM mat_hang WHERE id = $id) AND id != $id";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='product-item' >";
                    echo "<h3>" . htmlspecialchars($row['ten_mat_hang']) . "</h3>";
                    echo "<p>Loại: " . htmlspecialchars($row['loai_mat_hang']) . "</p>";
                    echo "<p>Giá: " . number_format($row['gia_mat_hang'], 0, ',', '.') . " VNĐ</p>";
                    
                    if (!empty($row['hinh_anh'])) {
                        $imageData = base64_encode($row['hinh_anh']);
                        echo '<img src="data:image/jpeg;base64,' . $imageData . '" alt="Hình ảnh sản phẩm" style="width: 200px; height: 200px;">';
                        
                    } else {
                        echo '<img src="sk.png" alt="Hình ảnh sản phẩm" style="width: 200px; height: 200px;">';
                    }
                    echo "<button style='background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;'><a href='sanphamchitiet.php?id=" . $row['id'] . "' style='text-decoration: none; color: white; font-weight: bold;'>Chi tiết</a></button>";
                    echo "</div>";
                }
            } else {
                echo"<div class='product-item' style='text-align: center; padding-left: 100px;'>";
                echo "<h3>  Không có sản phẩm liên quan.</h3>";
                
                echo"</div>";
                echo"<br>";
                echo"<br>";
                echo"<div class='product-item mx2' style='text-align: center;'>";
                echo"<h4>Hãy Thử Tìm Kiếm Sản Phẩm</h4>";
                echo"</div>";
            }
        }

        $ket_noi = null;
        ?>
        </div>
        <br>
        <br>
        
    </div>
    
</body>
</html>
