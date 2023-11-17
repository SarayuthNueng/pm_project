<?php
session_start();
include('./db/connect.php');

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;

$options = [
    'cost' => 10
];

$uname = $_POST['uname'];
$password = $_POST['password'];
$store_password = $password;
$passwordHash = password_hash($store_password, PASSWORD_BCRYPT, $options);
$level = $_POST['level'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$cid = $_POST['cid'];


?>
<?php if(!$_SESSION){
    Header("Location: home.php");
}else{
    if(!isset($_POST['add_member'])) {
        Header("Location: home.php");
    }else{
        // check data
        $checkmember = " SELECT * FROM member WHERE uname = '".$uname."' OR cid = '".$cid."' ";
        $check = mysqli_query($conn,$checkmember);
        $num = mysqli_num_rows($check);

        if($num > 0){
            echo '
            <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

        echo '<script>
            setTimeout(function() {
            swal({
            title: "มีชื่อผู้ใช้นี้แล้ว กรุณาสมัครใหม่อีกครั้ง !!!",
            type: "warning",
            showConfirmButton: false,
            timer: 1500
            }, function() {
                window.location = "member-manage.php"; //หน้าที่ต้องการให้กระโดดไป
            });
            }, 1000);
            </script>';
        }else{
            $sql = " INSERT INTO member (uname, password, level, fname, lname, cid, created, modified) VALUES ('$uname', '$passwordHash', '$level', '$fname', '$lname', '$cid', NOW(), NOW() ) ";
            $insert = mysqli_query($conn,$sql);

            echo '
            <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

        echo '<script>
            setTimeout(function() {
            swal({
            title: "บันทึกสำเร็จ",
            type: "success",
            showConfirmButton: false,
            timer: 1500
            }, function() {
                window.location = "member-manage.php"; //หน้าที่ต้องการให้กระโดดไป
            });
            }, 1000);
            </script>';
        }
    }
}
?>