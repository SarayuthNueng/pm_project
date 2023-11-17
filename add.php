<?php
session_start();
include "./db/connect.php";

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
                $date = $row[4];


                $sql1 = "INSERT INTO project (plan_code, project_plan ,project_name, project_budget, date) VALUES ('$plan_code', '$project_plan', '$project_name' , '$project_budget', '$date')";
                $res1 = $conn->query($sql1);
            }
            $i++;
        }
    } else {
        echo SimpleXLSX::parseError();
    }
}
?>

<!-- *************************************************************** -->
<!-- Start Top Leader Table -->
<!-- *************************************************************** -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">เพิ่มสมาชิกจากไฟล์ Excel</h4>
                <div class="form-group">
                    <div class="form-label-group">
                        <center><?php if (isset($message, $colorfont)) {
                                    echo "<h2><font color = '" . $colorfont . "' > $message </font></h2>";
                                } ?></center>
                    </div>
                </div>
                <form method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                    <div>
                        <center>
                            <label>
                                <h5>เลือกไฟล์ Excel ที่ต้องการอัพโหลด</h5>
                            </label>

                            <br><br>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" data-theme="asphalt" name="file" id="file" accept=".xls,.xlsx" required>

                                </div>
                            </div>
                            <br>
                            <button type="submit" id="submit" name="import" class="btn btn-success">เพิ่มไฟล์</button>
                            <br><br>

                            <label>ดาวน์โหลดตัวอย่างไฟล์ Excel ได้ <a href="example.xlsx">ที่นี่</a></label>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- order table -->
<!-- *************************************************************** -->