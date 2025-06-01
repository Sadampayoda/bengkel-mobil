<?php

namespace App\Controller;

use App\Model\Barang;
use App\Model\BarangKeluar;
use App\Model\BarangMasuk;
use App\Model\StokBarang;
use App\Model\Supplier;

include_once __DIR__.'/../model/StokBarang.php';
include_once __DIR__.'/../model/BarangMasuk.php';
include_once __DIR__.'/../model/BarangKeluar.php';
include_once __DIR__.'/../model/Supplier.php';
include_once __DIR__.'/../model/Barang.php';


class DashboardController {

    protected $stok,$masuk,$keluar,$supplier,$barang;
    public function __construct()
    {
        
        $this->stok = new StokBarang();
        $this->masuk = new BarangMasuk();
        $this->keluar = new BarangKeluar();
        $this->supplier = new Supplier();
        $this->barang = new Barang();
    }
    
    public function index()
    {
    
        return [
            'stok' => $this->stok->all()->count(),
            'masuk' => $this->masuk->all()->count(),
            'keluar' => $this->keluar->all()->count(),
            'supplier' => $this->supplier->all()->count(),
            'barang' => $this->barang->all()->count(),
        ];
    }

    
}