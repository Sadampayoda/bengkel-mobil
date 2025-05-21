<?php

namespace App\Controller;


use App\Model\Order;

include_once __DIR__ . '/../model/Order.php';


class OrderController
{

    protected $model;
    public function __construct()
    {
        $this->model = new Order();
    }

    public function index()
    {
        if (isset($_GET['search'])) {
            $this->model->all(
                '*,orders.id as id ,orders.created_at as tanggal,pelanggans.name as pelanggan,mekaniks.name as mekanik'
            )
                ->with('pelangganDesc')
                ->with('mekanikDesc')
                ->where('name', 'LIKE', '%' . $_GET['search'] . '%')->get()
                ->get();
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
}
