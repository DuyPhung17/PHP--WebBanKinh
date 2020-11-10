<?php 
    session_start();
    $id = $_GET['id'];
    require_once('db_config/db_connect.php');

    $sql = 'Select glasses.name as gname, glasses.image, normal_price, sale_price, rating, brand.name as bname, brand.image as bimage, id_brand 
            from glasses join brand
            on glasses.id_brand = brand.id 
            where glasses.id = '.$id;
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);

    $id_brand = $row['id_brand'];
    //Phan trang
    $sql_qty = 'select count(id) as qty from glasses where id_brand ='.$id_brand;
    $result_qty = mysqli_query($conn,$sql_qty);
    $row_qty = mysqli_fetch_array($result_qty);
    $total_Product = $row_qty['qty']; //Tong so san pham
    $product_perPage = 4;//So san pham tren 1 trang
    $total_Page = ceil($total_Product / $product_perPage);//tong so trang
    if(isset($_GET['pg']))
        $current_Page = $_GET['pg'];//Trang hien tai
    $index = ($current_Page - 1)*$product_perPage; //Vi tri bat dau lay trong $sql LIMIT
    $sqllq = 'select * from glasses where id_brand ='.$id_brand.' limit '.$index.', '.$product_perPage.'';
    $resultlq = mysqli_query($conn,$sqllq);

?>
<!doctype html>
<html lang="en">
    <head>
        <title>Thông Tin Sản Phẩm</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="img/logo.png">
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- <script src="code.js"></script> -->
      </head>
  <body>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <?php 
        include('header.php');
    ?>   

    <!--Detail-->
    <div class="container detail">
        <div class="row">
            <?php 
                echo '
                <div class="col-sm-6">
                    <img class="detail-img" src="img/'.$row['image'].'">
                </div>

                <div class="col-sm-6 detail-content">
                    <div class="product-body">
                        <h1 class="product-name">'.$row['gname'].'</h1>';
                        if(!empty($row['sale_price']))
                            echo '
                            <del class="price-old">'.number_format($row['normal_price']).' VND</del>
                            <p class="price-sale text-danger">'.number_format($row['sale_price']).' VND</p>
                            ';
                        else echo '<p class="price-unit">'.number_format($row['normal_price']).' VND</p>';
                        echo ' <p>Thương hiệu: <img height="40px" src="img/'.$row['bimage'].'"></p>';
                        echo '                    
                        <p class="price-unit"></p>
                        <p>
                            Đánh giá: ';
                            for($i=0; $i<$row['rating']; $i++)
                                echo ' <i class="fa fa-star"></i>'; 
                        echo '</p>';
                        echo '
                    </div>

                    <div class="product-desc">
                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo ms id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe.</p>
                    </div>
                    <a href="addcart.php?id='.$id.'" id="loginbtn" class="btn bg-color text-white">Thêm vào <i class="fa fa-shopping-cart"></i> </a>
                    <button type="button" id="signup" class="btn btn-outline-color">Đánh giá</button>
                </div>
                    ';
            ?>
        </div>

        <div style="padding-left: 50px;">
            <h5 class="text-color mt-5">SẢN PHẨM KHÁC CÙNG THƯƠNG HIỆU </h5>
            <hr id="hra_2">
        </div>
        <div class="row">
        <?php 
                if(mysqli_num_rows($resultlq) > 0)
                {
                    while($row = mysqli_fetch_array($resultlq))
                    {
                        echo '
                        <div class="col-md-3 product_item">
                            <a href="detail.php?id='.$row['id'].'"><img class="product_image" src="./img/'.$row['image'].'"></a>
                            <h3 class="text-color">'.$row['name'].'</h3>
                            <p class="price">'.number_format($row['normal_price']).' VND</p>
                            <button class="btn bg-color text-white">Thêm vào <i class="fa fa-shopping-cart"></i> </button>
                        </div>
                        ';
                    }
                }
            ?>
        </div>

        <!--Phan trang-->
        <ul class="pagination mx-auto" style="width: 30%">
            <?php 
            //Gan nut truoc
            if($_GET['pg']>1)
                echo '        
                <li class="page-item">
                    <a class="page-link" href="?id='.$id.'&pg='.($_GET['pg']-1).'">Trước</a>
                </li>';
            else echo '        
                <li class="page-item disabled">
                    <a class="page-link" href="#">Trước</a>
                </li>';
            //Gan cac trang
            for($i=1;$i<=$total_Page;$i++)
            {   
                if($i==$_GET['pg'])
                echo '        
                <li class="page-item active">
                    <a class="page-link" href="?id='.$id.'&pg='.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                </li>';
                else echo '<li class="page-item"><a class="page-link" href="?id='.$id.'&pg='.$i.'">'.$i.'</a></li>';
            }
            //Gan nut sau
            if($_GET['pg']<$total_Page)
                echo '        
                <li class="page-item">
                    <a class="page-link" href="?id='.$id.'&pg='.($_GET['pg']+1).'">Sau</a>
                </li>';
            else echo '        
                <li class="page-item disabled">
                    <a class="page-link" href="#">Sau</a>
                </li>';
            ?>
        </ul>
        </div>
    </div>

<!----------------------- VIII. Footer -->
<?php include('footer.php') ?>

  </body>
</html>

<?php 
    mysqli_free_result($result);
    mysqli_free_result($resultlq);
    mysqli_close($conn);
?>