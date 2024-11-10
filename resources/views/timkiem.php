<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm Kiếm Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            
            background-image: url(/anh/hihi.jpg);
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: auto;
        }
        .search-result {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            margin: 10px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .search-result img {
            max-width: 100%;
            border-radius: 5px;
            margin-top: 10px;
        }
        .button-group {
            text-align: center;
            margin: 20px 0;
        }
        .button-group button {
            margin: 0 10px;
        }
        
    </style>
</head>
<body>
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

        <?php
       $ket_noi = DB::connection()->getPdo();
        if (!$ket_noi) {
            die("Connection Lỗi: " . mysqli_connect_error());
        }

        // Kiểm tra và xử lý tìm kiếm
        if (isset($_POST['search'])) {
            $search = mysqli_real_escape_string($ketnoi, $_POST['search']); 
            $sql = "SELECT * FROM mat_hang WHERE ten_mat_hang LIKE '%$search%'";
            $stmt = $ket_noi->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (!$result) {
                die("Lỗi truy vấn: " . mysqli_error($conn));
            }

            // Hiển thị kết quả
            if (count($result) > 0) {
                foreach ($result as $row) {
                    echo "<div class='search-result' style = 'text-align: center;'>";
                    echo "<h4>" . htmlspecialchars($row['ten_mat_hang']) . "</h4>"; 
                    echo "<p><strong>Loại:</strong> " . htmlspecialchars($row['loai_mat_hang']) . "</p>";   
                    echo "<p><strong>Giá:</strong> " . number_format($row['gia_mat_hang'], 0, ',', '.') . " VNĐ</p>"; 
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['hinh_anh']) . '" alt="Hình ảnh sản phẩm">';
                    echo "<br>";
                    echo "<a href='sanphamchitiet.php?id=" . $row['id'] . "' class='btn btn-primary'>Chi tiết</a>";
                    echo "</div>";
                    
                }
            } else {
                echo "<div class='search-result'><p>Không tìm thấy sản phẩm nào.</p></div>";
            }
        }

        // Đóng kết nối
        $ket_noi = null;
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
