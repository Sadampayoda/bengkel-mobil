<?php


use App\Controller\BarangMasukController;
use App\Controller\StokController;

header('Content-Type: application/json');


include_once __DIR__.'/../controller/BarangMasukController.php';
include_once __DIR__.'/../controller/StokController.php';

$barang_masuk = new BarangMasukController();
$stok = new StokController();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    try {
        $barang_masuk->store($_POST);

        $data = $stok->show($_POST['barang_id']);
        $stok->update([
            'stok' => $data['stok'] + $_POST['jumlah'],
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
        $oldData = $barang_masuk->show($putData['id']);
        $dataStok = $stok->show($putData['barang_id']);

        $barang_masuk->update( $putData,$putData['id']);

    
        $stokNow = $putData['jumlah'] - $oldData['jumlah'];

        $stok->update([
            'stok' => $dataStok['stok'] + ($stokNow)
        ],$putData['barang_id']);

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
        $dataIn = $barang_masuk->show($data['id']);
        $dataStok = $stok->show($dataIn['barang_id']);
        $barang_masuk->destroy($data['id']);

        $stok->update([
            'stok' => $dataStok['stok'] - $dataIn['jumlah']
        ],$dataIn['barang_id']);
        echo json_encode(['success' => true, 'message' => 'Data berhasil di hapus','data' => $data]);
        exit;
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit;
        //throw $th;
    }

}