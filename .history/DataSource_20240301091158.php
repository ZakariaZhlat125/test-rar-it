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

    public function  execute($query , $paramType="" , $paramArray= array())
    {
        $statement = $this->connection->prepare($query);
        if(!empty($paramType) && !empty($paramArray)){
            $this->bindQueryParams($statement, $paramType, $paramArray);
        }
    }

    public function select($query, $paramType = "", $paramArray = array()) {}
    public function insert($query, $paramType , $paramArray ) {}
    public function update($query, $paramType , $paramArray ) {}
    public function delete($query, $paramType , $paramArray ) {}

    public function getRrcordCount($query, $paramType = "", $paramArray = array()) {}
  
}
