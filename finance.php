<?php session_start(); ?>
<?php if (!$_SESSION) {
    Header("Location:home.php");
} else { ?>
    
    <?php include('./project-dashboard.php') ?>

<?php } ?>