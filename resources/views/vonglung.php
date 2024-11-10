<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vòng Lưng</title>
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
                <a class="navbar-brand" href="trangchu.php" style="padding-top: 100px; transition: transform 0.2s; transform: scale(1.1);">
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
  
    <div class="content">
        <img src="vonglung.png" alt="võng lưng" class="hero-img">
        <h1>Võng lưng là gì? Cách nhận biết và điều trị</h1>
        
        <div style="background-color: #f0f0f0; padding: 20px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); font-style: italic;" class="intro">
            <p class="lead">
                Võng lưng hay còn gọi là tật ưỡn cột sống, là một dạng cong vẹo cột sống ảnh hưởng đến mọi người ở mọi lứa tuổi. Điều này không chỉ khiến dáng trông xấu đi mà còn ảnh hưởng lớn đến sức khỏe tổng thể.
            </p>
        </div>

        <p>Võng lưng là một trong những chứng vẹo cột sống thường gặp ở trẻ em và người già. Tình trạng này không chỉ ảnh hưởng đến dáng đi, thẩm mỹ mà còn có thể gây nguy hiểm đến chức năng hô hấp, tiêu hóa.</p>

        <h3>Tìm hiểu chung về võng lưng</h3>
        <p>Võng lưng là tình trạng rối loạn cột sống xảy ra khi các đốt sống thắt lưng cong quá mức về phía trước. Người bị võng lưng có thể dễ dàng nhận biết qua các dấu hiệu như:</p>
        
        <ul>
            <li>Lưng dưới ưỡn cong về phía trước so với mông</li>
            <li>Thường xuyên bị đau lưng, đặc biệt là đau thắt lưng</li>
            <li>Di chuyển khó khăn</li>
            <li>Xương chậu bị nghiêng về phía trước, tạo thành tư thế võng lưng</li>
            <li>Người bị võng lưng khi nằm ngửa sẽ tạo ra một khoảng trống giữa lưng dưới và sàn nhà</li>
        </ul>

        <h3>Nguyên nhân võng lưng</h3>
        <p>Căn cứ vào nguyên nhân và đặc điểm của bệnh, võng lưng được phân thành 5 dạng chính bao gồm:</p>

        <h3>Võng lưng do chấn thương</h3>
        <p>Chấn thương xảy ra ở cột sống có thể làm đứt liên kết của các đốt sống là một trong những nguyên nhân gây cong vẹo cột sống. Loại chấn thương này thường gặp ở trẻ nhỏ do ngã từ trên cao hoặc chấn thương khi chơi thể thao.</p>

        <h3>Võng lưng do bẩm sinh</h3>
        <p>Võng lưng cũng có thể phát triển từ khi sinh ra do dị tật ở các bộ phận của cột sống. Bất kể nguyên nhân nào, chứng ưỡn cột sống sẽ phát triển nặng dần theo thời gian khi các đốt sống trượt về phía trước và đè lên các dây thần kinh.</p>

        <img src="vonglung1.jpeg" alt="võng lưng" class="hero-img" >

        <h3>Chứng võng lưng tư thế</h3>
        <p>Võng lưng tư thế không phải do chấn thương hay bẩm sinh mà do béo phì gây mất cân đối giữa cơ lưng và cơ bụng. Nếu bạn nghiêng quá nhiều về phía trước ở phần bụng, dạ dày sẽ khiến một phần lưng bị kéo về phía trước.</p>

        <h3>Võng lưng do rối loạn thần kinh - cơ</h3>
        <p>Võng lưng có thể là một trong những chứng vẹo cột sống do rối loạn thần kinh - cơ. Có nhiều nguyên nhân thần kinh - cơ hoặc cơ bắp gây ra dị tật cột sống, cần được chẩn đoán để tìm nguyên nhân và cách điều trị thích hợp.</p>

        <h3>Hậu phẫu thuật</h3>
        <p>Phẫu thuật cắt cung sau cột sống cổ được thực hiện để giảm áp lực do hẹp cột sống đè lên tủy sống và các rễ thần kinh. Khi thực hiện phẫu thuật này gây ảnh hưởng xấu đến cột sống.</p>

        <img src="vonglung2.png" alt="võng lưng" class="hero-img" >

        <h3>Võng lưng có nguy hiểm không?</h3>
        <p>Tuy không nguy hiểm đến tính mạng nhưng võng lưng có thể gây ra tác hại như:</p>
        
        <ul>
            <li>Gây mất thẩm mỹ, làm dáng người thấp xuống</li>
            <li>Gây đau lưng, đau cổ, đau hạ vị</li>
            <li>Gây tật khác như xương chậu nghiêng, đau lưng, đau hông</li>
        </ul>

        <h3>Phương pháp điều trị</h3>
        <p>Các phương pháp điều trị võng lưng bao gồm:</p>
        
        <ul>
            <li>Vật lý trị liệu và các bài tập phục hồi chức năng</li>
            <li>Đeo nẹp lưng (đặc biệt hiệu quả với trẻ nhỏ)</li>
            <li>Kiểm soát cân nặng</li>
            <li>Phẫu thuật thay đĩa đệm (trong trường hợp nặng)</li>
        </ul>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   
</body>
</html>