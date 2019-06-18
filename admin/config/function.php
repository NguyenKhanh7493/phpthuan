<?php
 function dataRow($result){
     if ($result){
         $data = array();
         while ($da = mysqli_fetch_assoc($result)){
             $data = $da;
         }
         return $data;
     }else{
         return false;
     }
 }
?>