<?php

namespace App\Controller;

use App\Model\StokBarang;

include_once __DIR__ . '/../model/StokBarang.php';


class StokController
{

    protected $model, $type;
    public function __construct()
    {
        $this->model = new StokBarang();
    }

    public function index()
    {
        if (isset($_GET['search'])) {
            return $this->model->all('*,stok_barangs.id as id,stok_barangs.name as name ,jenis.name as jenis,satuans.name as satuan')
                ->with('jenisDesc')
                ->with('satuanDesc')
                ->where('stok_barangs.name', 'LIKE', '%' . $_GET['search'] . '%')->get();
        }
        return $this->model->all('*,stok_barangs.id as id,stok_barangs.name as name ,jenis.name as jenis, satuans.name as satuan')
            ->with('satuanDesc')
            ->with('jenisDesc')->get();
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

    public function get($id = null)
    {
        if ($id) {
            $data = $this->model->all()->where('id', '=', $id)->get();
            return $data[0];
        }
        return $this->model->all()->where('stok', '>', 20)->get();
    }

    public function stok()
    {
        $data = $this->index();
        $alert = [];
        foreach ($data as $item) {
            if($item['stok'] < 20)
            {
                $alert[] = ' Stock Barang '.$item['name'].' akan segera habis ';
            }
        }

        return $alert;
    }
}
