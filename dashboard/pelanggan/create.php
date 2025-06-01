<?php ob_start();

use App\Controller\PelangganController;



$editMode = isset($_GET['id']);
$id = $_GET['id'] ?? null;

?>


<h3 class="font-medium text-4xl ms-5"><?= $editMode ? 'Edit' : 'Tambah' ?> Pelanggan</h3>
<?php

use App\Repository\FormRepository;

include __DIR__ . '/../../app/repository/formRepository.php';
include_once __DIR__ . '/../../app/controller/PelangganController.php';

$controller = new PelangganController();
$data = $controller->show($id);

$method = $editMode ? 'PUT' : "POST";

$form = new FormRepository('form-supplier', $method, '', 'formPelanggan');

$input = [
    [
        'label' => 'Nama Pelanggan',
        'name' => 'name',
        'id' => 'name',
        'placeholder' => 'Nama Pelanggan',
        'required' => true,
        'value' => @$data['name'],
    ],
    [
        'label' => 'Alamat',
        'name' => 'alamat',
        'id' => 'alamat',
        'placeholder' => 'Alamat Pelanggan',
        'required' => true,
        'value' => @$data['alamat'],
    ],
    [
        'label' => 'No Telepon',
        'name' => 'telepon',
        'type' => 'number',
        'placeholder' => 'Nomer Telepon',
        'required' => true,
        'value' => @$data['telepon'],
    ],
    [
        'label' => 'Aktif',
        'name' => 'active',
        'id' => 'active',
        'type' => 'hidden',
        'placeholder' => 'Status Pelanggan',
        'value' => 1,
    ],
];

include __DIR__ . '/../../components/form.php';
?>



<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>