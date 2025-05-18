<?php ob_start() ;

use App\Controller\StokController;

use App\Controller\SupplierController;

use App\Controller\BarangMasukController;

use App\Controller\JenisSatuanController;

$editMode = isset($_GET['id']);
$id = $_GET['id'] ?? null;

?>



<h3 class="font-medium text-4xl ms-5"><?= $editMode ? 'Edit' : 'Tambah' ?> Barang Masuk</h3>
<?php

use App\Repository\FormRepository;

include __DIR__ . '/../../app/repository/formRepository.php';
include_once __DIR__.'/../../app/controller/BarangMasukController.php';
include_once __DIR__ . '/../../app/controller/JenisSatuanController.php';
include_once __DIR__ . '/../../app/controller/StokController.php';
include_once __DIR__ .'/../../app/controller/SupplierController.php';

$controller = new BarangMasukController();
$data = $controller->show($id);

$jenisSatuan = new JenisSatuanController();
$barang = new StokController();
$supplier = new SupplierController();
// var_dump($jenisSatuan->index('satuan'));

$method = $editMode ? 'PUT' : "POST";

$form = new FormRepository('form-stok', $method, '', 'formBarangMasuk');

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
        'label' => 'Jenis',
        'name' => 'jenis_id',
        'type' => 'select',
        'id' => 'jenis_id',
        'data' => $jenisSatuan->index('jenis'),
        'placeholder' => 'Pilih Jenis',
        'required' => true,
        'value' => @$data['jenis_id'],
    ],
    [
        'label' => 'Pilih Supplier',
        'name' => 'supplier_id',
        'type' => 'select',
        'id' => 'supplier_id',
        'data' => $supplier->index(),
        'placeholder' => 'Pilih Supplier',
        'required' => true,
        'value' => @$data['supplier_id'],
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