<?php

require_once("ConnectDb.php");

class Article extends ConnectDb
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
        $sql = "INSERT INTO Article ($field) VALUES ($value)";
        $result = $this->execute_sql($sql);
        $this->close_connect();
        return $result;
    }

    //修改
    public function update($array, $article_id)
    {
        $update = '';
        foreach($array as $key => $value){
            $update .= $key . "='" . $value . "',";
        }
        //-1表示去掉最後一個','
        $update = substr($update, 0, -1);
        //執行
        $sql = "UPDATE Article set $update WHERE article_id = $article_id";
        $result = $this->execute_sql($sql);
        $this->close_connect();
        return $result;
    }

    //刪除
    public function delete($article_id)
    {
        $sql = "DELETE FROM Article WHERE article_id = $article_id";
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
            $select .= $key . "='" . $value . "' AND ";
        }
        $select = substr($select, 0, -5);
        //sql
        $sql = "SELECT * FROM Article WHERE $select";
        $result = $this->execute_sql($sql);
        $row_result = mysqli_fetch_assoc($result);
        $this->close_connect();
        return $row_result;
    }

    /*
     *  index文章顯示
     *  總數
     */
    public function show_article()
    {
        $sql = "SELECT * FROM 
            (SELECT article.title,article.content,member.nickname,article.create_date,article.article_id 
            FROM member LEFT JOIN article ON member.user_id = article.user_id GROUP BY article.article_id ) 
            as newTable WHERE newTable.article_id IS NOT NULL";
        $result = $this->execute_sql($sql);
        $row_result = mysqli_num_rows($result);
        $this->close_connect();
        return $row_result;
    }

    /*
     *  分頁
     */
    public function show_article_page($start,$count)
    {
        $sql = "SELECT * FROM 
            (SELECT article.title,article.content,member.nickname,article.create_date,article.article_id 
            FROM member LEFT JOIN article ON member.user_id = article.user_id GROUP BY article.article_id ) 
            as newTable WHERE newTable.article_id IS NOT NULL LIMIT $start,$count";
        $result = $this->execute_sql($sql);
        $row_result = mysqli_num_rows($result);
        $this->close_connect();
        $array = [
            'result' => $result,
            'row_result' => $row_result
        ];
        return $array;
    }

    //index留言顯示
    public function show_msg($article_id)
    {
        $sql = "SELECT msg.msg_id,msg.user_id,msg.msg_name,msg.msg_content,msg.msg_date,msg.article_id 
            FROM msg LEFT JOIN article ON article.article_id = msg.article_id 
            WHERE msg.article_id = $article_id";
        $result = $this->execute_sql($sql);
        $this->close_connect();
        return $result;
    }
    
}
