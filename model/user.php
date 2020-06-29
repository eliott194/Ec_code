<?php

require_once( 'database.php' );

class User {

  protected $id;
  protected $email;
  protected $password;

  public function __construct( $user = null ) {

    if( $user != null ):
      $this->setId( isset( $user->id ) ? $user->id : null );
      $this->setEmail( $user->email );
      $this->setPassword( check_password($user->password), isset( $user->password_confirm ) ? $user->password_confirm : false );
    endif;
  }

  /***************************
  * -------- SETTERS ---------
  ***************************/

  public function setId( $id ) {
    $this->id = $id;
  }

  public function setEmail( $email ) {

    if ( !filter_var($email, FILTER_VALIDATE_EMAIL)):
      throw new Exception( 'Email incorrect' );
    endif;

    $this->email = $email;

  }

  public function setPassword( $password, $password_confirm = false ) {

    if( $password_confirm && $password != $password_confirm ):
      throw new Exception( 'Vos mots de passes sont différents' );
    endif;

    // function to hide/hash the password 
    $this->password = hash('sha256', $password);
  }

  /***************************
  * -------- GETTERS ---------
  ***************************/

  public function getId() {
    return $this->id;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPassword() {
    return $this->password;
  }

  /***********************************
  * -------- CREATE NEW USER ---------
  ************************************/

  public function createUser() {

    $db   = init_db();

    // Check if email already exist
    $req  = $db->prepare( "SELECT * FROM user WHERE email = ?" );
    $req->execute( array( $this->getEmail() ) );

    if( $req->rowCount() > 0 ) throw new Exception( "Email ou mot de passe incorrect" );

    // Insert new user
    $req->closeCursor();

    $req  = $db->prepare( "INSERT INTO user ( email, password ) VALUES ( :email, :password )" );
    $req->execute( array(
      'email'     => $this->getEmail(),
      'password'  => $this->getPassword()
    ));

    $db = null;

  }

  /**************************************
  * -------- GET USER DATA BY ID --------
  ***************************************/

  public static function getUserById( $id ) {

    
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM user WHERE id = ?" );
    $req->execute( array( $id ));

    
    $db   = null;

    return $req->fetch();
  }

  /***************************************
  * ------- GET USER DATA BY EMAIL -------
  ****************************************/

  public function getUserByEmail() {

    
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM user WHERE email = ?" );
    $req->execute( array( $this->getEmail() ));

    
    $db   = null;

    return $req->fetch();
  }

}

  /***************************************
  * ------- REGEX ON PASSWORD SIGN UP -------
  ****************************************/
  
function check_password($password) {

    $error = '';

    if( strlen($password ) < 8 ) $error .="Password too short !</br>";

    if( strlen($password ) > 20 ) $error.= "Password too long !</br>";

    if( !preg_match("#[0-9]+#", $password ) ) $error.= "Password must include at least one number !</br>";

    if( !preg_match("#[a-z]+#", $password ) ) $error.= "Password must include at least one letter !</br>";

    if( !preg_match("#[A-Z]+#", $password ) ) $error.= "Password must include at least one CAPS !</br>" ;

    if( !preg_match("#\W+#", $password ) ) $error.="Password must include at least one symbol !";
    
    if ($error != '') {
      throw new Exception($error);
    }
    else {
     return true;
    }
  }