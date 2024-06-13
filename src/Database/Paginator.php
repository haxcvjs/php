<?php


namespace Core\Database;

use Core\Tools\Config;
use DateTime;
use eftec\bladeone\BladeOne;
use PDO;
use PDOException;
use stdClass;

class Paginator
{

    private PDO $db;
    private $limit;
    private $page;
    private $query;
    private $selection;
    private $total;

    public function __construct(PDO $conn, $query, $selection)
    {

        $this->db = $conn;
        $this->query = $query;
        $this->selection = $selection;

        $statement = $this->db->query(sprintf($this->query, 'COUNT(*) AS cc'));
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $this->total = $row['cc'];
        }
    }
    
    public function fetch($limit = 10, $page = 1)
    {
        
        $this->limit   = $limit;
        $this->page    = $page;
        
        if ($this->limit == 'all') {
            $query = $this->query;
        } else {
            $query = sprintf($this->query . " LIMIT " . (($this->page - 1) * $this->limit) . ",$this->limit" , $this->selection);
        }
        
        
        
        $statement  = $this->db->query($query);
        
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $results[]  = $row;
        }

        $result         = new stdClass();
        $result->page   = $this->page;
        $result->limit  = $this->limit;
        $result->total  = $this->total;
        $result->data   = $results;

        return $result->data;
    }

    public function createLinks($links, $list_class='')
    {
        if ($this->limit == 'all') {
            return '';
        }

        $last       = ceil($this->total / $this->limit);

        $start      = (($this->page - $links) > 0) ? $this->page - $links : 1;
        $end        = (($this->page + $links) < $last) ? $this->page + $links : $last;

        $views = app('path.src') . '/Database/views';
        $cache = app('path.base') . '/cache';
          
        $blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG); // MODE_DEBUG allows to pinpoint troubles.
        return $blade->run('pagination', [
            'page' => $this->page,
            'limit' => $this->limit,
            'last' => $last,
            'start' => $start,
            'end' => $end,
            'class_list' => ''
        ]);
    }
}
