<?php 
    require_once('../db_config/db_connect.php');

    $sql = 'Select * from brand';
    $result = mysqli_query($conn,$sql);
?>

<div class="container detail">
    <div class="top">
        <h4 class="text-color">QUẢN LÝ THƯƠNG HIỆU</h4>
        <a class="btn btn-color" href="#">Thêm mới</a>
    </div>

    <table class="table">
        <thead class="bg-color text-white">
            <tr>
                <th>STT</th>
                <th>Thương hiệu</th>
                <th>Logo</th>
                <th>Xuất xứ</th>
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
                    <td>'.$row['name'].'</td>
                    <td><img src="../img/'.$row['image'].'"/></td>
                    <td>'.$row['country'].'</td>
                    <td>
                        <a class="btn btn-sm btn-secondary" href="#">Cập nhật</a>
                        <a class="btn btn-sm btn-secondary" href="#">Xóa</a>
                    </td>
                </tr>
                ';
            ?>
        </tbody>
    </table>
</div>

<?php 
    mysqli_free_result($result);
    mysqli_close($conn);
?>