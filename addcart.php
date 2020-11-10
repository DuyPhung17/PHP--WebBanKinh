<?php 
    session_start();
    if(empty($_SESSION['name']))
        header('location: index.php?stt=1');
    else
    {
        $id= $_GET['id'];
        if(!empty($id))
        {
            if(isset($_SESSION['cart'][$id]))
                $_SESSION['cart'][$id]++;
            else   
                $_SESSION['cart'][$id] = 1;
            header('Location: index.php?stt=2');
        }
        else header('Location: index.php');
    }    
?>