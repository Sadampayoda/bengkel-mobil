<?php

namespace App\Controller;
use App\Model\JenisSatuan;
include __DIR__.'/../model/JenisSatuan.php';

class JenisSatuanController {

    protected $model;
    public function __construct()
    {
        $this->model = new JenisSatuan();
    }
    
    public function index($type = 'jenis')
    {
        return $this->model->all()->where('type',' = ',$type)->get();
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
        return $row ? $row[0] : null;
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