<?php

require_once('../Model/Member.php');
require_once('smarty.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    ##檢查是否有空
    if ((!empty($_POST["account"])) && (!empty($_POST["password"])) && (!empty($_POST["nickname"]))) {
        ##基礎檢查通過
        $nickname = $_POST['nickname'];
        $account = $_POST["account"];
        $password = $_POST['password'];
        ##檢查是否有特殊字元
        if (preg_match("/^([0-9A-Za-z]+)$/", $account) && preg_match("/^([0-9A-Za-z]+)$/", $password) && preg_match("/^([\x7f-\xff0-9A-Za-z]+)$/", $nickname)) {
            ##檢查長度
            $tips = '';
            if (mb_strlen($nickname, "utf-8") > 5) {
                $tips .= "暱稱長度不符。";
            } elseif (strlen($account) > 12 || strlen($account) < 2) {
                $tips .= "帳號長度不符。";
            } elseif (strlen($password) > 12 || strlen($password) < 2) {
                $tips .= "密碼長度不符。";
            } elseif ($tips === '') {
                ##通過長度驗證，準備進行重複驗證
                ##加密
                $password = md5($password);
                $array = [
                    'nickname' => $nickname,
                    'account' => $account,
                    'password' => $password
                ];
                ##檢查重複
                foreach ($array as $key => $value) {
                    $user = new Member();
                    $arrayCheck = [
                        $key => $value
                    ];
                    $row_result = $user->check($arrayCheck);
                    if ($row_result > 0) {
                        ##有重複，看是哪個重複，給使用者知道
                        switch ($key) {
                            case 'nickname' :
                                $tips .= "此暱稱已有人使用。";
                                break;
                            case 'account' :
                                $tips .= "此帳號已有人使用。";
                                break;
                            case 'password' :
                                $tips .= "此密碼已有人使用。";
                                break;
                        }
                    }
                }
                ##檢查完畢
                if ($tips === "") {
                    $user = new Member();
                    $user->register($array);
                    $tips = "註冊成功，請登入。";
                    echo json_encode(array(
                        'isRegister' => true,
                        'msg' => $tips
                    ));
                } else {
                    echo json_encode(array(
                        'isRegister' => false,
                        'errorMsg' => $tips
                    ));
                }
            }
        } else {
            $tips .= "不得有特殊字元。";
        }
    } else {
        $tips .= "不得為空。" ;
    }
} else {
    ##除了註冊成功以外一律導向原註冊頁面並跳錯誤訊息
    $smarty->display("register.html"); 
}
