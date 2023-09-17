<?php
class ORMFacade
{
    private static pdo $pdo;
    private static string $action;
    private static string $table;
    private static array $finalActions = [
        'find' => 'select',
        'select' => 'select',
        'create' => 'insert',
        'insert' => 'insert',
        'add' => 'insert',
        'make' => 'insert',
        'new' => 'insert',
        'update'=>'update',
        'edit'=>'update',
        'remove'=>'delete',
        'delete'=>'delete',
    ];
    private static function initialize(): void
    {
        $dsn = 'mysql:host=mysql;dbname=FacadeDB';
        $username = 'AliZibaie';
        $password = 123456;
        self::$pdo = new \PDO($dsn, $username, $password);
    }
    private static function getInstance(): pdo
    {
        if (!isset(self::$pdo)){
             self::initialize();
        }
        return self::$pdo;
    }
    public static function __callStatic(string $method, array|string $args)
    {
             self::performAction($method, $args);
    }
    public function __call(string $method, array|string $args)
    {
         $this->performAction($method, $args);
    }
    private static function performAction($method, $args)
    {
        self::setParamsMethod($method, $args);
        $method = "perform".ucfirst(self::$action);
        self::$method(self::$table, $args[0]);
    }
    private static function setParamsMethod($method, $args): void
    {
        try {
            $matches = implode('|',array_keys(self::$finalActions));
            preg_match("/($matches)/", $method, $actionMatch, PREG_UNMATCHED_AS_NULL);
            preg_match('/(User|m0001tableproducts)/', $method, $tableMatch, PREG_UNMATCHED_AS_NULL);
            preg_match_all('/(name|id|email)/', implode('',array_keys($args[0])), $argMatch, PREG_UNMATCHED_AS_NULL);
            if (!$actionMatch){
                InvalidMethod::throw();
            }
            if (!$tableMatch){
                InvalidTable::throw();
            }
            if (count($argMatch[1]) < count(array_keys($args[0]))){
                InvalidColumn::throw();
            }
            static::$action = self::$finalActions[$actionMatch[1]];
            static::$table = strtolower($tableMatch[1]).'s';
        }
        catch (Exception $e){
            echo $e->getMessage();
            exit();
        }
    }
    private static function performSelect($table, $args): void
    {
        $condition = self::makeCondition($args, 'OR');
        $query = "SELECT * FROM $table where $condition";
        $stmt = self::getInstance()->prepare($query);
        self::bind($args, $stmt);
        $stmt->execute();
        echo "<pre>";
        var_dump( $stmt->fetchAll(PDO::FETCH_ASSOC));
        echo "</pre>";
    }

    private static function performInsert($table, $data): void
    {
        $fields = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $query = "INSERT INTO $table ($fields) VALUES ($values)";
        $stmt = self::getInstance()->prepare($query);
        self::bind($data, $stmt);
        $stmt->execute();
        self::$pdo->lastinsertid();
        self::showResult($table, self::$action);
    }
    private static function performUpdate($table, $data)
    {
        $condition = self::makeCondition($data, ",");
        $stmt = self::getInstance()->prepare("UPDATE $table  SET $condition");
        self::bind($data, $stmt);
        $stmt->execute();
        self::getInstance()->lastinsertid();
        self::showResult($table, self::$action);
    }
    private static function performDelete($table, $data)
    {
        $condition = self::makeCondition($data, "AND");
        $query = "DELETE FROM  $table WHERE $condition";
        $stmt = self::getInstance()->prepare($query);
        self::bind($data, $stmt);
        $stmt->execute();
        self::getInstance()->lastinsertid();
        self::showResult($table, self::$action);
    }
    private static function makeCondition($args, $operator)
    {
        $condition = '';
        foreach ($args as $key => $arg){
            $condition .= "$key=:$key $operator ";
        }
        return rtrim($condition," $operator").';';
    }
    public static function bind($args, $stmt): void
    {
        foreach ($args as $key => $arg){
            $stmt->bindValue(":$key", $arg);
        }
    }
    public static function showResult($table, $method)
    {
        echo "$table $method"."d successfully";
    }

}