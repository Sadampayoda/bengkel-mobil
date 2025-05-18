<?php

namespace App\Controller;

use App\Model\StokBarang;
include_once __DIR__.'/../model/StokBarang.php';


class StokController {

    protected $model, $type;
    public function __construct()
    {
        $this->model = new StokBarang();
    }
    
    public function index()
    {
        return $this->model->all('*,stok_barangs.id as id,stok_barangs.name as name ,jenis_satuans.name as jenis')
        ->with('jenisDesc')->get();
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