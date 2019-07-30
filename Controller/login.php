<?php

require_once('../Model/Member.php');
require_once('smarty.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if ($_POST["account"] != null && $_POST["password"] != null) {
        $account = $_POST["account"];
        $password = $_POST["password"];
        $password = md5($password);
        $array = [
            'account' => $account,
            'password' => $password
        ];
        
        $user = new Member();
        $row_result = $user->login($array);
        ##錯誤會回傳0
        if ($row_result === NULL) {
            echo json_encode(array(
                'isLogin' => false
            ));
        } else {
            ##設置簡單token判斷是否登入
            $token = rand(1,100000);
            ##將token存入資料庫
            $array = [
                'token' => $token
            ];
            $user = new Member();
            $user->update($array,$row_result['user_id']);
            ##儲存cookie，保存1小時
            setcookie("token", $token, time()+3600);
            setcookie("nickname", $row_result['nickname'], time()+3600);
            setcookie("user_id", $row_result['user_id'], time()+3600);
            echo json_encode(array(
                'isLogin' => true
            ));
        }
    } else {
        echo json_encode(array(
            'isLogin' => false
        ));
    }
} else {
    $smarty->display("login.html"); 
}
