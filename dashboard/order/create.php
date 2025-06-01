<?php ob_start();

use App\Controller\OrderDetailController;

use App\Controller\OrderController;

use App\Controller\MekanikController;

use App\Controller\PelangganController;


$editMode = isset($_GET['id']);
$id = $_GET['id'] ?? null;

?>



<h3 class="font-medium text-4xl ms-5"><?= $editMode ? 'Edit' : 'Tambah' ?> Barang Masuk</h3>
<?php

use App\Repository\FormRepository;

include __DIR__ . '/../../app/repository/formRepository.php';
include_once __DIR__ . '/../../app/controller/MekanikController.php';
include_once __DIR__ . '/../../app/controller/OrderController.php';
include_once __DIR__ . '/../../app/controller/PelangganController.php';
include_once __DIR__ . '/../../app/controller/OrderDetailController.php';

$controller = new OrderController();
$data = $controller->show($id);
$pelanggan = new PelangganController();
$mekanik = new MekanikController();

$order_detail = new OrderDetailController();



$method = $editMode ? 'PUT' : "POST";
$form = new FormRepository('form-stok', $method, '', 'formOrder', true);
$input = [
    [
        'label' => 'Nama Pelanggan',
        'name' => 'pelanggan_id',
        'id' => 'pelanggan_id',
        'type' => 'select',
        'placeholder' => 'Pilih Pelanggan',
        'data' => $pelanggan->index(),
        'required' => true,
        'value' => @$data['pelanggan_id'],
    ],
    [
        'label' => 'Kendaraan',
        'name' => 'kendaraan',
        'type' => 'text',
        'id' => 'kendaraan',
        'placeholder' => 'Kendaraan',
        'required' => true,
        'value' => @$data['kendaraan'],
    ],
    [
        'label' => 'Plat Nomer',
        'name' => 'plat_nomer',
        'type' => 'text',
        'id' => 'plat_nomer',
        'placeholder' => 'Plat Nomer',
        'required' => true,
        'value' => @$data['plat_nomer'],
    ],
    [
        'label' => 'Transmisi',
        'name' => 'transmisi',
        'type' => 'text',
        'id' => 'transmisi',
        'placeholder' => 'Transmisi',
        'required' => true,
        'value' => @$data['transmisi'],
    ],
    [
        'label' => 'Telepon',
        'name' => 'telepon',
        'type' => 'number',
        'id' => 'telepon',
        'placeholder' => 'Nomer Telepon',
        'required' => true,
        'value' => @$data['telepon'],
    ],
    [
        'label' => 'Jasa Servis',
        'name' => 'jasa_servis',
        'type' => 'text',
        'id' => 'jasa_servis',
        'placeholder' => 'Jasa Servis',
        'required' => true,
        'value' => @$data['jasa_servis'],
    ],
    [
        'label' => 'Total Harga Jasa',
        'name' => 'total_harga_jasa',
        'type' => 'number',
        'id' => 'total_harga_jasa',
        'placeholder' => 'Total harga jasa',
        'required' => true,
        'value' => @$data['total_harga_jasa'],
    ],
    [
        'label' => 'Total Harga Keseluruhan',
        'name' => 'total_harga_keseluruhan',
        'type' => 'number',
        'id' => 'total_harga_keseluruhan',
        'placeholder' => 'Total harga Keseluruhan',
        'required' => true,
        'readonly' => true,
        'value' => @$data['total_harga_keseluruhan'],
    ],
    [
        'label' => 'Status',
        'name' => 'status',
        'id' => 'status',
        'type' => $editMode ? 'select' : 'hidden',
        'placeholder' => 'Pilih Status',
        'required' => true,
        'data' => [
            [
                'id' => 'proses',
                'name' => 'Proses',
            ],
            [
                'id' => 'tertunda',
                'name' => 'Tertunda',
            ],
            [
                'id' => 'selesai',
                'name' => 'Selesai',
            ],

        ],
        'value' => $editMode ? @$data['status'] : 'proses',
    ],

    [
        'label' => 'Mekanik',
        'name' => 'mekanik_id',
        'id' => 'mekanik_id',
        'type' => 'select',
        'placeholder' => 'Pilih Mekanik',
        'data' => $mekanik->index(),
        'required' => true,
        'value' => @$data['mekanik_id'],
    ],
];

include __DIR__ . '/../../components/form.php';


?>



<?php $content = ob_get_clean();
include __DIR__ . '/../../components/index.php';
?>

