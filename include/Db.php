<?php
class Db
{

    private static $connection;

    private static $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false,
    );

    public static function connect($host, $database, $user, $password)
    {
        if (!isset(self::$connection)) {
            $dsn = "mysql:host=$host;dbname=$database";
            self::$connection = new PDO($dsn, $user, $password, self::$options);
        }
    }

    private static function executeStatement($params)
    {
        $query = array_shift($params);
        $statement = self::$connection->prepare($query);
        $statement->execute($params);
        return $statement;
    }

    public static function query($query) {
        $statement = self::executeStatement(func_get_args());
        return $statement->rowCount();
    }

    public static function querySingle($query) {
        $statement = self::executeStatement(func_get_args());
        $data = $statement->fetch();
        return $data[0];
    }

    public static function queryOne($query) {
        $statement = self::executeStatement(func_get_args());
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function queryAll($query) {
        $statement = self::executeStatement(func_get_args());
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insert($table, $data) {
        $keys = array_keys($data);
        self::checkIdentifiers(array($table) + $keys);
        $query = "
			INSERT INTO `$table` (`" . implode('`, `', $keys) . "`)
			VALUES (" . str_repeat('?,', count($data) - 1) . "?)
		";
        $params = array_merge(array($query), array_values($data));
        $statement = self::executeStatement($params);
        return $statement->rowCount();
    }

    public static function update($table, $data, $condition) {
        $keys = array_keys($data);
        self::checkIdentifiers(array($table) + $keys);
        $query = "
			UPDATE `$table` SET `".
            implode('` = ?, `', array_keys($data)) . "` = ?
			$condition
		";
        $params = array_merge(array($query), array_values($data), array_slice(func_get_args(), 3));
        $statement = self::executeStatement($params);
        return $statement->rowCount();
    }

    public static function getLastId()
    {
        return self::$connection->lastInsertId();
    }

    public static function quote($string)
    {
        return self::$connection->quote($string);
    }

    private static function checkIdentifiers($identifiers)
    {
        foreach ($identifiers as $identifier)
        {
            if (!preg_match('/^[a-zA-Z0-9\_\-]+$/u', $identifier))
                throw new Exception('Dangerous identifier in SQL query');
        }
    }
    public static function tableStructure($table)
    {
        $query = self::queryAll('
			SHOW COLUMNS
			FROM ' . $table);
        $int = 0;
        foreach ($query as $array) {
            $column_array[$int] = $array['Field'];
            $int++;
        }
        return $column_array;
    }
    public static function databaseTables()
    {
        $query = Db::queryAll('
			SHOW TABLES');
        $int = 0;
        foreach ($query as $array) {
            foreach ($array as $key => $value) {
                $table_array[$int] = $value;
                $int++;
            }
        }
        return $table_array;
    }
}