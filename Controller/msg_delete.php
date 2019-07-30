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

$msg_id = $_POST['msg_id'];

##先紀錄要返回的文章ID
$user = new Message();

$array = [
    'msg_id' => $msg_id
];

$row_result = $user->getAll($array);

##再砍掉
$user = new Message();
$user->delete($msg_id);

$tips = "刪除成功";
echo json_encode(array(
    'isDeleteMsg' => true,
    'article_id' => $row_result['article_id'],
    'msg_id' => $msg_id,
    'tips' => $tips
));
