<?php 
use App\Controller\BarangController;
header('Content-Type: application/json');


include __DIR__.'/../controller/BarangController.php';

$barang = new BarangController();


if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    try{
        $data = $barang->generateCodeItem();
        echo json_encode(['success' => true, 'message' => 'Api berhasil','data' => $data]);
        exit;
    }catch(Exception $e)
    {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit;
    }
}

