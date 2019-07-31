<?php

require_once('../Model/Article.php');
require_once('../Model/Message.php');
require_once('../Model/Member.php');
require_once('smarty.php');

$useMemberTb = new Member();
$useArticleTb = new Article();
$useMessageTb = new Message();

## 驗證登入
if (isset($_COOKIE['token'])) {
    $token = $_COOKIE['token'];
    $isCheck = $useMemberTb->checkToken($token);
    if ($isCheck === true) {
        ## 取資料用於顯示meun暱稱
        $memberData = $useMemberTb->getAll($token);
        $nowUserId = $memberData['userId'];
    } else {
        ## 檢查不正確，強制登出
        header("Location: logout.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}

$tips = "";
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $msgContent = $_POST['msgContent'];
    if (mb_strlen($msgContent, "utf-8") > 15) {
        $tips .= "內容不可超過15字，您的內容為" . mb_strlen($msgContent, "utf-8") . "字";
    } elseif ($tips === '') {
        $msgContent = htmlentities($msgContent, ENT_NOQUOTES, "UTF-8");
        $articleId = $_POST['articleId'];
        $array = [
            'articleId' => $articleId,
            'msgName' => $memberData['nickName'],
            'msgContent' => $msgContent,
            'userId' => $nowUserId
        ];
        $checkInsert = $useMessageTb->insert($array);
        ## 判斷新增是否成功，並告知使用者
        if ($checkInsert === true) {
            $tips = "新增留言成功";
            echo json_encode(array(
                'isAddMsg' => true,
                'tips' => $tips,
                'articleId' => $articleId
            ));
        } else {
            $tips = "新增留言失敗";
            echo json_encode(array(
                'isAddMsg' => false,
                'tips' => $tips,
                'articleId' => $articleId
            ));
        }
    }
} else {
    ## 防呆
    ## 文章頁面防呆
    if (($_SERVER['QUERY_STRING'] === "") || (!is_numeric($_GET['id'])) || ($_GET['id'] < 1)) {
        header("Location: index.php");
    } else {
        $articleId = $_GET['id'];
    }
    $checkArticle = $useArticleTb->checkArticle($articleId);
    ## 防止有人亂打出現錯誤
    if ($checkArticle === false) {
        header("Location: index.php");
    }
    $array = [
        'articleId' => $articleId
    ];
    
    if (isset($memberData)) {
        $smarty->assign('nickName', $memberData['nickName']);
    }
    $smarty->assign("articleId", $articleId);
    $smarty->display("msg_add.html");
}
