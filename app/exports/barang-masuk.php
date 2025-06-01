<?php
require_once __DIR__ . '/../../vendor/autoload.php';

include_once __DIR__.'/../controller/BarangMasukController.php'; 
include_once __DIR__.'/../controller/BarangController.php'; 

use App\Controller\BarangController;
use App\Controller\BarangMasukController;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$model = new BarangMasukController(); 
$barang = new BarangController();
$dataList = $model->index();

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Buat header kolom
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Nama Barang');
$sheet->setCellValue('C1', 'Tanggal');
$sheet->setCellValue('D1', 'Jumlah stok');

// Isi baris dari data
$row = 2;
foreach ($dataList as $data) {
    $sheet->setCellValue('A' . $row, $data['id']);
    $sheet->setCellValue('B' . $row, $data['nama_barang']);
    $sheet->setCellValue('C' . $row, $data['tanggal']);
    $sheet->setCellValue('D' . $row, $data['jumlah']);
    $row++;
}

// Download Excel
$filename = 'barang_masuk-' . date('YmdHis') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
