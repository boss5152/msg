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
     * 檢查申請的帳號有無重複
     */
    public function checkAccount($account)
    {
        $sql = "SELECT user_id FROM Member WHERE $account";
        $result = $this->executeSql($sql);
        $row_result = mysqli_num_rows($result);
        return ($row_result === 1) ? true : false;
    }

    /*
     * 檢查申請的暱稱有無重複
     */
    public function checkNickName($nickName)
    {
        $sql = "SELECT user_id FROM Member WHERE $nickName";
        $result = $this->executeSql($sql);
        $row_result = mysqli_num_rows($result);
        return ($row_result === 1) ? true : false;
    }

    /*
     * 檢查token是否合法
     */
    public function checkToken($token)
    {
        $sql = "SELECT user_id FROM Member WHERE token = " . $token;
        $result = $this->executeSql($sql);
        $row_result = mysqli_num_rows($result);
        return ($row_result === 1) ? true : false;
    }

    /*
     * 取資料
     * 用於顯示於html讓使用者知道自己名稱
     */
    public function getAll($token){
        $sql = "SELECT * FROM Member WHERE token = " . $token;
        $result = $this->executeSql($sql);
        return $result;
    }
    
    /*
     * 登入
     */
    public function login($array)
    {
        $field = '';
        $value = '';
        foreach ($array as $key => $v) {
            $field .= $key . ",";
            $value .= "'" . $v . "',";
        }
        $field = substr($field, 0, -1);
        $value = substr($value, 0, -1);
        $sql = "SELECT * FROM Member WHERE ($field) = ($value)";
        //回傳結果
        $result = $this->executeSql($sql);
        //判斷
        $row_result = mysqli_fetch_assoc($result);
        return $row_result;
    }

    /*
     * 修改
     */
    public function update($array, $user_id)
    {
        $update = '';
        foreach($array as $key => $value){
            $update .= $key . "='" . $value . "',";
        }
        //-1表示去掉最後一個','
        $update = substr($update, 0, -1);
        //執行
        $sql = "UPDATE member set $update WHERE user_id = $user_id";
        $result = $this->executeSql($sql);
        return $result;
    }
}
