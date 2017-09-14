<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/reseptit', function() {
  HelloWorldController::reseptienlistaus();
  });
  
  $routes->get('/reseptit/1', function() {
  HelloWorldController::reseptiesittely();
  });
  
  $routes->get('/reseptin_muokkaus', function() {
  HelloWorldController::reseptinmuokkaus();
  });
  
  $routes->get('/login', function() {
  HelloWorldController::login();
  });
