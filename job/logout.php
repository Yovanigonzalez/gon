<?php 
session_start();
if($_SESSION['user']){	
	session_destroy();
	header("location:../index");
}
else{
	header("location:../index");
}
?>