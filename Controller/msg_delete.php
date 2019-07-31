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

## 先紀錄要返回的文章ID
$msgId = $_POST['msgId'];
$array = [
    'msgId' => $msgId
];
$messageData = $useMessageTb->getAll($array);
## 再砍掉
$checkDelete = $useMessageTb->delete($msgId);
## 告知使用者刪除有無成功
if ($checkDelete === true) {
    $tips = "刪除成功";
    echo json_encode(array(
        'isDeleteMsg' => true,
        'articleId' => $messageData['articleId'],
        'msgId' => $msgId,
        'tips' => $tips
    ));
} else {
    $tips = "刪除失敗";
    echo json_encode(array(
        'isDeleteMsg' => false,
        'articleId' => $messageData['articleId'],
        'tips' => $tips
    ));
}

