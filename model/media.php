<?php

require_once( 'database.php' );

class Media {

  protected $id;
  protected $genre_id;
  protected $title;
  protected $type;
  protected $status;
  protected $release_date;
  protected $summary;
  protected $trailer_url;

  public function __construct( $media ) {

    $this->setId( isset( $media->id ) ? $media->id : null );
    $this->setGenreId( $media->genre_id );
    $this->setTitle( $media->title );
  }

  /***************************
  * -------- SETTERS ---------
  ***************************/

  public function setId( $id ) {
    $this->id = $id;
  }

  public function setGenreId( $genre_id ) {
    $this->genre_id = $genre_id;
  }

  public function setTitle( $title ) {
    $this->title = $title;
  }

  public function setType( $type ) {
    $this->type = $type;
  }

  public function setStatus( $status ) {
    $this->status = $status;
  }

  public function setReleaseDate( $release_date ) {
    $this->release_date = $release_date;
  }

  /***************************
  * -------- GETTERS ---------
  ***************************/

  public function getId() {
    return $this->id;
  }

  public function getGenreId() {
    return $this->genre_id;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getType() {
    return $this->type;
  }

  public function getStatus() {
    return $this->status;
  }

  public function getReleaseDate() {
    return $this->release_date;
  }

  public function getSummary() {
    return $this->summary;
  }

  public function getTrailerUrl() {
    return $this->trailer_url;
  }

  /***************************
  * -------- GET LIST --------
  ***************************/

  public static function filterMedias( $title ) {

    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM media WHERE title LIKE ? ORDER BY release_date DESC" );
    $req->execute( array( '%' . $title . '%' ));

    $db   = null;

    return $req->fetchAll();

  }
  // Function to recover from the database all the media
  public static function getAllMedias() {

    $db = init_db();

    $req = $db->query("SELECT * FROM media");
    $req->execute();

    $db = null;

    return $req->fetchAll();
  }

}
  // Function to recover from the database media by id
  function getOne( $id ) {

      $db = init_db();

      $req = $db->prepare("SELECT * FROM media WHERE id = ?");
      $req->execute( array( $id ));

      $db = null;

      return $req->fetch();

}
  //Function to recover a season link to a media
  function getSerie( $id ) {

      $db = init_db();

      $req = $db->prepare("SELECT * FROM season WHERE id_media = ?");
      $req->execute( array( $id ));

      $db = null;

      return $req->fetchAll();

}

  //Function to recover an episode link to a season
  function getEpisode( $id ) {

      $db = init_db();

      $req = $db->prepare("SELECT * FROM episode WHERE id_season = ?");
      $req->execute( array( $id ));

      $db = null;

      return $req->fetchAll();

}