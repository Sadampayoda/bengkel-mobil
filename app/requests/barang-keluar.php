<?php


use App\Controller\BarangKeluarController;
use App\Controller\StokController;

header('Content-Type: application/json');


include_once __DIR__.'/../controller/BarangKeluarController.php';
include_once __DIR__.'/../controller/StokController.php';

$barang_keluar = new BarangKeluarController();
$stok = new StokController();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    try {
        $barang_keluar->store($_POST);

        $data = $stok->show($_POST['barang_id']);
        $stok->update([
            'stok' => $data['stok'] - $_POST['jumlah'],
        ],$_POST['barang_id']);
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
        $barang_keluar->update( $putData,$putData['id']);
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
        $barang_keluar->destroy($data['id']);
        echo json_encode(['success' => true, 'message' => 'Data berhasil di hapus','data' => $data]);
        exit;
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit;
        //throw $th;
    }

}