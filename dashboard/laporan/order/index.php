<?php 

use App\Controller\OrderController;




include __DIR__.'/../../../app/controller/OrderController.php';
$data = new OrderController();
$search = '/dashboard/laporan/order';
ob_start() ?>



<?php

// var_dump($data->index());
$title = 'Laporan Orderan Servis';
include __DIR__ . '/../../../app/repository/tableRepository.php';
$table = new TableRepository(['tanggal','pelanggan','kendaraan','plat_nomer','transmisi','telepon','jasa_servis','total_harga_jasa','total_harga_barang','total_harga_keseluruhan','status','mekanik','invoice'],$data->index(),'onEditOrder','onDeleteOrder',false);



include __DIR__ . '/../../../components/table.php'
?>

<?php
?>

<?php $content = ob_get_clean();
include __DIR__ . '/../../../components/index.php';
?>