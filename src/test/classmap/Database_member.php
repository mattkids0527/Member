<?php
namespace wayne;

use PDO;
use PDOException;

class Database_member
{
    private $dsn = "mysql:host=127.0.0.1;dbname=php_project1";
    private $username = "root";
    private $password = "";

    private $conn;

    function __construct()
    {
        $this->connection();
    }

    // 02/01編譯
    function Insert($table, $field_value)
    {
        $str_key = "";
        $str_value = "";
        foreach ($field_value as $key => $value) {
            $str_key .= $key . ",";
            $str_value .= "'" . $value . "',";
        }
        try {
            $sql = "INSERT INTO $table (" . rtrim($str_key, ",") . ") VALUES (" . rtrim($str_value, ",") . ")";
            $this->conn->exec($sql);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    
    function Insert_single($table, $column,$value)
    {
        try {
            $sql = "INSERT INTO $table ($column) VALUES ('$value') ";
            $this->conn->exec($sql);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //
    function Read($table,$field,$col,bool $id=false)
    {

        try {
            if($id==true){
                $sql = $this->conn->prepare("SELECT ID FROM `$table` WHERE `$field`='$col'");
            }else{
                $sql = $this->conn->prepare("SELECT * FROM $table WHERE `$field`='$col' ");
            }
            //$sql = $this->conn->prepare("SELECT * FROM $table WHERE `$field`='$col' ");
            $sql->execute();
            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function Update($table,$userName,$userPassword)
    {
        try {
            
            $sql = $this->conn->prepare("UPDATE $table SET userPassword='$userPassword' WHERE userName='$userName' ");
            $sql->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }
    function Delete($id)
    {
        try {
            $sql = $this->conn->prepare("DELETE FROM member WHERE ID='$id' ");
            $sql->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function connection()
    {
        try {
            $this->conn = new PDO($this->dsn, $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'));
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function closeconn()
    {
        $this->conn = null;
    }

    function createTable()
    {
        $sql = "
            CREATE TABLE test_users (
                `account` varchar(20) NOT NULL DEFAULT '' COMMENT '帳號',
                `password` varchar(256) NOT NULL DEFAULT '' COMMENT '密碼',
                `db_insert_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '寫入時間',
                `db_update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間',
                PRIMARY KEY (account)
            )
        ";
        try {
            $this->conn->exec($sql);
        } catch (PDOException $e) {
            echo "PDOException :" . $e->getMessage();
            echo "\n";
        }
    }
    function truncate($sql)
    {
        try {
            $this->conn->exec($sql);
        } catch (PDOException $e) {
            echo "PDOException :" . $e->getMessage();
        }
    }
}


?>