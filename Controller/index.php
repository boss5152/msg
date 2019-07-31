<?php

require_once('../Model/Article.php');
require_once('../Model/Member.php');
require_once('smarty.php');

$useMemberTb = new Member();
$useArticleTb = new Article();

## 驗證登入
if (isset($_COOKIE['token'])) {
    $token = $_COOKIE['token'];
    $isCheck = $useMemberTb->checkToken($token);
    if ($isCheck === true) {
        ##取資料用於顯示meun暱稱
        $memberData = $useMemberTb->getAll($token);
    }
}

##因ajax關係，須給他page值，順便防呆
if ($_SERVER['QUERY_STRING'] === "") {
    $page = 1;
} elseif ((!is_numeric($_GET['page'])) || ($_GET['page'] < 1)) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

## 從start筆開始，往後五筆
$start = ($page - 1) * 5;
$count = 5;

## 檢查該分頁是否有資料
$checkPage = $useArticleTb->checkPage($start, $count);
## 沒有則導回首頁page1
if ($checkPage === false) {
    $page = 1;
}

## 取得主資料有幾筆
$articleDataCount = $useArticleTb->getArticleDataCount();

## 每五筆一頁，計算
($articleDataCount % 5 === 0) ? ($PageTotals = $articleDataCount / 5) : ($PageTotals = $articleDataCount / 5 + 1);
$PageTotals = (int)$PageTotals;

## 最多只會出現五個分頁
## 如果總頁數大於5，顯示當前+-2的分頁面
if ($PageTotals > 5) {
    ## 如果當前頁面小於三，則出現12345
    if ($page < 3) {
        $firstPage = 1;
        $endPage = 5;
    } else {
        ## 如果當前頁面大於三，且與總頁面之差小於2
        if (($PageTotals - $page) < 3) {
            $firstPage = $page - 2;
            $endPage = $PageTotals;
        } else {
            ## 若無，則正常顯示+-2分頁
            $firstPage = $page - 2;
            $endPage = $page + 2;
        }
    }
} else {
    ## 總頁數小於五，就顯示總數分頁
    $firstPage = 1;
    $endPage = $PageTotals;
}
## 查找該分頁資料
$articleObj = $useArticleTb->showArticlePage($start, $count);
## smarty部分
if (isset($memberData)) {
    $smarty->assign('nickName', $memberData['nickName']);
}
$smarty->assign('firstPage', $firstPage);
$smarty->assign('endPage', $PageTotals);
$smarty->assign('nowPage', $page);
$smarty->assign('articleObj', $articleObj);
$smarty->display("index.html"); 
