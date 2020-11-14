<?php 
  if(isset($_GET['id']))
  $id = $_GET['id'];
  require_once('../db_config/db_connect.php');

  $sql_account = 'select * from account where id ='.$id;
  $result_account = mysqli_query($conn, $sql_account);
  $row = mysqli_fetch_array($result_account);

  $name = $row['name'];
  $username = $row['username'];
  $password = $row['password'];
  $phone = $row['phone'];
  $address = $row['address'];

  $errName = $errAddress = $errPhone = $errUsername = $errPassword = $errPasswordRT = "";
  if(isset($_POST['submit']))
  {
    //Kiem Tra name
    if(isset($_POST['name']))
    {
      $name = $_POST['name'];
      if($name =="")
        $errName = "Chưa nhập tên";
      elseif(!is_string($name))
        $errName = "Dữ liệu không hợp lệ";
    }
    //Kiem Tra address
    if(isset($_POST['address']))
    {
        $address = $_POST['address'];
        if($address =="")
        $errAddress = "Chưa nhập địa chỉ";
        elseif(!is_string($address))
        $errAddress = "Dữ liệu không hợp lệ";
    }
    //Kiem Tra phone
    if(isset($_POST['phone']))
    {
        $phone = $_POST['phone'];
        if($phone =="")
        $errPhone = "Chưa nhập SĐT";
        elseif(!is_numeric($phone))
        $errPhone = "Dữ liệu không hợp lệ";
    }
    //Kiem Tra username
    if(isset($_POST['username']))
    {
        $username = $_POST['username'];
        if($username =="")
        $errUsername = "Chưa nhập tên đăng nhập";
        elseif(!is_string($username))
        $errUsername = "Dữ liệu không hợp lệ";
        else{
            $sql_check = 'SELECT * FROM account WHERE username = "'.$username.'"';
            $result_check = mysqli_query($conn,$sql_check);
            if(mysqli_num_rows($result_check))
                $errUsername = "Tên đăng nhập đã tồn tại";
        }
    }
    //Kiem Tra password
    if(isset($_POST['password']))
    {
        $password = $_POST['password'];
        if($password =="")
        $errPassword = "Chưa nhập mật khẩu";
        elseif(!is_string($password))
        $errPassword = "Dữ liệu không hợp lệ";
    }
    //Kiem Tra passwordRetype
    if(isset($_POST['passwordRT']))
    {
        $passwordRT = $_POST['passwordRT'];
        if($passwordRT =="")
        $errPasswordRT = "Chưa nhập lại mật khẩu";
        elseif(isset($password) && strcmp($password,$passwordRT)!=0)
        $errPasswordRT = "Mật khẩu không trùng khớp";
        elseif(!is_string($passwordRT))
        $errPasswordRT = "Dữ liệu không hợp lệ";
    }
    //Kiem Tra img
    if(isset($_FILES['img']))
    {
        $img = $_FILES['img']['name'];
        $target_dir = "../img/";
        $target_file = $target_dir . basename($img);
        move_uploaded_file($_FILES['img']['tmp_name'],$target_file);
    }
    //add new
    if(empty($errName) && empty($errAddress) && empty($errPhone) && empty($errUsername) && empty($errPassword) && empty($errPasswordRT))
    {
      $sql = 'UPDATE account SET
                ';
      mysqli_query($conn, $sql);
      $check = 1;
      echo '<script type="text/javascript">swal("Tạo tài khoản thành công!", "Tên tài khoản: '.$name.'", "success");</script>';
    }
  }

?>

<div class="mt-4">
    <h3 class=" text-center mb-4">- Cập nhật tài khoản -</h3>
    <form action="" method="post" enctype="multipart/form-data" style="width:50%;margin-left:20%">
    
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Tên đầy đủ: </label>
          <input type="text" name="name" class="form-control col-sm-8" value="<?php if(isset($name)) echo $name ?>">
        </div>
        <?php 
          if(!empty($errName))
            echo '
            <div class="form-group row">
              <p class="text-danger col-sm-4"></p>
              <p class="text-danger col-sm-8">'.$errName.'</p>
            </div>
            ';
        ?>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Địa chỉ: </label>
          <input type="text" name="address" class="form-control col-sm-8" value="<?php if(isset($address)) echo $address ?>">
        </div>
        <?php 
          if(!empty($errAddress))
            echo '
            <div class="form-group row">
              <p class="text-danger col-sm-4"></p>
              <p class="text-danger col-sm-8">'.$errAddress.'</p>
            </div>
            ';
        ?>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Số điện thoại: </label>
          <input type="text" name="phone" class="form-control col-sm-8" value="<?php if(isset($phone)) echo $phone ?>">
        </div>
        <?php 
          if(!empty($errPhone))
            echo '
            <div class="form-group row">
              <p class="text-danger col-sm-4"></p>
              <p class="text-danger col-sm-8">'.$errPhone.'</p>
            </div>
            ';
        ?>
       
       <div class="form-group row">
          <label class="col-sm-4 col-form-label">Tên đăng nhập: </label>
          <input type="text" name="username" disabled class="form-control col-sm-8" value="<?php if(isset($username)) echo $username ?>">
        </div>
        <?php 
          if(!empty($errUsername))
            echo '
            <div class="form-group row">
              <p class="text-danger col-sm-4"></p>
              <p class="text-danger col-sm-8">'.$errUsername.'</p>
            </div>
            ';
        ?>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Mật khẩu: </label>
          <input type="password" name="password" class="form-control col-sm-8" value="<?php if(isset($password)) echo $password ?>">
        </div>
        <?php 
          if(!empty($errPassword))
            echo '
            <div class="form-group row">
              <p class="text-danger col-sm-4"></p>
              <p class="text-danger col-sm-8">'.$errPassword.'</p>
            </div>
            ';
        ?>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Nhập lại mật khẩu: </label>
          <input type="password" name="passwordRT" class="form-control col-sm-8" value="<?php if(isset($passwordRT)) echo $passwordRT ?>">
        </div>
        <?php 
          if(!empty($errPasswordRT))
            echo '
            <div class="form-group row">
              <p class="text-danger col-sm-4"></p>
              <p class="text-danger col-sm-8">'.$errPasswordRT.'</p>
            </div>
            ';
        ?>
        
        <div class="form-group row">
        <p class="col-sm-4"></p>
          <div class="col-sm-8 pl-0 pt-3">
            <input class="btn btn-color" type="submit" name="submit" value="Cập nhật">
            <button class="btn btn-secondary" type="reset">Đặt lại</button>
          </div>
        </div>

    </form> 

</div>