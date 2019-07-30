<?php

require_once('../Model/Message.php');
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
    } else {
        setcookie("nickname", "", time()-3600);
        setcookie("token", "", time()-3600);
        setcookie("user_id", "", time()-3600);
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    $article_id = $_POST['article_id'];

    $user = new Article();
    $user->delete($article_id);

    $user = new Message();
    $user->delete_article($article_id);

    $tips = "刪除成功";
    echo json_encode(array(
        'isDelete' => true,
        'tips' => $tips
    ));
}
