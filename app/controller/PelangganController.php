<?php

namespace App\Controller;

use App\Model\Pelanggan;

include_once __DIR__.'/../model/Pelanggan.php';


class PelangganController {

    protected $model;
    public function __construct()
    {
        $this->model = new Pelanggan();
    }
    
    public function index()
    {
        if(isset($_GET['search']))
        {
            return $this->model->all()
            ->where('name','LIKE','%'.$_GET['search'].'%')->get();
        }
        return $this->model->all()->get();
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