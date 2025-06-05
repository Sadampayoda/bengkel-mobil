<?php

namespace App\Controller;

use App\Model\BarangMasuk;
include_once __DIR__ . '/../model/BarangMasuk.php';


class BarangMasukController
{

    protected $model;
    public function __construct()
    {
        $this->model = new BarangMasuk();
    }

    public function index()
    {
        if (isset($_GET['search'])) {

            $search = $this->model->all('*,barang_masuks.created_at as tanggal,barang_masuks.id as id, barangs.name as nama_barang')
                ->with('barangDesc')
                ->search(['barangs.name','barang_masuks.jumlah'],$_GET['search'])
                ->get();
            return $search ?? [];
        }
        if (isset($_GET['start']) || isset($_GET['end'])) {

            $date = $this->model->all('*,barang_masuks.created_at as tanggal,barang_masuks.id as id, barangs.name as nama_barang')
                ->with('barangDesc')
                ->whereBetween('barang_masuks.created_at', $_GET['start'], $_GET['end'])
                ->get();

            return $date ?? [];
        }
        return $this->model->all('*,barang_masuks.created_at as tanggal,barang_masuks.id as id, barangs.name as nama_barang')
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
        $row = $this->model->all('*,barang_masuks.created_at as tanggal,barang_masuks.id as id, barangs.name as nama_barang')
            ->with('barangDesc')
            ->where('barang_masuks.id', ' = ', $id)
            ->get();
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