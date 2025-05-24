<?php 

use App\Controller\SatuanController;
include __DIR__.'/../../app/controller/SatuanController.php';
$data = new SatuanController();

ob_start() ?>



<?php

$title = 'Satuan Barang';
include __DIR__ . '/../../app/repository/tableRepository.php';
$table = new TableRepository(['name'],$data->index(),'onEditSatuan','onDeleteSatuan');


$search = '/dashboard/satuan/';


include __DIR__ . '/../../components/table.php'
?>

<?php
?>

<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>