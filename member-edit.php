<?php
session_start();
include('./db/connect.php');
?>
<?php if(!$_SESSION){
Header("Location: home.php");
}else{?>
    <?php include('./include/head.php') ?>
    <?php include('./include/sidebar.php') ?>
    <!--  Header Start -->
    <?php include('./include/header.php') ?>
    <!--  Header End -->
    
    <div class="container-fluid">
    
        <?php
    
        // echo "<pre>";
        // print_r($_GET);
        // echo "</pre>";
        // exit;
    
        // edit data
        $sql = " SELECT * FROM member WHERE m_id = '" . $_GET['m_id'] . "' ";
        $result = mysqli_query($conn, $sql);
        ?>
    
    
        <body>
            <div class="container mt-3">
                <h3>แก้ไขข้อมูลผู้ใช้งาน</h3>
    
                <div class="mt-3">
                    <form class="row g-3" action="member-edit-db.php" method="POST">
                        <?php while ($row = mysqli_fetch_array($result)) { ?>
                            <div class="col-md-6">
                                <label class="form-label">ชื่อผู้ใช้งาน</label>
                                <input type="text" name="uname" class="form-control" value="<?php echo $row['uname'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">ระดับผู้ใช้งาน</label>
                                <input type="text" name="level" class="form-control" value="<?php echo $row['level'] ?>">
                            </div>
    
                            <div class="col-md-4">
                                <label class="form-label">ชื่อ</label>
                                <input type="text" name="fname" class="form-control" value="<?php echo $row['fname'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">นามสกุล</label>
                                <input type="text" name="lname" class="form-control" value="<?php echo $row['lname'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">เลขบัตรประชาชน</label>
                                <input type="text" name="cid" class="form-control" value="<?php echo $row['cid'] ?>">
                            </div>
    
                            <input type="hidden" name="m_id" class="form-control" value="<?php echo $_GET['m_id'] ?>">
    
                            <div class="col-12">
                                <a href="member-manage.php" type="button" class="btn btn-warning">ย้อนกลับ</a>
                                <button type="submit" name="edit_member" class="btn btn-primary">บันทึก</button>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </body>
    
        <?php include('./include/footer.php') ?>
    </div>
<?php } ?>
