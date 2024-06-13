<?php

namespace Core\Database;

use Closure;
use Core\Database\Connection;
use Core\Database\Database;
use Core\Http\Request;
use PDO;

abstract class Model
{

  /**
   * The connection name for the model.
   *
   * @var string|null
   */
  protected Connection $connection;

  protected PDO $db;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table;


  /**
   * The name of the "created at" column.
   *
   * @var string|null
   */
  const CREATED_AT = 'created_at';

  /**
   * The name of the "updated at" column.
   *
   * @var string|null
   */
  const UPDATED_AT = 'updated_at';

  protected $index = 'id';

  protected $indexValue;

  protected $data = [];

  protected $data_array = [];

  protected $limit = false;

  protected $selection = '*';

  protected $wheres = '';

  protected $order_by = '';

  protected $desc = '';

  public $links = '';

  public function __construct()
  {
    $this->db = app()->singleton(Connection::class)->getConnection();
    $this->setup();
  }


  public function setIndex($index)
  {
    $this->index = $index;
    return $this;
  }

  public function setIndexValue($value)
  {
    $this->indexValue = $value;
    return $this;
  }

  public function setup()
  {
  }

  public function select($selection = '*')
  {
    $this->selection = $selection;
    return $this;
  }


  public function orderBy($orderby = '', $desc = 'DESC')
  {
    $this->order_by = $orderby;
    $this->desc = $desc;
    return $this;
  }

  public function where($key, $cond = '=', $value = '')
  {
    if ($key instanceof Closure) {

      $key($this);
      return $this;
    } else {
      $this->wheres .= " AND {$key}{$cond}'$value' ";
    }
    return $this;
  }

  public function fetchData()
  {


    if (!$this->indexValue) return;
    $orderBy = '';
    if ($this->order_by) {
      $orderBy = 'ORDER BY ' . $this->order_by . ' ' . $this->desc;
    }

    $statement = $this->db->query("SELECT {$this->selection} FROM $this->table WHERE " . ( $this->index && $this->indexValue ?  "{$this->index}='{$this->indexValue}'" : "1") . " {$this->wheres} {$orderBy}  " . ($this->limit ? 'LIMIT' : '') . " {$this->limit} ");

    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      $this->data_array[] = $row;
      foreach ($row as $key => $value) {
        $this->data[$key] = $value;
      }
    }
  }

  public function paginate($limit = null)
  {

    if (!$this->indexValue) return;
    $orderBy = '';
    if ($this->order_by) {
      $orderBy = 'ORDER BY ' . $this->order_by . ' ' . $this->desc;
    }

    $paginator = new Paginator($this->db, "SELECT %s FROM $this->table WHERE  1 {$this->wheres} {$orderBy}  ", $this->selection);
    $result = $paginator->fetch($limit ?? $this->limit, app(Request::class)->query('page') ?? 1);
    $this->links =  $paginator->createLinks(2);
    app()->instance('current.links', $this->links);
    return $result;
  }

  public function index($key = '', $value = '')
  {


    $this->setIndex($key);
    if ($value) {
      $this->setIndexValue($value);
    }

    return $this;
  }

  public function limit($limit = 1)
  {


    $this->limit = $limit;;
    return $this;
  }

  public function fetch()
  {
    $this->fetchData();
    $this->wheres = '';
    return $this->data_array;
  }



  public function get($key = '')
  {

    $this->fetchData();
    $this->wheres = '';
    if (!$key) {
      return $this->data;
    }

    if (array_key_exists($key, $this->data)) {
      return $this->data[$key];
    }
  }

  public function All()
  {
    $this->fetchData();
    if (!$this->indexValue) return;

    $statement = $this->db->query("SELECT * FROM $this->table ");
    $rows = [];
    while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      $rows[] = $row;
    }
    $this->data_array = $rows;
    return $rows;
  }


  public function insert($values = [])
  {

    // check if Email exists

    $keys = build_query_keys(array_keys($values));
    $vals = build_keys($values, '?');


    $statement = $this->db->prepare("INSERT INTO $this->table  $keys VALUES $vals ");

    $statement->execute(array_values($values));


    $ID = $this->db->lastInsertId();

    if ($ID) {
      return $ID;
    }
  }

  public function update($values = [])
  {

    // check if Email exists



    $sets = '';

    foreach ($values as $key => $value) {
      $sets .= sprintf("%s='%s',", $key, $value);
    }

    $sets = rtrim($sets, ',');
    
    $statement = $this->db->prepare("UPDATE {$this->table} SET  $sets WHERE " . ( $this->index && $this->indexValue ?  "{$this->index}='{$this->indexValue}'" : "1") . " {$this->wheres} ");

    $rows = ($this->db->exec($statement->queryString));
    

    return $rows;
  }
}
