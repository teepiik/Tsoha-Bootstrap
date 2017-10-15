<?php

class ReseptiOlio extends BaseModel {

    // Atribuutit
    public $id, $nimi, $raaka_aineet, $ohje, $tekija_id, $validators;

    // Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_ohje', 'validate_raaka_aineet');
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
            $reseptit[] = new ReseptiOlio(array(
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
            $resepti = new ReseptiOlio(array(
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
            $resepti = new ReseptiOlio(array(
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

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Resepti (nimi, raaka_aineet, ohje, tekija_id) VALUES (:nimi, :raaka_aineet, :ohje, :tekija_id) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'raaka_aineet' => $this->raaka_aineet, 'ohje' => $this->ohje, 'tekija_id' => $this->tekija_id));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function validate_name() {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if (strlen($this->nimi) < 3) {
            $errors[] = 'Reseptin nimen pituuden tulee olla vähintään kolme merkkiä!';
        }
        
        if (strlen($this->nimi) > 50) {
            $errors[] = 'Reseptin nimi saa maksimissaan olla 50 merkkiä pitkä';
        }

        return $errors;
    }
    
    public function validate_ohje() {
        $errors = array();
        if ($this->ohje == '' || $this->ohje == null) {
            $errors[] = 'Sinun täytyy antaa ohje reseptillesi!';
        }
        if (strlen($this->ohje) < 10) {
            $errors[] = 'Ohjeesi on liian lyhyt.';
        }
        
        if (strlen($this->ohje) > 600) {
            $errors[] = 'Ohjeesi on liian pitkä. (raja 600 merkkiä)';
        }

        return $errors;
    }
    
    public function validate_raaka_aineet() {
        $errors = array();
        if ($this->raaka_aineet == '' || $this->raaka_aineet == null) {
            $errors[] = 'Lisää raaka-aineet.';
        }
        if(strlen($this->raaka_aineet) > 400) {
            $errors[] = 'Raaka-aineet ovat liian pitkä lista, maksimi 400 merkkiä.';
        }

        return $errors;
    }
    
    
    
    public function update() {
        //UPDATE Resepti SET nimi = :nimi, raaka_aineet = :raaka_aineet, ... WHERE id = :id
        $query = DB::connection()->prepare('UPDATE Resepti SET nimi = :nimi, raaka_aineet = :raaka_aineet, ohje = :ohje WHERE id = :id');
        $query->execute(array('nimi' => $this->nimi, 'raaka_aineet' => $this->raaka_aineet, 'ohje' => $this->ohje, 'id'=> $this->id));

    }
    
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Resepti WHERE id=:id');
        $query->execute(array('id' => $this->id));

    }

}
