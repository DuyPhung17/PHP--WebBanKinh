<?php 
    if (!isset($_SESSION['adm'])) {
        header('Location: ../index.php');
    }
    else{
        $adm = $_SESSION['adm'];
        if($adm == 0)
        {
            echo'ko đủ quyền';
            exit();
        }
    }
?>