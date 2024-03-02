<?php

class DataSource
{
    const HOST = 'localhost';
    const USERNAME = 'root';
    const PASSWORD = '';
    const DATABASENAME = 'shopping_cart';
    private $connection;

    function __construct()
    {
        $this->connection = $this->getConnection();
    }

    public function getConnection()
    {
        $connection = new \mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASENAME);

        if (mysqli_connect_errno()) {
            trigger_error('Problem with connection to the database with MySQL.');
        }

        $connection->set_charset("utf8");
        return $connection;
    }

    public function bindQueryParams($statement, $paramtype, $paramArray = array())
    {
        $paramValueReference = array($paramtype);

        foreach ($paramArray as &$param) {
            $paramValueReference[] = &$param;
        }

        call_user_func_array(array($statement, 'bind_param'), $paramValueReference);
    }

    public function execute($query, $paramType = "", $paramArray = array())
    {
        $statement = $this->connection->prepare($query);
        if (!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($statement, $paramType, $paramArray);
        }

        $statement->execute();
        return $statement;
    }

    public function select($query, $paramType = "", $paramArray = array())
    {
        $statement = $this->execute($query, $paramType, $paramArray);
        $result = $statement->get_result();

        $records = array();
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }

        $statement->close();
        return $records;
    }

    public function insert($query, $paramType, $paramArray)
    {
        $statement = $this->execute($query, $paramType, $paramArray);
        $insertId = $statement->insert_id;
        $statement->close();

        return $insertId;
    }

    public function update($query, $paramType, $paramArray)
    {
        $statement = $this->execute($query, $paramType, $paramArray);
        $affectedRows = $statement->affected_rows;
        $statement->close();

        return $affectedRows;
    }

    public function delete($query, $paramType, $paramArray)
    {
        return $this->update($query, $paramType, $paramArray);
    }

    public function getRecordCount($query, $paramType = "", $paramArray = array())
    {
        $statement = $this->execute($query, $paramType, $paramArray);
        $result = $statement->get_result();
        $recordCount = $result->num_rows;
        $statement->close();

        return $recordCount;
    }
}
