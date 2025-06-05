<?php

use App\Controller\OrderController;
use App\Controller\SupplierController;




include __DIR__ . '/../../app/controller/OrderController.php';
include __DIR__ . '/../../app/controller/SupplierController.php';
$data = new OrderController();
$supplier = new SupplierController();
$order = $data->index();
$i = 0;
foreach ($order as $row) {
    $order_detail = $data->orderDetailFirst($row['id']);
    if($order_detail) {
        $order[$i]['nama_barang'] = $order_detail['nama_barang'];
        $suppliers = $supplier->show($order_detail['supplier_id']);
        $order[$i]['supplier'] = $suppliers['name'];
    }else{
        $order[$i]['nama_barang'] = ' - ';
        $order[$i]['supplier'] = ' - ';
    }
    $i++;
}


ob_start() ?>



<?php

$title = 'Order Servis';
include __DIR__ . '/../../app/repository/tableRepository.php';
$table = new TableRepository(['tanggal','nama_barang','supplier','pelanggan', 'kendaraan', 'plat_nomer', 'transmisi', 'telepon', 'jasa_servis', 'total_harga_jasa', 'total_harga_barang', 'total_harga_keseluruhan', 'status', 'mekanik'], $order, 'onEditOrder', 'onDeleteOrder');


$search = '/dashboard/order/';
include __DIR__ . '/../../components/table.php'
    ?>


<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>