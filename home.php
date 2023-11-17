<?php include('./include/head.php') ?>
<?php
session_start();
?>

<?php
if (!$_SESSION['m_id']) {
    Header("Location: index.php");
} else { ?>
    <?php if ($_SESSION['level'] == 'member') { ?>

        <?php include('./member.php'); ?>

    <?php } else if ($_SESSION['level'] == 'admin') { ?>

        <?php include('./admin.php'); ?>


    <?php } else if ($_SESSION['level'] == 'plan') { ?>

        <?php include('./plan.php'); ?>

    <?php } else if ($_SESSION['level'] == 'finance') { ?>

        <?php include('./finance.php'); ?>

    <?php }  ?>
<?php } ?>