<?php

namespace App\Controller;

use App\Model\BarangKeluar;
include_once __DIR__.'/../model/BarangKeluar.php';


class BarangKeluarController {

    protected $model;
    public function __construct()
    {
        $this->model = new BarangKeluar();
    }
    
    public function index()
    {
        return $this->model->all('*,barang_keluars.id as id,barang_keluars.created_at as tanggal,stok_barangs.name as barang')
        ->with('barangDesc')
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