<?php

require_once('../Model/Member.php');
require_once('smarty.php');

$useMemberTb = new Member();
$token = $_COOKIE['token'];
$useMemberTb->logout($token);

setcookie("token", "", time()-3600);

header("Location: index.php?page=1");
