<?php 
    session_start();
    require_once('permission.php');
    echo 'Xin chào admin: '.$_SESSION['usn'];
?>