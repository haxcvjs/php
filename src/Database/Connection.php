<?php


namespace Core\Database;

use Core\Tools\Config;
use DateTime;
use PDO;
use PDOException;

class Connection
{

    protected PDO  $connection;

    protected $created; // datetime

    protected $updated; // datetime

    protected  $established = false; // PDO list

    protected  $config = false; // Config instance

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->establsih();
    }

    public function re_establish(): PDO
    {
        $this->updateDate();
        return $this->make( function(PDO $db) {
            $this->updateDate();
        });
    }
    
    public function establsih(): PDO
    {

        if($this->established) {
            return $this->getConnection();
        }

        return $this->make( function(PDO $db) {
            $this->registerDate();
        });
    }

    public function make($callback): PDO
    {

        $dbconfig = $this->config->get('database');

        if (!is_array($dbconfig)) {
            throw new PDOException('Error in Databae Config should be in Array ');
        }

        if (!get_var($dbconfig, 'connections')) {
            throw new PDOException('Error in Databae Config connections should be in Array ');
        }
        
        $driver = get_var($dbconfig, 'default');

        $connections  = get_var($dbconfig, 'connections');
        $driverConfig = get_var($connections, $driver);
        
        if (!$driverConfig) {
            throw new PDOException("Error  {{$driver}} Driver Config connections  ");
        }

        
        $username = get_var($driverConfig, 'username');
        $password = get_var($driverConfig, 'password');
        $database = get_var($driverConfig, 'database');
        $host = get_var($driverConfig, 'host');
        
        $dsn = sprintf("%s:host=%s;dbname=%s" , $driver, $host, $database );

        //code...
        $this->connection = new PDO(
            $dsn,
            $username,
            $password,
            array(PDO::ATTR_PERSISTENT => 'unbuff', PDO::MYSQL_ATTR_USE_BUFFERED_QUERY  => false)
        );
        /* $this->connection->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true); */

        if(is_callable($callback)) {
            $callback($this->connection);
        }

        $this->established = true;
        return $this->connection;

    }



    public function registerDate()
    {
        $this->created = date("Y-m-d H:i:s A");
    }
    
    public function updateDate()
    {
        $this->updated = date("Y-m-d H:i:s A");
    }
    
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
