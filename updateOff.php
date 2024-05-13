<?php
require_once"config/db.php";
if(isset($_POST['updateOff'])){
     

    // คำสั่ง SQL สำหรับการอัพเดตข้อมูล
    $sql = "UPDATE switch SET stat='0' WHERE id=0";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } 
}

?>
