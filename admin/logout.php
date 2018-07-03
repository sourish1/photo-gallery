<?php include "includes/admin_header.php"; ?>

<?php require_once("includes/init.php"); ?>

<?php

$session->logout();
redirect("login.php");

 ?>

 <?php include "includes/admin_footer.php"; ?>
