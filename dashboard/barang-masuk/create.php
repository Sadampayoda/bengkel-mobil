<?php ob_start();

use App\Controller\BarangController;


use App\Controller\StokController;


use App\Controller\BarangMasukController;


$editMode = isset($_GET['id']);
$id = $_GET['id'] ?? null;

?>



<h3 class="font-medium text-4xl ms-5"><?= $editMode ? 'Edit' : 'Tambah' ?> Barang Masuk</h3>
<?php

use App\Repository\FormRepository;

include __DIR__ . '/../../app/repository/formRepository.php';
include_once __DIR__ . '/../../app/controller/BarangMasukController.php';
include_once __DIR__ . '/../../app/controller/BarangController.php';


$controller = new BarangMasukController();
$data = $controller->show($id);


$barang = new BarangController();

$method = $editMode ? 'PUT' : "POST";

$form = new FormRepository('form-stok', $method, '', 'formBarangMasuk');

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
        'label' => 'Supplier',
        'name' => 'supplier',
        'type' => 'text',
        'placeholder' => 'Supplier',
        'required' => true,
        'readonly' => true,
    ],
    [
        'label' => 'Total Stok Masuk',
        'name' => 'jumlah',
        'id' => 'jumlah',
        'type' => 'number',
        'placeholder' => 'Total jumlah Barang',
        'required' => true,
        'value' => @$data['jumlah'],
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

    document.getElementById('jumlah').addEventListener('input', function (e) {
        const count = e.target.value
        if (count < 0) {
            document.getElementById('jumlah').value = 1
        }
    })

    document.addEventListener('DOMContentLoaded', function () {
        const id = document.getElementById('barang_id').value
        if (id) {
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
                document.getElementById('supplier').value = response.data.nama_supplier
            })
            .catch((err) => {
                console.log(err);
            })

    }
</script>