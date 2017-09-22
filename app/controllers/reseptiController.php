<?php

class ReseptiController extends BaseController {

    public static function reseptiListaus() {
        require 'app/models/ReseptiOlio.php';
        $reseptit = ReseptiOlio::all();
        Kint::dump($reseptit);

        View::make('suunnitelmat/reseptien-listaus.html', array('reseptit' => $reseptit));
    }

    public static function reseptiEsittely() {
        require 'app/models/ReseptiOlio.php';
        $resepti = ReseptiOlio::find(1); // lisää id riippuvuus (muuttuva id)
        Kint::dump($resepti);

        View::make('suunnitelmat/reseptin-esittely.html', array('resepti' => $resepti));
    }

    public static function store() {
        require 'app/models/ReseptiOlio.php';
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi ReseptiOlio-luokan olion käyttäjän syöttämillä arvoilla
        $resepti = new ReseptiOlio(array(
            //'id'=>11,
            'nimi' => $params['nimi'],
            'raaka_aineet' => $params['raaka_aineet'],
            'ohje' => $params['ohje'],
            'tekija_id'=>1
        ));

        // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
        $resepti->save();

        // Ohjataan käyttäjä lisäyksen jälkeen reseptin esittelysivulle (ei toimi)
        Redirect::to('/reseptit/' . $resepti->id, array('message' => 'Resepti on lisätty kirjastoosi!'));
    }

}
