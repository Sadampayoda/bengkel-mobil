<?php 

use App\Controller\JenisSatuanController;
include __DIR__.'/../../app/controller/JenisSatuanController.php';
$data = new JenisSatuanController();

ob_start() ?>



<?php

$title = 'Jenis Barang';
include __DIR__ . '/../../app/repository/tableRepository.php';
$table = new TableRepository(['name'],$data->index(),'onEditJenis','onDeleteJenis');

$search = '/dashboard/jenis/';

include __DIR__ . '/../../components/table.php'
?>

<?php
?>

<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>