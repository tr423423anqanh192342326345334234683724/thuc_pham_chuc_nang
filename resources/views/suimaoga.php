<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        }
        p.intro-text {
            font-size: 18px;
            font-weight: 500;
            font-style: italic;
            color: #555;
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
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="trangchu.php">
                <img  src="logo.png" alt="Logo" style="width: 180px; height: auto; padding-top: 90px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>   
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="sanphan.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                                    echo "<li><a class='dropdown-item' href='{$row['loai_mat_hang']}.php'>{$row['loai_mat_hang']}</a></li>";
                                }
                            }
                            $ket_noi = null;
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gioithieu.php">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lienhe.php">Liên hệ</a>
                    </li>
                </ul>
                <form action="timkiem.php" method="post" class="d-flex" style="flex-grow: 1;">
                    <input class="form-control me-2" type="text" name="search" placeholder="Tìm kiếm sản phẩm" required style="max-width: 500px;">
                    <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                </form>
            </div>
        </div>
    </nav>
    <br>
    <br>

    <div class="content">
        <img src="suimaoga.png" alt="" class="hero-img">
        <h1>Sùi mào gà âm đạo là gì? Mức độ nguy hiểm của bệnh lý này ra sao?</h1>
        <p class="intro-text">Sùi mào gà âm đạo gây ảnh hưởng như thế nào đến sức khỏe của chị em phụ nữ? Phương pháp điều trị và ngăn ngừa bệnh lý về đường sinh dục này là gì? Cùng tìm hiểu kỹ hơn về sùi mào gà âm đạo qua bài viết dưới đây nhé!</p>
        <h3>1. Sùi mào gà âm đạo là gì?</h3>
        <p>HPV – Chủng virus gây u nhú ở người là nguyên nhân chính gây nên sùi mào gà. Mặc dù vậy, không phải ai bị nhiễm HPV thì cũng sẽ mắc sùi mào gà. Bệnh lý này làm xuất hiện những mụn nhỏ có màu hồng hoặc màu da trên cổ tử cung, ở cửa âm đạo, môi âm hộ, xung quanh hoặc bên trong hậu môn. Theo thống kê, tỷ lệ phụ nữ bị sùi mào gà cao hơn so với nam giới.</p>
            <img src="/anh/suimaoga1.png" alt="" class="hero-img">
        <p>Việc tiếp xúc trực tiếp da với da khi quan hệ tình dục có thể khiến sùi mào gà lây lan, bao gồm: Quan hệ tình dục qua đường hậu môn, quan hệ bằng miệng hay bất cứ tiếp xúc nào khác liên quan đến bộ phận sinh dục. Trong một số trường hợp, người nhiễm HPV sùi mào gà sẽ không có triệu chứng gì. Sau khi tiếp xúc với virus, biểu hiện của bệnh có thể xuất hiện sau vài tuần cho đến 1 năm hoặc thậm chí là lâu hơn.</p>
        <h3>Ảnh hưởng đối với nữ giới nói chung</h3>
        <p>Sự xuất hiện của những nốt sùi mào gà xung quanh âm đạo hoặc hậu môn sẽ gây ngứa và đau, trong một số trường hợp còn bị chảy máu khi những nốt này vỡ ra. Nghiêm trọng hơn là gây viêm và sưng phù bộ phận sinh dục, làm khó khăn cho việc đi lại và ít nhiều cản trở trong hoạt động hằng ngày.</p>
        <img src="/anh/suimaoga2.png" alt="" class="hero-img">
        <p>Sùi mào gà âm đạo có thể gây đau đớn khi giao hợp, từ đó làm giảm ham muốn ở nữ giới. Điều này có thể ảnh hưởng đến chất lượng đời sống tình dục và hạnh phúc gia đình. Bên cạnh đó, sùi mào gà ở miệng (lây lan do quan hệ tình dục bằng đường miệng) còn gây ra đau họng, khó nuốt.</p>
        <h3>Ảnh hưởng đối với phụ nữ mang thai</h3>
        <p>Ở phụ nữ mang thai, bệnh sẽ phát triển và nhân lên lớn hơn mức bình thường. Bệnh lý xuất hiện lần đầu và tái phát sau một khoảng thời gian dài sau đó. Trong một số trường hợp, chị em bị đau khi đi tiểu và nếu sùi mào gà lớn có khả năng gây chảy máu khi sinh.</p>
        <br>
        <p>Đặc biệt, sùi mào gà trên thành âm đạo có thể khiến âm đạo của bệnh nhân khó co giãn hơn trong quá trình sinh nở. Để an toàn, bác sĩ sẽ đề nghị sinh mổ trong tình huống này. Mặc dù hiếm gặp, nhưng bệnh có thể lây truyền sang em bé trong quá trình sinh nở. Cụ thể, virus HPV gây nhiễm trùng và phát triển ở cổ họng hoặc bộ phận sinh dục của bé vài tuần sau khi sinh.</p>
        <br>
        <p>Trên thực tế, bệnh sùi mào gà âm đạo thường không gây những ảnh hưởng nghiêm trọng đến phụ nữ có thai hoặc thai nhi. Tuy nhiên, trong một số trường hợp có thể phát sinh những biến chứng ngoài ý muốn. Chưa có bằng chứng cụ thể nào cho thấy các chủng HPV gây ra sùi mào gà làm tăng nguy cơ về sảy thai hoặc các vấn đề khác trong quá trình sinh nở.    </p>
        <h3>Cách điều trị sùi mào gà âm đạo</h3>
        <ul>
            <li><strong>Dùng thuốc bôi:</strong> Bệnh nhân có thể tự bôi thuốc trực tiếp lên các nốt sùi mào gà vài lần/tuần trong khoảng thời gian là vài tuần. Đối với một số trường hợp nghiêm trọng, bệnh nhân sẽ được bác sĩ chỉnh định lượng thuốc cần phải sử dụng. Các tác dụng phụ sau khi bôi thuốc bao gồm cảm giác nóng ran, cảm giác đau hoặc kích ứng.</li>
            <li><strong>Phương pháp phẫu thuật:</strong> Bác sĩ sẽ thực hiện cắt, đốt hoặc dùng tia laser để loại bỏ tổn thương ở vùng âm đạo. Các phương pháp này có thể gây kích ứng, đau hoặc thậm chí là để lại sẹo.</li>
            <li><strong>Phương pháp áp lạnh:</strong> Đây là phương pháp áp lạnh các nốt sùi bằng nitơ lỏng. Cách này thường ít gây đau nhưng sẽ gây ra tiết dịch nhiều sau khi thực hiện khoảng 1 đến 2 tuần.</li>
            <img src="/anh/suimaoga3.png" alt="" class="hero-img">
            <p>Đối với sùi mào gà âm đạo, thời gian điều trị có thể kéo dài vài tuần hoặc vài tháng để có kết quả. Ngoài ra, bệnh lý này có khả năng tái phát cao và chưa có phương pháp nào để chữa khỏi mụn sùi mào gà dứt điểm hoàn toàn. </p>
        </ul>

        <div class="related-posts mt-5">
            <h3>Bài viết liên quan</h3>
            <div class="d-flex flex-wrap">
                <div class="col-md-4 mb-4">
                    <a href="vonglung.php" style="text-decoration: none;">
                        <img src="vonglung.png" alt="">
                        <h4>Bệnh võng mạch có thể chữa được không? cách chữa võng lưng</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="comment-section" style="max-width: 1200px; margin: auto;">
        <h3>Để lại bình luận của bạn</h3>
        <form action="#.php" method="post">
            <textarea name="binhluan" placeholder="Viết bình luận của bạn..." required></textarea>
            <br>
            <button style="background-color: #0056b3; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;" type="submit">Gửi</button>
        </form>
    </div>
    <br>
    <br>
    <br>
    <br>
    
   

   </body>
</html>
