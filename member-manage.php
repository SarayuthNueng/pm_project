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
        <div class="container">
            <div class="row p-3">
                <!-- <h2>ผู้ใช้งานทั้งหมด</h2> -->
                <div class="row">
                    <div class="col-md-12"><a type="button" class="btn btn-primary" href="add-member.php">+เพิ่มผู้ใช้งาน</a></div>
                </div>

                <!-- Data list table -->
                <table class="mt-3 table table-striped table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>ชื่อผู้ใช้งาน</th>
                            <th>แก้ไขรหัสผ่าน</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>ระดับผู้ใช้งาน</th>
                            <th>เลขบัตรประชาชน</th>
                            <th>แก้ไข</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Get member rows 
                        $result = $conn->query("SELECT *, CONCAT(fname,' ',lname) as fullname FROM member ORDER BY m_id ASC");
                        if ($result->num_rows > 0) {
                            $i = 0;
                            while ($row = $result->fetch_assoc()) {
                                $i++;
                        ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['uname']; ?></td>
                                    <td><a style="text-decoration: none;" href="member-resetpassword.php?m_id=<?php echo $row['m_id'] ?>">แก้ไขรหัสผ่าน</a></td>
                                    <td><?php echo $row['fullname']; ?></td>
                                    <td><?php echo $row['level']; ?></td>
                                    <td><?php echo $row['cid']; ?></td>
                                    <td class="text-center"><a style="text-decoration: none;" href="member-edit.php?m_id=<?php echo $row['m_id'] ?>"><i class="fa-regular fa-pen-to-square"></i></a></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="7">ไม่พบข้อมูล...</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>

    <?php include('./include/footer.php') ?>
</div>
<?php } ?>
