<?php

namespace App\Controller;

use App\Model\Barang;
include_once __DIR__ . '/../model/Barang.php';


class BarangController
{

    protected $model;
    public function __construct()
    {
        $this->model = new Barang();
    }

    public function index()
    {
    
        if (isset($_GET['search'])) {
            return $this->model->all('*,barangs.id as id,barangs.name as name, suppliers.name as nama_supplier')
                ->with('supplierDesc')
                ->where('barangs.name', 'like', '%'.$_GET['search'].'%')
                ->get();

        }


        return $this->model->all('*,barangs.id as id,barangs.name as name, suppliers.name as nama_supplier')
            ->with('supplierDesc')
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
        $row = $this->model->all('*,barangs.id as id,barangs.name as name, suppliers.name as nama_supplier')
            ->with('supplierDesc')
            ->where('barangs.id', ' = ', $id)
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

    public function get($id = null)
    {
        if ($id) {
            $data = $this->model->all()
            ->where('id', '=', $id)->get();
            return $data[0];
        }
        return $this->model->all()->get();
    }

    public function generateCodeItem()
    {
        $number = '0000';
        $data = $this->model->all()->where('DATE(created_at)', ' = ', date('Y-m-d'))->count() + 1;
        $number = substr($number, 0, -strlen($data));
        $kode = 'BRG-' . date('ymd') . '-' . $number . '' . $data;
        return $kode;

    }


}