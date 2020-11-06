<?php 
    $id = $_GET['id'];
    require_once('db_config/db_connect.php');

    $sql = 'Select glasses.id as gid, glasses.name as gname, glasses.image, normal_price, sale_price, rating, brand.image as bimage, id_brand 
            from glasses join brand
            on glasses.id_brand = brand.id 
            where glasses.id_brand = '.$id;
    $result = mysqli_query($conn,$sql);

    $sql_brandimage = 'select image from brand where id='.$id;
    $result_brandimage = mysqli_query($conn,$sql_brandimage);
    $bimage = mysqli_fetch_array($result_brandimage)['image'];
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Thương Hiệu</title>
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
        session_start();
        include('header.php');
    ?>    

    <div class="container mt-5">
            <!--Sidebar-->
        <div class="row">
            <div class="col-3">
                <nav class="sidebar" id="sidebar">
                    <ul style="list-style:none;" class="rounded">
                        <li class="sb_active"><a href="brand.php?id=7"> Ray-Ban</a></li>
                        <li class=""><a href="brand.php?id=1"> Coach</a></li>
                        <li class=""><a href="brand.php?id=3"> Fendi</a></li>
                        <li class=""><a href="brand.php?id=4"> Maui Jim</a></li>
                        <li class=""><a href="brand.php?id=2"> Dolce & Gabbana</a></li>
                        <li class=""><a href="brand.php?id=8"> Saint Laurent</a></li>
                        <li class=""><a href="brand.php?id=5"> Oakley</a></li>
                        <li class=""><a href="brand.php?id=6"> Prada</a></li>
                        <li class=""><a href="brand.php?id=10"> Versace</a></li>
                        <li class=""><a href="brand.php?id=9"> Tory Burch</a></li>
                    </ul>
                </nav>
            </div>

            <div class="col-9">
                <div class="row">
                <?php 
                    echo '<div class="col-12 text-center position-absoluted"><img src="img/'.$bimage.'" height="100px"></div>';
                    while($row = mysqli_fetch_array($result))
                    {
                        echo '
                        <div class="col-md-4 product_item">
                            <a href="detail.php?id='.$row['gid'].'"><img class="product_image" src="img/'.$row['image'].'"></a>
                            <h3 class="text-color">'.$row['gname'].'</h3>
                            <p class="rating">
                                Đánh giá: ';
                                for($i=0; $i<$row['rating']; $i++)
                                    echo ' <i class="fa fa-star"></i>'; 
                            echo'</p>
                            <p class="price">';
                                if(!empty($row['sale_price']))
                                    echo '
                                    <del>'.number_format($row['normal_price']).' VND</del>
                                    <span class="text-danger">'.number_format($row['sale_price']).' VND</span>
                                    ';
                                else echo number_format($row['normal_price']).' VND';
                            echo '</p>
                            <button class="btn bg-color text-white">Thêm vào <i class="fa fa-shopping-cart"></i> </button>
                        </div>
                    ';
                    }
                ?>
                </div>
                                                    
            <nav>
                <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="#">Trước</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item active"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Sau</a></li>
                </ul>
              </nav>
            </div>
        </div>
    </div>

<!----------------------- VIII. Footer -->
<?php include_once('footer.php') ?> 

  </body>
</html>