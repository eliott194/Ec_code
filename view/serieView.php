<?php ob_start();

$file = getOne($_GET['media']);
$seasons = getSerie($_GET['media']);

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

<div class="media-list">
    <?php foreach( $seasons as $season ): 

        //Function to allow click if the saison is available
        
        $available = $season['Available'];
        if ($available == "Indisponible") {
            echo "<a class='item'>";
        }
        else {
            echo "<a class='item' href='index.php?episode=" . $season['id'] . "'>";
        }
    ?>
        <div class="video">
            <div>
                <img src="<?= $saison['cover']; ?>" class="img-fluid" alt="Responsive image">
            </div>
        </div>
        <div class="title"><?= $season['name']; ?></div>
        <div class="date"><?= $season['Available']; ?></div>
    </a>
    <?php endforeach; ?>
</div>

</br>
</br>
</br>
</br>
<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>