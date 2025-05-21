<?php 


use App\Controller\DashboardController;




include __DIR__.'/app/controller/dashboardController.php';
$data = new DashboardController();
$status = $data->index();

ob_start() ?>

<div class="card m-4 p-4">
    <div class="card-header">
        <div class="card-title">Dashboard</div>
    </div>
    <div class="card-body">
        <div class="row ">
            <div class="col-3">
                <div class="card bg-warning p-3">
                    <h4>Stok Barang</h4>
                    <p><?= $status['stok']; ?></p>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-warning p-3">
                    <h4>Barang Masuk</h4>
                    <p><?= $status['masuk']; ?></p>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-warning p-3">
                    <h4>Barang Keluar</h4>
                    <p><?= $status['keluar']; ?></p>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-warning p-3">
                    <h4>Supplier</h4>
                    <p><?= $status['supplier']; ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="card bg-warning p-3">
                    <h4>Jenis Barang</h4>
                    <p><?= $status['jenis']; ?></p>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-warning p-3">
                    <h4>Satuan Barang</h4>
                    <p><?= $status['satuan']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $content = ob_get_clean();
include __DIR__ . '/components/index.php';
?>