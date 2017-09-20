<label class="float-left span15">Essaza Lyo:</label>
<select class="form-control" data-region="<?php echo  $region ; ?>" name="essaza" id="js-saza" onchange="$byakunoCore.Region.gombolola(this);">
    <option value="">Londa Essaza Lyo</option>
    <?php foreach($regions as $region => $saza): ?>
        <option value="<?php echo  $region ; ?>"><?php echo  $region ; ?></option>
    <?php endforeach; ?>
</select>