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
    
    
    public static function reseptienlistaus() {
        View::make('resepti/reseptien-listaus.html');
    }
    
    // Vanha metodi
    public static function reseptinmuokkaus() {
        View::make('resepti/reseptimuokkaus.html');
    }
    
    public static function reseptiesittely() {
        View::make('resepti/reseptin-esittely.html');
    }
    
    
  }
