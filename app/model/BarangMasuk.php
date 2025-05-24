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
        return $this->relational('stok_barangs','barang_id','id');
    }

    public function jenisDesc()
    {
        return $this->relational('jenis','jenis_id','id');
    }

    public function supplierDesc()
    {
        return $this->relational('suppliers','supplier_id','id');
    }

    
}
