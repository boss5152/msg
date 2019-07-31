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
        $result = $this->executeSql($sql);
        return ($result === true) ? true : false ;
    }

    //修改
    public function update($array, $articleId)
    {
        $update = '';
        foreach($array as $key => $value){
            $update .= $key . "='" . $value . "',";
        }
        //-1表示去掉最後一個','
        $update = substr($update, 0, -1);
        //執行
        $sql = "UPDATE Article set $update WHERE articleId = $articleId";
        $result = $this->executeSql($sql);
        return $result;
    }

    //刪除
    public function delete($articleId)
    {
        $sql = "DELETE FROM Article WHERE articleId = $articleId";
        $result = $this->executeSql($sql);
        return ($result === true) ? true : false;
    }

    //查詢
    public function getAll($articleId)
    {
        $sql = "SELECT * FROM Article WHERE articleId = $articleId";
        $result = $this->executeSql($sql);
        $row_result = mysqli_fetch_assoc($result);
        return $row_result;
    }

    /**
     * 檢查文章
     */
    //查詢
    public function checkArticle($articleId)
    {
        $sql = "SELECT articleId FROM Article WHERE articleId = $articleId";
        $result = $this->executeSql($sql);
        $row_result = mysqli_num_rows($result);
        return ($row_result === 0) ? false : true;
    }

    /*
     *  index文章顯示
     *  總數
     */
    public function getArticleDataCount()
    {
        $sql = "SELECT * FROM 
            (SELECT article.title,article.content,member.nickName,article.createDate,article.articleId 
            FROM member LEFT JOIN article ON member.userId = article.userId GROUP BY article.articleId ) 
            as newTable WHERE newTable.articleId IS NOT NULL";
        $result = $this->executeSql($sql);
        $row_result = mysqli_num_rows($result);
        return $row_result;
    }

    /*
     *  分頁
     */
    public function showArticlePage($start,$count)
    {
        $sql = "SELECT * FROM 
            (SELECT article.title,article.content,member.nickName,article.createDate,article.articleId 
            FROM member LEFT JOIN article ON member.userId = article.userId GROUP BY article.articleId ) 
            as newTable WHERE newTable.articleId IS NOT NULL LIMIT $start,$count";
        $result = $this->executeSql($sql);
        return $result;
    }

    /*
     * 檢查分頁是否有資料
     */
    public function checkPage($start,$count)
    {
        $sql = "SELECT * FROM 
            (SELECT article.title,article.content,member.nickName,article.createDate,article.articleId 
            FROM member LEFT JOIN article ON member.userId = article.userId GROUP BY article.articleId ) 
            as newTable WHERE newTable.articleId IS NOT NULL LIMIT $start,$count";
        $result = $this->executeSql($sql);
        $row_result = mysqli_num_rows($result);
        return ($row_result === 0) ? false : true;
    }

    //index留言顯示
    public function showMsg($articleId)
    {
        $sql = "SELECT msg.msgId,msg.msgName,msg.userId,msg.msgContent,msg.msgDate,msg.articleId 
            FROM msg LEFT JOIN article ON article.articleId = msg.articleId 
            WHERE msg.articleId = $articleId";
        $result = $this->executeSql($sql);
        return $result;
    }
    
}
