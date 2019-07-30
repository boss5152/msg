<?php

require_once("ConnectDb.php");

class Message extends ConnectDb
{
    //新增
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
        $result = $this->execute_sql($sql);
        $this->close_connect();
        return $result;
    }

    //修改
    public function update($array, $msg_id)
    {
        $update = '';
        foreach($array as $key => $value){
            $update .= $key . "='" . $value . "',";
        }
        //-1表示去掉最後一個','
        $update = substr($update, 0, -1);
        //執行
        $sql = "UPDATE msg set $update WHERE msg_id = $msg_id";
        $result = $this->execute_sql($sql);
        $this->close_connect();
        return $result;
    }

    //刪除
    public function delete($msg_id)
    {
        $sql = "DELETE FROM msg WHERE msg_id = $msg_id";
        $result = $this->execute_sql($sql);
        $this->close_connect();
        return $result;
    }

    //文章被刪除時連帶刪除留言
    public function delete_article($article_id)
    {
        $sql = "DELETE FROM msg WHERE article_id = $article_id";
        $result = $this->execute_sql($sql);
        $this->close_connect();
        return $result;
    }

    //查詢
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
        $result = $this->execute_sql($sql);
        $row_result = mysqli_fetch_assoc($result);
        $this->close_connect();
        return $row_result;
    }
    
}
