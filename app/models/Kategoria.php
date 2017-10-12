<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Kategoria extends BaseModel {

    public $id, $nimi, $validators;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kategoria WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $kategoria = new Kategoria(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
            return $kategoria;
        } else {
            return null;
        }
    }
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Kategoria');
        $query->execute();
        $rows = $query->fetchAll();
        
        $kategoriat = array();
        
        foreach ($rows as $row) {
            $kategoriat[] = new Kategoria(array(
                'nimi' => $row['nimi']
            ));
        }
        return $kategoriat;
             
    }
    
    public static function findWithName($nimi) {
        $query = DB::connection()->prepare('SELECT * FROM Kategoria WHERE nimi = :nimi');
        $query->execute(array('nimi' => $nimi));
        $row = $query->fetch();

        if ($row) {
            $kategoria = new Kategoria(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
            return $kategoria;
        } else {
            return null;
        }
    }
    
    public function update() {
        $query = DB::connection()->prepare('Update Kategoria SET nimi = :nimi');
        $query->execute(array('id' => $this->id));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Kategoria WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $this->id));
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Kategoria(nimi) VALUES(:nimi) RETURNING id');
        $query->execute(array('nimi' => $this->nimi));

        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    
    
    public function validate_name() {
        $errors = array();
        
        if($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Kategorialla täytyy olla nimi';
        }
        
        if(strlen($this->nimi) < 3) {
            $errors[] = 'Kategorian nimen tulee olla ainakin 3 merkkiä pitkä';
        }
        
        if(strlen($this->nimi) > 30) {
            $errors[] = 'Kategorian nimi saa maksimissaan olla 30 merkkiä pitkä';
        }
        return $errors;
    }
    
    

}
