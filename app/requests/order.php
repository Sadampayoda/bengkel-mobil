<?php

use App\Controller\OrderController;
use App\Controller\OrderDetailController;

header('Content-Type: application/json');

include_once __DIR__ . '/../controller/OrderController.php';
include_once __DIR__ . '/../controller/OrderDetailController.php';

$order = new OrderController();
$order_detail = new OrderDetailController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $order->store([
            'pelanggan_id' => $data['pelanggan_id'],
            'kendaraan' => $data['kendaraan'],
            'plat_nomer' => $data['plat_nomer'],
            'transmisi' => $data['transmisi'],
            'telepon' => $data['telepon'],
            'jasa_servis' => $data['jasa_servis'],
            'total_harga_jasa' => $data['total_harga_jasa'],
            'total_harga_barang' => $data['total_harga_barang'],
            'total_harga_keseluruhan' => $data['total_harga_keseluruhan'],
            'status' => $data['status'],
            'mekanik_id' => $data['mekanik_id'],
        ]);


        foreach ($data['details'] as $item) {
            $order_detail->store([
                'order_id' => $id,
                'barang_id' => $item['barang_id'],
                'harga' => $item['harga'],
                'jumlah' => $item['jumlah'],
            ]);
        }
        echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan', 'data' => $data]);
        exit;
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    try {
        $data = json_decode(file_get_contents("php://input"), true);

        $order->update([
            'pelanggan_id' => $data['pelanggan_id'],
            'kendaraan' => $data['kendaraan'],
            'plat_nomer' => $data['plat_nomer'],
            'transmisi' => $data['transmisi'],
            'telepon' => $data['telepon'],
            'jasa_servis' => $data['jasa_servis'],
            'total_harga_jasa' => $data['total_harga_jasa'],
            'total_harga_barang' => $data['total_harga_barang'],
            'total_harga_keseluruhan' => $data['total_harga_keseluruhan'],
            'status' => $data['status'],
            'mekanik_id' => $data['mekanik_id'],
        ], $data['id']);

        $order_detail->deleteByOrderId($data['id']);

        foreach ($data['details'] as $item) {
            $order_detail->store([
                'order_id' => $data['id'],
                'barang_id' => $item['barang_id'],
                'harga' => $item['harga'],
                'jumlah' => $item['jumlah'],
            ]);
        }
        echo json_encode(['success' => true, 'message' => 'Data berhasil di ubah', 'data' => $data]);
        exit;
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        parse_str(file_get_contents("php://input"), $data);
        $order->destroy($data['id']);
        $order_detail->deleteByOrderId($data['id']);
        echo json_encode(['success' => true, 'message' => 'Data berhasil di hapus', 'data' => $data]);
        exit;
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit;
        //throw $th;
    }
}
