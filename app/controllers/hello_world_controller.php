<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }
    
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
