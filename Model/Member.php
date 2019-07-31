<?php

require_once("ConnectDb.php");

class Member extends ConnectDb
{
    /*
     * 註冊
     */
    public function register($array)
    {
        $field = '';
        $value = '';
        foreach ($array as $key => $v) {
            //key
            $field .= $key . ",";
            //value
            $value .= "'" . $v . "',";
        }
        //-1表示去掉最後一個','
        $field = substr($field, 0, -1);
        $value = substr($value, 0, -1);
        //執行
        $sql = "INSERT INTO Member ($field) VALUES ($value)";
        $result = $this->executeSql($sql);
        return $result;
    }

    /*
     * 檢查申請的暱稱有無重複
     */
    public function checkNickName($nickName)
    {
        $sql = "SELECT userId FROM Member WHERE nickName = " . $nickName;
        $result = $this->executeSql($sql);
        $row_result = mysqli_num_rows($result);
        return ($row_result === 1) ? true : false;
    }

    /*
     * 檢查申請的帳號有無重複
     */
    public function checkAccount($account)
    {
        $sql = "SELECT userId FROM Member WHERE account = " . $account;
        $result = $this->executeSql($sql);
        $row_result = mysqli_num_rows($result);
        return ($row_result === 1) ? true : false;
    }

    /*
     * 檢查token是否合法
     */
    public function checkToken($token)
    {
        $sql = "SELECT userId FROM Member WHERE token = " . $token;
        $result = $this->executeSql($sql);
        $row_result = mysqli_num_rows($result);
        return ($row_result === 1) ? true : false;
    }

    /*
     * 取資料
     * 用於顯示於html讓使用者知道自己名稱
     * 用於登入時給資料讓token存進對應user
     */
    public function getAll($token){
        $sql = "SELECT * FROM Member WHERE token = " . $token;
        $result = $this->executeSql($sql);
        $row_result = mysqli_fetch_assoc($result);
        return $row_result;
    }
    
    /*
     * 檢查登入
     */
    public function checkLogin($array){
        $check = '';
        foreach ($array as $key => $value) {
            $check .= $key . "='" . $value . "' AND ";
        }
        $check = substr($check, 0, -5);
        $sql = "SELECT userId FROM Member WHERE $check";
        $result = $this->executeSql($sql);
        $row_result = mysqli_num_rows($result);
        return ($row_result === 0) ? true : false ;
    }

    /*
     * 存token
     */
    public function saveToken($token, $array)
    {
        $update = '';
        foreach($array as $key => $value){
            $update .= $key . "='" . $value . "' AND ";
        }
        $update = substr($update, 0, -5);
        //執行
        $sql = "UPDATE member set token = $token WHERE $update";
        $result = $this->executeSql($sql);
        return $result;
    }

    /**
     * 登出
     */
    public function logout($token){
        $sql = "UPDATE member set token = 0 WHERE token = $token";
        $result = $this->executeSql($sql);
        return $result;
    }
}
