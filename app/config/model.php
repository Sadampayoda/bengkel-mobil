<?php


namespace App\Config;

use App\Traits\QueryTraits;
use App\Config\Database;

include_once __DIR__ . '/../traits/QueryTraits.php';
include_once __DIR__ . '/database.php';

class Model extends Database
{

    use QueryTraits;

    public function get()
    {
        $result = $this->connect()->query($this->query);
        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            if (isset($this->enum)) {
                $data = $this->dataEnum($data, $this->enum);
            }
            if(isset($this->timestamps))
            {
                $data = $this->setTimesStamps($data,$this->timestamps);
            }

            return $data;
        }

        return null;
    }

    public function count()
    {
        return count($this->get() ?? []);
    }

    public function create($data)
    {

        $timestamp = date('Y-m-d H:i:s');
        $data['created_at'] = $timestamp;
        $data['updated_at'] = $timestamp;


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

        $timestamp = date('Y-m-d H:i:s');
        $data['updated_at'] = $timestamp;


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

    private function dataEnum($data, $enum)
    {
        foreach ($data as $key => $value) {
            foreach ($enum as $enumKey => $enumValues) {
                if (isset($value[$enumKey]) && isset($enumValues[$value[$enumKey]])) {
                    $data[$key][$enumKey] = $enumValues[$value[$enumKey]];
                }
            }
        }

        return $data;
    }

    private function setTimesStamps($data,$timestamp)
    {
        foreach ($data as $key => $value) {
            if(isset($value['created_at']) && isset($value['updated_at']))
            {
                $data[$key]['created_at'] = date($timestamp, strtotime($value['created_at']));
                $data[$key]['updated_at'] = date($timestamp, strtotime($value['updated_at']));
            } 
            
            if(isset($value[$this->columnTimestamps]))
            {
                $data[$key][$this->columnTimestamps] = date($timestamp, strtotime($value[$this->columnTimestamps]));
                
            }
        }
        return $data;
    }
}
