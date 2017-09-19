<?php

class ReseptiController extends BaseController {
    public static function reseptiListaus() {
        require 'app/models/reseptiModel.php';
        $reseptit = reseptiModel::all();
        Kint::dump($reseptit);
        
        View::make('suunnitelmat/reseptien-listaus.html', array('reseptit'=>$reseptit));
    }
    public static function reseptiEsittely() {
        require 'app/models/reseptiModel.php';
        $resepti = reseptiModel::find(1); // lisää id riippuvuus (muuttuva id)
        Kint::dump($resepti);
        
        View::make('suunnitelmat/reseptin-esittely.html', array('resepti'=>$resepti));
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * public static function index(){
    // Haetaan kaikki pelit tietokannasta
    $games = Game::all();
    // Renderöidään views/game kansiossa sijaitseva tiedosto index.html muuttujan $games datalla
    View::make('game/index.html', array('games' => $games));
  }
 */

