<?php ob_start();

use App\Controller\BarangController;


use App\Controller\StokController;

$editMode = isset($_GET['id']);
$id = $_GET['id'] ?? null;

?>



<h3 class="font-medium text-4xl ms-5"><?= $editMode ? 'Edit' : 'Tambah' ?> Stok Barang</h3>
<?php

use App\Repository\FormRepository;

include __DIR__ . '/../../app/repository/formRepository.php';
include_once __DIR__ . '/../../app/controller/StokController.php';
include_once __DIR__ . '/../../app/controller/BarangController.php';

$controller = new StokController();
$barang = new BarangController();
$data = $controller->show($id);

// var_dump($jenisSatuan->index('satuan'));

$method = $editMode ? 'PUT' : "POST";

$form = new FormRepository('form-stok', $method, '', 'formStok');

$input = [
    [
        'label' => 'Kode Barang',
        'name' => 'kode',
        'placeholder' => 'Kode Barang',
        'required' => true,
        'readonly' => true,
    ],
    [
        'label' => 'Nama Barang',
        'name' => 'barang_id',
        'id' => 'barang_id',
        'type' => 'select',
        'placeholder' => 'Pilih Barang',
        'data' => $barang->index(),
        'required' => true,
        'value' => @$data['barang_id'],
    ],
    [
        'label' => 'Jenis',
        'name' => 'jenis',
        'id' => 'jenis',
        'placeholder' => 'Jenis Barang',
        'required' => true,
        'readonly' => true,
    ],
    [
        'label' => 'Satuan',
        'name' => 'satuan',
        'id' => 'satuan',
        'placeholder' => 'Satuan Barang',
        'required' => true,
        'readonly' => true,
    ],
    [
        'label' => 'Harga Barang',
        'name' => 'harga',
        'type' => 'number',
        'placeholder' => 'harga Barang',
        'required' => true,
        'readonly' => true,
    ],
    [
        'label' => 'Total Stok',
        'name' => 'stok',
        'id' => 'stok',
        'type' => 'number',
        'placeholder' => 'Total Stok Barang',
        'required' => true,
        'value' => @$data['stok'],
    ],
];

include __DIR__ . '/../../components/form.php';
?>



<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>

<script>
    new TomSelect("#barang_id", {
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

    document.getElementById('stok').addEventListener('input',function(e){
        const count = e.target.value
        if(count < 0){
            document.getElementById('stok').value = 1
        }
    })

    document.addEventListener('DOMContentLoaded', function () {
        const id = document.getElementById('barang_id').value
        if(id){
            fetchApiItem(id);
        }
    })

    document.getElementById('barang_id').addEventListener('change', function (e) {
        console.log('tes')
        const id = e.target.value;
        fetchApiItem(id);
    })

    const fetchApiItem = (id) => {
        const url = window.location.protocol + '//' + window.location.hostname
        fetch(`${url}/bengkel-mobil/app/Api/item.php?id=${id}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        }).then(res => res.json())
            .then((response) => {
                document.getElementById('kode').value = response.data.kode;
                document.getElementById('jenis').value = response.data.jenis;
                document.getElementById('satuan').value = response.data.satuan;
                document.getElementById('harga').value = response.data.harga;
            })
            .catch((err) => {
                console.log(err);
            })

    }
</script>