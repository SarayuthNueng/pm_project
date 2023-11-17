<?php
session_start();
include('./db/connect.php');

// print_r($_SESSION);
// exit;
// sum total
$sql = "SELECT SUM(project_budget) FROM project ";
$result = $conn->query($sql);
$row_sum_total = mysqli_fetch_array($result);
// echo 'total:' . $row_sum_total[0];
// exit;
?>
<?php
require_once __DIR__ . '/SimpleXLSX.php';

if (isset($_FILES['file'])) {

    if ($xlsx = SimpleXLSX::parse($_FILES['file']['tmp_name'])) {


        $dim = $xlsx->dimension();
        $cols = $dim[0];

        $i = 0;
        foreach ($xlsx->rows() as $row) {
            if ($i > 0) {
                $plan_code = $row[0];
                $project_plan = $row[1];
                $project_name = $row[2];
                $project_budget = $row[3];
                $user_id_import = $_SESSION['m_id'];

                //check data
                $check_import = "SELECT * FROM project WHERE project_plan = '$project_plan' AND project_name = '$project_name' ";
                $import = mysqli_query($conn, $check_import);
                $num = mysqli_num_rows($import);

                if($num > 0){
                    $sql1 = " UPDATE project SET project_budget = '".$project_budget."', modified = NOW(), user_id_import = '".$user_id_import."', edit_user_id = '".$_SESSION['m_id']."' WHERE project_plan = '".$project_plan."' AND project_name = '".$project_name."' ";
                    $update_import = mysqli_query($conn, $sql1);
                }else{
                    $sql2 = " INSERT INTO project (plan_code,project_plan, project_name, project_budget, date, user_id_import, project_status, created, modified, edit_user_id) VALUES ('".$plan_code."','".$project_plan."', '".$project_name."', '".$project_budget."', NOW(), '".$user_id_import."', 'อนุมัติ', NOW(), NOW(), '".$_SESSION['m_id']."' ) ";
                    $import = mysqli_query($conn, $sql2);
                }
                
                
                

                // $sql1 = "INSERT INTO project (plan_code, project_plan ,project_name, project_budget, date) VALUES ('$plan_code', '$project_plan', '$project_name' , '$project_budget', '$date')";
                // $res1 = $conn->query($sql1);
            }
            $i++;
        }
    } else {
        echo SimpleXLSX::parseError();
    }
}
?>
<?php if(!$_SESSION){
    Header("Location: home.php");
}else{ ?>
<!-- Show/hide Excel file upload form -->
<script>
    function formToggle(ID) {
        var element = document.getElementById(ID);
        if (element.style.display === "none") {
            element.style.display = "block";
        } else {
            element.style.display = "none";
        }
    }
</script>
<?php include('./include/head.php') ?>
<?php include('./include/sidebar.php') ?>
<!--  Header Start -->
<?php include('./include/header.php') ?>
<!--  Header End -->


<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row p-2">
                <!-- Import link -->
                <div class="col-md-12 head mb-2">
                    <div class="float-end">
                        <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> นำเข้าโครงการ</a>
                    </div>
                </div>
                <!-- Excel file upload form -->
                <div class="col-md-12" id="importFrm" style="display: none;">
                    <form class="row g-3" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                        <div class="col-auto">
                            <label for="fileInput" class="visually-hidden">File</label>
                            <input type="file" class="form-control" name="file" id="file" accept=".xls,.xlsx" required/>
                        </div>
                        <div class="col-auto">
                            <input type="submit" class="btn btn-primary mb-3" name="importSubmit" value="นำเข้าไฟล์ excel">
                        </div>
                    </form>
                </div>

                <!-- Data list table -->
                <table id="example" class="table table-hover" style="margin-top: 4%; width: 100%; border-color: #fff;">
                    <thead class="table-dark">
                        <tr>
                            
                            <th>เลขที่</th>
                            <th>ชื่อโครงการ</th>
                            <th>กิจกรรม</th>
                            <th>งบประมาณที่ขอใช้(บาท)</th>
                            <th>แก้ไข</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Get member rows 
                        $result = $conn->query("SELECT * FROM project WHERE project_status = 'อนุมัติ' ORDER BY project_id ASC");
                        if ($result->num_rows > 0) {
                            $i = 0;
                            while ($row = $result->fetch_assoc()) {
                                $i++;
                        ?>
                                <tr>
                                    
                                    <td><?php echo $row['plan_code']; ?></td>
                                    <td><?php echo $row['project_plan']; ?></td>
                                    <td><?php echo $row['project_name']; ?></td>
                                    <td><?php $budget = $row['project_budget'];
                                        echo number_format($budget, 2) ?> บาท</td>
                                    <td class="text-center"><a href="project_edit.php?p_id=<?php echo $row['project_id'] ?>"><i class="fa-solid fa-pen-to-square" style="color: #e8d611;"></i></a></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td>ไม่พบข้อมูล...</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <h6>งบประมาณตั้งต้นรวมทั้งหมด : <?php $total = $row_sum_total[0];
                                                        echo number_format($total, 2) ?> บาท</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
</body>

<?php include('./include/footer.php') ?>

<?php include('./include/datatable.php') ?>
</div>
<?php } ?>
