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
    ##檢查是否有空
    $tips = "";
    if (!empty($_POST["title"]) && (!empty($_POST["content"]))) {
        ##檢查長度
        $title = $_POST["title"];
        $content = $_POST["content"];
        if (mb_strlen($title, "utf-8") > 15) {
            $tips .= "標題不可超過15字，您的標題為" . mb_strlen($title, "utf-8") . "字";
        } elseif (mb_strlen($content, "utf-8") > 100) {
            $tips .= "內容不可超過100字，您的內容為" . mb_strlen($content, "utf-8") . "字";
        } elseif ($tips === '') {
            ##防注入
            $title = htmlentities($title, ENT_NOQUOTES, "UTF-8");
            $content = htmlentities($content, ENT_NOQUOTES, "UTF-8");
            ##把ID裝入
            $user_id = $_COOKIE['user_id'];

            $array = [
                'title' => $title, 
                'content' => $content, 
                'user_id' => $user_id
            ];
            
            $user = new Article();
            $result = $user->insert($array);
            
            ##回傳
            if ($result === true) {
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
    $smarty->display("add.html"); 
}
