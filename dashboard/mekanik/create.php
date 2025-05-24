<?php ob_start();



$editMode = isset($_GET['id']);
$id = $_GET['id'] ?? null;

?>


<h3 class="font-medium text-4xl ms-5"><?= $editMode ? 'Edit' : 'Tambah' ?> Mekanik</h3>
<?php

use App\Controller\MekanikController;
use App\Repository\FormRepository;

include __DIR__ . '/../../app/repository/formRepository.php';
include_once __DIR__ . '/../../app/controller/MekanikController.php';

$controller = new MekanikController();
$data = $controller->show($id);

$method = $editMode ? 'PUT' : "POST";

$form = new FormRepository('form-supplier', $method, '', 'formMekanik');

$input = [
    [
        'label' => 'Nama Mekanik',
        'name' => 'name',
        'id' => 'name',
        'placeholder' => 'Nama Mekanik',
        'required' => true,
        'value' => @$data['name'],
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
        'placeholder' => 'Status Mekanik',
        'value' => 1,
    ],
];

include __DIR__ . '/../../components/form.php';
?>



<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>