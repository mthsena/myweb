<?php

namespace app;

require_once dirname(__DIR__, 2) . '/core/Checker.php';

class TableModel
{
    private $table = 'table';

    public function create($value1, $value2)
    {
        $query = sprintf('insert into %s (column1, column2) values (?, ?)', $this->table);
        return Database::query($query, func_get_args());
    }
}
