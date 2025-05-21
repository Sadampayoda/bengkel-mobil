<?php 


use App\Controller\StatusController;




include __DIR__.'/../../app/controller/StatusController.php';
$data = new StatusController();
$status = $data->index();

ob_start() ?>

<div class="card m-4 p-4">
    <div class="card-header">
        <div class="card-title">Data Order Status</div>
    </div>
    <div class="card-body">
        <div class="row ">
            <div class="col-3">
                <div class="card bg-warning p-3">
                    <h4>Mekanik</h4>
                    <p><?= $status['mekanik']; ?></p>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-warning p-3">
                    <h4>Proses</h4>
                    <p><?= $status['proses']; ?></p>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-warning p-3">
                    <h4>Tertunda</h4>
                    <p><?= $status['tertunda']; ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="card bg-warning p-3">
                    <h4>Selesai</h4>
                    <p><?= $status['selesai']; ?></p>
                </div>
            </div>

        
        </div>
    </div>
</div>



<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>