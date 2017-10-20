<?php

class ReseptiController extends BaseController {

    public static function reseptiListaus() {
        $reseptit = ReseptiOlio::all();
        View::make('resepti/reseptien-listaus.html', array('reseptit' => $reseptit));
    }

    public static function reseptiEsittely($id) {
        
        $resepti = ReseptiOlio::find($id);
        $knimi = ReseptiOlio::getTekijaNimi($id);
        $kategorianimi = ReseptiOlio::getKategoriaNimi($id);
        View::make('resepti/reseptin-esittely.html', array('resepti' => $resepti, 'knimi' => $knimi, 'katnimi' => $kategorianimi));
    }

    public static function store() {
        self::check_logged_in();

        $params = $_POST;

        $kategoria = $params['kategoria'];
        
        $resepti = new ReseptiOlio(array(
            'nimi' => $params['nimi'],
            'raaka_aineet' => $params['raaka_aineet'],
            'ohje' => $params['ohje'],
            'tekija_id' => self::get_user_id(),
            'kategoria_id' => $kategoria
        ));
        $errors = $resepti->errors();
        $kategoriat = Kategoria::all();

        if (count($errors) > 0) {
            echo 'Resepti on virheellinen!';
            View::make('resepti/uusiResepti.html', array('errors' => $errors, 'attributes' => $resepti, 'kategoriat' => $kategoriat));
        } else {
            // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
            $resepti->save();
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
        $kategoriat = Kategoria::all();
        View::make('resepti/uusiResepti.html', array('kategoriat' => $kategoriat));
    }

    // Reseptin muokkaaminen, lomakkeen esittäminen
    public static function edit($id) {
        self::check_logged_in();
        
        $resepti = ReseptiOlio::find($id);
        $kategoriat = Kategoria::all();
        View::make('resepti/muokkaa.html', array('attributes' => $resepti, 'kategoriat' => $kategoriat));
    }

    // Reseptin muokkaaminen, lomakkeen käsittely
    public static function update($id) {
        $params = $_POST;
        $kategoria = $params['kategoria'];

        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'raaka_aineet' => $params['raaka_aineet'],
            'ohje' => $params['ohje'],
            'tekija_id' => self::get_user_id(),
            'kategoria_id' => $kategoria
        );

        $resepti = new ReseptiOlio($attributes);
        $errors = $resepti->errors();
        $kategoriat = Kategoria::all();

        if (count($errors) > 0) {
            View::make('resepti/muokkaa.html', array('errors' => $errors, 'attributes' => $attributes, 'kategoriat' => $kategoriat));
        } else {
            $resepti->update();

            Redirect::to('/reseptit/' . $resepti->id, array('message' => 'Reseptiä muokattiin onnistuneesti'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        self::check_admin_logged_in();

        $resepti = new ReseptiOlio(array('id' => $id));
        
        $resepti->destroy();
        
        Redirect::to('/reseptit', array('message' => 'Resepti on poistettu'));
    }
}
    