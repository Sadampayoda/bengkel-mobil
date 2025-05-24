<?php ob_start() ;

use App\Controller\BarangKeluarController;

use App\Controller\StokController;


$editMode = isset($_GET['id']);
$id = $_GET['id'] ?? null;

?>



<h3 class="font-medium text-4xl ms-5"><?= $editMode ? 'Edit' : 'Tambah' ?> Barang Keluar</h3>
<?php

use App\Repository\FormRepository;

include __DIR__ . '/../../app/repository/formRepository.php';

include_once __DIR__ . '/../../app/controller/BarangKeluarController.php';
include_once __DIR__ . '/../../app/controller/StokController.php';

$controller = new BarangKeluarController();
$data = $controller->show($id);

$barang = new StokController();


$method = $editMode ? 'PUT' : "POST";

$form = new FormRepository('form-stok', $method, '', 'formBarangKeluar');

$input = [
    [
        'label' => 'Nama Barang',
        'name' => 'barang_id',
        'id' => 'barang_id',
        'type' => 'select',
        'placeholder' => 'Pilih Barang',
        'data' => $barang->index(),
        'required' => true,
        'value' => @$data['barang_id'],
    ],
    [
        'label' => 'Penerima',
        'name' => 'penerima',
        'type' => 'text',
        'id' => 'penerima',
        'placeholder' => 'Nama Penerima',
        'required' => true,
        'value' => @$data['penerima'],
    ],
    [
        'label' => 'Jumlah',
        'name' => 'jumlah',
        'id' => 'jumlah',
        'type' => 'number',
        'placeholder' => 'Jumlah stok',
        'required' => true,
        'value' => @$data['jumlah'],
    ],
];

include __DIR__ . '/../../components/form.php';
?>



<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>