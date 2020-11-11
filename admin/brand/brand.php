<?php 
    require_once('../db_config/db_connect.php');

    //Phan trang
    $sql_qty = 'select count(id) as qty from brand';
    $result_qty = mysqli_query($conn,$sql_qty);
    $row = mysqli_fetch_array($result_qty);
    $total_Product = $row['qty']; //Tong so san pham
    $product_perPage = 5;//So san pham tren 1 trang
    $total_Page = ceil($total_Product / $product_perPage);//tong so trang
    if(isset($_GET['pg']))
        $current_Page = $_GET['pg'];//Trang hien tai
    $index = ($current_Page - 1)*$product_perPage; //Vi tri bat dau lay trong $sql LIMIT

    $sql = 'SELECT  brand.name as "bname", country, brand.image as "bimage" , COUNT(glasses.id) as "qty"
                    FROM glasses JOIN brand WHERE glasses.id_brand = brand.id 
                    GROUP BY id_brand, bname, bimage, country limit '.$index.', '.$product_perPage.'';
    $result = mysqli_query($conn,$sql);
?>

<div class="container detail">
    <div class="top">
        <h4 class="text-color"><i class="fas fa-copyright"></i> QUẢN LÝ THƯƠNG HIỆU</h4>
        <a class="btn btn-color" href="index.php?page=ba">Thêm mới</a>
    </div>

    <table class="table table-hover">
        <thead class="bg-color text-white">
            <tr>
                <th>STT</th>
                <th>Thương hiệu</th>
                <th>Logo</th>
                <th>Xuất xứ</th>
                <th>SL sản phẩm</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i = 1;
                while($row = mysqli_fetch_array($result))
                echo '
                <tr>
                    <td>'.$i++.'</td>
                    <td>'.$row['bname'].'</td>
                    <td><img src="../img/'.$row['bimage'].'"/></td>
                    <td>'.$row['country'].'</td>
                    <td>'.$row['qty'].'</td>
                    <td>
                        <a class="btn btn-sm btn-secondary" href="#">Cập nhật</a>
                        <a class="btn btn-sm btn-danger" href="#">Xóa</a>
                    </td>
                </tr>
                ';
            ?>
        </tbody>
    </table>
</div>

<ul class="pagination mx-auto" style="width: 30%">
        <?php 
            //Gan nut truoc
            if($_GET['pg']>1)
                echo '        
                <li class="page-item">
                    <a class="page-link" href="?page=b&pg='.($_GET['pg']-1).'">Trước</a>
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
                    <a class="page-link" href="?page=b&pg='.$i.'">'.$i.'<span class="sr-only">(current)</span></a>
                </li>';
                else echo '<li class="page-item"><a class="page-link" href="?page=b&pg='.$i.'">'.$i.'</a></li>';
            }
            //Gan nut sau
            if($_GET['pg']<$total_Page)
                echo '        
                <li class="page-item">
                    <a class="page-link" href="?page=b&pg='.($_GET['pg']+1).'">Sau</a>
                </li>';
            else echo '        
                <li class="page-item disabled">
                    <a class="page-link" href="#">Sau</a>
                </li>';
        ?>
    </ul>
<?php 
    mysqli_free_result($result);
    mysqli_close($conn);
?>