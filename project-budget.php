<?php
session_start();
include('./db/connect.php');
?>
<?php if (!$_SESSION) {
    Header("Location: home.php");
} else { ?>
    <?php include('./include/head.php') ?>
    <?php include('./include/sidebar.php') ?>
    <!--  Header Start -->
    <?php include('./include/header.php') ?>
    <!--  Header End -->

<?php } ?>
<!-- <link rel="stylesheet" href="./assets/css/dropdown.style.css" /> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<?php
//   date,time
$currentDate = date('Y-m-d');
// echo $currentDate;
date_default_timezone_set("Asia/Bangkok");
$Time = date('h:i:s');
$currentTime = date('h:i:s', strtotime($Time));
$sub_created = date('Y-m-d h:i:s', strtotime($Time));
// echo $newTime;
// exit;
?>
<div class="container-fluid">
    <?php if (!$_SESSION) {
        Header("Location: home.php");
    } else { ?>


        <body>
            <div class="container mt-4">
            <h2>เบิกงบโครงการ</h2>
                <div class="mt-3">
                    <form class="row g-3" action="project-budget_db.php" method="POST">
                        <div class="col-md-6">
                            <label class="form-label">ชื่อรายการเบิก</label>
                            <input type="text" name="sub_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">จำนวนเงิน</label>
                            <input type="float" name="sub_budget" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="CATEGORY-DROPDOWN">โครงการ</label>
                            <select name="sub_p_plan_id" class="form-control" id="category-dropdown">
                                <option value="">กรุณาเลือกโครงการ</option>
                                <?php
                                require_once "./db/connect.php";

                                $result = mysqli_query($conn, "SELECT * FROM project 
                                    WHERE plan_code IS NOT NULL AND plan_code != ' ' 
                                    GROUP BY plan_code ORDER BY project_id ASC");

                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <option value="<?php echo $row['plan_code']; ?>">[ <?php echo $row["plan_code"]; ?> ] <?php echo $row["project_plan"]; ?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="SUBCATEGORY">กิจกรรม</label>
                            <select name="sub_p_name_id" class="form-control" id="sub-category-dropdown">

                            </select>
                        </div>

                        <input type="hidden" name="member_id" class="form-control" value="<?php echo $_SESSION['m_id'] ?>">
                        <input type="hidden" name="sub_date" class="form-control" value="<?php echo $currentDate ?>">
                        <input type="hidden" name="sub_time" class="form-control" value="<?php echo $currentTime ?>">
                        <input type="hidden" name="sub_created" class="form-control" value="<?php echo $sub_created ?>">

                        <div class="col-12">
                            <!-- <a href="home.php" type="submit" class="btn btn-warning">กลับ</a> -->
                            <button type="submit" name="project_budget" class="btn btn-success">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </body>
    <?php } ?>
</div>
<?php include('./include/footer.php') ?>

<script>
    $(document).ready(function() {
        $('#category-dropdown').on('change', function() {
            var category_id = this.value;
            $.ajax({
                url: "fetch-subcategory-by-category.php",
                type: "POST",
                data: {
                    category_id: category_id
                },
                cache: false,
                success: function(result) {
                    $("#sub-category-dropdown").html(result);
                }
            });


        });
    });
</script>
<!-- <script src="./assets/js/drowmdown.js"></script> -->