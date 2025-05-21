<?php

use App\Controller\SupplierController;

include __DIR__.'/../../../app/controller/SupplierController.php';
$data = new SupplierController();
$search = '/dashboard/laporan/supplier/';
ob_start() ?>



<?php

// var_dump($data->index());
$title = 'Laporan Supplier';
include __DIR__ . '/../../../app/repository/tableRepository.php';
$table = new TableRepository(['name','alamat','telepon','active'],$data->index(),'onEditSupplier','onDeleteSupplier',false);



include __DIR__ . '/../../../components/table.php'
?>

<?php
?>

<?php $content = ob_get_clean();
include __DIR__ . '/../../../components/index.php';
?>