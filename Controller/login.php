<?php

require_once('../Model/Member.php');
require_once('smarty.php');

$useMemberTb = new Member();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if ($_POST["account"] != null && $_POST["password"] != null) {
        $account = $_POST["account"];
        $password = $_POST["password"];
        $password = md5($password);
        ## 列入帳號密碼
        $array_loginData = [
            'account' => $account,
            'password' => $password
        ];
        $isLogin = $useMemberTb->checkLogin($array_loginData);
        ## 錯誤會回傳0
        if ($isLogin === true) {
            $tips = "帳號密碼錯誤";
            echo json_encode(array(
                'isLogin' => false,
                'tips' => $tips
            ));
        } else {
            ## 設置簡單token判斷是否登入
            $token = rand(1,100000);
            ## 將token存入資料庫
            $useMemberTb->saveToken($token, $array_loginData);
            $tips = "登入成功";
            ## 儲存cookie，保存1小時
            setcookie("token", $token, time()+3600);
            echo json_encode(array(
                'isLogin' => true,
                'tips' => $tips
            ));
        }
    } else {
        $tips = "帳號密碼不得為空";
        echo json_encode(array(
            'isLogin' => false,
            'tips' => $tips
        ));
    }
} else {
    $smarty->display("login.html"); 
}
