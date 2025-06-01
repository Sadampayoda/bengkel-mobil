<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controller\BarangController;
use App\Controller\StokController;

use Mpdf\Mpdf;

require_once __DIR__. '/../../controller/StokController.php';
require_once __DIR__. '/../../controller/BarangController.php';


$mpdf = new Mpdf(['format' => 'A4-L']);
$stok = new StokController();
$barang = new BarangController();
$data = $stok->index();
$html = '
    <!DOCTYPE html>
    <html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; font-size: 12pt; }
            table { border-collapse: collapse; width: 100%; }
            th, td { border: 1px solid black; padding: 6px; text-align: left; }
            th { background-color: #f2f2f2; }
        </style>
    </head>
    <body>
        <h2 style="text-align:center;">Laporan Barang Keluar</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Jenis</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Supplier</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>';
$no = 1;
foreach ($data as $item) {
    $row_barang = $barang->show($item['barang_id']); 
    $html .= '<tr>';
    $html .= '<td>' . $no++ . '</td>';
    $html .= '<td>' . $item['tanggal'] . '</td>';
    $html .= '<td>' . $row_barang['name'] . '</td>';
    $html .= '<td>' . $row_barang['jenis'] . '</td>';
    $html .= '<td>' . $row_barang['satuan'] . '</td>';
    $html .= '<td>' . $row_barang['harga'] . '</td>';
    $html .= '<td>' . $row_barang['nama_supplier'] . '</td>';
    $html .= '<td>' . $item['stok'] . '</td>';
    $html .= '</tr>';
}

$html .= '
            </tbody>
        </table>
    </body>
    </html>';
$mpdf->WriteHTML($html);
$mpdf->Output('laporan-barang-keluar.pdf', 'I');
