<?php
require_once __DIR__ . '/../../vendor/autoload.php';

include_once __DIR__.'/../controller/SupplierController.php';


use App\Controller\SupplierController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$model = new SupplierController(); 
$dataList = $model->index();

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Buat header kolom
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Nama Supplier');
$sheet->setCellValue('C1', 'Alamat');
$sheet->setCellValue('D1', 'Telepon');

// Isi baris dari data
$row = 2;
foreach ($dataList as $data) {
    $sheet->setCellValue('A' . $row, $data['id']);
    $sheet->setCellValue('B' . $row, $data['name']);
    $sheet->setCellValue('C' . $row, $data['alamat']);
    $sheet->setCellValue('D' . $row, $data['telepon']);
    $row++;
}

// Download Excel
$filename = 'supplier-' . date('YmdHis') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
