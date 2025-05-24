<?php ob_start() ;

use App\Controller\SatuanController;
use App\Controller\JenisController;
use App\Controller\StokController;

$editMode = isset($_GET['id']);
$id = $_GET['id'] ?? null;

?>



<h3 class="font-medium text-4xl ms-5"><?= $editMode ? 'Edit' : 'Tambah' ?> Stok Barang</h3>
<?php

use App\Repository\FormRepository;

include __DIR__ . '/../../app/repository/formRepository.php';
include_once __DIR__.'/../../app/controller/StokController.php';
include_once __DIR__ . '/../../app/controller/JenisController.php';
include_once __DIR__ . '/../../app/controller/SatuanController.php';

$controller = new StokController();
$data = $controller->show($id);

$jenis = new JenisController();
$satuan = new SatuanController();
// var_dump($jenisSatuan->index('satuan'));

$method = $editMode ? 'PUT' : "POST";

$form = new FormRepository('form-stok', $method, '', 'formStok');

$input = [
    [
        'label' => 'Nama Barang',
        'name' => 'name',
        'id' => 'name',
        'placeholder' => 'Nama Barang',
        'required' => true,
        'value' => @$data['name'],
    ],
    [
        'label' => 'Jenis',
        'name' => 'jenis_id',
        'type' => 'select',
        'id' => 'jenis_id',
        'data' => $jenis->index(),
        'placeholder' => 'Pilih Jenis',
        'required' => true,
        'value' => @$data['jenis_id'],
    ],
    [
        'label' => 'Satuan',
        'name' => 'satuan_id',
        'type' => 'select',
        'id' => 'satuan_id',
        'data' => $satuan->index(),
        'placeholder' => 'Pilih Satuan',
        'required' => true,
        'value' => @$data['satuan_id'],
    ],
    [
        'label' => 'Total Stok',
        'name' => 'stok',
        'id' => 'stok',
        'type' => 'number',
        'placeholder' => 'Total Stok Barang',
        'required' => true,
        'value' => @$data['stok'],
    ],
    [
        'label' => 'Harga',
        'name' => 'harga',
        'id' => 'harga',
        'type' => 'number',
        'placeholder' => 'Harga Barang',
        'required' => true,
        'value' => @$data['harga'],
    ],
];

include __DIR__ . '/../../components/form.php';
?>



<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>