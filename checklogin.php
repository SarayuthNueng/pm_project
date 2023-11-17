<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;

session_start();
include('./db/connect.php');

if (isset($_POST['uname'])) {

  $uname = $_POST['uname'];
  $password = $_POST['pass'];

  $sql = "SELECT uname, password FROM member WHERE uname='$uname'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);

    //password from table member
    $store_password = $row['password'];
    //Verify  Password check password between $password and $hashpassword
    $validPassword = password_verify($password, $store_password);


    if ($validPassword) {

      //create query for create session
      $queryMember = "SELECT * FROM member WHERE uname='$uname'";
      $rsMember = mysqli_query($conn, $queryMember);
      $rowM = mysqli_fetch_array($rsMember);

      $_SESSION["m_id"] = $rowM["m_id"];
      $_SESSION["uname"] = $rowM["uname"];
      $_SESSION["fname"] = $rowM["fname"];
      $_SESSION["lname"] = $rowM["lname"];
      $_SESSION["cid"] = $rowM["cid"];
      $_SESSION["level"] = $rowM["level"];


      if ($_SESSION["level"] == "admin") {

        Header("Location: home.php");
      }
      if ($_SESSION["level"] == "plan") {

        Header("Location: home.php");
      }
      if ($_SESSION["level"] == "member") {

        Header("Location: home.php");
      }
      if ($_SESSION["level"] == "finance") {

        Header("Location: home.php");
      }
    } else {
      echo "<script>";
      echo "alert(\" user หรือ  password ไม่ถูกต้อง\");";
      // echo "window.history.back()";
      echo "window.location='index.php'";
      echo "</script>";
    }
  }
} else {
  Header("Location: index.php");
}
