<?php

use App\Controller\MekanikController;

include __DIR__.'/../../app/controller/MekanikController.php';
$data = new MekanikController();

ob_start() ?>



<?php

// var_dump($data->index());
$title = 'Data Mekanik';
include __DIR__ . '/../../app/repository/tableRepository.php';
$table = new TableRepository(['tanggal','name','telepon','active'],$data->index(),'onEditMekanik','onDeleteMekanik');


$search = '/dashboard/mekanik/';
include __DIR__ . '/../../components/table.php'
?>

<?php
?>

<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>