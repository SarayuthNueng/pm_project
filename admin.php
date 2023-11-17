<?php 
if(!$_SESSION){
Header("Location: index.php");
}else{
include('./project-dashboard.php');
}
?>