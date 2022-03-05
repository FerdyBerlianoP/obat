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
        <h2 style="margin-top:0px">obatnr Read</h2>
        <table class="table">
        <tr><td>Kode Obat Non Racik</td><td><?php echo $obatalkes_kode; ?></td></tr>
        <tr><td>Nama Obat</td><td><?php echo $obatalkes_nama; ?></td></tr>
        <tr><td>Aturan Minum</td><td><?php echo $signa_nama;  ?></td></tr>
        <tr><td>Jumlah</td><td><?php echo $stok; ?></td></tr>
        <tr><td></td><td><a href="<?php echo site_url('obatnr') ?>" class="btn btn-default">Cancel</a></td></tr>
    </table>
        </body>
</html>