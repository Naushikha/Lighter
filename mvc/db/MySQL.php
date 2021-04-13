<?php

class MySQL
{
    // https://codeshack.io/super-fast-php-mysql-database-class/

    public $query_count = 0;

    protected $connection;
    protected $query;
    protected $show_errors = true;
    protected $query_closed = true;

    private $host = DB_HOST;
    private $dbname = DB_NAME;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $charset = 'utf8';

    public function __construct()
    {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        if ($this->connection->connect_error) {
            $this->error('Failed to connect to MySQL Server: '.$this->connection->connect_error);
        }
        $this->connection->set_charset($this->charset);
    }

    public function query($query)
    {
        if (!$this->query_closed) {
            $this->query->close();
        }
        if ($this->query = $this->connection->prepare($query)) {
            if (func_num_args() > 1) {
                $x = func_get_args();
                $args = array_slice($x, 1);
                $types = '';
                $args_ref = [];
                foreach ($args as $k => &$arg) {
                    if (is_array($args[$k])) {
                        foreach ($args[$k] as $j => &$a) {
                            $types .= $this->_gettype($args[$k][$j]);
                            $args_ref[] = &$a;
                        }
                    } else {
                        $types .= $this->_gettype($args[$k]);
                        $args_ref[] = &$arg;
                    }
                }
                array_unshift($args_ref, $types);
                call_user_func_array([$this->query, 'bind_param'], $args_ref);
            }
            $this->query->execute();
            if ($this->query->errno) {
                $this->error('Unable to process MySQL query (check your params): '.$this->query->error);
            }
            $this->query_closed = false;
            ++$this->query_count;
        } else {
            $this->error('Unable to prepare MySQL statement (check your syntax): '.$this->connection->error);
        }

        return $this;
    }

    public function fetchAll($callback = null)
    {
        $params = [];
        $row = [];
        $meta = $this->query->result_metadata();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array([$this->query, 'bind_result'], $params);
        $result = [];
        while ($this->query->fetch()) {
            $r = [];
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            if (null != $callback && is_callable($callback)) {
                $value = call_user_func($callback, $r);
                if ('break' == $value) {
                    break;
                }
            } else {
                $result[] = $r;
            }
        }
        $this->query->close();
        $this->query_closed = true;

        return $result;
    }

    public function fetchArray()
    {
        $params = [];
        $row = [];
        $meta = $this->query->result_metadata();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array([$this->query, 'bind_result'], $params);
        $result = [];
        while ($this->query->fetch()) {
            foreach ($row as $key => $val) {
                $result[$key] = $val;
            }
        }
        $this->query->close();
        $this->query_closed = true;

        return $result;
    }

    public function close()
    {
        return $this->connection->close();
    }

    public function numRows()
    {
        $this->query->store_result();

        return $this->query->num_rows;
    }

    public function affectedRows()
    {
        return $this->query->affected_rows;
    }

    public function lastInsertID()
    {
        return $this->connection->insert_id;
    }

    public function error($error)
    {
        if ($this->show_errors) {
            logging('MySQL', $error);

            exit($error);
        }
    }

    private function _gettype($var)
    {
        if (is_string($var)) {
            return 's';
        }
        if (is_float($var)) {
            return 'd';
        }
        if (is_int($var)) {
            return 'i';
        }

        return 'b';
    }
}
