<?php

use App\Controller\PelangganController;

include __DIR__.'/../../app/controller/PelangganController.php';
$data = new PelangganController();

ob_start() ?>



<?php

// var_dump($data->index());
$title = 'Data Pelanggan';
include __DIR__ . '/../../app/repository/tableRepository.php';
$table = new TableRepository(['name','alamat','telepon','active'],$data->index(),'onEditPelanggan','onDeletePelanggan');


$search = '/dashboard/pelanggan/';

include __DIR__ . '/../../components/table.php'
?>

<?php
?>

<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>