<?php
class DBConnect{
    private static $instance;
    private $pdo;
    public function __construct(){
        $this->pdo =new PDO("mysql:dbname=".$_ENV['DB_NAME'].";host=".$_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function getPDO(): PDO{
        return $this->pdo;
    }
    public function query(string $sql, ?array $params = null) : PDOStatement{
        $pdo = $this->getPDO();
        if($params == null){
            $stmt = $pdo->query($sql);
        }else{
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
        }
        return $stmt;
    }
    public static function getInstance() : DBConnect
    {
        if (!self::$instance) {
            self::$instance = new DBConnect();
        }
        return self::$instance;
    }
}