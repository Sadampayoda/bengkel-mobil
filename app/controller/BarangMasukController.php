<?php

namespace App\Controller;

use App\Model\BarangMasuk;
include_once __DIR__.'/../model/BarangMasuk.php';


class BarangMasukController {

    protected $model;
    public function __construct()
    {
        $this->model = new BarangMasuk();
    }
    
    public function index()
    {
        if(isset($_GET['start']) || isset($_GET['end']))
        {

            return $this->model->all('*,barang_masuks.id as id,barang_masuks.created_at as tanggal,stok_barangs.name as barang,jenis_satuans.name as jenis,suppliers.name as supplier')
            ->with('barangDesc')
            ->with('jenisDesc')
            ->with('supplierDesc')
            ->whereBetween('barang_masuks.created_at',$_GET['start'],$_GET['end'])
            ->get();
        }
        return $this->model->all('*,barang_masuks.id as id,barang_masuks.created_at as tanggal,stok_barangs.name as barang,jenis_satuans.name as jenis,suppliers.name as supplier')
        ->with('barangDesc')
        ->with('jenisDesc')
        ->with('supplierDesc')
        ->get();
    }

    public function store($request)
    {
        $jenis = $this->model->create($request);
    }

    public function show($id)
    {
        if(!$id)
        {
            return null;
        }
        $row = $this->model->all()->where('id',' = ',$id)->get();
        return $row[0] ?? null;
    }

    public function update($request,$id)
    {
        $update = $this->model->update($request,['id' => $id]);
        return $update ?? null;
    }

    public function destroy($id)
    {
        $delete = $this->model->delete('id',$id);
        return $delete ?? null;
    }
}