<?php

require_once('../Model/Article.php');
require_once('../Model/Member.php');
require_once('smarty.php');

// ##驗證登入
// if (isset($_COOKIE['token'])) {
//     $token = $_COOKIE['token'];
//     $useMemberDb = new Member();
//     $isCheck = $useMemberDb->checkToken($token);
//     if ($isCheck === true) {
//         $memberData = $useMemberDb->getAll();
//         $memberData['nickName']

//         // $smarty->assign('nickname', $_COOKIE['nickname']);
//     }
// }

$useMemberDb = new Member();
$memberData = $useMemberDb->getAll();
$memberData['nickName'];
exit;

##因ajax關係，須給他page值
if ($_SERVER['QUERY_STRING'] === "") {
    $page = 1;
} else {
    $page = $_GET['page'];
}

## 從start筆開始，往後五筆
$start = ($page - 1) * 5;
$count = 5;

$user = new Article();
$result = $user->show_article_page($start, $count);
## 上面亂打導回首頁page1
if ($result['row_result'] === 0) {
    header("Location: index.php?page=1");
}

$user = new Article();
$row_result = $user->show_article();

## 每五筆一頁，計算
($row_result % 5 === 0) ? ($PageTotals = $row_result / 5) : ($PageTotals = $row_result / 5 + 1);
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
    ##總頁數小於五，就顯示總數分頁
    $firstPage = 1;
    $endPage = $PageTotals;
}

$smarty->assign('firstPage', $firstPage);
$smarty->assign('endPage', $PageTotals);
$smarty->assign('nowPage', $page);
$smarty->assign('arrays', $result['result']);
$smarty->display("index.html"); 
