<?php

include_once "libraries/random_str.php";

class User{

    const SessionDays = 1;

    // Constantes de Login
    const LoginOK = 0;
    const LoginBadPass = 10;
    const LoginBadEmail = 20;
    const LoginError = 30;

    // Constantes de SignUp
    const SignUpOK = 1;
    const SignUpBadPass = 11;
    const SignUpBadEmail = 21;
    const SignUpError = 31;

    // Atributos
    private $email = "";

    //Static methods
    public static function restoreSession(){
        $user = new User();
        $today_date = time();

        // Si no ha iniciado sesion salgo
        if(!isset($_COOKIE['token']))
            return $user;

        $token = $_COOKIE['token'];

        // Consigo el email de la base de datos
        $query = "
            SELECT email
            FROM session INNER JOIN user
            WHERE
                token = '$token' AND
                end_date > $today_date
            ;
        ";
        $db = DB::connect();
        $email = $db->query($query)->fetch_array()['email'];
        $user->setEmail($email);

        return $user;
    }

    public static function createSession($user){
        $db = DB::connect();

        $today_time = time();
        $end_time = $today_time + User::SessionDays * 24 * 60 * 60;
        $end_date = date("Y-m-d H:i:s", $end_time);
        $str_generator = new RandomSTRGenerator();

        // Creo un token aleatorio y lo comparo con la base de datos
        $token = $str_generator->generate();
        $query = "SELECT count(*) n FROM session WHERE token = '$token';";
        $token_coincidences = $db->query($query)->fetch_array()['n'];
        while($token_coincidences != 0){
            $token = $str_generator->generate();
            $query = "SELECT count(*) n FROM session WHERE token = '$token';";
            $token_coincidences = $db->query($query)->fetch_array()['n'];
        }

        // Guardo el token en la base de datos
        $id = $user->getId();
        $insert = "INSERT INTO session VALUES ($id, '$token', '$end_date');";
        echo $insert;
        $db->query($insert);

        $db->close();

        // Establezco el nuevo token
        setcookie("token", $token, $end_time);
    }

    public function getEmail(){
        return $this->email;
    }

    public function getId(){
        $query = "SELECT id FROM user WHERE email = '$this->email'";
        $db = DB::connect();
        $id = $db->query($query)->fetch_array()['id'];

        return $id;
    }

    public function setEmail($email){
        $this->email = $email;
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
            User::createSession($this);
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

    public function signup($nick, $email, $password){
        $db = DB::connect();

        // Compruebo si ya existe el email
        $query = "
            SELECT COUNT(*) n
            FROM user
            WHERE
                email = '$email'
            ;
        ";
        $result = $db->query($query);
        $fila = $result->fetch_array();

        if($fila['n'] != 0){
            $db->close();
            return User::SignUpBadEmail;
        }

        $insert = "
            INSERT INTO user (nick, email, password)
            VALUES ('$nick', '$email', '$password');
        ";

        $result = $db->query($insert);

        User::createSession($this);

        return User::SignUpOK;
    }
}

?>
