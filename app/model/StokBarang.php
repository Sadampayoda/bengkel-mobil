<?php 

namespace App\Model;


use App\Config\Model;


include_once __DIR__.'/../config/model.php';

class StokBarang extends Model
{
    protected $table = 'stok_barangs';


    public function barangDesc()
    {
        return $this->relational('barangs','barang_id','id');
    }
        
}