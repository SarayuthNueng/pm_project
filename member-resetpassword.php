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

    <body>
        <div class="container mt-3">
            <h3>เเก้ไขรหัสผ่าน</h3>

            <div class="mt-3">
                <form class="row g-3" action="member-resetpassword_db.php" method="POST">
                    <div class="col-md-4">
                        <label class="form-label">รหัสผ่านใหม่</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <input type="hidden" name="m_id" class="form-control" value="<?php echo $_GET['m_id']; ?>">

                    <div class="col-12">
                        <a href="member-manage.php" type="button" class="btn btn-warning">ย้อนกลับ</a>
                        <button type="submit" name="edit_password" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </body>

    <?php include('./include/footer.php') ?>
</div>





<?php } ?>
