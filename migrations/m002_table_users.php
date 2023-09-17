<?php



class m002_table_users
{
    private static \pdo $pdo;
    private static function initialize(): void
    {
        $dsn = 'mysql:host=mysql;dbname=FacadeDB';
        $username = 'AliZibaie';
        $password = 123456;
        self::$pdo = new \PDO($dsn, $username, $password);
    }

    public static function up()
    {
        self::initialize();
        $query = "
CREATE TABLE users(
    id INT  AUTO_INCREMENT,
    name VARCHAR(255),
    email TEXT,
    PRIMARY KEY (id)
                      );";
        $stmt =  self::$pdo->prepare($query);
        $stmt->execute();
    }
}