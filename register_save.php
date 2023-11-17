<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;

session_start();

include ('./db/connect.php');

if(!$_POST){
    Header("Location: register.php");
}else{
    $password = $_POST['pass'];

    // cost for password
    $options = [
        'cost' => 10,
    ];
    
    // create valiable
    $store_password = $password;
    
    $uname = $_POST['uname'];
    $passwordHash = password_hash($store_password, PASSWORD_BCRYPT, $options);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $cid = $_POST['cid'];
    
    
    // check data
    $check_uname = "SELECT * FROM member WHERE uname = '$uname' AND cid = '$cid' ";
    $register = mysqli_query($conn, $check_uname);
    $num = mysqli_num_rows($register);
    
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
    if ($num > 0) {
        echo '<script>
                setTimeout(function() {
                swal({
                title: "มีชื่อผู้ใช้นี้แล้ว กรุณาสมัครใหม่อีกครั้ง !",
                type: "warning",
                showConfirmButton: false,
                timer: 2000
                }, function() {
                    window.location = "register.php"; //หน้าที่ต้องการให้กระโดดไป
                });
            }, 1000);
            </script>';
        }else{
            $sql = " INSERT INTO member (uname, password, fname, lname, cid, level, created, modified) VALUES ('$uname', '$passwordHash','$fname', '$lname', '$cid', 'member', NOW(), NOW() ) ";
            $register2 = mysqli_query($conn, $sql);
    
            echo '<script>
                setTimeout(function() {
                swal({
                title: "บันทึกข้อมูลเรียบร้อย",
                type: "success",
                showConfirmButton: false,
                timer: 1500
                }, function() {
                    window.location = "login.php"; //หน้าที่ต้องการให้กระโดดไป
                });
            }, 1000);
            </script>';
        }
        //close connect
    mysqli_close($conn);
}
  
?>
