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
        if (isset($_GET['start']) || isset($_GET['end'])) {
            return $this->model->all('*,stok_barangs.created_at as tanggal,stok_barangs.id as id,barangs.name as nama_barang')
                ->with('barangDesc')
                ->whereBetween('stok_barangs.created_at', $_GET['start'], $_GET['end'])
                ->get();
        }
        if (isset($_GET['search'])) {
            return $this->model->all('*,stok_barangs.created_at as tanggal,stok_barangs.id as id,barangs.name as nama_barang')
                ->with('barangDesc')
                ->where('stok_barangs.name', 'LIKE', '%' . $_GET['search'] . '%')->get();
        }
        return $this->model->all('*,stok_barangs.created_at as tanggal, stok_barangs.id as id,barangs.name as nama_barang')
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
        $row = $this->model->all('*,stok_barangs.created_at as tanggal, stok_barangs.id as id,barangs.name as nama_barang')
        ->where('stok_barangs.id', ' = ', $id)->get();
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
            $data = $this->model->all('stok_barangs.*,stok_barangs.id as id, stok_barangs.name as name, jenis.id as jenis_id, jenis.name as jenis_name')
                ->with('jenisDesc')->where('stok_barangs.id', '=', $id)->get();
            return $data[0];
        }
        return $this->model->all()->where('stok', '>', 20)->get();
    }

    public function stok()
    {
        $data = $this->index();
        $alert = [];
        if (isset($data) && count($data) > 0) {
            foreach ($data as $item) {
                if ($item['stok'] < 20) {
                    $alert[] = ' Stock Barang ' . $item['name'] . ' akan segera habis ';
                }
            }
        }

        return $alert ?? null;
    }
}
