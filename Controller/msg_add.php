<?php

require_once('../Model/Article.php');
require_once('../Model/Message.php');
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

$tips = "";
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $msg_content = $_POST['msg_content'];
    if (mb_strlen($msg_content, "utf-8") > 15) {
        $tips .= "內容不可超過15字，您的內容為" . mb_strlen($msg_content, "utf-8") . "字";
    } elseif ($tips === '') {
        $user_id = $_COOKIE['user_id'];
        $msg_content = htmlentities($msg_content, ENT_NOQUOTES, "UTF-8");
        $article_id = $_POST['article_id'];
        $msg_name = $_COOKIE['nickname'];
    
        $array = [
            'article_id' => $article_id,
            'msg_name' => $msg_name,
            'msg_content' => $msg_content,
            'user_id' => $user_id,
        ];
    
        $user = new Message();
        $user->insert($array);
        $tips = "新增留言成功";
        echo json_encode(array(
            'isAddMsg' => true,
            'tips' => $tips,
            'article_id' => $article_id
        ));
    }
} else {

    $article_id = $_GET['id'];

    $array = [
        'article_id' => $article_id
    ];

    ##----
    $user = new Article();
    $row_result = $user->getAll($array);

    ## 防止有人亂打出現錯誤
    if ($row_result === NULL) {
        header("Location: index.php");
    }
    ## 弄成function
    
    $smarty->assign("article_id", $article_id);
    $smarty->display("msg_add.html");
}
