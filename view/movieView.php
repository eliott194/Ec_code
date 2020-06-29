<?php ob_start();

$file = getOne($_GET['media']);

?>


<div class="embed-responsive embed-responsive-21by9">
  <iframe class="embed-responsive-item" src="<?= $file['trailer_url']; ?>" allowfullscreen></iframe>
</div>
<div>
  <div class="card-body">
    <h5 class="card-title"><?= $file['title']; ?></h5>
    <p class="card-text"><?= $file['status']; ?></p>
    <p class="card-text"><?= $file['summary']; ?></p>
    
  </div>
</div>
</br>
</br>
<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>