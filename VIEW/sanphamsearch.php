<?php
require_once '../DAO/pdo.php';
require_once '../DAO/search.php';

session_start();

if (isset($_SESSION['s_user']) && count($_SESSION['s_user']) > 0) {
    extract($_SESSION['s_user']);
    $html_account = '<li><a href="index.php?pg=myaccount">' . htmlspecialchars($username) . '</a></li>';
} else {
    $html_account = '<li><a href="index.php?pg=dangnhap"><img src="LAYOUT/img/user.png" alt="" width="30px"></a></li>';
}

$conn = pdo_get_connection();

$keyword = "";
$sanphamNames = [];
if (isset($_POST['timkiem'])) {
    $keyword = $_POST['kyw'];
    $sanphamNames = searchSanPhamByName($conn, $keyword);
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EPIC FOOT</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="/LAYOUT/style.css">
        <link rel="stylesheet" href="/LAYOUT/formmuahang/form.css">
        <link rel="stylesheet" href="/LAYOUT/search.css">
    </head>

    <body>

        <section id="header">
            <a href="/index.php"><img src="/LAYOUT/img/logo1-removebg-preview.png" alt="" width="80px"></a>
            <div>

            <div class="timkiem">
                <form action="<?= file_exists('VIEW/sanphamsearch.php') ? 'VIEW/sanphamsearch.php' : '' ?>" method="post">
                    <input type="text" name="kyw" placeholder="Bạn muốn tìm gì" style="width: 350px; height: 50px; padding: 16px; border-radius: 40px; border: 1px solid transparent;">
                    <input type="submit" name="timkiem" value="Tìm Kiếm" style="width: 80px; height: 50px; background-color: #088178; color: #fff; white-space: nowrap; border-radius: 40px; border: 1px solid transparent;">
                </form>
            </div>





                <ul id="navbar">

                    <li><a class="active" href="/index.php">Trang chủ</a></li>
                    <li><a href="/index.php?pg=sanpham">Cửa hàng</a></li>
                    <li><a href="/index.php?pg=gioithieu">Giới thiệu</a></li>
                     <li><a href="#">Liên hệ</a></li>
                    <!-- <li><a href="index.php?pg=dangnhap">Đăng nhập</a></li> -->
                    <div class="alo">
                    <li id="lg-bag" ><a href="index.php?pg=viewcart" ><i class="fa-solid fa-bag-shopping" style="font-size: 30px;";></i></a></li>
                    <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>                         
                        <li><?=$html_account;?></li>
                    </div>
                    
                
                </ul>
            </div>
            <div id="mobile">
                <a href="index.php?pg=viewcart"><i class="fa-solid fa-bag-shopping"></i></a>
                <i id="bar" class="fas fa-outdent"></i> <!-- icon cho menu cho mobile -->
            </div>
        </section>


    </section>

                <section id="product-search-results" class="section-p1">
                <h2>Kết quả tìm kiếm cho từ khóa '<?= htmlspecialchars($keyword) ?>'</h2>
                <br>
                <div class="pro-container">
                    <?php
                    if (!empty($sanphamNames)) {
                        foreach ($sanphamNames as $sanpham) {
                            ?>
                            <div class="pro">
                                <a href="index.php?pg=sanphamchitiet&idpro=<?= htmlspecialchars($sanpham['id']) ?>">
                                    <img src="/LAYOUT/img/<?= htmlspecialchars($sanpham['img']) ?>" alt="">
                                    <div class="des">
                                        <h5><?= htmlspecialchars($sanpham['name']) ?></h5>
                                        <div class="star">
                                            <!-- Hiển thị đánh giá nếu có -->
                                        </div>
                                        <p class="price"><?= htmlspecialchars($sanpham['price']) ?> Đ</p>
                                    </div>
                                </a>
                                <form action="index.php?pg=addcart" method="post">
                                    <input type="hidden" name="name" value="<?= htmlspecialchars($sanpham['name']) ?>">
                                    <input type="hidden" name="img" value="<?= htmlspecialchars($sanpham['img']) ?>">
                                    <input type="hidden" name="price"  value="<?= htmlspecialchars($sanpham['price']) ?>">
                                    <input type="number" name="soluong" min="1" value="1" max="10">
                                    <button class="normal" name="addcart">Thêm vào giỏ hàng</button>
                                </form>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p>Không có sản phẩm nào phù hợp với từ khóa '" . htmlspecialchars($keyword) . "'.</p>";
                    }
                    ?>
                </div>
            </section>



    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign up for newsletter</h4>
            <p>Get email updates about our latest shop and <span>special offers.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal"> Sign Up</button>
        </div>
    </section>

    <footer class="section-p1">
        <div class="col">
            <img class="logo" src="LAYOUT/img/logo.jpg" alt="" width="60px">
            <h4>Liên Hệ</h4>
            <p><strong>Địa chỉ:</strong> Lý Thường Kiệt, Tân Tiến, LaGi, Bình Thuận</p>
            <p><strong>Phone:</strong> +84 7722 2926/ (033 7742 075) </p>
            <p><strong>Giờ:</strong> 06:00(AM) - 10:00(PM) Thứ 2 - CN hằng tuần</p>
            <div class="follow">
                <h4>Follow</h4>
                <div class="icon">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-pinterest-p"></i>
                    <i class="fab fa-youtube"></i>
                </div>
            </div>
        </div>

        <div class="col">
            <h4>About</h4>
            <a href="#">Về chúng tôi</a>
            <a href="#">Thông tin giao hàng</a>
            <a href="#">Chính sách bảo mật</a>
            <a href="#">Điều khoản & điều kiện</a>
            <a href="#">Liên hệ với chúng tôi</a>
        </div>
        <div class="col">
            <h4>Tài khoản của tôi</h4>
            <a href="#">Đăng nhập</a>
            <a href="#">Xem giỏ hàng</a>
            <a href="#">Danh sách yêu thích của tôi</a>
            <a href="#">Theo dõi đơn hàng</a>
            <a href="#">Trợ giúp</a>
        </div>
        <div class="col install">
            <h4>App tại</h4>
            <p>Ở app Store hoặc Google play</p>
            <div class="row">
                <img src="../LAYOUT/img/pay/app.jpg" alt="">
                <img src="../LAYOUT/img/pay/play.jpg" alt="">
            </div>
            <p>Cổng thanh toán an toàn</p>
            <img src="img/pay/pay.png" alt="">
        </div>

        <div class="copyright">
            <p>2023 © Copyright N2T_Nguyễn Thành Tâm. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>
