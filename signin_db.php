<?php 

session_start();
require_once 'config/db.php';

if (isset($_POST['signin'])) {
    $admin_name = $_POST['admin_name'];
    $password = $_POST['password'];

    if (empty($admin_name)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อผู้ใช้';
        header("location: signin.php");
    } else if (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: signin.php");
    } else {
        try {
            $check_data = $conn->prepare("SELECT * FROM admin_login WHERE admin_name = :admin_name");
            $check_data->bindParam(":admin_name", $admin_name);
            $check_data->execute();
            $row = $check_data->fetch(PDO::FETCH_ASSOC);

            if ($check_data->rowCount() > 0) {
                if ($admin_name == $row['admin_name']) {
                    // ตรวจสอบรหัสผ่านโดยเปรียบเทียบโดยตรงกับที่อยู่ในฐานข้อมูล
                    if ($password == $row['password']) {
                        if ($row['urole'] == 'admin') {
                            $_SESSION['admin_login'] = $row['id'];
                            header("location: admin.php");
                        } else {
                            $_SESSION['user_login'] = $row['id'];
                            header("location: user.php");
                        }
                    } else {
                        $_SESSION['error'] = 'รหัสผ่านผิด';
                        header("location: signin.php");
                    }
                } else {
                    $_SESSION['error'] = 'ชื่อผู้ใช้ผิด';
                    header("location: signin.php");
                }
            } else {
                $_SESSION['error'] = "ไม่มีข้อมูลผู้ใช้งานในระบบ";
                header("location: signin.php");
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
