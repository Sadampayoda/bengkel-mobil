<?php

namespace App\Controller;

use App\Model\BarangKeluar;
use App\Model\BarangMasuk;
use App\Model\Jenis;
use App\Model\Satuan;
use App\Model\StokBarang;
use App\Model\Supplier;

include_once __DIR__.'/../model/StokBarang.php';
include_once __DIR__.'/../model/BarangMasuk.php';
include_once __DIR__.'/../model/BarangKeluar.php';
include_once __DIR__.'/../model/Supplier.php';
include_once __DIR__.'/../model/Satuan.php';
include_once __DIR__.'/../model/Jenis.php';


class DashboardController {

    protected $stok,$masuk,$keluar,$supplier,$jenis,$satuan;
    public function __construct()
    {
        
        $this->stok = new StokBarang();
        $this->masuk = new BarangMasuk();
        $this->keluar = new BarangKeluar();
        $this->supplier = new Supplier();
        $this->jenis = new Jenis();
        $this->satuan = new Satuan();
    }
    
    public function index()
    {
    
        return [
            'stok' => $this->stok->all()->count(),
            'masuk' => $this->masuk->all()->count(),
            'keluar' => $this->keluar->all()->count(),
            'supplier' => $this->supplier->all()->count(),
            'jenis' => $this->jenis->all()->count(),
            'satuan' => $this->satuan->all()->count(),
        ];
    }

    
}