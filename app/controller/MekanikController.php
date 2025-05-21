<?php

namespace App\Controller;

use App\Model\Mekanik;
include_once __DIR__.'/../model/Mekanik.php';


class MekanikController {

    protected $model;
    public function __construct()
    {
        $this->model = new Mekanik();
    }
    
    public function index()
    {
        if(isset($_GET['search']))
        {
            return $this->model->all('*,mekaniks.created_at as tanggal')
            ->where('name','LIKE','%'.$_GET['search'].'%')->get();
        }
        return $this->model->all('*,mekaniks.created_at as tanggal')->get();
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