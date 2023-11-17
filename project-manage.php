<?php
session_start();
include('./db/connect.php');
?>
<?php if(!$_SESSION){
    Header("Location: home.php");
}else{ ?>
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
                // sum total
                $sql = "SELECT SUM(project_budget) FROM project ";
                $result = $conn->query($sql);
                $row_sum_total = mysqli_fetch_array($result);
                // echo 'total:' . $row_sum_total[0];

                // sum sub_budget
                $sql2 = "SELECT SUM(sub_budget) FROM sub_budget ";
                $result2 = $conn->query($sql2);
                $row_sum_sub_budget = mysqli_fetch_array($result2);
                // echo 'total:' . $row_sum_total[0];

                // exit;


                // remain
                $sql2 = "SELECT *, (project_budget - sub_budget) as remain
                FROM sub_budget s1 
                LEFT JOIN project s2 on s1.sub_p_name_id = s2.project_id
                WHERE s2.project_id = 1";
                $result2 = $conn->query($sql2);
                $row_remain = mysqli_fetch_array($result2);
                ?>

                <body>
                    <div class="container">
                        <div class="row p-3">
                            <!-- Data list table -->
                            <table id="example" class="table table-hover" style="margin-top: 4%; width: 100%; border-color: #fff;">
                                <thead class="table-dark">
                                    <tr>
                                        <th>เลขที่</th>
                                        <th>ชื่อโครงการ</th>
                                        <th>รายการกิจกรรม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Get member rows 
                                    $result = $conn->query("SELECT * FROM project WHERE project_status = 'อนุมัติ' GROUP BY plan_code  ORDER BY project_id ASC");
                                    if ($result->num_rows > 0) {
                                        $i = 0;
                                        while ($row = $result->fetch_assoc()) {
                                            $i++;
                                    ?>
                                            <tr>
                                                <td><?php echo $row['plan_code']; ?></td>
                                                <td><?php echo $row['project_plan']; ?></td>
                                                <td class="text-center"><a style="text-decoration: none;" href="project-sub-budget.php?plan_code=<?php echo $row['plan_code'] ?>&&project_plan=<?php echo $row['project_plan']?>">แสดงข้อมูล</a></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                        <td>ไม่พบข้อมูล...</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="row mt-3 text-center">
                                <div class="col-md-4">
                                    <h6>งบประมาณตั้งต้นรวมทั้งหมด : <?php $total = $row_sum_total[0];
                                                                    echo number_format($total, 2) ?> บาท</h6>
                                </div>
                                <div class="col-md-4">
                                    <h6>งบประมาณที่ใช้ไปรวมทั้งหมด : <?php $total_sub_budget = $row_sum_sub_budget[0];
                                                                        echo number_format($total_sub_budget, 2) ?> บาท</h6>
                                </div>
                                <div class="col-md-4">
                                    <h6>งบประมาณคงเหลือรวมทั้งหมด : <?php $total_remain = ($row_sum_total[0] - $row_sum_sub_budget[0]);
                                                                    echo number_format($total_remain, 2) ?> บาท</h6>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>


    </body>

    </html>
    <?php include('./include/footer.php') ?>
    <?php include('./include/datatable.php') ?>
</div>
<?php } ?>
