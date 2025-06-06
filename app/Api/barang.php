<?php

use App\Controller\BarangController;

header('Content-Type: application/json');


include __DIR__.'/../controller/BarangController.php';

$barags = new BarangController();


if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    try{
        if(isset($_GET['id'])){
            $data = $barags->get($_GET['id']);
        }else{
            $data = $barags->get();
        }
        echo json_encode(['success' => true, 'message' => 'Api berhasil','data' => $data]);
        exit;
    }catch(Exception $e)
    {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit;
    }
}