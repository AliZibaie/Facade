<?php



class m001_table_products
{
    private static \pdo $pdo;
    public static function initialize(): void
    {
        $dsn = 'mysql:host=localhost;dbname=FacadeDB';
        $username = 'AliZibaie';
        $password = 123456;
        self::$pdo = new \PDO($dsn, $username, $password);
    }
    public static function up()
    {
        self::initialize();
//        $query = "
//CREATE TABLE  products(
//    id INT  AUTO_INCREMENT,
//    name VARCHAR(255),
//    email TEXT,
//     PRIMARY KEY (id)
//                      );";
//       $stmt =  self::$pdo->prepare($query);
//        $stmt->execute();
    }
}
