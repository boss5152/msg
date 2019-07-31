<?php

require_once("ConnectDb.php");

class Message extends ConnectDb
{
    /*
     * 新增
     */
    public function insert($array)
    {
        $field = '';
        $value = '';
        foreach($array as $key => $v){
            //key
            $field .= "" . $key . ",";
            //value
            $value .= "'" . $v . "',";
        }
        //-1表示去掉最後一個','
        $field = substr($field, 0, -1);
        $value = substr($value, 0, -1);
        //執行
        $sql = "INSERT INTO msg ($field) VALUES ($value)";
        $result = $this->executeSql($sql);
        return ($result === true) ? true : false;
    }

    /*
     * 修改
     */
    public function update($array, $msgId)
    {
        $update = '';
        foreach($array as $key => $value){
            $update .= $key . "='" . $value . "',";
        }
        //-1表示去掉最後一個','
        $update = substr($update, 0, -1);
        //執行
        $sql = "UPDATE msg set $update WHERE msgId = $msgId";
        $result = $this->executeSql($sql);
        return ($result === true) ? true : false;
    }

    /*
     * 刪除
     */
    public function delete($msgId)
    {
        $sql = "DELETE FROM msg WHERE msgId = $msgId";
        $result = $this->executeSql($sql);
        return ($result === true) ? true : false;
    }
    /*
     * 文章被刪除時連帶刪除留言文章被刪除時連帶刪除留言 
     */

    public function deleteArticle($articleId)
    {
        $sql = "DELETE FROM msg WHERE articleId = $articleId";
        $result = $this->executeSql($sql);
        return $result;
    }

    /*
     * 查詢
     */
    public function getAll($array)
    {
        $select = '';
        foreach ($array as $key => $value) {
            //key = value
            $select .= $key . "='" . $value . "' and ";
        }
        $select = substr($select, 0, -5);
        //sql
        $sql = "SELECT * FROM msg WHERE $select";
        $result = $this->executeSql($sql);
        $row_result = mysqli_fetch_assoc($result);
        return $row_result;
    }

    /*
     * 留言防呆
     */
    public function checkMsg($msgId){
        $sql = "SELECT * FROM msg WHERE msgId = $msgId";
        $result = $this->executeSql($sql);
        $row_result = mysqli_num_rows($result);
        return ($row_result === 0) ? false : true;
    }
    
}
