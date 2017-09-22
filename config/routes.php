<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/reseptit', function() {
      ReseptiController::reseptiListaus();
  });
  
  // Reseptin lisääminen tietokantaan
$routes->post('/reseptit', function(){
  ReseptiController::store();
});
// Reseptin lisäyslomakkeen näyttäminen
$routes->get('/reseptit/uusiResepti', function(){
  ReseptiController::create();
});
  
  $routes->get('/reseptit/1', function() {
      ReseptiController::reseptiEsittely();
  });
  
  $routes->get('/reseptin_muokkaus', function() {
  HelloWorldController::reseptinmuokkaus();
  });
  
  $routes->get('/login', function() {
  HelloWorldController::login();
  });
