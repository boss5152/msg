<?php

require_once('../Model/Member.php');
require_once('smarty.php');

$useMemberTb = new Member();
$tips = '';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    ##檢查是否有空
    if ((!empty($_POST["account"])) && (!empty($_POST["password"])) && (!empty($_POST["nickName"]))) {
        ## 基礎檢查通過
        $nickName = $_POST['nickName'];
        $account = $_POST["account"];
        $password = $_POST['password'];
        ## 檢查是否有特殊字元
        if (preg_match("/^([0-9A-Za-z]+)$/", $account) && preg_match("/^([0-9A-Za-z]+)$/", $password) && preg_match("/^([\x7f-\xff0-9A-Za-z]+)$/", $nickName)) {
            ## 檢查長度
            if (mb_strlen($nickName, "utf-8") > 5) {
                $tips .= "暱稱長度不符。";
            } elseif (strlen($account) > 12 || strlen($account) < 2) {
                $tips .= "帳號長度不符。";
            } elseif (strlen($password) > 12 || strlen($password) < 2) {
                $tips .= "密碼長度不符。";
            } elseif ($tips === '') {
                ## 通過長度驗證，準備進行重複驗證
                ## 加密
                $password = md5($password);
                $registerArray = [
                    'nickName' => $nickName,
                    'account' => $account,
                    'password' => $password
                ];
                ## 檢查暱稱有無重複
                $checkNickName = $useMemberTb->checkNickName($nickName);
                if ($checkNickName === true) {
                    $tips .= "此暱稱已有人使用。";
                }
                ## 檢查帳號有無重複
                $checkAccount = $useMemberTb->checkAccount($account);
                if ($checkAccount === true) {
                    $tips .= "此帳號已有人使用。";
                }
                ##檢查完畢
                if ($tips === "") {
                    $useMemberTb->register($registerArray);
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
