<?php
    session_start();
    require_once('db_config/db_connect.php');
    if(isset($_SESSION['cart']))
    $cart = $_SESSION['cart'];
    
    if(isset($_GET['action']))
    {
        switch($_GET['action']){
            case 'del':
                if(isset($_GET['id'])) 
                {
                    unset($_SESSION['cart'][$_GET['id']]);
                    header('location: cart.php');
                }
                ;break;

            case 'submit':
                if(isset($_POST['upd'])) 
                {   
                    // foreach($_POST['qty'] as $id=>$qty)
                    //     $_SESSION['cart'][$id] = $qty;
                }
                elseif(isset($_POST['ord'])) 
                {
                    
                }
                ;break;
        }
    }
    //Xy ly cart
    if(!isset($_SESSION['name']))
        header('location: index.php?fail=1');


?>
<!doctype html>
<html lang="en">
    <head>
        <title>Giỏ Hàng</title>
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
        <!-- <script src="code.js"></script> -->
      </head>
  <body>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!----------------------- I. Header -->
    <?php 
        include('header.php');
    ?>   

    <!--Glasses on cart-->
    <div class="container detail">
        <h4 class="text-center pt-1 pb-3 text-color">- SẢN PHẨM ĐÃ THÊM -</h4>

        <form action="cart.php?action=submit" method="post">
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
                    $total = 0;               
                    if(!isset($cart))
                        echo '<tr><td colspan="7" align="center"><h5>Bạn chưa thêm mặt hàng nào !<h5></td></tr>';
                     else
                        foreach($cart as $id=>$qty)
                        {
                            $sql = 'Select glasses.name as gname, glasses.image as gimage, normal_price, sale_price, brand.image as bimage
                                    from glasses join brand
                                    on glasses.id_brand = brand.id 
                                    where glasses.id = '.$id;
                            $row = mysqli_fetch_array(mysqli_query($conn,$sql));
                            echo '
                            <tr>
                                <td>1</td>
                                <td><img height="40px" src="img/'.$row['gimage'].'"/> '.$row['gname'].'</td>
                                <td><img height="40px" src="img/'.$row['bimage'].'"/></td>
                                <td>'.number_format($row['normal_price']).' VND</td>
                                <td><input type="number" name="qty" value="'.$qty.'" style="width:50px"></td>
                                <td>'.number_format($row['normal_price']*$qty).' VND</td>
                                <td>
                                    <a class="btn btn-sm btn-danger" href="cart.php?action=del&id='.$id.'">Xóa</a>
                                </td>
                            </tr>';
                            $total += $row['normal_price']*$qty;
                        }
                        echo'
                        <tr class="text-color">
                            <td colspan="5" align="right"><b>Tổng cộng: </b></td>
                            <td colspan="2"><b>'.number_format($total).' VND</b></td>
                        </tr>
                        ';
                    ?>
                </tbody>
            </table>
            <div>
                <button type="submit" name="upd" class="btn btn-secondary">Cập nhật</button>
                <button type="submit" name="ord" class="btn btn-color">Đặt hàng</button>
                <a class="btn btn-info" href="index.php">Mua sắm tiếp</a>
            </div>
        </form>
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