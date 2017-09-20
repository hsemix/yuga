<label class="float-left span15">Eggombolola Lyo:</label>
<select class="form-control" name="gombolola" id="js-gombolola" onchange="$byakunoCore.Region.gombolola(this);">
    <option value="">Londa Eggombolola Lyo</option>
    <?php foreach($regions as $gombolola): ?>
        <option value="<?php echo  $gombolola ; ?>"><?php echo  $gombolola ; ?></option>
    <?php endforeach; ?>
</select>