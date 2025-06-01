<?php 

use App\Controller\StokController;


include __DIR__.'/../../app/controller/StokController.php';
$data = new StokController();

ob_start() ?>



<?php

$search = '/dashboard/stok/';
// var_dump($data->index());
$title = 'Stok Barang';
include __DIR__ . '/../../app/repository/tableRepository.php';
$table = new TableRepository(['nama_barang','stok'],$data->index(),'onEditStok','onDeleteStok');

$alert = $data->stok();


include __DIR__ . '/../../components/table.php'
?>

<?php
?>

<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>