<?php

namespace wfs;

use wfs\MySql;

Abstract Class Model {
    
    protected static $table;
    
    private $where = false;
    private $select = false;
    private $from = false;
    
    protected $sql;
    
    public function __construct() {
        
        $tableName = self::$table;
        $this->from = " {$tableName} ";
        
    }
    
    static function findOne($id) {
        
        $tableName = self::$table;
        $sql = "SELECT * FROM {$tableName} WHERE id = '{$id}'";
        
        return Mysql::getRow($sql);
        
    }
    
    static function find() {
        
        $class_name = get_called_class();
        return (new $class_name());
        
    }
    
    public function joinLeft($table) {
        
        $methodName = 'get'.$table;        
        if(method_exists($this, $methodName))
            $this->from .= $this->$methodName();
        
        return $this;
        
    }
    
    public function select($conditions) {
        
        if(is_array($conditions)) {
            $select = '';
            foreach($conditions as $key => $val) {
                 
            }
            $this->select = $select;
        } else {
            $this->select = $conditions;
        }
        
        return $this;        
        
    }
    
    public function where($conditions) {
        
        if(is_array($conditions)) {
            $where = '';
            foreach($conditions as $key => $val) {
                 
            }
            $this->where = $where;
        } else {
            $this->where = $conditions;
        }
        
        return $this;
    }
    
    public function one() {
       
        return MySql::getOne($this->build());
        
    }
    
    public function all() {
        
        $tableName = self::$table;
        
        $sql = "SELECT * FROM {$tableName}";
        if($this->where) { $sql .= $this->where; }
               
        return MySql::getRows($sql);
        
    }
    
    private function build() {
        
        $sql = '';
        $sql .= " SELECT * ";       
        $sql .= " FROM " . $this->from;
        $sql .= " WHERE " . $this->where;
        
        return $sql;
    }
    
    public function hasOne($classname, $bind = []) {
        
        $classname = basename(str_replace('\\', '/', $classname));
        $from = reset(array_keys($bind));        
        $to = reset($bind);
        $this_class = basename(str_replace('\\', '/', self::classname()));
        
        return " LEFT JOIN {$classname} ON {$classname}.{$from} = {$this_class}.{$to} ";
        
    }
    
    public function hasMany() {
        
        return $this;
        
    }
    
    static function init() {
        
        $modelName = self::classname();
        $modelName = str_replace('\\', '/', $modelName);
        
        $tableName = strtolower(basename($modelName));
        self::$table = $tableName;
        
    }
    
    static function classname() {
        return get_called_class();
    }
    
    public function getRawSql() {
        return $this->build();
    }
    
}