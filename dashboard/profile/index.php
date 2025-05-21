<?php 
ob_start();

?>


<h3 class="font-medium text-4xl ms-5">Edit Profile</h3>
<?php

use App\Repository\FormRepository;

include __DIR__ . '/../../app/repository/formRepository.php';


$form = new FormRepository('form-profile', 'POST', '', 'formProfile');

$input = [
    [
        'label' => 'Nama',
        'name' => 'name',
        'id' => 'name',
        'placeholder' => 'Nama',
        'required' => true,
        'value' => @$_SESSION['user']['name'],
    ],
    [
        'label' => 'Email',
        'name' => 'email',
        'id' => 'email',
        'placeholder' => 'Email',
        'required' => true,
        'value' => @$_SESSION['user']['email'],
    ],
    [
        'label' => 'Password Lama',
        'name' => 'old_password',
        'id' => 'old_password',
        'placeholder' => 'Password Lama',
        'required' => true,
    ],
    [
        'label' => 'Password Baru',
        'name' => 'password',
        'id' => 'password',
        'placeholder' => 'Password Baru',
        'required' => true,
    ],
    [
        'label' => 'Password Konfirmasi',
        'name' => 'konfirmasi',
        'id' => 'konfirmasi',
        'placeholder' => 'Password Konfirmasi',
        'required' => true,
    ],
];

include __DIR__ . '/../../components/form.php';
?>



<?php $content = ob_get_clean();

include __DIR__ . '/../../components/index.php';
?>