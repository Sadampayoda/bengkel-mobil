<?php

namespace App\Controller;

use App\Model\BarangKeluar;
use App\Model\BarangMasuk;
use App\Model\JenisSatuan;
use App\Model\StokBarang;
use App\Model\Supplier;

include_once __DIR__.'/../model/StokBarang.php';
include_once __DIR__.'/../model/BarangMasuk.php';
include_once __DIR__.'/../model/BarangKeluar.php';
include_once __DIR__.'/../model/Supplier.php';
include_once __DIR__.'/../model/JenisSatuan.php';


class DashboardController {

    protected $stok,$masuk,$keluar,$supplier,$jenisSatuan;
    public function __construct()
    {
        
        $this->stok = new StokBarang();
        $this->masuk = new BarangMasuk();
        $this->keluar = new BarangKeluar();
        $this->supplier = new Supplier();
        $this->jenisSatuan = new JenisSatuan();
    }
    
    public function index()
    {
    
        return [
            'stok' => $this->stok->all()->count(),
            'masuk' => $this->masuk->all()->count(),
            'keluar' => $this->keluar->all()->count(),
            'supplier' => $this->supplier->all()->count(),
            'jenis' => $this->jenisSatuan->all()->where('type',' = ','jenis')->count(),
            'satuan' => $this->jenisSatuan->all()->where('type',' = ','satuan')->count(),
        ];
    }

    
}