<script>
    new TomSelect("#pelanggan_id", {
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

    new TomSelect("#mekanik_id", {
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
    const dataBarangLama = <?php echo json_encode($order_detail->show($id)); ?>;

    document.addEventListener('DOMContentLoaded', function() {
        const tbody = document.querySelector('#detail tbody');
        console.log(dataBarangLama);
        dataBarangLama.forEach((item) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    ${item.barang}
                    <input type="hidden" name="barang_id[]" value="${item.id}">
                </td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" onclick="tambahJumlah(this)">+</button>
                    <input class="rounded-2 py-1" type="number" name="jumlah[]" value="${item.jumlah}" min="1" style="width:50px; text-align:center;" readonly>
                    <button type="button" class="btn btn-danger btn-sm" onclick="kurangiJumlah(this)">-</button>
                </td>
                <td>
                    ${item.harga}
                    <input type="hidden" name="harga[]" value="${item.harga}">
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)">Hapus</button>
                </td>
            `;
            tbody.appendChild(tr);

            summaryItemResult()
        });
    });


    document.getElementById('select-barang').addEventListener('change', function(event) {
        noUrut = 1
        url = window.location.protocol + '//' + window.location.hostname
        const id = event.target.value;

        fetch(`${url}/bengkel-mobil/app/Api/barang.php?id=${id}`, {
            method: "GET",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
        }).then(response => response.json()).then(
            res => {


                const tbody = document.querySelector('#detail tbody');
                const tr = document.createElement('tr');

                const rows = tbody.querySelectorAll('tr');
                for (const row of rows) {
                    const inputId = row.querySelector('input[name="barang_id[]"]');
                    if (inputId && inputId.value == res.data.id) {
                        const jumlahInput = row.querySelector('input[name="jumlah[]"]');
                        jumlahInput.value = parseInt(jumlahInput.value) + 1;
                        summaryItemResult();
                        return;
                    }
                }

                tr.innerHTML = `
                    <td>
                    ${res.data.name}
                    <input type="hidden" name="barang_id[]" value="${res.data.id}">
                    </td>
                    <td>
                    <button type="button" class="btn btn-primary btn-sm" onclick="tambahJumlah(this)">+</button>
                    <input class="rounded-2 py-1" type="number" name="jumlah[]" value="1" min="1" style="width:50px; text-align:center;" readonly>
                    <button type="button" class="btn btn-danger btn-sm" onclick="kurangiJumlah(this)">-</button>
                    </td>
                    <td>
                    ${res.data.harga}
                    <input type="hidden" name="harga[]" value="${res.data.harga}">
                    </td>
                    <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)">Hapus</button>
                    </td>
                `;
                tbody.appendChild(tr);

                const summaryItem = document.getElementById('total_harga_barang').value || 0

                const result = parseFloat(summaryItem) + parseFloat(res.data.harga);

                document.getElementById('total_harga_barang').value = result

                summaryItemResult()
            }
        )
    })

    document.getElementById('total_harga_jasa').addEventListener('input', function(event) {
        summaryWorkPrice()
    })

    const summaryItemResult = () => {
        const jumlahInputs = document.querySelectorAll('input[name="jumlah[]"]');
        const hargaInputs = document.querySelectorAll('input[name="harga[]"]');

        let summaryResult = 0
        for (let index = 0; index < jumlahInputs.length; index++) {
            summaryResult += (jumlahInputs[index].value * hargaInputs[index].value)
        }

        document.getElementById('total_harga_barang').value = summaryResult

        summaryWorkPrice()

    }

    const summaryWorkPrice = () => {
        const totalHargaJasa = document.getElementById('total_harga_jasa').value || 0
        const totalHargaBarang = document.getElementById('total_harga_barang').value || 0

        document.getElementById('total_harga_keseluruhan').value = parseFloat(totalHargaBarang) + parseFloat(totalHargaJasa)
    }

    function tambahJumlah(button) {
        const input = button.parentElement.querySelector('input[name="jumlah[]"]');

        input.value = parseInt(input.value) + 1;
        summaryItemResult()
    }

    function kurangiJumlah(button) {
        const input = button.parentElement.querySelector('input[name="jumlah[]"]');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
        summaryItemResult()
    }

    function hapusBaris(button) {
        button.closest('tr').remove();
        summaryItemResult()
    }

    const getApiBarang = () => {
        url = window.location.protocol + '//' + window.location.hostname
        fetch(`${url}/bengkel-mobil/app/Api/barang.php`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
        }).then(response => response.json()).then(res => {
            const select = document.getElementById('select-barang')
            res.data.forEach((item) => {
                const option = document.createElement('option');
                option.value = item.id
                option.textContent = item.name
                select.appendChild(option)
            })

            new TomSelect("#select-barang", {
                create: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        })
    }

    getApiBarang();
</script>