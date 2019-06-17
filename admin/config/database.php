<?php
    $db = mysqli_connect('localhost','root','','phpthuan');
    if (!$db){
        echo "Kết nối database không thành công";
    }else{
        mysqli_set_charset($db,'utf8');
    }
    return $db;
?>