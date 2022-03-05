<form action="<?php echo $action; ?>" method="post">
	<div class="form-group">
            <label for="varchar">Kode Obat Racik <?php echo form_error('obatalkes_kode') ?></label>
            <input type="text" class="form-control" name="obatalkes_kode" id="obatalkes_kode" placeholder="Kode Obat Racik" value="<?php echo $obatalkes_kode; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nama Obat <?php echo form_error('obatr_nama') ?></label>
            <input type="text" class="form-control" name="obatr_nama" id="obatr_nama" placeholder="Nama obat" value="<?php echo $obatr_nama; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Obat 1 <?php echo form_error('obatalkes_nama') ?></label>
            <select name="obatalkes_nama" class="form-control">
                <option value="<?php echo $obatalkes_nama?>"><?php echo $obatalkes_nama?></option>
                <?php 
                $sql = $this->db->get('obatalkes');
                foreach ($sql->result() as $row) {
                 ?>
                <option value="<?php echo $row->obatalkes_nama?>"><?php echo $row->obatalkes_nama ?></option>
            <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="varchar">Obat 2 <?php echo form_error('obatr2') ?></label>
            <select name="obatr2" class="form-control">
                <option value="<?php echo $obatr2?>"><?php echo $obatr2?></option>
                <?php 
                $sql = $this->db->get('obatalkes');
                foreach ($sql->result() as $row) {
                 ?>
                <option value="<?php echo $row->obatalkes_nama?>"><?php echo $row->obatalkes_nama ?></option>
            <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="varchar">Aturan Minum <?php echo form_error('signa_nama') ?></label>
            <select name="signa_nama" class="form-control">
                <option value="<?php echo $signa_nama?>"><?php echo $signa_nama?></option>
                <?php 
                $sql = $this->db->get('signa');
                foreach ($sql->result() as $row) {
                 ?>
                <option value="<?php echo $row->signa_nama?>"><?php echo $row->signa_nama?></option>
            <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="varchar">Jumlah Obat 1<?php echo form_error('stok') ?></label>
            <input type="text" class="form-control" name="stok" id="stok" placeholder="Jumlah" value="<?php echo $stok; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Jumlah Obat 2<?php echo form_error('stokr2') ?></label>
            <input type="text" class="form-control" name="stokr2" id="stokr2" placeholder="Jumlah" value="<?php echo $stokr2; ?>" />
        </div>
        <input type="hidden" name="obatnr_id" value="<?php echo $obatnr_id; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('obatr') ?>" class="btn btn-default">Cancel</a>
    </form>