<?php 
    $id = $_GET['id'];
    $i = 0;
    require_once('db_config/db_connect.php');

    $sql = 'Select glasses.name as gname, glasses.image as gimage, normal_price, sale_price, brand.image as bimage
            from glasses join brand
            on glasses.id_brand = brand.id 
            where glasses.id = '.$id;
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_array($result);
        $i++;
    }
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
        <script src="code.js"></script>
      </head>
  <body>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!----------------------- I. Header -->
    <?php include('header.php') ?>



    <!--Glasses on cart-->
    <div class="container detail">
        <h3 class="text-center p-3 text-color">- SẢN PHẨM ĐÃ THÊM -</h3>
            <table class="table">
                <thead class="bg-color text-white">
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Thương hiệu</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        echo '
                        <tr>
                            <td>'.$i.'</td>
                            <td><img height="40px" src="img/'.$row['gimage'].'"/> '.$row['gname'].'</td>
                            <td><img height="40px" src="img/'.$row['bimage'].'"/></td>
                            <td>'.number_format($row['normal_price']).'</td>
                            <td><input type="number" value="1" style="width:50px"></td>
                            <td>'.number_format($row['normal_price']).'</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="#">Xóa</a>
                                <a class="btn btn-sm btn-secondary" href="#">Cập nhật</a>
                            </td>
                        </tr>
                        ';
                    ?>
                </tbody>
            </table>
            <div>
                <p class="">Tổng cộng: 10000000</p>
                <a class="btn btn-sm btn-color" href="#">Mua hàng</a>
            </div>

    </div>

    <!----------------------- VIII. Footer -->
    <?php include('footer.php') ?>

  </body>
</html>

<?php 
    // mysqli_free_result($result);
    // mysqli_free_result($resultlq);
    // mysqli_close($conn);
?>