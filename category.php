                                <!--1. Phân loại các mẫu laptop theo nhu cầu-->





<?php
include './setting/connect.php';

$id_hang = $_GET['id_hang'];

// Chuẩn bị và thực thi truy vấn cơ sở dữ liệu
$sql = "SELECT * FROM product WHERE id_hang = '$id_hang' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

//Tính số bản ghi của bảng product
$total_table = mysqli_num_rows($result);

//Thiết lập số bảng ghi trên một trang
$limit = 25;

//Lấy trang hiện tại
$cr_page = (isset($_GET['page']) ? $_GET['page'] : 1);

//Tính số trang
$page = ceil($total_table / $limit);

//Tính start
$start = ($cr_page - 1) * $limit;

//Query sử dụng limit
$result = mysqli_query($conn, "SELECT * FROM product WHERE id_hang = '$id_hang' ORDER BY id DESC LIMIT $start,$limit");

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phân loại</title>
    <link rel="icon" href="./img/logo.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./Css/styles.css">
    <link rel="stylesheet" href="./Css/responsive_home.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <!--Area of category-->
    <div class="category">
        <div class="category_frame">
            <div class="title_category">
                <h3>Phân loại theo nhu cầu</h3>
            </div>
            <div class="content_category">
                <ul>
                    <li><a href="category.php?id_hang=1">LENOVO</a></li>
                    <li><a href="category.php?id_hang=2">ACER</a></li>
                    <li><a href="category.php?id_hang=3">ASUS</a></li>
                    <li><a href="category.php?id_hang=4">DELL</a></li>
                    <li><a href="category.php?id_hang=5">HP</a></li>
                    <li><a href="category.php?id_hang=6">MSI</a></li>
                    <li><a href="category.php?id_hang=7">MACBOOK</a></li>
                    <li><a href="category_price.php?sort=low_price">GIÁ THẤP</a></li>
                    <li><a href="category_price.php?sort=hight_price">GIÁ CAO</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!--Area of content-->
    <div class="content">
        <div class="content_type"></div>
        <div class="content_laptop">
            <div class="content_frame">
                <div class="content_card">
                    <?php foreach ($result as $info_product) : ?>
                        <div class="content_item">
                            <div class="in_stock">
                                <?php if ($info_product['status'] == 1) { ?>
                                    <i class="far fa-check-circle"></i>
                                    <p>In stock</p>
                                <?php } else { ?>
                                    <i style="color: red;" class="fas fa-times-circle"></i>
                                    <p style="color: red;">Sold out</p>
                                <?php } ?>
                            </div>
                            <div class="img_laptop">
                                <a href="product_detail.php?id=<?php echo $info_product['id'] ?>"><img src="./img/<?php echo $info_product['image'] ?>" alt=""></a>
                            </div>
                            <div class="click_order">
                                <p><a href="product_detail.php?id=<?php echo $info_product['id'] ?>">Click để xem chi tiết</a></p>
                                <?php if ($info_product['status'] == 1) { ?>
                                    <button><a style="text-decoration: none; color:white;" href="./cart.php?id=<?php echo $info_product['id'] ?>">Đặt hàng</a></button>
                                <?php } else { ?>
                                    <button><a style="text-decoration: none; color:white;">Hết hàng</a></button>
                                <?php } ?>
                            </div>
                            <div class="describe_laptop">
                                <p><?php echo $info_product['name'] ?></p>
                            </div>
                            <div class="cost_laptop">
                                <p style=""><?php echo $info_product['price'] ?>.000₫</p>
                                <h2><?php echo $info_product['sale_price'] ?>.000₫</h2>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="page_number">
            <div class="number">
                <ul>
                    <?php if ($page >= 1) : ?>
                        <?php if ($cr_page - 1 > 0) { ?>
                            <li class="number1"><a href="category.php?id_hang=<?php echo $id_hang ?>&page=<?php echo $cr_page - 1 ?>"><i class="fas fa-chevron-left"></i></a></li>
                        <?php } ?>

                        <?php for ($i = 1; $i <= $page; $i++) { ?>
                            <li class="number1 <?php echo (($cr_page == $i) ? 'active' : '') ?>"><a href="category.php?id_hang=<?php echo $id_hang ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php } ?>

                        <?php if ($cr_page + 1 <= $page) { ?>
                            <li class="number1"><a href="category.php?id_hang=<?php echo $id_hang ?>&page=<?php echo $cr_page + 1 ?>"><i class="fas fa-chevron-right"></i></a></li>
                        <?php } ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>