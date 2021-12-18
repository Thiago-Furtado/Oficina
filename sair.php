<?php 
session_start();
unset($_SESSION['chave']);
header("location: index.php")
?>