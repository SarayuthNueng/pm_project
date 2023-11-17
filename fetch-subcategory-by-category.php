<?php


require_once "./db/connect.php";

$category_id = $_POST["category_id"];

$result = mysqli_query($conn, "SELECT * FROM project where plan_code = $category_id");
?>

<option value="">กรุณาเลือกกิจกรรม</option>
<?php while ($row = mysqli_fetch_array($result)) { ?>
    <option value="<?php echo $row["project_id"]; ?>">[ <?php echo $row["project_id"]; ?> ] <?php echo $row["project_name"]; ?></option>
<?php } ?>
