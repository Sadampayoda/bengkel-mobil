<?php

namespace App\Controller;

use App\Model\Mekanik;
use App\Model\Order;
include_once __DIR__.'/../model/Order.php';
include_once __DIR__.'/../model/Mekanik.php';


class StatusController {

    protected $model, $mekanik;
    public function __construct()
    {
        $this->model = new Order();
        $this->mekanik = new Mekanik();
    }
    
    public function index()
    {
    
        return [
            'mekanik' => $this->mekanik->all()->count(),
            'proses' => $this->model->all()->where('status',' = ','proses')->count(),
            'tertunda' => $this->model->all()->where('status',' = ','tertentu')->count(),
            'selesai' => $this->model->all()->where('status',' = ','selesai')->count(),
        ];
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

    public function get($id = null)
    {
        if($id)
        {
            $data = $this->model->all()->where('id','=',$id)->get();
            return $data[0];
        }
        return $this->model->all()->where('stok','>',20)->get();
    }
}