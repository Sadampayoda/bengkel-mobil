<?php

use App\Controller\BarangController;

include __DIR__.'/../../app/controller/BarangController.php';
$data = new BarangController();

ob_start() ?>



<?php


$title = 'Data Barang';
include __DIR__ . '/../../app/repository/tableRepository.php';
$table = new TableRepository(['kode','name','jenis','satuan','harga','nama_supplier'],$data->index(),'onEditBarang','onDeleteBarang');


$search = '/dashboard/barang/';
include __DIR__ . '/../../components/table.php'
?>

<?php
?>

<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>