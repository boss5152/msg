<?php

require_once('../Model/Message.php');
require_once('../Model/Article.php');
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
        ##取資料用於顯示meun暱稱
        $memberData = $useMemberTb->getAll($token);
        $nowUserId = $memberData['userId'];
    } else {
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $articleId = $_POST["articleId"];
    $checkDelete = $useArticleTb->delete($articleId);
    if ($checkDelete === true) {
        $useMessageTb->deleteArticle($articleId);
        $tips = "刪除成功";
        echo json_encode(array(
            'isDelete' => true,
            'tips' => $tips
        ));
    } else {
        $tips = "刪除失敗";
        echo json_encode(array(
            'isDelete' => false,
            'tips' => $tips
        ));
    }

}
