<?php 
use App\Controller\StokController;
header('Content-Type: application/json');


include __DIR__.'/../controller/StokController.php';

$stok = new StokController();


if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    try{
        if(isset($_GET['id'])){
            $data = $stok->get($_GET['id']);
        }else{
            $data = $stok->get();
        }
        echo json_encode(['success' => true, 'message' => 'Data berhasil di hapus','data' => $data]);
        exit;
    }catch(Exception $e)
    {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit;
    }
}