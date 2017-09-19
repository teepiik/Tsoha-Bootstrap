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
  
  $routes->get('/reseptit/1', function() {
      ReseptiController::reseptiEsittely();
  });
  
  $routes->get('/reseptin_muokkaus', function() {
  HelloWorldController::reseptinmuokkaus();
  });
  
  $routes->get('/login', function() {
  HelloWorldController::login();
  });
