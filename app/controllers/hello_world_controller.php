<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      require 'app/models/reseptiModel.php';
      $reseptit = ReseptiOlio::all();
      $jauhelihapihvi = ReseptiOlio::find(1);
      Kint::dump($reseptit);
      Kint::dump($jauhelihapihvi);
      //View::make('helloworld.html');
      
    }
    
    /*
     * $skyrim = Game::find(1);
    $games = Game::all();
    // Kint-luokan dump-metodi tulostaa muuttujan arvon
    Kint::dump($games);
    Kint::dump($skyrim);
     */
    
    public static function reseptienlistaus() {
        View::make('suunnitelmat/reseptien-listaus.html');
    }
    
    public static function reseptinmuokkaus() {
        View::make('suunnitelmat/reseptimuokkaus.html');
    }
    
    public static function reseptiesittely() {
        View::make('suunnitelmat/reseptin-esittely.html');
    }
    
    public static function login() {
        View::make('suunnitelmat/login.html');
    }
  }
