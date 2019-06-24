<?php
include (__DIR__.'/../../config/database.php');
$id = $_POST['id'];
$sql = "SELECT FROM users WHERE id=".$id;
$result = mysqli_query($db,$sql);
if ($result){
    echo "OK";
}else{
    echo "FAIL";
}
?>