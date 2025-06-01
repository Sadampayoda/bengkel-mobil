<?php

namespace App\Model;


use App\Config\Model;


include_once __DIR__ . '/../config/model.php';

class Barang extends Model
{
    protected $table = 'barangs';

    public function supplierDesc()
    {
        return $this->relational('suppliers','supplier_id','id');
    }
    
}
