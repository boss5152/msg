<?php

require_once('../Model/Message.php');
require_once('../Model/Member.php');
require_once('smarty.php');

$useMemberTb = new Member();
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

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $msgContent = $_POST['msgContent'];
    $tips = '';
    if (mb_strlen($msgContent, "utf-8") > 15) {
        $tips .= "內容不可超過15字，您的內容為" . mb_strlen($msgContent, "utf-8") . "字";
    } elseif ($tips === '') {
        ## 修改
        $msgId = $_POST['msgId'];
        $msgContent = $_POST['msgContent'];
        $msgContent = htmlentities($msgContent, ENT_NOQUOTES, "UTF-8");
        $array = [
            'msgContent' => $msgContent
        ];
        $useMessageTb->update($array, $msgId);

        ## 返回留言對應之文章用
        $messageData = $useMessageTb->getAll($array);

        ## 給使用者訊息
        $tips = "留言編輯成功";

        echo json_encode(array(
            'isUpdateMsg' => true,
            'articleId' => $messageData['articleId'],
            'tips' => $tips
        ));
    }

} else {
    ## 顯示
    ## 文章頁面防呆
    if (($_SERVER['QUERY_STRING'] === "") || (!is_numeric($_GET['id'])) || ($_GET['id'] < 1)) {
        header("Location: index.php");
    } else {
        $msgId = $_GET['id'];
    }
    ##防止有人亂打出現錯誤
    $array = [
        'msgId' => $msgId,
    ];
    $messageData = $useMessageTb->getAll($array);
    $checkMsg = $useMessageTb->checkMsg($msgId);
    if ($checkMsg === false) {
        header("Location: index.php");
    }

    $msgContent = $messageData['msgContent'];
    $msgId = $messageData['msgId'];
    $articleId = $messageData['articleId'];

    if (isset($memberData)) {
        $smarty->assign('nickName', $memberData['nickName']);
    }
    $smarty->assign("msgContent", $msgContent);
    $smarty->assign("msgId", $msgId);
    $smarty->assign("articleId", $articleId);
    $smarty->display("msg_update.html"); 
}
