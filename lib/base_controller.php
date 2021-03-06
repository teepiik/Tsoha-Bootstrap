<?php

require 'app/models/Kategoria.php';
require 'app/models/ReseptiOlio.php';
require 'app/models/User.php';
require 'app/models/hello_world.php';

  class BaseController{

    public static function get_user_logged_in(){
        if(isset($_SESSION['user'])) {
            $user_id = $_SESSION['user'];
            $user = User::find($user_id);
            return $user;
        }
      // Toteuta kirjautuneen käyttäjän haku tähän
      return null;
    }
    
    public static function check_admin_logged_in(){
        if(isset($_SESSION['user'])) {
            $user_id = $_SESSION['user'];
            $user = User::find($user_id);
            if($user->id!=1) {
               Redirect::to('/reseptit', array('message' => 'Vain Admin voi poistaa reseptejä!')); 
            }
        }
        
      
    }

    public static function check_logged_in(){
        if(!isset($_SESSION['user'])) {
            Redirect::to('/login', array('message' => 'Kirjaudu sisään nähdäksesi sivun sisältö'));
        }
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
    }
    
    public static function get_user_id(){
        if(isset($_SESSION['user'])) {
            $user_id = $_SESSION['user'];
            $user = User::find($user_id);
            return $user->id;
        }
      // Toteuta kirjautuneen käyttäjän haku tähän
      return null;
    }
    
    

  }
