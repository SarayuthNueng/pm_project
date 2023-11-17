<?php
session_start();
include('./db/connect.php');
// echo '<pre>';
// print_r($_GET);
// echo '</pre>';
// exit;
?>
<?php if (!$_SESSION) {
    Header("Location: home.php");
} else { ?>
    <?php include('./include/head.php') ?>
    <?php include('./include/sidebar.php') ?>
    <!--  Header Start -->
    <?php include('./include/header.php') ?>
    <!--  Header End -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="container-fluid">

        <?php if (!$_SESSION) {
            Header("Location: home.php");
        } else { ?>

            <?php
            // edit
            $sub_budgetID = $_GET['sub_budget_id'];
            $sql = " SELECT *, s2.project_plan as project_plan, s2.project_name as project_name, s2.project_id as project_plan_id, s2.project_budget as project_budget
            FROM sub_budget s1
            LEFT JOIN project s2 on s1.sub_p_plan_id = s2.project_id
            WHERE s1.sub_id = '" . $sub_budgetID . "' ";
            $query = mysqli_query($conn, $sql);
            //   dropdrown
            $sql1 = " SELECT * FROM project ";
            $query1 = mysqli_query($conn, $sql1);

            $sql2 = " SELECT * FROM project ";
            $query2 = mysqli_query($conn, $sql2);

            //   date,time
            $currentDate = date('Y-m-d');
            // echo $currentDate;
            date_default_timezone_set("Asia/Bangkok");
            $Time = date('h:i:s');
            $currentTime = date('h:i:s', strtotime($Time));
            // echo $newTime;
            // exit;

            ?>

            <body>
                <div class="container mt-4">
                    <h2>แก้ไขข้อมูลการเบิกงบโครงการ</h2>

                    <div class="mt-3">
                        <form class="row g-3" action="project-sub-detail-edit_db.php" method="POST">
                            <?php while ($row1 = mysqli_fetch_array($query)) { ?>
                                <div class="col-md-6">
                                    <label class="form-label">โครงการ</label>
                                    <input type="text" name="project_plan" class="form-control" value="<?php echo $row1['project_plan'] ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">กิจกรรม</label>
                                    <input type="text" name="project_name" class="form-control" value="<?php echo $row1['project_name'] ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">ชื่อรายการเบิก</label>
                                    <input type="text" name="sub_name" class="form-control" value="<?php echo $row1['sub_name'] ?>" >
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">จำนวนเงิน</label>
                                    <input type="float" name="sub_budget" class="form-control" value="<?php echo $row1['sub_budget'] ?>">
                                </div>
                                

                                <input type="hidden" name="sub_id" class="form-control" value="<?php echo $row1['sub_id'] ?>">
                                <input type="hidden" name="edit_m_id" class="form-control" value="<?php echo $_SESSION['m_id'] ?>">
                                <input type="hidden" name="project_id" class="form-control" value="<?php echo $_GET['project_id'] ?>">
                                <input type="hidden" name="plan_code" class="form-control" value="<?php echo $_GET['plan_code'] ?>">
                                <input type="hidden" name="project_plan" class="form-control" value="<?php echo $_GET['project_plan'] ?>">

                                <div class="col-12">
                                    <a type="button" class="btn btn-warning" href="./project-sub-budget-detail.php?project_id=<?php echo $_GET['project_id'] ?>&&project_name=<?php echo $_GET['project_name']?>&&project_plan=<?php echo $_GET['project_plan']?>&&plan_code=<?php echo $_GET['plan_code']?>">ย้อนกลับ</a>
                                    <button type="submit" name="sub_detail_edit" class="btn btn-success">บันทึก</button>
                                </div>


                            <?php } ?>
                        </form>
                        
                    </div>


                </div>
                
            </body>

            </html>
        <?php } ?>

        <?php include('./include/footer.php') ?>
    </div>
<?php } ?>