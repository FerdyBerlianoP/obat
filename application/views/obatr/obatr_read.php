<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">obatr Read</h2>
        <table class="table">
            <tr><td>Kode Obat Non Racik</td><td><?php echo $obatr_kode; ?></td></tr>
        <tr><td>Nama Obat</td><td><?php echo $obatr_nama; ?></td></tr>
        <tr><td>Obat 1</td><td><?php echo $obatalkes_nama; ?></td></tr>
        <tr><td>Obat 2</td><td><?php echo $obatr2; ?></td></tr>
        <tr><td>Aturan Minum</td><td><?php echo $signa_nama; ?></td></tr>
        <tr><td>Jumlah</td><td><?php echo $stok; ?></td></tr>
        <tr><td>Jumlah</td><td><?php echo $stokr2; ?></td></tr>
        <tr><td></td><td><a href="<?php echo site_url('obatr') ?>" class="btn btn-default">Cancel</a></td></tr>
    </table>
        </body>
</html>