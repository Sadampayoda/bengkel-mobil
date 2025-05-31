<?php

use App\Controller\BarangController;
header('Content-Type: application/json');


include __DIR__.'/../controller/BarangController.php';

$barang = new BarangController();
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    try {
        $barang->store($_POST);
        echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan','data' => $_POST]);
        exit;
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit;
    }

}

if($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    try {
        parse_str(file_get_contents("php://input"), $putData);
        $barang->update( $putData,$putData['id']);
        echo json_encode(['success' => true, 'message' => 'Data berhasil di ubah','data' => $putData]);
        exit;
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit;
    }
}

if($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    try {
        parse_str(file_get_contents("php://input"), $data);
        $barang->destroy($data['id']);
        echo json_encode(['success' => true, 'message' => 'Data berhasil di hapus','data' => $data]);
        exit;
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit;
        //throw $th;
    }

}