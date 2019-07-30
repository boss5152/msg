<?php

class ConnectDb 
{
    private $mysqli;
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPassword = "";
    private $dbName = "message";

    function __construct()
    {
        $this->mysqli = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);
        if ($this->mysqli->connect_error) {
            die("連線失敗" . $this->mysqli->connect_error);
        }
        mysqli_query($this->mysqli, "SET NAMES 'utf8'");  
    }

    //執行sql語句
    public function executeSql($sql) 
    {
        $result = mysqli_query($this->mysqli,$sql);
        return $result;
    }

    //關閉連線
    public function closeConnect() 
    {
        if (!empty($this->mysqli)) {
            $this->mysqli->close();
        }
    }

}
