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

    public static function save() {
        $query = DB::connection()->prepare('INSERT INTO Kayttaja(nimi, salasana) VALUES(:nimi, :salasana)');
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
        $user = User::findWithName($nimi);

        if ($user != null && salasana === $user->salasana) {
            return $user;
        } else {
            return null;
        }
    }

}
