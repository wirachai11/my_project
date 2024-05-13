<?php
require_once"config/db.php";
if(isset($_POST['updateOn'])){
     

    // คำสั่ง SQL สำหรับการอัพเดตข้อมูล
    $sql = "UPDATE switch SET stat='1' WHERE id=0";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } 
}

?>
