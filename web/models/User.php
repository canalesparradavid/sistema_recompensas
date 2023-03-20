<?php

class User{

    // Constantes de Login
    const LoginOK = 0;
    const LoginBadPass = 1;
    const LoginBadEmail = 2;
    const LoginError = 3;

    public static function restoreSession(){
        // TODO
        return new User();
    }

    public function login($email, $password){
        // TODO
        return User::LoginOK;
    }
}

?>
