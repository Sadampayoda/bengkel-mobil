<?php ob_start();

use App\Controller\SupplierController;



$editMode = isset($_GET['id']);
$id = $_GET['id'] ?? null;

?>


<h3 class="font-medium text-4xl ms-5"><?= $editMode ? 'Edit' : 'Tambah' ?> Barang</h3>
<?php

use App\Controller\BarangController;
use App\Repository\FormRepository;

include __DIR__ . '/../../app/repository/formRepository.php';
include_once __DIR__ . '/../../app/controller/BarangController.php';
include_once __DIR__ . '/../../app/controller/SupplierController.php';

$controller = new BarangController();
$supplier = new SupplierController();
$data = $controller->show($id);

$method = $editMode ? 'PUT' : "POST";

$form = new FormRepository('form-barang', $method, '', 'formBarang');

$input = [
    [
        'label' => 'Kode Barang',
        'name' => 'kode',
        'id' => 'kode',
        'placeholder' => 'Kode Barang',
        'required' => true,
        'readonly' => true,
        'value' => @$data['kode'],
    ],
    [
        'label' => 'Nama Barang',
        'name' => 'name',
        'id' => 'name',
        'placeholder' => 'Nama Barang',
        'required' => true,
        'value' => @$data['name'],
    ],
    [
        'label' => 'Jenis',
        'name' => 'jenis',
        'id' => 'jenis',
        'placeholder' => 'Jenis Barang',
        'required' => true,
        'value' => @$data['jenis'],
    ],
    [
        'label' => 'Satuan',
        'name' => 'satuan',
        'id' => 'satuan',
        'placeholder' => 'Satuan Barang',
        'required' => true,
        'value' => @$data['satuan'],
    ],
    [
        'label' => 'Harga Barang',
        'name' => 'harga',
        'id' => 'harga',
        'type' => 'number',
        'placeholder' => 'harga Barang',
        'required' => true,
        'value' => @$data['harga'],
    ],
    [
        'label' => 'Nama Supplier',
        'name' => 'supplier_id',
        'id' => 'supplier_id',
        'type' => 'select',
        'data' => $supplier->index(),
        'placeholder' => 'Pilih Supplie',
        'required' => true,
        'value' => @$data['supplier_id'],
    ],
];

include __DIR__ . '/../../components/form.php';
?>



<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>

<script>

    new TomSelect("#supplier_id", {
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
    document.addEventListener('DOMContentLoaded', function () {
        const kode = document.getElementById('kode').value;
        const url = window.location.protocol + '//' + window.location.hostname
        if (!kode) {
            fetch(`${url}/bengkel-mobil/app/Api/kode-barang.php`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            }).then(res => res.json())
            .then((response) => {
                document.getElementById('kode').value = response.data;
            })
            .catch((err) => {
                console.log(err);
            })
        }
    });
</script>