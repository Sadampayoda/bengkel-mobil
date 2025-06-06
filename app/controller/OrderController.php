<?php

namespace App\Controller;


use App\Model\Order;
use App\Model\OrderDetail;

include_once __DIR__ . '/../model/Order.php';
include_once __DIR__ . '/../model/OrderDetail.php';


class OrderController
{

    protected $model, $orderDetail;
    public function __construct()
    {
        $this->model = new Order();
        $this->orderDetail = new OrderDetail();
    }

    public function index()
    {
        if (isset($_GET['search'])) {
            $search = $this->model->all(
                '*,orders.id as id ,orders.created_at as tanggal,pelanggans.name as pelanggan,mekaniks.name as mekanik'
            )
                ->with('pelangganDesc')
                ->with('mekanikDesc')
                ->search([
                    'pelanggans.name',
                    'orders.kendaraan',
                    'orders.plat_nomer',
                    'orders.transmisi',
                    'orders.telepon',
                    'orders.jasa_servis',
                    'orders.total_harga_jasa',
                    'orders.total_harga_barang',
                    'orders.total_harga_keseluruhan',
                    'orders.status',
                ],$_GET['search'])
                ->get();
            return $search ?? [];
        }
        if (isset($_GET['start']) || isset($_GET['end'])) {

            return $this->model->all(
            '*,orders.id as id ,orders.created_at as tanggal,pelanggans.name as pelanggan,mekaniks.name as mekanik')
                ->with('pelangganDesc')
                ->with('mekanikDesc')
                ->whereBetween('orders.created_at', $_GET['start'], $_GET['end'])
                ->get();
        }
        return $this->model->all(
            '*,orders.id as id ,orders.created_at as tanggal,pelanggans.name as pelanggan,mekaniks.name as mekanik'
        )
            ->with('pelangganDesc')
            ->with('mekanikDesc')
            ->get();
    }

    public function store($request)
    {
        return $this->model->create($request);
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

    public function print($id)
    {
        $data = $this->model->all(
            '*,orders.id as id ,orders.created_at as tanggal,pelanggans.name as pelanggan,mekaniks.name as mekanik'
        )
            ->with('pelangganDesc')
            ->with('mekanikDesc')
            ->where('orders.id', ' = ', $id)
            ->get();

        return $data[0] ?? null;
    }

    public function orderDetailFirst($id)
    {
        
        $order_detail =  $this->orderDetail->all('*,order_details.id as id, barangs.name as nama_barang')
        ->with('barangDesc')->where('order_id',' = ',$id)->get();
    
        return $order_detail[0] ?? null;
    }
}
