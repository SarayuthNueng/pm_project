<?php
session_start();
include('./db/connect.php');
?>
<?php
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit;

$m_id = $_POST['m_id'];
$uname = $_POST['uname'];
$level = $_POST['level'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$cid = $_POST['cid'];
?>
<?php
if(!$_SESSION){
    Header("Location: home.php");
}else{
    if(!isset($_POST['edit_member'])){
        Header("Location: home.php");
    }else{
        $sql = " UPDATE member SET uname = '".$uname."', level = '".$level."', fname = '".$fname."', lname = '".$lname."', cid = '".$cid."' WHERE m_id = '".$m_id."' ";
        $result = mysqli_query($conn,$sql);

        echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    echo '<script>
        setTimeout(function() {
        swal({
        title: "แก้ไขข้อมูลสำเร็จ",
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
?>