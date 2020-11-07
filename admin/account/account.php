<?php 
    require_once('../db_config/db_connect.php');

    $sql = 'Select * from account';
    $result = mysqli_query($conn,$sql);
?>

<div class="container detail">
    <div class="top">
        <h4 class="text-color">QUẢN LÝ TÀI KHOẢN</h4>
        <a class="btn btn-color" href="#">Thêm mới</a>
    </div>

    <table class="table">
        <thead class="bg-color text-white">
            <tr>
                <th>STT</th>
                <th>Tên tài khoản</th>
                <th>Ảnh đại diện</th>
                <th>Tên đăng nhập</th>
                <th>Mật khẩu</th>
                <th>Điện thoại</th>
                <th>Địa chỉ</th>
                <th>Vai trò</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i = 1;
                while($row = mysqli_fetch_array($result))
                {
                    echo '
                    <tr>
                        <td>'.$i++.'</td>
                        <td>'.$row['name'].'</td>
                        <td><img class="avt_user" src="../img/'.$row['image'].'"/></td>
                        <td>'.$row['username'].'</td>
                        <td>'.$row['password'].'</td>
                        <td>'.$row['phone'].'</td>
                        <td>'.$row['address'].'</td>';
                        if($row['admin']==1)
                            echo'<td>Quản trị</td>';
                        else echo '<td>Khách hàng</td>';
                        echo '
                        <td>
                            <a class="btn btn-sm btn-secondary" href="#">Cập nhật</a>
                            <a class="btn btn-sm btn-danger" href="#">Xóa</a>
                        </td>
                    </tr>';
                }
            ?>
        </tbody>
    </table>
</div>

<?php 
    mysqli_free_result($result);
    mysqli_close($conn);
?>