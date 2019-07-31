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

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    ## 檢查是否有空
    $tips = "";
    if (!empty($_POST["title"]) && (!empty($_POST["content"]))) {
        ## 檢查長度
        $title = $_POST["title"];
        $content = $_POST["content"];
        if (mb_strlen($title, "utf-8") > 15) {
            $tips .= "標題不可超過15字，您的標題為" . mb_strlen($title, "utf-8") . "字";
        } elseif (mb_strlen($content, "utf-8") > 100) {
            $tips .= "內容不可超過100字，您的內容為" . mb_strlen($content, "utf-8") . "字";
        } elseif ($tips === '') {
            ## 防注入
            $title = htmlentities($title, ENT_NOQUOTES, "UTF-8");
            $content = htmlentities($content, ENT_NOQUOTES, "UTF-8");
            $insertArray = [
                'title' => $title, 
                'content' => $content, 
                'userId' => $nowUserId
            ];
            $isInsert = $useArticleTb->insert($insertArray);
            ## 回傳
            if ($isInsert === true) {
                $tips = "發文成功";
                echo json_encode(array(
                    'isAdd' => true,
                    'tips' => $tips
                ));
                
            } else {
                $tips = "失敗，請重新操作一次";
                echo json_encode(array(
                    'isAdd' => false,
                    'tips' => $tips
                ));
            }
        }
    } else {
        $tips .= "內容標題不得為空";
        echo json_encode(array(
            'isAdd' => false,
            'tips' => $tips
        ));
    }
} else {
    if (isset($memberData)) {
        $smarty->assign('nickName', $memberData['nickName']);
    }
    $smarty->display("add.html"); 
}
