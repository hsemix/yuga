
<?php $this->extend ('tests.layout'); ?> 

<?php $this->section ('page'); ?>
    <div>But</div>
    <div>You</div>

    <div><?php echo  $name ; ?></div>

    <?php foreach ($users as $user): ?>
        <div><?php echo  $user ; ?></div>
    <?php endforeach; ?>
<?php $this->endSection() ?>