<?php 

use App\Controller\StokController;


include __DIR__.'/../../app/controller/StokController.php';
$data = new StokController();

ob_start() ?>



<?php

// var_dump($data->index());
$title = 'Stok Barang';
include __DIR__ . '/../../app/repository/tableRepository.php';
$table = new TableRepository(['name','jenis','satuan_id','harga','stok'],$data->index(),'onEditStok','onDeleteStok');



include __DIR__ . '/../../components/table.php'
?>

<?php
?>

<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>