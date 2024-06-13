<?php


namespace Core\Database;

use PDO;

class Database
{
    public Connection $connection;

    public $table;

    public $query = '';

    public $query_start = '';

    public PDO $db;

    public function __construct()
    {

        $this->connection = app()->singleton(Connection::class);
        $this->db = $this->connection->getConnection();
    }

    public function insert($table = '')
    {
        $this->table = $table;
        $this->query_start = 'INSERT INTO';
        return $this;
    }

    public function values($values = [])
    {

        $keys =  build_query_keys(array_keys($values));
        $values = build_query_values(array_values($values));

        $this->query = $this->query_start . ' ' . $this->table . ' ' . $keys . ' VALUES ' . $values;
        return $this;
    }

    public function exec()
    {
         
    }
}
