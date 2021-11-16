<?php
require_once "../config.php";
$db = Config::getIntance();

session_start();
if ($_SESSION['user'] != 'admin')exit();

$rand = rand(1, 9999999);
$key = md5($rand);
$db->mSet("luo2888_config", "value='$key'", "where name='randkey'");
echo '更新成功！';

?>