<?php

require_once('../Model/Article.php');
require_once('../Model/Member.php');
require_once('smarty.php');

##驗證登入
if (isset($_COOKIE['token'])) {

    $array = [
        'token' => $_COOKIE['token'],
        'user_id' => $_COOKIE['user_id'],
        'nickname' => $_COOKIE['nickname']
    ];
    
    $user = new Member();
    $result = $user->check($array);
    if ($result === 1) {
        $smarty->assign('nickname', $_COOKIE['nickname']);
    }
}

##顯示文章
$article_id = $_GET['id'];

$user = new Article();
$array = [
    'article_id' => $article_id
];

$row_result = $user->getAll($array);

##防止有人亂打出現錯誤
if ($row_result === NULL) {
    header("Location: index.php");
}

$smarty->assign('array_article', $row_result);

##留言部分
$user = new Article();
$result = $user->show_msg($article_id);

$smarty->assign('arrays_msg',$result);

##user_id，給留言的修改刪除用
if (isset($_COOKIE['user_id'])) {
    $array = [
        "user_id" => $_COOKIE['user_id'],
        "nickname" => $_COOKIE['nickname'],
        "article_id" => $article_id
    ];

    foreach ($array as $k => $v) {
        $smarty->assign($k, $v);
    }
}

$smarty->display("article.html"); 
