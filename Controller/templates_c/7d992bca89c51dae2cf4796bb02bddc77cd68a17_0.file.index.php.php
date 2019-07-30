<?php
/* Smarty version 3.1.33, created on 2019-07-29 08:07:09
  from 'C:\xampp\htdocs\msg\Controller\index.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3e8d0dc7a423_59179180',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d992bca89c51dae2cf4796bb02bddc77cd68a17' => 
    array (
      0 => 'C:\\xampp\\htdocs\\msg\\Controller\\index.php',
      1 => 1564380334,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d3e8d0dc7a423_59179180 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php

';?>require_once('../Model/Article.php');
require_once('../Model/Member.php');
require_once('smarty.php');

##驗證登入
$array = [
    'token' => $_COOKIE['token'],
    'user_id' => $_COOKIE['user_id'],
    'nickname' => $_COOKIE['nickname']
];

$user = new Member();
$result = $user->checkLogin();

if ($result == true) {
    $smarty->assign('nickname', $_COOKIE['nickname']);
}

$user = new Article();
$result = $user->show_article();

$array_title = $array_content = $array_nickname = 
$array_create_date = $array_article_id = [];

//拆成單一陣列
foreach ($result as $array_single) {
    array_push($array_title, $array_single['title']);
    array_push($array_content, $array_single['content']);
    array_push($array_nickname, $array_single['nickname']);
    array_push($array_create_date, $array_single['create_date']);
    array_push($array_article_id, $array_single['article_id']);
}

$array = [
    "array_title" => $array_title,
    "array_content" => $array_content,
    "array_nickname" => $array_nickname,
    "array_create_date" => $array_create_date,
    "array_article_id" => $array_article_id
];
foreach ($array as $key => $value) {
    $smarty->assign($key, $value);
}

$smarty->display("index.html"); 




<?php }
}
