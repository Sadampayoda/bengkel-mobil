<?php

use App\Controller\SupplierController;

include __DIR__.'/../../app/controller/SupplierController.php';
$data = new SupplierController();

ob_start() ?>



<?php

// var_dump($data->index());
$title = 'Data Supplier';
include __DIR__ . '/../../app/repository/tableRepository.php';
$table = new TableRepository(['tanggal','name','alamat','telepon','active'],$data->index(),'onEditSupplier','onDeleteSupplier');


$search = '/dashboard/supplier/';
include __DIR__ . '/../../components/table.php'
?>

<?php
?>

<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>