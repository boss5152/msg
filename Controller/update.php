<?php

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
            $article_id = $_POST['article_id'];
            $title = htmlentities($title, ENT_NOQUOTES, "UTF-8");
            $content = htmlentities($content, ENT_NOQUOTES, "UTF-8");

            $array = [
                'title' => $title,
                'content' => $content
            ];

            $user = new Article();
            $user->update($array, $article_id);

            $tips = "文章編輯成功";
            echo json_encode(array(
                'isUpdate' => true,
                'tips' => $tips,
                'article_id' => $article_id
            ));
        }
    } else {
        $tips .= "內容標題不得為空";
    }
} else {
    ##顯示
    $article_id = $_GET['id'];
    $user_id = $_COOKIE['user_id'];

    $user = new Article();
    $array = [
        'article_id' => $article_id,
        'user_id' => $user_id
    ];

    ##----
    $row_result = $user->getAll($array);

    ##防止有人亂打出現錯誤
    if ($row_result === NULL) {
        header("Location: index.php");
    }

    $title = $row_result['title'];
    $content = $row_result['content'];

    $smarty->assign("article_id", $article_id);
    $smarty->assign("title", $title);
    $smarty->assign("content", $content);
    $smarty->display("update.html");

}
