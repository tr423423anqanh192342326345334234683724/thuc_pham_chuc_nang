<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm Vitamins</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">  
    <style>
        body {
            background-image: url('hihi.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
            font-size: 2rem;
        }
        .product-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        .product-item {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            transition: transform 0.2s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 15px;
            text-align: center;
        }
        .product-item:hover {
            transform: scale(1.05);
        }
        img {
            max-width: 100%;
            border-radius: 10px;
            margin: 10px 0;
        }
        .search-form {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .dropdown-menu {
            max-height: 300px;
            overflow-y: auto;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            position: relative;
            bottom: 0;
            width: 100%;
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
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "thuc_pham_chuc_nang";

                                $conn = mysqli_connect($servername, $username, $password, $dbname);
                                if (!$conn) {
                                    die("Kết nối thất bại: " . mysqli_connect_error());
                                }

                                $sql = "SELECT DISTINCT loai_mat_hang FROM mat_hang";
                                $result = mysqli_query($conn, $sql);

                                if ($result && mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
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
                                mysqli_close($conn);
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
<div class="container my-5">
    <h1>Danh sách sản phẩm Thực Phẩm Bổ Sung</h1>
    <div class="product-list">
        <?php
        // Kết nối đến cơ sở dữ liệu
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Kết nối thất bại: " . $e->getMessage();
        }

        // Truy vấn dữ liệu chỉ lấy sản phẩm Thực Phẩm Bổ Sung
        $sql = "SELECT * FROM mat_hang WHERE loai_mat_hang = 'Vitamins'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // Lấy tất cả sản phẩm thực phẩm bổ sung
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Hiển thị dữ liệu
        if (count($products) > 0) {
            foreach ($products as $product): ?>
                <div class="col-md-4 mb-4 product-item" style = "background-color: white;">
                   <?php
                   $imageData = $product['hinh_anh'];
                   if (!empty($imageData)) {
                    $imageData = base64_encode($imageData);
                    echo '<img src="data:image/jpeg;base64,' . $imageData . '" alt="Hình ảnh sản phẩm" class="img-fluid" style="width: 200px; height: 200px;">';
                } else {
                        echo '<img src="sk.png" alt="Hình ảnh mặc định" class="img-fluid" style="width: 200px; height: 200px;">';
                    }
                   ?>
                    <h5 class="card-title"><?php echo htmlspecialchars($product['ten_mat_hang']); ?></h5>
                    <p class="card-text"><?php echo number_format($product['gia_mat_hang'], 0, ',', '.') . " VND"; ?></p>
                    <a href="sanphamchitiet.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Chi Tiết</a>
                </div>
            <?php endforeach; 
        } else {
            echo '<p class="text-center">Không có sản phẩm thực phẩm bổ sung nào.</p>';
        }
        ?>
    </div>
</div>




</body>
</html>
