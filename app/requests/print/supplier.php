<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controller\SupplierController;
use Mpdf\Mpdf;

require_once __DIR__. '/../../controller/SupplierController.php';


$mpdf = new Mpdf(['format' => 'A4-L']);
$supplier = new SupplierController();
$data = $supplier->index();
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
        <h2 style="text-align:center;">Laporan Supplier</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Supplier</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                </tr>
            </thead>
            <tbody>';
$no = 1;
foreach ($data as $item) {
    $html .= '<tr>';
    $html .= '<td>' . $no++ . '</td>';
    $html .= '<td>' . $item['name'] . '</td>';
    $html .= '<td>' . $item['alamat'] . '</td>';
    $html .= '<td>' . $item['telepon'] . '</td>';
    $html .= '</tr>';
}

$html .= '
            </tbody>
        </table>
    </body>
    </html>';
$mpdf->WriteHTML($html);
$mpdf->Output('laporan-supplier.pdf', 'I');
