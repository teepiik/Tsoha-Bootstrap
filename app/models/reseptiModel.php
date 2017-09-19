<?php

class reseptiModel extends BaseModel {

    // Atribuutit
    public $id, $nimi, $raaka_aineet, $ohje, $tekija_id;

    // Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        // Alustetaan kysely tietokantayhteydellä
        $query = DB::connection()->prepare('SELECT * FROM  Resepti');
        // Suoritetaan kysely
        $query->execute();
        // Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();

        $reseptit = array();

        foreach ($rows as $row) {
            $reseptit[] = new reseptiModel(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'raaka_aineet' => $row['raaka_aineet'],
                'ohje' => $row['ohje'],
                'tekija_id' => $row['tekija_id']
            ));
            
        } return $reseptit;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Resepti WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $resepti = new reseptiModel(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'raaka_aineet' => $row['raaka_aineet'],
                'ohje' => $row['ohje'],
                'tekija_id' => $row['tekija_id']
            ));
            return $resepti;
        }
        return null;
    }
    
    public static function findTekija($tekija_id) {
        $query = DB::connection()->prepare('SELECT * FROM Resepti WHERE tekija_id = :id LIMIT 1');
        $query->execute(array('id' => $tekija_id));
        $row = $query->fetch();

        if ($row) {
            $resepti = new reseptiModel(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'raaka_aineet' => $row['raaka_aineet'],
                'ohje' => $row['ohje'],
                'tekija_id' => $row['tekija_id']
            ));
            return $resepti;
        }
        return null;
    }

}

