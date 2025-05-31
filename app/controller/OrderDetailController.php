<?php

namespace App\Controller;


use App\Model\OrderDetail;
include_once __DIR__.'/../model/OrderDetail.php';


class OrderDetailController {

    protected $model;
    public function __construct()
    {
        $this->model = new OrderDetail();
    }
    
    public function index()
    {
        return $this->model->all(
            '*,order_details.id as id ,orders_details.created_at as tanggal,stok_barangs.name as barang'
        )
        ->with('barangDesc')
        ->get();
    }

    public function store($request)
    {
        return $this->model->create($request);
    }

    public function show($id)
    {
        if(!$id)
        {
            return null;
        }
        $row = $this->model->all('*,barangs.name as barang')
        ->with('barangDesc')->where('order_id',' = ',$id)->get();
        return $row ?? null;
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

    public function deleteByOrderId($id)
    {
        $order_detail = $this->model->all()->where('order_id',' = ',$id)->get();
        foreach ($order_detail as $row) {
            $this->destroy($row['id']);
        }
    }
}