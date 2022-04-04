<?php

namespace app\models;

defined('APP_PATH') or exit(header('Location: /', true, 301));

class Table {
    private $table = 'table';

    public function create($column1, $column2) {
        $query = 'insert into %s (column1, column2) values (?, ?)';
        $result = database($query, $this->table, func_get_args());
        return empty($result->rowCount()) ? false : true;
    }
}
