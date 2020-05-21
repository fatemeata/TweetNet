<?php

class Database {
    private $con;
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    function __construct($option = null)
    {
        if ($option != null) {
            $host = $option['host'];
            $user = $option['user'];
            $pass = $option['pass'];
            $name = $option['name'];
        } else {
            global $config;
            $host = $config['db']['host'];
            $user = $config['db']['user'];
            $pass = $config['db']['pass'];
            $name = $config['db']['name'];
        }
        $this->con = new mysqli($host, $user, $pass, $name);
        if ($this->con->connect_error) {
            echo "Connection failed!<br>error:".$this->con->connect_error;
        }
        $this->con->query("SET NAMES 'utf8'");
    }
    public function query($sql) {
        $result = $this->con->query($sql);
        $record = array();
        if ($result->num_rows == 0) {
            return null;
        }
        while ($row = $result->fetch_assoc()) {
            $record[] = $row;
        }
        return $record;
    }
    public function get_row($table, $where = null) {
    $sql = "SELECT * FROM ".$table;
    if ($where) {
        $i = 1;
        $length_array = count($where);
        $sql.=" WHERE ";
        foreach ($where as $key => $value) {
            if ($i < $length_array) {
                $sql.= "$key = '$value' AND ";
                $i++;
            } else {
                $sql.= "$key = '$value'";
            }
        }
    }
    $data = $this->query($sql);
    if ($data) {
        return $data[0];
    } else {
        return null;
    }
}
    public function insert($table, $data) {
        $sql = "INSERT INTO ".$table;
        $columns = "";
        $values = "";
        $i = 1;
        $count = count($data);

        foreach ($data as $key => $value) {
            $columns.= $key;
            $values.= "'".$value."'";

            if ($i < $count) {
                $columns.=",";
                $values.=",";
            }
            $i++;
        }
        $sql.= " (".$columns.") VALUES (".$values.")";
        $status = $this->con->query($sql);
        return $status;
    }

    public function update($table, $update, $where) {

    }


    public function get_all($table, $where = null) {
        $sql = "SELECT * FROM ".$table;
        if ($where) {
            $i = 1;
            $length_array = count($where);
            $sql.=" WHERE ";
            foreach ($where as $key => $value) {
                if ($i < $length_array) {
                    $sql.= "$key = '$value' AND ";
                    $i++;
                } else {
                    $sql.= "$key = '$value'";
                }
            }
        }
        $data = $this->query($sql);
        if ($data) {
            return $data;
        } else {
            return null;
        }
    }
}