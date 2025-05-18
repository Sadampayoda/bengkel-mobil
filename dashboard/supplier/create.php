<?php ob_start();



$editMode = isset($_GET['id']);
$id = $_GET['id'] ?? null;

?>


<h3 class="font-medium text-4xl ms-5"><?= $editMode ? 'Edit' : 'Tambah' ?> Suppliar</h3>
<?php

use App\Controller\SupplierController;
use App\Repository\FormRepository;

include __DIR__ . '/../../app/repository/formRepository.php';
include_once __DIR__ . '/../../app/controller/SupplierController.php';

$controller = new SupplierController();
$data = $controller->show($id);

$method = $editMode ? 'PUT' : "POST";

$form = new FormRepository('form-supplier', $method, '', 'formSupplier');

$input = [
    [
        'label' => 'Nama Supplier',
        'name' => 'name',
        'id' => 'name',
        'placeholder' => 'Nama Supplier',
        'required' => true,
        'value' => @$data['name'],
    ],
    [
        'label' => 'Alamat',
        'name' => 'alamat',
        'id' => 'alamat',
        'placeholder' => 'Alamat Supplier',
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
        'type' => $editMode ? 'select' : 'hidden',
        'placeholder' => 'Status Supplier',
        'data' => [
            [
                'id' => 1,
                'name' => 'Aktif',
            ],
            [
                'id' => 0,
                'name' => 'Tidak Aktif',
            ],
    
        ],
        'value' => $editMode ? (@$data['active'] == 'Aktif' ? 1 : 0) : 1,
    ],
];

include __DIR__ . '/../../components/form.php';
?>



<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>