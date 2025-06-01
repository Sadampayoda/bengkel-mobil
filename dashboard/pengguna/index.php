<?php

use App\Controller\PenggunaController;

include __DIR__.'/../../app/controller/PenggunaController.php';
$data = new PenggunaController();

ob_start() ?>



<?php

// var_dump($data->index());
$title = 'Data Pengguna';
include __DIR__ . '/../../app/repository/tableRepository.php';
$table = new TableRepository(['name','email'],$data->index(),'onEditPengguna','onDeletePengguna');


$search = '/dashboard/pengguna/';

include __DIR__ . '/../../components/table.php'
?>

<?php
?>

<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>