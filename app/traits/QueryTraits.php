<?php

namespace App\Traits;


trait QueryTraits
{

    protected $query;

    public function all()
    {
        $this->query = 'SELECT * FROM ' . $this->table;
        return $this;
    }

    public function where($column, $operator = ' = ', $value)
    {
        if (is_string(value: $value)) {
            $value = "'" . addslashes($value) . "'";
        }
        $this->query .= ' WHERE ' . $column . ' ' . $operator . ' ' . $value;
        return $this;
    }


}
