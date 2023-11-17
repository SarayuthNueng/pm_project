<?php
session_start();
include('./db/connect.php');
?>
<?php if(!$_SESSION){
    Header("Location:home.php");
}else{ ?>
    <?php include('./include/head.php') ?>
    <?php include('./include/sidebar.php') ?>
    <!--  Header Start -->
    <?php include('./include/header.php') ?>
    <!--  Header End -->
    
    <div class="container-fluid">
    
        <body>
            <div class="container mt-3">
                <h3>เพิ่มผู้ใช้งาน</h3>
    
                <div class="mt-3">
                    <form class="row g-3" action="add-member-db.php" method="POST">
                        <div class="col-md-4">
                            <label class="form-label">ชื่อผู้ใช้งาน</label>
                            <input type="text" name="uname" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">รหัสผ่าน</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">ระดับผู้ใช้งาน</label>
                            <input type="text" name="level" class="form-control" required>
                        </div>
    
                        <div class="col-md-4">
                            <label class="form-label">ชื่อ</label>
                            <input type="text" name="fname" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">นามสกุล</label>
                            <input type="text" name="lname" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">เลขบัตรประชาชน</label>
                            <input type="text" name="cid" class="form-control" required>
                        </div>
    
                        <div class="col-12">
                            <a href="member-manage.php" type="button" class="btn btn-warning">ย้อนกลับ</a>
                            <button type="submit" name="add_member" class="btn btn-primary">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </body>
    
        <?php include('./include/footer.php') ?>
    </div>
<?php } ?>
