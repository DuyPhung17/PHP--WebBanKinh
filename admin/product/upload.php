<?php 
$allowUpload = true;
//set noi save ảnh
$uploadPath = '../../img/'; 
// //lấy kieu file
// $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// //kieu anh cho phep
// $allowtypes    = array('jpg', 'png', 'jpeg', 'gif');
// // Kiểm tra kiểu file
// if (!in_array($imageFileType,$allowtypes ))
// {
//     echo "Chỉ được upload các định dạng JPG, PNG, JPEG, GIF";
//     $allowUpload = false;
// }
//tien hanh save anh
// if ($allowUpload)
//   {
      // Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
      if(isset($_POST['submit']) && !empty($_FILES['file']['name']))
      { 
        if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath.$_FILES['file']['name']))
            echo 'Upload thành công.'; 
        else
            echo 'Upload thất bại.'; 
        
        } 
    // }
?>
