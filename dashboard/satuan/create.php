<?php ob_start() ;

use App\Controller\SatuanController;


$editMode = isset($_GET['id']);
$id = $_GET['id'] ?? null;

?>



<h3 class="font-medium text-4xl ms-5"><?= $editMode ? 'Edit' : 'Tambah' ?> Satuan Barang</h3>
<?php

use App\Repository\FormRepository;

include __DIR__ . '/../../app/repository/formRepository.php';
include __DIR__.'/../../app/controller/SatuanController.php';

$controller = new SatuanController();
$data = $controller->show($id);

$method = $editMode ? 'PUT' : "POST";

$form = new FormRepository('form-jenis', $method, '', 'formSatuan');

$input = [
    [
        'label' => 'Nama Satuan',
        'name' => 'name',
        'id' => 'name',
        'placeholder' => 'Nama Satuan',
        'required' => true,
        'value' => @$data['name'],
    ],
];


include __DIR__ . '/../../components/form.php';
?>



<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>