<?php

require_once( 'model/media.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/

// Function allowing to go on a page when the user look on a media
function mediaPage() {

	 if ( isset($_GET['title'])) {

	  $search = isset( $_GET['title'] ) ? $_GET['title'] : null;

	  $medias = Media::filterMedias( $search );

	  require('view/mediaListView.php');

	 }

	 else {

	  $medias = Media::getAllMedias();

	  require('view/mediaListView.php');
	}
}



//Function allowing to go on a page when the user look on a media
function episodePage() {

	if ( isset($_GET['episode'])) {

		require('view/episodeView.php');
	}
}



// Function allowing to go on a page when the user look on a media
function mediaSelecte() {

	if ( isset($_GET['media'])) {

		$value = getOne($_GET['media']);
		$type_media = $value['type'];

		if ($type_media == "series") {
			
			require('view/serieView.php');

	 	}

		if ($type_media == "movie") {

	  		require('view/movieView.php');

		}
	}
}
