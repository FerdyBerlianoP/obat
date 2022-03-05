<form action="<?php echo $action; ?>" method="post">
	<div class="form-group">
            <label for="varchar">Kode Obat Non Racik <?php echo form_error('obatalkes_kode') ?></label>
            <input type="text" class="form-control" name="obatalkes_kode" id="obatalkes_kode" placeholder="Kode Obat Non Racik" value="<?php echo $obatalkes_kode; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar"> Nama Obat <?php echo form_error('obatalkes_nama') ?></label>
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
            <label for="varchar">Jumlah <?php echo form_error('stok') ?></label>
            <input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?php echo $stok; ?>" />
        </div>
        <input type="hidden" name="obatnr_id" value="<?php echo $obatnr_id; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('obatnr') ?>" class="btn btn-default">Cancel</a>
    </form>