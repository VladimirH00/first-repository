<?php


namespace MVC\model;

use PDO;

class PDOWrapper
{
    private $connection = null;

    public function __construct($host, $db, $login, $password)
    {
        try {
            $this->connection = new PDO('mysql:host=' . $host . ';dbname=' . $db, $login, $password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        } catch (PDOException $e) {
            echo "Невозможно установить соединение с базой данный";
        }
    }

    public function query($sql, $params)
    {
        if ($this->connection == null && empty($params))
            return array();
        try {

            $query = $this->connection->prepare($sql);

            $query->execute($params);
            return $query->fetchAll();
        } catch (\PDOException $e) {
            echo "Ошибка выполнения запроса : " . $e->getMessage();
        }
    }

    public function insert($table, $row)
    {
        if (empty($row))
            return 0;
        $sql = "INSERT INTO `{$table}` VALUES (";
        foreach ($row as $item => $value) {
            if (is_string($value))
                $sql .= "'" . $value . "',";
            else
                $sql .= "" . $value . ",";
        }
        $sql = substr($sql, 0, strlen($sql) - 1) . ")";

        $query = $this->connection->prepare($sql);
        try {
            $query->execute();
            return $this->connection->lastInsertId();
        } catch (\PDOException $e) {
            echo "Ошибка выполнения запроса : " . $e->getMessage();
        }
    }

    public function update($table, $values, $before)
    {
        if (empty($values) || empty($before))
            return 0;
        $sql = "UPDATE `{$table}` SET ";
        foreach ($values as $key => $value) {
            $sql .= "{$key} = ";
            if (is_string($value))
                $sql .= "'{$value}',";
            else
                $sql .= "{$value},";
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        $sql .= " WHERE ";
        foreach ($before as $key => $value) {
            $sql .= "{$key} = ";
            if (is_string($value))
                $sql .= "'{$value}'";
            else
                $sql .= "{$value}";
        }

        try {
            return $this->connection->exec($sql);
        } catch (\PDOException $e) {
            echo "Ошибка выполнения запроса : " . $e->getMessage();
        }
    }

    public function delete($table, $params)
    {
        if (empty($params))
            return 1;
        $sql = "DELETE FROM `{$table}` WHERE ";

        foreach ($params as $key => $value) {
            $sql .= "{$key} = ";
            if (is_string($value))
                $sql .= "'{$value}'";
            else
                $sql .= "{$value}";
        }
        try {
           return $this->connection->exec($sql);
        } catch (\PDOException $e) {
            echo "Ошибка выполнения запроса : " . $e->getMessage();
        }

    }
}

?>
