<?php ob_start();

use App\Controller\PenggunaController;


$editMode = isset($_GET['id']);
$id = $_GET['id'] ?? null;

?>


<h3 class="font-medium text-4xl ms-5"><?= $editMode ? 'Edit' : 'Tambah' ?> Pengguna</h3>
<?php

use App\Repository\FormRepository;

include __DIR__ . '/../../app/repository/formRepository.php';
include_once __DIR__ . '/../../app/controller/PenggunaController.php';

$controller = new PenggunaController();
$data = $controller->show($id);

$method = $editMode ? 'PUT' : "POST";

$form = new FormRepository('form-pengguna', $method, '', 'formPengguna');

$input = [
    [
        'label' => 'Username',
        'name' => 'name',
        'id' => 'name',
        'placeholder' => 'Username',
        'required' => true,
        'value' => @$data['name'],
    ],
    [
        'label' => 'email',
        'name' => 'email',
        'id' => 'email',
        'type' => 'email',
        'placeholder' => 'Email',
        'required' => true,
        'value' => @$data['email'],
    ],
    [
        'label' => 'Password',
        'name' => 'password',
        'type' => 'password',
        'placeholder' => 'Password',
        'required' => true,
    ],
];

include __DIR__ . '/../../components/form.php';
?>



<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>