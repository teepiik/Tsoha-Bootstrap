<?php

class UserController extends BaseController{
   
   
   public static function login() {
        View::make('login/login.html');
    }
   
   public static function handle_login() {
       $params = $_POST;
       
       $user = User::authenticate($params['nimi'], $params['salasana']);
       
       if(!$user) {
           View::make('login/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana' , 'nimi' =>
               $params['nimi']));
       }
       else {
           $_SESSION['user'] = $user->id;
           
           Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->nimi . '!'));
       }
   }
   
   public static function register() {
       View::make('login/register.html'); 
   }
   
   public static function handle_register() {
       $params = $_POST;
       
       $attributes = array(
           'nimi' => $params['nimi'],
           'salasana' => $params['salasana']
       );
       
       $user = new User($attributes);
       $errors = $user->errors();
       
       if(count($errors) == 0) {
           $user->save();
           Redirect::to('/login', array('message' => 'Loit tunnukset onnistuneesti, voit nyt kirjautua niillä sisään.'));
           
       } else {
           View::make('login/register.html', array('attributes' => $attributes, 'errors' => $errors));
       }
   }
   
   
    public static function tunnusListaus() {
        $kayttajat = User::all();
        View::make('login/kayttajatLista.html', array('kayttajat' => $kayttajat));
    }
    
    
    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/login', array('message' => 'Olet kirjautunut ulos.'));
    }
}

