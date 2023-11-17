
<?php
session_start();
include('./db/connect.php');

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit;

$sub_id = $_POST['sub_id'];
$sub_budget = $_POST['sub_budget'];
$sub_p_plan_id = $_POST['sub_p_plan_id'];
$sub_p_name_id = $_POST['sub_p_name_id'];
$edit_m_id = $_POST['edit_m_id'];

?>

<?php if (!$_SESSION) {
    Header("Location: home.php");
} else {
    if(!isset($_POST['sub_budget_edit'])) {
        Header("Location: home.php");
    }else{
        $sql = " UPDATE sub_budget SET sub_budget = '" . $sub_budget . "', sub_p_plan_id = '" . $sub_p_plan_id . "', sub_p_name_id = '" . $sub_p_name_id . "', sub_modified = NOW(), edit_budget_m_id = '".$edit_m_id."' WHERE sub_id = '" . $sub_id . "'  ";
        $update = mysqli_query($conn, $sql);

        echo '
            <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

        echo '<script>
            setTimeout(function() {
            swal({
            title: "แก้ไขข้อมูลเรียบร้อย",
            type: "success",
            showConfirmButton: false,
            timer: 1500
            }, function() {
                window.location = "project-manage.php"; //หน้าที่ต้องการให้กระโดดไป
            });
            }, 1000);
            </script>';

        //ปิดการเชื่อมต่อกับฐานข้อมูล
        mysqli_close($conn);
    } ?>

<?php } ?>