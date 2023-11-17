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

    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="row p-2">
                    <?php
                    if (!$_GET) {
                        Header("Location: home.php");
                    } else { ?>
                        <?php

                        // echo "<pre>";
                        // print_r($_GET);
                        // print_r($_SESSION);
                        // echo "</pre>";

                        // sum total
                        $sql = "SELECT SUM(project_budget) 
                        FROM project
                        WHERE plan_code = '" . $_GET['plan_code'] . "' ";
                        $result = $conn->query($sql);
                        $row_sum_total = mysqli_fetch_array($result);
                        // echo 'total:' . $row_sum_total[0];
                        // exit;

                        // sum total activity
                        $sql = "SELECT SUM(sub_budget)
                        FROM sub_budget
                        WHERE sub_p_plan_id = '".$_GET['plan_code']."' ";
                        $result = $conn->query($sql);
                        $row_sum_total2 = mysqli_fetch_array($result);
                        // echo 'total:' . $row_sum_total[0];
                        // exit;

                        // remain
                        $sql2 = "SELECT ((s2.project_budget) - SUM(s1.sub_budget))
                        FROM sub_budget s1 
                        LEFT JOIN project s2 on s1.sub_p_name_id = s2.project_id
                        WHERE s2.project_id = '" . $_GET['project_id'] . "' ";
                        $result2 = $conn->query($sql2);
                        $row_remain = mysqli_fetch_array($result2);
                        // echo 'remain:' . $row_remain[0];
                        // exit;

                        ?>

                        <body>
                            <div class="container">
                                <div class="row p-3">
                                    <div class="col-md-12">
                                        <h4>โครงการ : <?php echo $_GET['project_plan']; ?></h4>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <a type="button" class="btn btn-warning" href="./project-manage.php">ย้อนกลับ</a>
                                    <?php if (($_SESSION['level'] == 'finance') or $_SESSION['level'] == 'admin') { ?>
                                        <a type="button" class="btn btn-primary" href="./project-budget.php">+ เบิกงบโครงการ</a>
                                    <?php } ?>
                                </div>


                                <div class="row p-2">

                                    <!-- Data list table -->

                                    <table id="example" class="table table-hover" style="margin-top: 4%; width: 100%; border-color: #fff;">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>รหัสกิจกรรม</th>
                                                <th>กิจกรรม</th>
                                                <th>งบประมาณที่ขอเบิกใช้</th>
                                                <th>รายการที่ขอเบิกใช้</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Get member rows 
                                            $result = $conn->query("SELECT project_id, plan_code, project_name, project_budget
                                                    FROM project 
                                                    WHERE plan_code = '" . $_GET['plan_code'] . "'");
                                            if ($result->num_rows > 0) {
                                                $i = 0;
                                                while ($row = $result->fetch_assoc()) {
                                                    $i++;
                                            ?>
                                                    <tr>
                                                        <td><?php echo $row['project_id']; ?></td>
                                                        <td><?php echo $row['project_name']; ?></td>
                                                        <td><?php $budget = $row['project_budget'];
                                                            echo number_format($budget, 2) ?> บาท</td>
                                                        <td class="text-center"><a style="text-decoration: none;" href="project-sub-budget-detail.php?project_id=<?php echo $row['project_id'] ?>&&project_name=<?php echo $row['project_name'] ?>&&plan_code=<?php echo $row['plan_code'] ?>&&project_plan=<?php echo $_GET['project_plan'] ?>">แสดงข้อมูล</a></td>

                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr>
                                                    <td>ไม่มีข้อมูล...</td>
                                                    <td></td>
                                                    <td></td>
                                                    <?php if (($_SESSION['level'] == 'plan') or ($_SESSION['level'] == 'admin')) { ?>
                                                        <td></td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <div class="row mt-3 text-center">
                                        <div class="col-md-4">
                                            <h6>งบประมาณรวมกิจกรรม : <?php $total_budget = $row_sum_total[0];
                                                                        echo number_format($total_budget, 2) ?> บาท</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <h6>งบประมาณกิจกรรมที่ใช้ไป : <?php $total_budget2 = $row_sum_total2[0];
                                                                        echo number_format($total_budget2, 2) ?> บาท</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <h6>งบประมาณกิจกรรมคงเหลือ : <?php $total_budget3 = $row_sum_total[0] - $row_sum_total2[0];
                                                                        echo number_format($total_budget3, 2) ?> บาท</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </body>

                        </html>
                    <?php } ?>
                </div>
            </div>
        </div>



        <?php include('./include/footer.php') ?>
        <?php include('./include/datatable.php') ?>
    </div>
<?php } ?>