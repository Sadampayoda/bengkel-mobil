<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controller\BarangController;
use App\Controller\BarangMasukController;
use Mpdf\Mpdf;


require_once __DIR__. '/../../controller/BarangMasukController.php';
require_once __DIR__. '/../../controller/BarangController.php';


$mpdf = new Mpdf(['format' => 'A4-L']);
$barang_masuk = new BarangMasukController();
$data = $barang_masuk->index();
$barang = new BarangController();
$html = '
    <!DOCTYPE html>
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
        <h2 style="text-align:center;">Laporan Barang Masuk</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Jenis</th>
                    <th>Supplier</th>
                    <th>Jumlah</th>
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
    $html .= '<td>' . $item['jenis'] . '</td>';
    $html .= '<td>' . $row_barang['nama_supplier'] . '</td>';
    $html .= '<td>' . $item['jumlah'] . '</td>';
    $html .= '</tr>';
}

$html .= '
            </tbody>
        </table>
    </body>
    </html>';
$mpdf->WriteHTML($html);
$mpdf->Output('laporan-barang-masuk.pdf', 'I');
