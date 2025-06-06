<?php

namespace App\Traits;


trait QueryTraits
{
    protected $query;

    public function all(string $view = '*')
    {
        $this->query = 'SELECT ' . $view . ' FROM ' . $this->table;
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

    public function andWhere($column, $operator = ' = ', $value)
    {
        if (is_string(value: $value)) {
            $value = "'" . addslashes($value) . "'";
        }
        $this->query .= ' AND ' . $column . ' ' . $operator . ' ' . $value;
        return $this;
    }

    public function whereBetween($column, $start, $end)
    {

        $this->query .= " AND DATE($column) BETWEEN '$start' AND '$end'";



        return $this;
    }

    public function whereBetweens($column, $start, $end)
    {
        $this->query .= " WHERE DATE($column) BETWEEN '$start' AND '$end'";

        return $this;
    }

    public function with(string $relational)
    {
        $data = $this->$relational();
        $this->query .= ' JOIN ' . $data->table . ' ON ' . $data->table . '.' . $data->relationKey . ' = ' . $this->table . '.' . $data->lokalKey;
        return $this;
    }

    public function relational($table, $lokalKey, $relationKey)
    {
        $relational = (object)[];

        $relational->table = $table;
        $relational->lokalKey = $lokalKey;
        $relational->relationKey = $relationKey;

        return $relational;
    }

    public function search(array $search,$value)
    {
        $length = count($search);
        $this->query .= " WHERE ";
        foreach ($search as $index => $row) {
            $this->query .= " ".$row." LIKE '%$value%' ";
            if(($index + 1) !== $length){
                $this->query .= " OR ";
            }
        }
        return $this;
    }
}
