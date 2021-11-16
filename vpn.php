<?php
include_once "config.php";
$db = Config::GetIntance();

$id=$_GET['id'];
$db->mSet("luo2888_users", "vpn=vpn+1", "where name=$id");
?>