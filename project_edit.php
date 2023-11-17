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

    <?php if (!$_SESSION) {
        Header("Location: home.php");
    } else { ?>

        <?php
        // print_r($_GET);
        // exit;

        $pID = $_GET['p_id'];
        $sql = " SELECT * FROM project WHERE project_id = '" . $pID . "' ";
        $query = mysqli_query($conn, $sql);

        $sql2 = " SELECT * FROM project_status";
        $query2 = mysqli_query($conn, $sql2);


        ?>

        <body>
            <div class="container mt-4">
                <h2>แก้ไขข้อมูลโครงการ</h2>

                <div class="mt-3">
                    <form class="row g-3" action="project_db.php" method="POST">
                        <?php while ($row = mysqli_fetch_array($query)) { ?>
                            <div class="col-md-4">
                                <label class="form-label">รหัสโครงการ</label>
                                <input type="text" name="project_plan" class="form-control" value="<?php echo $row['plan_code'] ?>" disabled>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">ชื่อแผนงาน</label>
                                <input type="text" name="project_plan" class="form-control" value="<?php echo $row['project_plan'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">ชื่อโครงการ/กิจกรรม</label>
                                <input type="text" name="project_name" class="form-control" value="<?php echo $row['project_name'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">งบประมาณรวม(บาท)</label>
                                <input type="float" name="project_budget" class="form-control" value="<?php echo $row['project_budget'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">สถานะ</label>
                                <select id="inputState" class="form-select" name="project_status">
                                    <option selected><?php echo $row['project_status'] ?></option>
                                    <?php foreach ($query2 as $s) { ?>
                                        <option value="<?= $s['status']; ?>"><?= $s['status']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <input type="hidden" name="project_id" class="form-control" value="<?php echo $row['project_id'] ?>">
                            <input type="hidden" name="edit_user_id" class="form-control" value="<?php echo $_SESSION['m_id'] ?>">
                            <div class="col-12">
                                <a href="./project-import-plan.php" type="submit" class="btn btn-warning">กลับ</a>
                                <button type="submit" name="editproject" class="btn btn-success">แก้ไขข้อมูล</button>
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

<?php include('./include/head.php') ?>
<?php } ?>
