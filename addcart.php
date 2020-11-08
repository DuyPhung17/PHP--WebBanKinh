<?php 
    session_start();
    $id= $_GET['id'];
    if(!empty($id))
    {
        if(isset($_SESSION['cart'][$id]))
            $_SESSION['cart'][$id]++;
        else   
            $_SESSION['cart'][$id] = 1;
        header('Location: index.php?stt=1');
    }
    else header('Location: index.php');
?>