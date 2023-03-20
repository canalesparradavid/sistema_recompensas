<?php

class User{

    // Constantes de Login
    const LoginOK = 0;
    const LoginBadPass = 1;
    const LoginBadEmail = 2;
    const LoginError = 3;

    // Atributos
    private $email;

    public static function restoreSession(){
        // TODO
        return new User();
    }

    public function login($email, $password){
        $db = DB::connect();

        $query = "
            SELECT COUNT(*) n
            FROM user
            WHERE
                email = '$email' AND
                password = '$password'
            ;
        ";
        $result = $db->query($query);
        $fila = $result->fetch_array();

        // Si no hay 0 ocurrencias es que los datos estan bien
        if($fila['n'] != 0){
            $db->close();
            $this->email = $email;
            return User::LoginOK;
        }

        // Compruebo si el fallo esta en el email
        $query = "
            SELECT COUNT(*) n
            FROM user
            WHERE
                email = '$email'
            ;
        ";
        $result = $db->query($query);
        $fila = $result->fetch_array();

        $db->close();

        if($fila['n'] == 0){
            return User::LoginBadEmail;
        }

        return User::LoginBadPass;
    }
}

?>
