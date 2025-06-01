<?php
require_once __DIR__ . '/../../vendor/autoload.php';

include_once __DIR__.'/../controller/OrderController.php';

use App\Controller\OrderController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$model = new OrderController(); 
$dataList = $model->index();

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$headers = [
    'tanggal', 'pelanggan', 'kendaraan', 'plat_nomer', 'transmisi',
    'telepon', 'jasa_servis', 'total_harga_jasa', 'total_harga_barang',
    'total_harga_keseluruhan', 'status', 'mekanik'
];

$col = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($col . '1', $header);
    $col++;
}

$row = 2;
foreach ($dataList as $data) {
    $col = 'A';
    foreach ($headers as $key) {
        $sheet->setCellValue($col . $row, $data[$key] ?? '');
        $col++;
    }
    $row++;
}

// Download Excel
$filename = 'Order-' . date('YmdHis') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
