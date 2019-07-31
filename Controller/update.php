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
    $tips = '';
    ##檢查是否有空
    if (!empty($_POST["title"]) && (!empty($_POST["content"]))) {
        ##檢查長度
        $title = $_POST["title"];
        $content = $_POST['content'];
        if (mb_strlen($title, "utf-8") > 15) {
            $tips .= "標題不可超過15字，您的標題為" . mb_strlen($title, "utf-8") . "字";
        } elseif (mb_strlen($content, "utf-8") > 100) {
            $tips .= "內容不可超過100字，您的內容為" . mb_strlen($content, "utf-8") . "字";
        } elseif ($tips === '') {
            ##修改
            $articleId = $_POST['articleId'];
            $title = htmlentities($title, ENT_NOQUOTES, "UTF-8");
            $content = htmlentities($content, ENT_NOQUOTES, "UTF-8");
            $uopdateArray = [
                'title' => $title,
                'content' => $content
            ];
            $checkUpdate = $useArticleTb->update($uopdateArray, $articleId);
            if ($checkUpdate === true) {
                $tips = "文章編輯成功";
                echo json_encode(array(
                    'isUpdate' => true,
                    'tips' => $tips,
                    'articleId' => $articleId
                ));
            }  else {
                $tips = "文章編輯失敗";
                echo json_encode(array(
                    'isUpdate' => true,
                    'tips' => $tips,
                    'articleId' => $articleId
                ));
            }

        }
    } else {
        $tips .= "內容標題不得為空";
    }
} else {
    ##顯示
    ## 文章頁面防呆
    if (($_SERVER['QUERY_STRING'] === "") || (!is_numeric($_GET['id'])) || ($_GET['id'] < 1)) {
        header("Location: index.php");
    } else {
        $articleId = $_GET['id'];
    }
    ##防止有人亂打出現錯誤
    $checkArticle = $useArticleTb->checkArticle($articleId);
    if ($checkArticle === false) {
        header("Location: index.php");
    }

    $articleData = $useArticleTb->getAll($articleId);
    $title = $articleData['title'];
    $content = $articleData['content'];

    if (isset($memberData)) {
        $smarty->assign('nickName', $memberData['nickName']);
    }
    $smarty->assign("articleId", $articleId);
    $smarty->assign("title", $title);
    $smarty->assign("content", $content);
    $smarty->display("update.html");

}
