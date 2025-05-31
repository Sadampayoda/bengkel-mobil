<?php

namespace App\Controller;

use App\Model\BarangKeluar;

include_once __DIR__ . '/../model/BarangKeluar.php';


class BarangKeluarController
{

    protected $model;
    public function __construct()
    {
        $this->model = new BarangKeluar();
    }

    public function index()
    {
        if(isset($_GET['search'])){
            return $this->model->all('*,barang_keluars.id as id,barang_keluars.created_at as tanggal,barangs.name as nama_barang')
                ->with('barangDesc')
            ->where('barangs.name', 'like', '%'.$_GET['search'].'%')
                ->get();
        }
        if (isset($_GET['start']) || isset($_GET['end'])) {

            return $this->model->all('*,barang_keluars.id as id,barang_keluars.created_at as tanggal,barangs.name as nama_barang')
                ->with('barangDesc')
                ->whereBetween('barang_keluars.created_at', $_GET['start'], $_GET['end'])
                ->get();
        }
        return $this->model->all('*,barang_keluars.id as id,barang_keluars.created_at as tanggal,barangs.name as nama_barang')
            ->with('barangDesc')
            ->get();
    }

    public function store($request)
    {
        $jenis = $this->model->create($request);
    }

    public function show($id)
    {
        if (!$id) {
            return null;
        }
        $row = $this->model->all()->where('id', ' = ', $id)->get();
        return $row[0] ?? null;
    }

    public function update($request, $id)
    {
        $update = $this->model->update($request, ['id' => $id]);
        return $update ?? null;
    }

    public function destroy($id)
    {
        $delete = $this->model->delete('id', $id);
        return $delete ?? null;
    }
}
