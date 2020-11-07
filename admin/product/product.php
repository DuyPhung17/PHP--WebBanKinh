<?php 
    require_once('../db_config/db_connect.php');

    $sql = 'Select glasses.id as gid, glasses.name as gname, glasses.image as gimage, normal_price, sale_price, brand.image as bimage
                from glasses join brand
                on glasses.id_brand = brand.id';
    $result = mysqli_query($conn,$sql);

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql_del = $sql = 'delete from glasses where id='.$id;
        mysqli_query($conn,$sql_del);
    }

?>

<div class="container detail">
    <div class="top">
        <h4 class="text-color">QUẢN LÝ SẢN PHẨM</h4>
        <a class="btn btn-color" href="index.php?page=pa">Thêm mới</a>
    </div>

    <table class="table">
        <thead class="bg-color text-white">
            <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Thương hiệu</th>
                <th>Đơn giá</th>
                <th>Giá khuyến mãi</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i = 1;
                while($row = mysqli_fetch_array($result))
                {
                    if(empty($row['sale_price']))
                        $sale_price = "";
                    else $sale_price = number_format($row['sale_price'])." VND";
                echo '
                <tr>
                    <td>'.$i++.'</td>
                    <td>'.$row['gname'].'</td>
                    <td><img src="../img/'.$row['gimage'].'"/></td>
                    <td><img src="../img/'.$row['bimage'].'"/></td>
                    <td>'.number_format($row['normal_price']).' VND</td>
                    <td class="text-danger">'.$sale_price.'</td>
                    <td>
                        <a class="btn btn-sm btn-secondary" href="index.php?page=pu&id='.$row['gid'].'">Cập nhật</a>
                        <a class="btn btn-sm btn-danger" href="product/product.php?id='.$row['gid'].'">Xóa</a>
                    </td>
                </tr>
                ';
                }
            ?>
        </tbody>
    </table>
</div>

<?php 
    mysqli_free_result($result);
    mysqli_close($conn);
?>