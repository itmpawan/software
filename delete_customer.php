<?php include "init.php"; //echo 'sparsh@2016'; ?>
<?php if(!isset($_SESSION['id'])): ?>
<?php header("location:index.php"); ?>
<?php endif; ?>
<?php if($_REQUEST['del']){ ?>
<?php $dbObject->queryExecute("DELETE FROM `customers` WHERE `id` = ".$_REQUEST['del'].""); ?>
<?php header("location:customers.php");?>
<?php } ?>