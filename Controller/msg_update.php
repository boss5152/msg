<?php

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

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $msg_content = $_POST['msg_content'];
    $tips = '';
    if (mb_strlen($msg_content, "utf-8") > 15) {
        $tips .= "內容不可超過15字，您的內容為" . mb_strlen($msg_content, "utf-8") . "字";
    } elseif ($tips === '') {
        ##修改
        $msg_id = $_POST['msg_id'];
        $msg_content = $_POST['msg_content'];
        $msg_content = htmlentities($msg_content, ENT_NOQUOTES, "UTF-8");

        $array = [
            'msg_content' => $msg_content
        ];

        $user = new Message();
        $user->update($array, $msg_id);

        ##返回留言對應之文章用
        $user = new Message();
        $row_result = $user->getAll($array);

        ##給使用者訊息
        $tips = "留言編輯成功";

        echo json_encode(array(
            'isUpdateMsg' => true,
            'article_id' => $row_result['article_id'],
            'tips' => $tips
        ));
    }

} else {
    ##顯示
    $msg_id = $_GET['id'];
    $user_id = $_COOKIE['user_id'];

    $array = [
        'msg_id' => $msg_id,
        'user_id' => $user_id
    ];
    
    $user = new Message();
    $row_result = $user->getAll($array);

     ##防止有人亂打出現錯誤
     if ($row_result === NULL) {
        header("Location: index.php");
    }

    $msg_content = $row_result['msg_content'];
    $msg_id = $row_result['msg_id'];
    $article_id = $row_result['article_id'];

    $smarty->assign("msg_content", $msg_content);
    $smarty->assign("msg_id", $msg_id);
    $smarty->assign("article_id", $row_result['article_id']);
    $smarty->display("msg_update.html"); 

}
