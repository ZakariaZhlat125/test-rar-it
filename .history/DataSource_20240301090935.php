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

    public function bindQueryParams($statement, $paramtype, $paramArray = array())
    {
        $paramValueReference = null;
        $paramValueReference[] = &$paramtype;

        for ($i = 0; $i < count($paramArray); $i++) {
            $paramValueReference[] = &$paramArray[$i];
        }
        call_user_func_array(array($statement, 'bind_apram'), $paramValueReference);
    }

    public function  execute($query , $paramtype="" , $paramArray= array())
    {
        $statement = $this->connection->prepare($query);
        if(!empty($paramtype) && !empty($paramArray)){
            $this->bindQueryParams($statement, $paramType, $paramArray);
        }
    }
}
