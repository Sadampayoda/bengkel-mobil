<?php ob_start() ;

use App\Controller\JenisSatuanController;

$editMode = isset($_GET['id']);
$id = $_GET['id'] ?? null;

?>



<h3 class="font-medium text-4xl ms-5"><?= $editMode ? 'Edit' : 'Tambah' ?> Jenis Barang</h3>
<?php

use App\Repository\FormRepository;

include __DIR__ . '/../../app/repository/formRepository.php';
include __DIR__.'/../../app/controller/JenisSatuanController.php';

$controller = new JenisSatuanController();
$data = $controller->show($id);

$method = $editMode ? 'PUT' : "POST";

$form = new FormRepository('form-jenis', $method, '', 'formJenis');

$input = [
    [
        'label' => 'Nama Jenis',
        'name' => 'name',
        'id' => 'name',
        'placeholder' => 'Nama Jenis',
        'required' => true,
        'value' => @$data['name'],
    ]
];


include __DIR__ . '/../../components/form.php';
?>



<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>