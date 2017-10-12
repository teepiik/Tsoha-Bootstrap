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
$routes->post('/reseptit', function() {
    ReseptiController::store();
});
// Reseptin lisäyslomakkeen näyttäminen
$routes->get('/reseptit/uusiResepti', function() {
    ReseptiController::create();
});


$routes->get('/reseptin_muokkaus', function() {
    HelloWorldController::reseptinmuokkaus();
});


// Login
$routes->get('/login', function() {
    UserController::login();
});

$routes->post('/login', function(){
    UserController::handle_login();
});

// Register
$routes->get('/register', function() {
    UserController::register();
});

$routes->post('/register', function(){
    UserController::handle_register();
});




// Reseptin esittelysivu
$routes->get('/reseptit/:id', function($id) {
    ReseptiController::reseptiEsittely($id);
});




$routes->get('/reseptit/:id/muokkaa', function($id) {
ReseptiController::edit($id);
});

$routes->post('/reseptit/:id/muokkaa', function($id) {
ReseptiController::update($id);
});

$routes->post('/reseptit/:id/poista', function($id) {
ReseptiController::destroy($id);
});

$routes->get('/tunnuksetsec', function() {
    UserController::tunnusListaus();
});

$routes->post('/logout', function() {
UserController::logout(); 

});


// Kategorioiden esittely
$routes->get('/kategoriat', function() {
    KategoriaController::kategoriaListaus();
});

// Kategorian lisääminen tietokantaan
$routes->post('/kategoriat', function() {
    KategoriaController::store();
});
    
// Kategorian lisäyslomakkeen näyttäminen
$routes->get('/kategoriat/uusiKategoria', function() {
    KategoriaController::create();

});

// Kategorian esittelysivu
$routes->get('/kategoriat/:id', function($id) {
    KategoriaController::kategoriaEsittely($id);
});

$routes->get('/kategoriat/:id/muokkaa', function($id) {
KategoriaController::edit($id);
});

$routes->post('/kategoriat/:id/muokkaa', function($id) {
KategoriaController::update($id);
});

$routes->post('/kategoriat/:id/poista', function($id) {
KategoriaController::destroy($id);
});