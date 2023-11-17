<?php
session_start();
include('./db/connect.php');

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;

?>
<?php
$project_id = $_POST['project_id'];
$project_plan = $_POST['project_plan'];
$project_name = $_POST['project_name'];
$project_budget = $_POST['project_budget'];
$project_status = $_POST['project_status'];
$edit_user_id = $_SESSION['m_id'];

// print_r($project_budget);
// exit;

if (!$_SESSION) {
    Header("Location: home.php");
} else {
    if (!isset($_POST['editproject'])) {
        Header("Location: home.php");
    } else {
        $sql = " UPDATE project SET project_plan = '" . $project_plan . "', project_name = '" . $project_name . "', project_budget = '" . $project_budget . "', modified = NOW(), project_status = '".$project_status."', edit_user_id = '".$edit_user_id."' WHERE project_id = '" . $project_id . "' ";
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
                window.location = "project-import-plan.php"; //หน้าที่ต้องการให้กระโดดไป
            });
            }, 1000);
            </script>';

        //ปิดการเชื่อมต่อกับฐานข้อมูล
        mysqli_close($conn);
    }
}


?>