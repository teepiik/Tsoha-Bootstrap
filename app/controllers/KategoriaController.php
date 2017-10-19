<?php

class KategoriaController extends BaseController {

    public static function kategoriaListaus() {
        $kategoriat = Kategoria::all();

        View::make('kategoria/kategoriaListaus.html', array('kategoriat' => $kategoriat));
    }

    public static function kategoriaEsittely($id) {
        //require 'app/models/ReseptiOlio.php';
        $kategoria = Kategoria::find($id);

        View::make('kategoria/kategoriaEsittely.html', array('kategoria' => $kategoria));
    }

    public static function store() {
        self::check_logged_in();

        $params = $_POST;

        $kategoria = new Kategoria(array(
            'nimi' => $params['nimi'],
        ));

        $errors = $kategoria->errors();

        if (count($errors) > 0) {
            echo 'Kategoria on virheellinen!';
            View::make('kategoria/uusiKategoria.html', array('errors' => $errors, 'attributes' => $kategoria));
        } else {
            // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
            $kategoria->save();

            // Ohjataan käyttäjä lisäyksen jälkeen kategorian esittelysivulle
            Redirect::to('/kategoriat/' . $kategoria->id, array('message' => 'Kategoria lisättiin!'));
        }
    }

    public static function create() {
        View::make('kategoria/uusiKategoria.html');
    }

    public static function edit($id) {
        self::check_logged_in();
        //require 'app/models/ReseptiOlio.php';
        $kategoria = Kategoria::find($id);
        View::make('kategoria/kategoriaMuokkaus.html', array('attributes' => $kategoria));
    }

    public function save() {
        self::check_logged_in();
        $query = DB::connection()->prepare('INSERT INTO Kategoria (nimi) VALUES (:nimi) RETURNING id');
        $query->execute(array('nimi' => $this->nimi));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
        );

        $kategoria = new Kategoria($attributes);
        $errors = $kategoria->errors();

        if (count($errors) > 0) {
            View::make('kategoria/kategoriaMuokkaus.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $kategoria->update();

            Redirect::to('/kategoriat/' . $kategoria->id, array('message' => 'Kategoriaa muokattiin onnistuneesti'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $kategoria = new Kategoria(array('id' => $id));
        if ($kategoria->checkIfKategoriaInUse()) {
            Redirect::to('/kategoriat', array('message' => 'Et voi poistaa resepteissä käytössä olevaa kategoriaa!'));
        } else {
            $kategoria->destroy();
            Redirect::to('/kategoriat', array('message' => 'Kategoria on poistettu'));
        }
    }

}
