<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;
?>

<?php
session_start();
include('./db/connect.php');


?>
<?php
$sub_name = $_POST['sub_name'];
$sub_budget = $_POST['sub_budget'];
$sub_p_plan_id = $_POST['sub_p_plan_id'];
$sub_p_name_id = $_POST['sub_p_name_id'];
$sub_date = $_POST['sub_date'];
$sub_time = $_POST['sub_time'];
$sub_created = $_POST['sub_created'];
$save_m_id = $_SESSION['m_id'];

// print_r($project_status);
// exit;

if (!$_SESSION) {
    Header("Location: home.php");
} else {
    if (!isset($_POST['project_budget'])) {
        Header("Location: home.php");
    } else {


        // check data
        $check = " SELECT * FROM sub_budget WHERE sub_name = '".$sub_name."' AND sub_budget = '".$sub_budget."' AND sub_date = '".$sub_date."' AND sub_time = '".$sub_time."' ";
        $check_budget = mysqli_query($conn, $check);
        $num = mysqli_num_rows($check_budget);
        if($num > 0){
             $sql1 = " UPDATE sub_budget SET sub_name = '" . $sub_name . "', sub_budget = '" . $sub_budget . "', sub_p_plan_id = '" . $sub_p_plan_id . "', sub_p_name_id = '" . $sub_p_name_id . "', sub_modified = '".$sub_created."', modified_m_id = '".$save_m_id."' WHERE sub_name = '".$sub_name."' AND sub_budget = '".$sub_budget."' AND sub_date = '".$sub_date."' AND sub_time = '".$sub_time."' ";
             $update = mysqli_query($conn, $sql1);
        }else{
            $sql2 = " INSERT INTO sub_budget (sub_name, sub_budget, sub_p_plan_id, sub_p_name_id, sub_date, sub_time, sub_created, sub_modified, modified_m_id, edit_budget_m_id, save_m_id) VALUES (' $sub_name', '$sub_budget','$sub_p_plan_id', '$sub_p_name_id', '$sub_date', '$sub_time', '$sub_created', '$sub_created', '$save_m_id', '$save_m_id', '$save_m_id'  ) ";
            $add_sub_budget = mysqli_query($conn, $sql2);
        }

        echo '
            <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

        echo '<script>
            setTimeout(function() {
            swal({
            title: "บันทึกข้อมูลเรียบร้อย",
            type: "success",
            showConfirmButton: false,
            timer: 1500
            }, function() {
                window.location = "project-budget.php"; //หน้าที่ต้องการให้กระโดดไป
            });
            }, 1000);
            </script>';

        //ปิดการเชื่อมต่อกับฐานข้อมูล
        mysqli_close($conn);
    }
}


?>