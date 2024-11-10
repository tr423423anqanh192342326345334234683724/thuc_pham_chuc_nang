<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <title>Sản phẩm Thực phẩm chức năng</title>
    <style>
       body {
            background-image: url('/anh/hihi.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
            font-size: 24px;
        }
        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }
        .product-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            width: calc(33.33% - 20px);
            box-sizing: border-box;
            background-color: #fff;
            transition: box-shadow 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .product-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }
        img {
            max-width: 100%;
            border-radius: 5px;
            margin: 10px 0;
        }
        .back-link {
            display: block;
            text-align: center;
            margin: 20px 0;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .search-form, .product-item {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }
        .product-item {
            transition: transform 0.2s;
        }

        .product-item:hover {
            transform: scale(1.1);
        }

        .product-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .dropdown-menu {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="container">
    <h1>Sản phẩm Thực phẩm chức năng</h1>
    <nav class="navbar navbar-expand-lg navbar-light" style="background: linear-gradient(to right, #87CEEB, #FFFFFF); border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); height: 100px;">
            <div class="container-fluid">
                <a class="navbar-brand" href="/" style="padding-top: 100px; transition: transform 0.2s; transform: scale(1.1);   ">
                    <img src="/anh/logo.png" alt="Logo" style="width: 200px; height: auto;">
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
                            $ketnoi = DB::connection()->getPdo();
                                $loaiMatHang = DB::table('mat_hang')->distinct()->pluck('loai_mat_hang');

                                if ($loaiMatHang->isNotEmpty()) {
                                    foreach ($loaiMatHang as $loai) {
                                        switch ($loai) {
                                            case "Vitamins":
                                                echo "<li><a class='dropdown-item' href='vitamin.php'>{$loai}</a></li>";
                                                break;
                                            case "Kháng Chất":
                                                echo "<li><a class='dropdown-item' href='khoangchat.php'>{$loai}</a></li>";
                                                break;
                                            case "Thực phẩm bổ sung":
                                                echo "<li><a class='dropdown-item' href='thucphamboxung.php'>{$loai}</a></li>";
                                                break;
                                            case "Mẹ và bé":
                                                echo "<li><a class='dropdown-item' href='mevabe.php'>{$loai}</a></li>";
                                                break;
                                            default:
                                                echo "<li><a class='dropdown-item' href='#'>{$loai}</a></li>";
                                                break;
                                        }
                                    }
                                }
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

    

    <?php
    $mathang = DB::table('mat_hang')->get();
    ?>

    <?php
    if($mathang->isNotEmpty()):
    ?>
        <div class='product-list' style='background-color: white;'>
            <?php
            foreach($mathang as $item):
            ?>
                <div class='product-item'>
                    <h3><?php echo htmlspecialchars($item->ten_mat_hang); 
                    ?></h3>
                    <p>Loại: <?php echo htmlspecialchars($item->loai_mat_hang)
                    ?></p>
                    <p>Giá: <?php echo number_format($item->gia_mat_hang, 0, ',', '.') ?> VNĐ</p>
                    <?php
                    if(!empty($item->hinh_anh)):
                        ?>
                        <img src="data:image/jpeg;base64,{{ base64_encode($item->hinh_anh) }}" alt="Hình ảnh sản phẩm" style="width: 300px; height: auto;">
                    <?php
                    else:
                    ?>
                        <img src="/anh/sk.png" alt="Hình ảnh mặc định" class="img-fluid" style="width: 200px; height: 200px;">
                    <?php
                    endif;
                    ?>
                    <br><br>
                    <button style='background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;'>
                        <a href='/sanphamchitiet?id={{ $item->id }}' style='text-decoration: none; color: white; font-weight: bold;'>Chi tiết</a>
                    </button>
                </div>
            <?php
            endforeach;
            ?>
        </div>
    <?php
    else:
    ?>
        <p>Không có sản phẩm nào.</p>
    <?php
    endif;
    ?>
    <br>
    <br>
    <br>
    
    
</body>
</html>
