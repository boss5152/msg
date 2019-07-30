<?php

require_once('../Model/Member.php');
require_once('smarty.php');

$array = [
    'token' => "0",
    'user_id' => $_COOKIE['user_id'],
    'nickname' => $_COOKIE['nickname']
];

$user = new Member();
$user->update($array,$_COOKIE['user_id']);

setcookie("nickname", "", time()-3600);
setcookie("token", "", time()-3600);
setcookie("user_id", "", time()-3600);

header("Location: index.php?page=1");
