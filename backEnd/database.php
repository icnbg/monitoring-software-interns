<?php
define('MYSQL_HOST', '127.0.0.1');
define('MYSQL_USER', 'root');
define('MYSQL_PASS', '');
define('MYSQL_DB', 'icn');

class DB
{
    private static $_instance = null;

    private $_pdo,
        $_query,
        $_error = false,
        $_results,
        $_count = 0;

    private function __construct()
    {
        try {
            $this->_pdo = new PDO(
                'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB,
                MYSQL_USER,
                MYSQL_PASS
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getDB()
    {
        if (!isset($_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $parameters = array()){
        $this->_error = false;
        if($this->_query = $this->_pdo->prepare($sql)){
            if(count($parameters)){
                $positionOfParameter = 1;
                foreach ($parameters as $parameter){
                    $this->_query->bindValue($positionOfParameter, $parameter);
                    $positionOfParameter++;
                }
            }
            if($this->_query->execute()){
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            }else{
                $this->_error = true;
            }
        }
        return $this;
    }

    public function action($action, $table, $where = array()){
       if(count($where) === 3){
           $operatorsAllowed = array('=', '>', '<', '>=', '<=');

           $field = $where[0];
           $operator = $where[1];
           $value = $where[2];

           if(in_array($operator, $operatorsAllowed)){
               $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
               if(!$this->query($sql, array($value))->error()){
                   return $this;
               }
           }
       }
        return false;
    }

    public function get($table, $where){
        $sqlForGet = $this->action('SELECT *', $table, $where);
        return $sqlForGet;
    }

    public function delete($table, $where){
        $sqlForDelete = $this->action('DELETE', $table, $where);
        return $sqlForDelete;
    }
    public function insert($table, $fields = array()){
        if(count($fields)){
            $keys = array_keys($fields);
            $values = '';
            $counterOfParameters = 1;

            foreach($fields as $field){
                $values .= "?";
                if($counterOfParameters < count($fields)){
                    $values .= ', ';
                }
                $counterOfParameters++;
            }
            $sql = "INSERT INTO {$table} (`". implode('`,`', $keys) ."`) VALUES ({$values})";

            if(!$this->query($sql, $fields)->error()){
                return true;
            }
        }
        return false;
    }

    public function update($table, $keyName, $keyValue, $fields){
        $set = '';
        $counterOfParameters = 1;
        foreach($fields as $name => $value){
            $set .= "{$name} = ?";
            if($counterOfParameters < count($fields)){
                $set .= ', ';
            }
            $counterOfParameters++;
        }


        $sql = "UPDATE {$table} SET {$set} WHERE {$keyName} = {$keyValue}";

        if(!$this->query($sql, $fields)->error()){
            return true;
        }
        return false;
    }
    public function results(){
        return $this->_results;
    }

    public function result(){
        return $this->results()[0];
    }

    public function error(){
        return $this->_error;
    }

    public function getWebsite($host){
        $user = $this->get("websites", array('host', '=', $host));
        if(!$user->error()){
            return $user->result();
        }else{
            return false;
        }
    }

    public function count(){
        return $this->_count;
    }
}

?>