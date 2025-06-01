<?php 

use App\Controller\BarangMasukController;


include __DIR__.'/../../../app/controller/BarangMasukController.php';
$data = new BarangMasukController();

ob_start() ?>



<?php


$title = 'Laporan Barang Masuk';
include __DIR__ . '/../../../app/repository/tableRepository.php';
$table = new TableRepository(['tanggal','nama_barang','jenis','satuan','jumlah'],$data->index(),'onEditBarangMasuk','onDeleteBarangMasuk',false,'onPrintBarangMasuk');

$search = '/dashboard/laporan/barang-masuk/';

include __DIR__ . '/../../../components/table.php'
?>

<?php
?>

<?php $content = ob_get_clean();
include __DIR__ . '/../../../components/index.php';
?>