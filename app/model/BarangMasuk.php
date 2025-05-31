<?php

namespace App\Model;


use App\Config\Model;


include_once __DIR__ . '/../config/model.php';

class BarangMasuk extends Model
{
    protected $table = 'barang_masuks';

    protected $timestamps = 'Y-m-d';

    protected $columnTimestamps = 'tanggal';
    public function barangDesc()
    {
        return $this->relational('barangs','barang_id','id');
    }

    
}
