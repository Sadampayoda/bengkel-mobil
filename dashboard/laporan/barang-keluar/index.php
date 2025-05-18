<?php 

use App\Controller\BarangKeluarController;


include __DIR__.'/../../../app/controller/BarangKeluarController.php';
$data = new BarangKeluarController();

ob_start() ?>



<?php

// var_dump($data->index());
$title = 'Laporan Barang Keluar';
include __DIR__ . '/../../../app/repository/tableRepository.php';
$table = new TableRepository(['tanggal','barang','penerima','jumlah'],$data->index(),'onEditBarangKeluar','onDeleteBarangKeluar',false);



include __DIR__ . '/../../../components/table.php'
?>

<?php
?>

<?php $content = ob_get_clean();
include __DIR__ . '/../../../components/index.php';
?>