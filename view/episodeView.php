<?php ob_start();

$files = getEpisode($_GET['episode']);

?>

<div class="row">
    <div class="col-md-4 offset-md-8">
        <form method="get">
            <div class="form-group has-btn">
                <input type="search" id="search" name="title" class="form-control"
                       placeholder="Rechercher un film ou une série">

                <button type="submit" class="btn btn-block bg-red">Valider</button>
            </div>
        </form>
    </div>
</div>

<div class="media-list">
    <?php foreach( $files as $file ): ?>
        <a class="item" href="index.php?episode=<?= $file['id']; ?>">
            <div class="video">
                <div>
                    <iframe allowfullscreen="" frameborder="0"
                            src="<?= $file['stream']; ?>" ></iframe>
                </div>
            </div>
            <div class="title"><?= $file['name']; ?></div>
            <div class="date"><?= $file['title']; ?></div>
        </a>
    <?php endforeach; ?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>