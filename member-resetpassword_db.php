<?php
include('./include/head.php');
include('./db/connect.php');
?>
<?php
session_start();

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit;

$options = [
    'cost' => 10
];

$m_id = $_POST['m_id'];
$password = $_POST['password'];
$store_password = $password;
$passwordHash = password_hash($store_password, PASSWORD_BCRYPT, $options);

?>
<?php if(!$_SESSION) {
    Header("Location: home.php");
}else{
    if(!isset($_POST['edit_password'])){
        Header("Location: home.php");
    }else{
        $sql = " UPDATE member SET password = '".$passwordHash."' WHERE m_id = '".$m_id."' ";
        $result = mysqli_query($conn,$sql);

        echo '
            <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

        echo '<script>
            setTimeout(function() {
            swal({
            title: "แก้ไขรหัสผ่านสำเร็จ",
            type: "success",
            showConfirmButton: false,
            timer: 1500
            }, function() {
                window.location = "member-manage.php"; //หน้าที่ต้องการให้กระโดดไป
            });
            }, 1000);
            </script>';
    }
}?>