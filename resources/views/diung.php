<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dị Ứng Là Gì? Cách Đối Phó Với Dị Ứng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            color: #333;
        }
        nav.navbar {
            background: linear-gradient(to right, #87CEEB, #FFFFFF);
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            height: 80px;
            margin-bottom: 30px;
        }
        nav.navbar a.navbar-brand {
            transition: transform 0.2s;
        }
        nav.navbar a.navbar-brand:hover {
            transform: scale(1.1);
        }
        .dropdown-menu a.dropdown-item:hover {
            background-color: #f0f0f0;
        }
        .content {
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
        }
        .hero-img {
            width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        h1, h3 {
            color: #0056b3;
            margin: 20px 0;
        }
        p.intro-text {
            font-size: 18px;
            font-weight: 500;
            font-style: italic;
            color: #555;
            line-height: 1.6;
        }
        ul {
            list-style-type: square;
            padding-left: 20px;
        }
        .related-posts img {
            width: 100%;
            height: auto;
            border-radius: 15px;
            margin-bottom: 15px;
            transition: transform 0.3s;
        }
        .related-posts img:hover {
            transform: scale(1.05);
        }
        .related-posts h4 {
            font-size: 18px;
            color: #0056b3;
            font-weight: bold;
        }
        .footer {
            background-color: #0056b3;
            color: #fff;
            padding: 15px;
            text-align: center;
            margin-top: 30px;
            border-radius: 10px;
        }
        .article-content {
            line-height: 1.8;
            margin: 20px 0;
        }
        .article-section {
            margin-bottom: 30px;
        }
        h2 {
            color: #0056b3;
            margin: 20px 0;
        }
        .comment-section {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .comment-section textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .comment-section button {
            background-color: #0056b3;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
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

<div class="container mt-5">
    <div class="content">
        <img src="/anh/diung.jpg" alt="Dị Ứng" class="hero-img">
        <h1>Dị Ứng Là Gì?</h1>
        <p class="intro-text">
        Dị ứng là phản ứng quá mức của hệ thống miễn dịch đối với các chất mà thông thường không gây hại cho cơ thể. Những chất này, được gọi là chất gây dị ứng (allergen), có thể là phấn hoa, bụi, thực phẩm, thuốc, côn trùng, hoặc lông động vật. Khi một người có dị ứng tiếp xúc với chất gây dị ứng, hệ miễn dịch phản ứng bằng cách sản xuất ra các kháng thể IgE (Immunoglobulin E). Kháng thể này nhận diện và phản ứng với chất gây dị ứng, dẫn đến sự giải phóng các hóa chất như histamin, gây ra các triệu chứng dị ứng.
        </p>
        <img src="/anh/diung1.jpg" alt="Dị Ứng" class="hero-img">
        <h2>Cơ Chế Gây Dị Ứng</h2>
        <p>Khi cơ thể tiếp xúc với chất gây dị ứng lần đầu tiên, hệ miễn dịch sẽ tạo ra các kháng thể IgE đặc hiệu. Các kháng thể này gắn vào bề mặt của các tế bào mast và bạch cầu ái kiềm. Trong những lần tiếp xúc tiếp theo, chất gây dị ứng sẽ kết hợp với các kháng thể IgE trên bề mặt tế bào, kích thích giải phóng các chất trung gian hóa học như histamin, prostaglandin và leukotrien. Chính những chất này gây ra các triệu chứng dị ứng điển hình.</p>

        <h2>Yếu Tố Nguy Cơ và Di Truyền</h2>
        <p>Dị ứng có tính chất di truyền cao. Nếu cả bố và mẹ đều bị dị ứng, con cái có tới 70% khả năng phát triển dị ứng. Ngoài ra, các yếu tố môi trường như ô nhiễm không khí, thay đổi khí hậu, và lối sống hiện đại cũng góp phần làm tăng nguy cơ mắc dị ứng.</p>

        <h3>Các Loại Dị Ứng Thường Gặp</h3>
        <img src="/anh/diunghohap.jpg" alt="Dị Ứng" class="hero-img">
        <h2>1. Dị Ứng Đường Hô Hấp</h2>
        <p>Dị ứng đường hô hấp là một trong những dạng phổ biến nhất, ảnh hưởng đến hàng triệu người trên toàn thế giới. Bệnh có thể xuất hiện theo mùa hoặc kéo dài quanh năm, tùy thuộc vào tác nhân gây dị ứng.</p>

        <h3>Triệu chứng chính:</h3>
        <ul>
            <li>Hắt hơi liên tục</li>
            <li>Ngứa mũi, họng và mắt</li>
            <li>Chảy nước mũi trong</li>
            <li>Nghẹt mũi</li>
            <li>Ho khan kéo dài</li>
            <li>Khó thở, thở khò khè</li>
        </ul>

        <p>Dị ứng đường hô hấp có thể dẫn đến nhiều biến chứng nghiêm trọng như viêm xoang mãn tính, hen suyễn, và các vấn đề về giấc ngủ. Đặc biệt, những người bị dị ứng đường hô hấp có nguy cơ cao phát triển hen suyễn, một bệnh mãn tính của đường hô hấp cần được điều trị và theo dõi lâu dài.</p>
        <img src="/anh/diungda.jpg" alt="Dị Ứng" class="hero-img">
        <h2>2. Dị Ứng Da</h2>
        <p>Dị ứng da là phản ứng của hệ miễn dịch đối với các chất tiếp xúc trực tiếp với da hoặc qua đường toàn thân. Đây là loại dị ứng phổ biến thứ hai sau dị ứng đường hô hấp.</p>

        <h3>Các dạng dị ứng da phổ biến:</h3>
        <ul>
            <li>Viêm da cơ địa (chàm)</li>
            <li>Mề đay cấp và mãn tính</li>
            <li>Viêm da tiếp xúc</li>
            <li>Phản ứng với côn trùng đốt</li>
        </ul>

        <p>Viêm da tiếp xúc có thể do nhiều nguyên nhân như:</p>
        <ul>
            <li>Mỹ phẩm và các sản phẩm chăm sóc da</li>
            <li>Kim loại (đặc biệt là nickel trong đồ trang sức)</li>
            <li>Latex và cao su</li>
            <li>Các loại cây độc</li>
            <li>Hóa chất trong các sản phẩm tẩy rửa</li>
        </ul>
        <img src="/anh/thucpham.jpg" alt="Dị Ứng" class="hero-img">
        <h2>3. Dị Ứng Thực Phẩm</h2>
        <p>Dị ứng thực phẩm là phản ứng bất thường của hệ miễn dịch đối với một số protein trong thực phẩm. Phản ứng có thể từ nhẹ đến nghiêm trọng, thậm chí đe dọa tính mạng.</p>

        <h3>Các thực phẩm thường gây dị ứng:</h3>
        <ul>
            <li>Đậu phộng và các loại hạt</li>
            <li>Hải sản và cá</li>
            <li>Sữa và các sản phẩm từ sữa</li>
            <li>Trứng</li>
            <li>Lúa mì và gluten</li>
            <li>Đậu nành</li>
        </ul>

        <h2>Phương Pháp Điều Trị và Phòng Ngừa</h2>
        <p>Việc điều trị dị ứng thường tập trung vào ba hướng chính:</p>

        <h3>1. Tránh tiếp xúc với chất gây dị ứng:</h3>
        <ul>
            <li>Sử dụng máy lọc không khí</li>
            <li>Giữ môi trường sống sạch sẽ</li>
            <li>Đọc kỹ thành phần thực phẩm</li>
            <li>Tránh các yếu tố kích thích</li>
        </ul>
        <img src="/anh/diungthuoc.jpg" alt="Dị Ứng" class="hero-img">
        <h3>2. Điều trị bằng thuốc:</h3>
        <ul>
            <li>Thuốc kháng histamine</li>
            <li>Thuốc xịt mũi corticosteroid</li>
            <li>Thuốc giãn phế quản</li>
            <li>Thuốc ức chế miễn dịch</li>
        </ul>

        <h3>3. Liệu pháp miễn dịch:</h3>
        <p>Đây là phương pháp điều trị lâu dài, giúp tăng khả năng dung nạp của cơ thể đối với chất gây dị ứng thông qua việc tiêm một lượng nhỏ chất gây dị ứng định kỳ.</p>

        <h2>Kết Luận</h2>
        <p>Dị ứng là một vấn đề sức khỏe phức tạp, ảnh hưởng đến chất lượng cuộc sống của nhiều người. Việc hiểu rõ về nguyên nhân, cơ chế và các biện pháp phòng ngừa, điều trị là rất quan trọng. Nếu bạn nghi ngờ mình bị dị ứng, hãy tham khảo ý kiến bác sĩ để được chẩn đoán và điều trị phù hợp.</p>
    </div>
    <br>
    <div class="comment-section" style="max-width: 1200px; margin: auto;">
        <h3>Để lại bình luận của bạn</h3>
        <form action="#.php" method="post">
            <textarea name="binhluan" placeholder="Viết bình luận của bạn..." required></textarea>
            <br>
            <button style="background-color: #0056b3; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;" type="submit">Gửi</button>
        </form>
    </div>
</div>