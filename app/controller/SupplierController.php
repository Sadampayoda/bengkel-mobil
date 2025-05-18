<?php

namespace App\Controller;

use App\Model\Supplier;
include_once __DIR__.'/../model/Supplier.php';


class SupplierController {

    protected $model;
    public function __construct()
    {
        $this->model = new Supplier();
    }
    
    public function index()
    {
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