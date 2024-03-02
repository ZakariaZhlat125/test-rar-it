<?php
class DataSource

{
    const HOST =  ' localhost';
    const USERNAME = 'root';

    const PASSWORD = '';
    const DATABASENAME = 'shopping_cart';
    private $connection;


    function __construct()
    {
        $this->connection = $this->getConnection();
    }

    public function  getConnection()
    {
        $connection  = new \mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASENAME);

        if (mysqli_connect_errno()) {
            trigger_error('Problem with  connection  to  database with mysql.');

            $connection->set_charset("utf8");
            return $connection;
        }
    }

    public function bindQueryParams($statement , $paramtype , $paramArray = arra())
    {
        $paramValueReference = null;
        $paramValueReference[] = &$paramtype;

    }
}
