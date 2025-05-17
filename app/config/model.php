<?php


namespace App\Config;

use App\Traits\QueryTraits;
use App\Config\Database;

include __DIR__ . '/../traits/QueryTraits.php';
include __DIR__ . '/database.php';

class Model extends Database
{

    use QueryTraits;


    public function get()
    {
        $result = $this->connect()->query($this->query);
        if ($result && $result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return null;
    }

    public function create($data)
    {


        $columns = implode(", ", array_keys($data));
        $placeholders = rtrim(str_repeat("?, ", count($data)), ", ");

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->connect()->prepare($sql);

        if ($stmt === false) {
            die("Prepare failed: " . $this->connect()->error);
        }


        $types = '';
        $values = [];

        foreach ($data as $key => $value) {
            if (is_int($value)) {
                $types .= 'i';
            } elseif (is_double($value)) {
                $types .= 'd';
            } else {
                $types .= 's';
            }
            $values[] = $value;
        }


        $refs = [];
        foreach ($values as $key => &$value) {
            $refs[$key] = &$value;
        }


        array_unshift($refs, $types);

        call_user_func_array([$stmt, 'bind_param'], $refs);


        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        return $stmt->insert_id;
    }


    public function update(array $data, array $where)
    {
        $setParts = [];
        $values = [];


        foreach ($data as $key => $value) {
            $setParts[] = "$key = ?";
            $values[] = $value;
        }

        $setClause = implode(', ', $setParts);

        $whereClause = '';
        foreach ($where as $key => $value) {
            $whereClause .= "$key = ? AND ";
            $values[] = $value;
        }
        $whereClause = rtrim($whereClause, ' AND ');

        $sql = "UPDATE {$this->table} SET {$setClause} WHERE {$whereClause}";


        $stmt = $this->connect()->prepare($sql);

        $types = str_repeat('s', count($values));
        $stmt->bind_param($types, ...$values);

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        return $stmt->affected_rows;
    }


    public function delete($column, $value)
    {
        $query = "DELETE FROM {$this->table} WHERE {$column} = ?";

        $stmt = $this->connect()->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $this->connect()->error);
        }

    
        $type = is_int($value) ? 'i' : 's';
        $stmt->bind_param($type, $value);

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        return $stmt->affected_rows;
    }
}
