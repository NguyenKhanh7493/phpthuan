<?php
include (__DIR__.'/../../config/database.php');
include (__DIR__.'/../../config/define.php');
if (isset($_POST['id'])){
    $path = __DIR__.'/../../public/admin/image/'.$_POST['avatar'];
    $id = $_POST['id'];
    $sql = "DELETE FROM users WHERE id=".$id;
    $result = mysqli_query($db,$sql);
    if ($result){
        unlink($path);
        echo "OK";
    }else{
        echo "FAIL";
    }
}
?>