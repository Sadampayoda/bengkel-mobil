<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #000; padding: 20px; }
        h2, h3 { text-align: center; margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td { padding: 8px; vertical-align: top; }
        .label { width: 35%; font-weight: bold; }
        .footer { margin-top: 40px; display: flex; justify-content: space-between; }
    </style>
</head>
<body>

    <h2>SAM JAYA</h2>
    <h3>BENGKEL MOBIL</h3>
    <p style="text-align:center;">Jl. Padjajaran Utama, Bogor | Telp: 0821 1244 3636</p>
    <hr>
    <h3 style="text-align:center;">Invoice</h3>

    <table>
        <tr><td class="label">Tanggal</td><td>: <?= $data['tanggal'] ?></td></tr>
        <tr><td class="label">Nama Pelanggan</td><td>: <?= $data['nama_pelanggan'] ?></td></tr>
        <tr><td class="label">Kendaraan</td><td>: <?= $data['kendaraan'] ?></td></tr>
        <tr><td class="label">Plat Nomer</td><td>: <?= $data['plat_nomer'] ?></td></tr>
        <tr><td class="label">Transmisi</td><td>: <?= $data['transmisi'] ?></td></tr>
        <tr><td class="label">No Telepon</td><td>: <?= $data['telepon'] ?></td></tr>
        <tr><td class="label">Jasa Servis</td><td>: <?= $data['jasa_servis'] ?></td></tr>
        <tr><td class="label">Nama Barang</td><td>: <?= $data['nama_barang'] ?></td></tr>
        <tr><td class="label">Total Harga Jasa</td><td>: <?= $data['total_harga_jasa'] ?></td></tr>
        <tr><td class="label">Total Harga Barang</td><td>: <?= $data['total_harga_barang'] ?></td></tr>
        <tr><td class="label">Total Keseluruhan</td><td>: <?= $data['total_keseluruhan'] ?></td></tr>
    </table>

    <div class="footer">
        <div>
            Pembayaran via bank <?= $data['bank'] ?><br>
            No Rekening : <?= $data['rekening'] ?><br>
            A/N : <?= $data['an'] ?>
        </div>
        <div style="text-align:right;">
            Hormat Kami<br><br><br>
            <b>SAM JAYA BOGOR</b>
        </div>
    </div>

</body>
</html>
