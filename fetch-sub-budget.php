<?php
if (!$_SESSION) {
    Header("Location: index.php");
} else {

    require_once "./db/connect.php";

    $category_id = $_POST["category_id"];

    $result = mysqli_query($conn, "SELECT * FROM project where plan_code = $category_id");
?>

    <option value="<?php echo $row1['project_id'] ?>"><?php echo $row1['project_name'] ?></option>
    <?php while ($row3 = mysqli_fetch_array($result)) { ?>
        <option value="<?php echo $row3["project_id"]; ?>">[ <?php echo $row3["project_id"]; ?> ] <?php echo $row3["project_name"]; ?></option>
    <?php } ?>

<?php } ?>