<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('obatr/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('obatr/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('obatr'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
        <th>No</th>
        <th>Kode Obat</th>
        <th>Nama Obat</th>
        <th>Obat 1</th>
        <th>Obat 2</th>
        <th>Aturan Minum</th>
        <th>Jumlah Obat 1</th>
        <th>Jumlah Obat 2</th>
        <th>Action</th>
            </tr><?php
            foreach ($obatr_data as $obatr)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $obatr->obatalkes_kode ?></td>
            <td><?php echo $obatr->obatr_nama ?></td>
            <td><?php echo $obatr->obatalkes_nama ?></td>
            <td><?php echo $obatr->obatr2 ?></td>
            <td><?php echo $obatr->signa_nama ?></td>
            <td><?php echo $obatr->stok ?></td>
            <td><?php echo $obatr->stokr2 ?></td>
            <td style="text-align:center" width="200px">
                <?php
                echo anchor(site_url('obatr/update/'.$obatr->obatr_id),'Update',array('class' => 'btn btn-warning btn-sm')); 
                echo ' | '; 
                echo anchor(site_url('obatr/delete/'.$obatr->obatr_id),'Delete',array('class'=> 'btn btn-danger btn-sm'),' onclick="javasciprt: return confirm"(\'Are You Sure ?\')"');
                ?>
            </td>
        </tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>