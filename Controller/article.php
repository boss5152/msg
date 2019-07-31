<?php

require_once('../Model/Article.php');
require_once('../Model/Member.php');
require_once('smarty.php');

$useArticleTb = new Article();
$useMemberTb = new Member();

## 驗證登入
if (isset($_COOKIE['token'])) {
    $token = $_COOKIE['token'];
    $isCheck = $useMemberTb->checkToken($token);
    if ($isCheck === true) {
        ##取資料用於顯示meun暱稱
        $memberData = $useMemberTb->getAll($token);
    }
}

## 文章頁面防呆
if (($_SERVER['QUERY_STRING'] === "") || (!is_numeric($_GET['id'])) || ($_GET['id'] < 1)) {
    header("Location: index.php");
} else {
    $articleId = $_GET['id'];
}

$articleId = $_GET['id'];
$checkArticle = $useArticleTb->checkArticle($articleId);
##防止有人亂打出現錯誤
if ($checkArticle === false) {
    header("Location: index.php");
}
## 取得文章資料
$articleData = $useArticleTb->getAll($articleId);

## 取得留言(物件)
$msgDataObj = $useArticleTb->showMsg($articleId);

if (isset($memberData)) {
    $smarty->assign('nickName', $memberData['nickName']);
}
$smarty->assign('nowUserId', $memberData['userId']);
$smarty->assign('msgDataObj',$msgDataObj);
$smarty->assign('articleData', $articleData);
$smarty->display("article.html"); 
