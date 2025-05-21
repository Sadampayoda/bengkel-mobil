<?php

use App\Controller\OrderController;
use App\Controller\OrderDetailController;

require_once __DIR__ . '/../../vendor/autoload.php';
include_once __DIR__ . '/../controller/OrderController.php';
include_once __DIR__ . '/../controller/OrderDetailController.php';

if ($_GET['id']) {
    $order = new OrderController();
    $order_detail = new OrderDetailController();

    $data = $order->print($_GET['id']);
    $data['barang'] = $order_detail->show($_GET['id']);
    $img = __DIR__.'/../../assets/logo.png';
    $html = '
<html>
<head>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            margin: 0;
            padding: 10px;
        }
        .header { 
            text-align: center; 
            margin-bottom: 5px;
        }
        .workshop-name {
            font-size: 16px;
            font-weight: bold;
        }
        .workshop-title {
            font-size: 14px;
        }
        .invoice-title { 
            font-size: 16px; 
            font-weight: bold;
            text-align: center;
            margin: 10px 0;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .invoice-table td {
            padding: 10px;
        }
        .total-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .total-table td {
            padding: 10px;
            border: 1px solid #000;
        }
        .total-label {
            width: 40%;
        }
        .footer {
            margin-top: 30px;
        }
        .payment-info {
            font-size: 11px;
        }
        .signature {
            text-align: right;
        }
        hr {
            border: 0.5px solid #000;
            margin: 5px 0;
        }
        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .item-table th, .item-table td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }
        .item-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="'.$img.'" style="width: 100%; height: auto;" />
    </div>

    <hr>

    <div class="invoice-title">INVOICE</div>

    <table border="1" class="invoice-table">
        <tr>
            <td colspan="2"><strong>Tanggal:</strong> ' . date('d F Y', strtotime($data["tanggal"])) . '</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Nama Pelanggan:</strong> ' . $data["pelanggan"] . '</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Kendaraan:</strong> ' . $data["kendaraan"] . '</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Plat Nomor:</strong> ' . $data["plat_nomer"] . '</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Transmisi:</strong> ' . $data["transmisi"] . '</td>
        </tr>
        <tr>
            <td colspan="2"><strong>No Telepon:</strong> ' . $data["telepon"] . '</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Jasa Servis:</strong> ' . $data["jasa_servis"] . '</td>
        </tr>
            <tr>
                <td>Nama Barang</td>
            </tr>
        ';
    foreach ($data['barang'] as $b) {
        $html .= '
            
                <td>' . $b['barang'] . ' - ' . $b['jumlah'] . ' Pcs</td>
            </table>';
    }
    $html .= '


    <table class="total-table">
        <tr>
            <td class="total-label"><strong>Total Harga Jasa:</strong> Rp ' . number_format($data["total_harga_jasa"], 0, ',', '.') . '</td>
        </tr>
        <tr>
            <td class="total-label"><strong>Total Harga Barang:</strong> Rp ' . number_format($data["total_harga_barang"], 0, ',', '.') . '</td>
        </tr>
        <tr>
            <td class="total-label"><strong>Total Keseluruhan:</strong> Rp ' . number_format($data["total_harga_keseluruhan"], 0, ',', '.') . '</td>
        </tr>
    </table>

    <table style="width:100%; margin-top: 30px;">
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <div class="payment-info">
                    <strong>Pembayaran via bank BCA</strong><br>
                    No Rekening: 8690380375<br>
                    A/N: Samsuri
                </div>
            </td>
            <td style="width: 50%; text-align: right; vertical-align: top;">
                <div class="signature">
                    Hormat Kami<br><br><br>
                    <strong>SAM JAYA BOGOR</strong>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
';

    $mpdf = new \Mpdf\Mpdf([
        'default_font_size' => 12,
        'default_font' => 'Arial',
        'format' => [150, 210],
        'margin_left' => 8,
        'margin_right' => 8,
        'margin_top' => 10,
        'margin_bottom' => 10,
        'margin_header' => 5,
        'margin_footer' => 5
    ]);

    $mpdf->WriteHTML($html);
    $mpdf->Output('invoice-' . $data["pelanggan"] . '.pdf', \Mpdf\Output\Destination::INLINE);
    exit;
}
