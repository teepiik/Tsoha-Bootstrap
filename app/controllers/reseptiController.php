<?php

class ReseptiController extends BaseController {

    public static function reseptiListaus() {
        //require 'app/models/ReseptiOlio.php';
        $reseptit = ReseptiOlio::all();
        Kint::dump($reseptit);

        View::make('resepti/reseptien-listaus.html', array('reseptit' => $reseptit));
    }

    public static function reseptiEsittely($id) {
        //require 'app/models/ReseptiOlio.php';
        $resepti = ReseptiOlio::find($id);
        Kint::dump($resepti);

        View::make('resepti/reseptin-esittely.html', array('resepti' => $resepti));
    }

    public static function store() {
        self::check_logged_in();
        //require 'app/models/ReseptiOlio.php';
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi ReseptiOlio-luokan olion käyttäjän syöttämillä arvoilla
        $resepti = new ReseptiOlio(array(
            //'id'=>11,
            'nimi' => $params['nimi'],
            'raaka_aineet' => $params['raaka_aineet'],
            'ohje' => $params['ohje'],
            'tekija_id' => 1
        ));
        $errors = $resepti->errors();

        if (count($errors) > 0) {
            echo 'Resepti on virheellinen!';
            View::make('resepti/uusiResepti.html', array('errors' => $errors, 'attributes' => $resepti));
        } else {
            // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
            $resepti->save();

            // Ohjataan käyttäjä lisäyksen jälkeen reseptin esittelysivulle
            Redirect::to('/reseptit/' . $resepti->id, array('message' => 'Resepti on lisätty kirjastoosi!'));
        }
    }

    public function save() {
        self::check_logged_in();
        $query = DB::connection()->prepare('INSERT INTO Resepti (nimi, raaka_aineet, ohje, tekija_id) VALUES (:nimi, :raaka_aineet, :ohje, tekija_id) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'raaka_aineet' => $this->raaka_aineet, 'ohje' => $this->ohje, 'tekija_id' => $this->tekija_id));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public static function create() {
        View::make('resepti/uusiResepti.html');
    }

    // Reseptin muokkaaminen, lomakkeen esittäminen
    public static function edit($id) {
        self::check_logged_in();
        //require 'app/models/ReseptiOlio.php';
        $resepti = ReseptiOlio::find($id);
        View::make('resepti/muokkaa.html', array('attributes' => $resepti));
    }

    // Reseptin muokkaaminen, lomakkeen käsittely
    public static function update($id) {
        //require 'app/models/ReseptiOlio.php';
        $params = $_POST;
        //Kint::dump($params);die();

        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'raaka_aineet' => $params['raaka_aineet'],
            'ohje' => $params['ohje'],
            'tekija_id' => 1   // korjaa vielä tekijä_id
        );

        $resepti = new ReseptiOlio($attributes);
        $errors = $resepti->errors();

        if (count($errors) > 0) {
            View::make('resepti/muokkaa.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $resepti->update();

            Redirect::to('/reseptit/' . $resepti->id, array('message' => 'Reseptiä muokattiin onnistuneesti'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        //require 'app/models/ReseptiOlio.php';
        $resepti = new ReseptiOlio(array('id' => $id));
        
        $resepti->destroy();
        
        Redirect::to('/reseptit', array('message' => 'Resepti on poistettu'));
    }
}
    