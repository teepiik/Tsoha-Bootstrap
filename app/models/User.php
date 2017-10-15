<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends BaseModel {

    public $id, $nimi, $salasana;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_salasana');
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));
            return $user;
        } else {
            return null;
        }
    }

    public static function findWithName($nimi) {
        $query = DB::connection()->prepare('SELECT FROM Kayttaja WHERE nimi = :nimi');
        $query->execute(array('nimi' => $nimi));
        $row = $query->fetch();

        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));
            return $user;
        } else {
            return null;
        }
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Kayttaja(nimi, salasana) VALUES(:nimi, :salasana) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'salasana' => $this->salasana));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('Update Kayttaja SET nimi = :nimi, salasana = :salasana');
        $query->execute(array('id' => $this->id));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Kayttaja WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public static function authenticate($nimi, $salasana) {

        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE nimi = :nimi AND salasana = :salasana LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'salasana' => $salasana));
        $row = $query->fetch();
        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));
            return $user;
        } else {
            return null;
        }
    }
    
    public function validate_nimi() {
        $errors = array();
        if($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Käyttäjätunnuksesi ei saa olla tyhjä.';
        }
        
        if(strlen($this->nimi > 40)) {
            $errors[] = 'Käyttäjätunnuksesi on liian pitkä, sen tulisi olla alle 40 merkkiä';
        }
        return $errors;
    }
    
    public function validate_salasana() {
        $errors = array();
        if($this->salasana == '' || $this->salasana == null) {
            $errors[] = 'Salasanasi ei saa olla tyhjä.';
        }
        
        if(strlen($this->salasana) > 15) {
            $errors[] = 'Salasanasi on liian pitkä, sen saa korkeintaan olla 15 merkkiä pitkä';
        }
        
        if(strlen($this->salasana) < 3) {
            $errors[] = 'Salasanasi on liian lyhyt, sen tulisi olla ainakin 3 merkkiä';
        }
        return $errors;
    }
    
    public static function all() {
        // Alustetaan kysely tietokantayhteydellä
        $query = DB::connection()->prepare('SELECT * FROM  Kayttaja');
        // Suoritetaan kysely
        $query->execute();
        // Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();

        $kayttajat = array();

        foreach ($rows as $row) {
            $kayttajat[] = new User(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana'],
                
            ));
        } return $kayttajat;
    }
    public function getId() {
        return $this->id;
    }

}
